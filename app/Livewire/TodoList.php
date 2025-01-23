<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination; // Include pagination functionality

    #[Rule('required|min:3|max:50')]
    public $name; // Holds the name of the new todo

    #[Rule('required|min:3|max:255')]
    public $description; // Holds the description of the new todo

    #[Rule('required|min:3|max:50')]
    public $EditingNewName; // Holds the updated name for an existing todo

    #[Rule('required|min:3|max:50')]
    public $EditingNewDescription; // Holds the updated description for an existing todo

    public $EditingTodoID; // Holds the ID of the todo being edited
    public $search; // Holds the search term for filtering todos
    public $filter = 'all'; // Filter property to toggle between all, completed, or pending todos

    // Create a new todo
    public function create()
    {
        // Validate input fields
        $this->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:255',
        ]);

        // Add a new todo to the database
        Todo::create([
            'name' => $this->name,
            'description' => $this->description,
            'completed' => false, // Set the default state to not completed
        ]);

        // Reset input fields and pagination
        $this->reset('name', 'description');
        $this->resetPage();

        // Display a success message
        session()->flash('success', 'Todo Created Successfully.');
    }

    // Delete a todo by ID
    public function delete($id)
    {
        try {
            // Find the todo by ID and delete it
            Todo::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            // Handle deletion errors, log them, and display an error message
            session()->flash('error', 'Failed to delete todo!');
            Log::error($th->getMessage());
            return;
        }
    }

    // Edit a todo by ID
    public function edit($id)
    {
        $this->EditingTodoID = $id; // Store the ID of the todo being edited
        $todo = Todo::find($id); // Fetch the todo from the database
        $this->EditingNewName = $todo->name; // Pre-fill the name field for editing
        $this->EditingNewDescription = $todo->description; // Pre-fill the description field for editing
    }

    // Toggle the completion status of a todo
    public function toggle($id)
    {
        $todo = Todo::find($id); // Find the todo by ID
        $todo->completed = !$todo->completed; // Toggle the completed status
        $todo->save(); // Save the updated status
    }

    // Update an existing todo
    public function update()
    {
        // Validate the updated fields
        $this->validate([
            'EditingNewName' => 'required|min:3|max:50',
            'EditingNewDescription' => 'required|min:3|max:255',
        ]);

        // Update the todo in the database
        Todo::find($this->EditingTodoID)->update([
            'name' => $this->EditingNewName,
            'description' => $this->EditingNewDescription,
        ]);

        $this->cancel(); // Reset the editing fields
    }

    // Cancel the edit operation
    public function cancel()
    {
        $this->reset('EditingTodoID', 'EditingNewName', 'EditingNewDescription'); // Clear all editing-related fields
    }

    // Render the Livewire component
    public function render()
    {
        // Build a query to fetch todos based on the search term
        $query = Todo::latest()->where('name', 'like', "%{$this->search}%");

        // Apply filters based on the completion status
        if ($this->filter === 'completed') {
            $query->where('completed', true); // Fetch only completed todos
        } elseif ($this->filter === 'pending') {
            $query->where('completed', false); // Fetch only pending todos
        }

        // Return the view with the paginated todos
        return view('livewire.todo-list', [
            'todos' => $query->paginate(5),
        ]);
    }
}
