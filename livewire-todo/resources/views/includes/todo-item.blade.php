<div>
    <!-- Check if there's an error session message and display it -->
    @if (session('error'))
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <!-- Error icon -->
                <div class="py-1"><svg class="fill-current h-6 w-6 text-red-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    <!-- Error message title -->
                    <p class="font-bold">Error</p>
                    <!-- Display the actual error message -->
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
    
    <!-- Include the todo creation form -->
    @include('includes.create-todo-list')
    
    <!-- Include the search box for filtering todos -->
    @include('includes.search-box')

    <div id="todos-list">
        <!-- Include todo card view for each todo item -->
        @include('includes.todo-card', ['todo' => $todo])

        <div class="my-2">
            <!-- Display pagination links for navigating through the todo list -->
            {{ $todos->links() }}
        </div>
    </div>
</div>
