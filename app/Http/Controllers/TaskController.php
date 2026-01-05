<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $view = $request->get('view', 'all');
        $search = $request->get('search');

        $query = Task::query();

        // Search (partial match)
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($view === 'pending') {
            $query->where('status', 'Pending');
        } elseif ($view === 'completed') {
            $query->where('status', 'Completed');
        }

        // Priority ordering: High → Medium → Low
        $query->orderByRaw("
            CASE priority
                WHEN 'High' THEN 1
                WHEN 'Medium' THEN 2
                WHEN 'Low' THEN 3
            END
        ")->orderBy('created_at', 'desc');

        $tasks = $query->get();

        $pendingCount = Task::where('status', 'Pending')->count();
        $completedCount = Task::where('status', 'Completed')->count();

        return view('tasks.index', compact(
            'tasks',
            'pendingCount',
            'completedCount',
            'view',
            'search'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'status' => 'Pending',
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task added');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

  
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|in:Low,Medium,High',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }

    public function toggleStatus(Task $task)
    {
        $task->status = $task->status === 'Pending'
            ? 'Completed'
            : 'Pending';

        $task->save();

        return redirect()->route('tasks.index');
    }
}
