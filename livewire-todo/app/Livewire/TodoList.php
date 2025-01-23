<?php

namespace App\Livewire;

use App\Models\Todo;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{
    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    #[Rule('required|min:3|max:255')]
    public $description;

    #[Rule('required|min:3|max:50')]
    public $EditingNewName;

    #[Rule('required|min:3|max:50')]
    public $EditingNewDescription;

    public $EditingTodoID;
    public $search;
    public $filter = 'all'; // New property for filter

    public function create()
    {
        $this->validate([
            'name' => 'required|min:3|max:50',
            'description' => 'required|min:3|max:255',
        ]);

        Todo::create([
            'name' => $this->name,
            'description' => $this->description,
            'completed' => false, // Default to not completed
        ]);

        $this->reset('name', 'description');
        $this->resetPage();

        session()->flash('success', 'Todo Created Successfully.');
    }

    public function delete($id)
    {
        try {
            Todo::findOrFail($id)->delete();
        } catch (\Throwable $th) {
            session()->flash('error', 'Failed to delete todo!');
            Log::error($th->getMessage());
            return;
        }
    }

    public function edit($id)
    {
        $this->EditingTodoID = $id;
        $todo = Todo::find($id);
        $this->EditingNewName = $todo->name;
        $this->EditingNewDescription = $todo->description;
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();
    }

    public function update()
    {
        $this->validate([
            'EditingNewName' => 'required|min:3|max:50',
            'EditingNewDescription' => 'required|min:3|max:255',
        ]);

        Todo::find($this->EditingTodoID)->update([
            'name' => $this->EditingNewName,
            'description' => $this->EditingNewDescription,
        ]);
        $this->cancel();
    }

    public function cancel()
    {
        $this->reset('EditingTodoID', 'EditingNewName', 'EditingNewDescription');
    }

    public function render()
    {
        $query = Todo::latest()->where('name', 'like', "%{$this->search}%");

        if ($this->filter === 'completed') {
            $query->where('completed', true);
        } elseif ($this->filter === 'pending') {
            $query->where('completed', false);
        }

        return view('livewire.todo-list', [
            'todos' => $query->paginate(5),
        ]);
    }
}
