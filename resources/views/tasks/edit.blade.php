@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Edit Task</h2>
        
        <form action="{{ route('tasks.update', [$project, $task]) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Task Name</label>
                <input type="text" name="name" id="name" value="{{ $task->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="{{ route('tasks.index', $project) }}" class="px-4 py-2 border rounded-md hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
@endsection