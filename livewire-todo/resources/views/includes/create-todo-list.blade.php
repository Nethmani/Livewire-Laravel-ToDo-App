<div class="container content py-6 mx-auto">
    <!-- Center the content horizontally -->
    <div class="mx-auto">
        <!-- Form container with styling -->
        <div id="create-form" class="hover:shadow p-6 bg-white border-blue-500 border-t-2 rounded">
            <!-- Form heading -->
            <div class="flex">
                <h2 class="font-semibold text-lg text-gray-800 mb-5">Create New Todo</h2>
            </div>
            <div>
                <form>
                    <!-- Todo Title -->
                    <div class="mb-6">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Todo Title</label>
                        <!-- Input field for the todo title -->
                        <input wire:model="name" type="text" id="title" placeholder="Enter todo title..."
                            class="bg-gray-100 text-gray-900 text-sm rounded block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500">
                        <!-- Validation error message for 'name' -->
                        @error('name')
                            <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Todo Description -->
                    <div class="mb-6">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                        <!-- Input field for the todo description -->
                        <textarea wire:model="description" id="description" placeholder="Enter todo description..."
                            class="bg-gray-100 text-gray-900 text-sm rounded block w-full p-2.5 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <!-- Validation error message for 'description' -->
                        @error('description')
                            <span class="text-red-500 text-xs mt-3 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button wire:click.prevent="create" type="submit"
                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded hover:bg-blue-600 disabled:opacity-50"
                        wire:loading.attr="disabled">Create +</button>

                    <!-- Success Message -->
                    @if (session('success'))
                        <span 
                            x-data="{ show: true }" 
                            x-init="setTimeout(() => show = false, 2000)" 
                            x-show="show" 
                            class="text-green-500 text-xs mt-3 block">
                            {{ session('success') }}
                        </span>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
