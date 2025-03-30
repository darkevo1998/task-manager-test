@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Projects</h1>
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Project</a>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Select a Project</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($projects as $project)
                <a href="{{ route('tasks.index', $project) }}" class="block p-4 border rounded-lg hover:bg-gray-50">
                    <h3 class="font-medium">{{ $project->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $project->tasks->count() }} tasks</p>
                </a>
            @endforeach
        </div>
    </div>
@endsection