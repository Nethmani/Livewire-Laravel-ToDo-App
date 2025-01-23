<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo App Template</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-500">
    <div id="head" class="flex border-blue-800 border-t-2">
        <div class="w-full">
            <header class="flex bg-white justify-between h-20 border-b border-b-gray-200 items-center px-6">
                <div id="left-header" class="text-3xl font-semibold text-blue-600">
                    My Todo
                </div>
            </header>
        </div>
    </div>
    <div id="content" class="mx-auto max-w-3xl p-6 w-full bg-blue-100 text-gray-800 rounded shadow-lg mt-6">
        <!-- Form -->
        @livewire('todo-list')
    </div>
    <footer class="mt-6 bg-blue-600 text-white text-center py-4">
        <p>&copy; 2025 My Todo App. All rights reserved.</p>
    </footer>
</body>

</html>
