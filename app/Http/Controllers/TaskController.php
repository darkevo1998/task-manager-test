<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index(Project $project)
    {
        $tasks = $project->tasks;
        $projects = Project::all();
        return view('tasks.index', compact('tasks', 'project', 'projects'));
    }

    public function create(Project $project)
    {
        $projects = Project::all();
        return view('tasks.create', compact('project', 'projects'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $priority = $project->tasks()->max('priority') + 1;
        
        $project->tasks()->create([
            'name' => $request->name,
            'priority' => $priority,
        ]);

        return redirect()->route('tasks.index', $project)->with('success', 'Task created successfully.');
    }

    public function edit(Project $project, Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('project', 'task', 'projects'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $task->update($request->validated());
        return redirect()->route('tasks.index', $project)->with('success', 'Task updated successfully.');
    }

    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        
        // Reorder remaining tasks
        $project->tasks()
            ->where('priority', '>', $task->priority)
            ->decrement('priority');
            
        return redirect()->route('tasks.index', $project)->with('success', 'Task deleted successfully.');
    }

    public function reorder(Project $project)
    {
        $taskIds = request()->input('taskIds');
        
        foreach ($taskIds as $index => $taskId) {
            Task::where('id', $taskId)->update(['priority' => $index + 1]);
        }
        
        return response()->json(['success' => true]);
    }
}