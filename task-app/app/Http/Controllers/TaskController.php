<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TaskController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        return Inertia::render('Dashboard', [
            'taskList' => auth()->user()->tasks()->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'task' => 'required|min:3|max:200'
        ]);

        $request->user()->tasks()->create($data);

        return redirect()->back();
    }

    public function update(Request $request, Task $task)
{
    $this->authorize('update', $task); // optional: if using policies

    $request->validate([
        'task' => 'required|min:3|max:200',
    ]);

    $task->update([
        'task' => $request->task,
    ]);

    return redirect()->back();
}


    public function toggleCompleted(Task $task)
{
    $this->authorize('update', $task);

    $task->completed_at = $task->completed_at ? null : now();
    $task->save();

    return redirect()->back();
}

public function remove(Task $task)
{
    $this->authorize('delete', $task);

    $task->delete();
    return redirect()->back();
}
}
