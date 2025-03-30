<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <nav class="mb-8 flex justify-between items-center">
            <a href="{{ route('projects.index') }}" class="text-xl font-bold">Task Manager</a>
            <div class="space-x-4">
                <a href="{{ route('projects.index') }}" class="text-blue-500 hover:text-blue-700">Projects</a>
                <a href="{{ route('projects.create') }}" class="text-blue-500 hover:text-blue-700">Add Project</a>
            </div>
        </nav>
        
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @yield('content')
    </div>
</body>
</html>