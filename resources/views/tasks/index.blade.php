@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Tasks for {{ $project->name }}</h2>
        <a href="{{ route('tasks.create', $project) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Task</a>
    </div>
    
    <div class="mb-4">
        <label for="project-select" class="block text-sm font-medium text-gray-700">Switch Project:</label>
        <select id="project-select" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
            @foreach($projects as $p)
                <option value="{{ route('tasks.index', $p) }}" {{ $p->id === $project->id ? 'selected' : '' }}>{{ $p->name }}</option>
            @endforeach
        </select>
    </div>
    
    <div id="task-list" class="bg-white rounded-lg shadow overflow-hidden">
        @foreach($tasks as $task)
            <div data-task-id="{{ $task->id }}" class="border-b p-4 flex justify-between items-center hover:bg-gray-50 task-item">
                <div class="flex items-center">
                    <span class="text-gray-500 mr-4">#{{ $task->priority }}</span>
                    <span>{{ $task->name }}</span>
                </div>
                <div class="flex space-x-2">
                    <a href="{{ route('tasks.edit', [$project, $task]) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form action="{{ route('tasks.destroy', [$project, $task]) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    
    @if($tasks->isEmpty())
        <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
            No tasks yet. <a href="{{ route('tasks.create', $project) }}" class="text-blue-500">Create one</a>.
        </div>
    @endif
@endsection

@push('scripts')
    <script>
        document.getElementById('project-select').addEventListener('change', function() {
            window.location.href = this.value;
        });
        
        const taskList = document.getElementById('task-list');
        new Sortable(taskList, {
            animation: 150,
            handle: '.task-item',
            onEnd: function() {
                const taskIds = Array.from(taskList.querySelectorAll('.task-item')).map(item => item.dataset.taskId);
                
                fetch("{{ route('tasks.reorder', $project) }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ taskIds })
                });
            }
        });
    </script>
@endpush