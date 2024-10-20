<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::withTrashed()->get();
        return view("tasks.index", compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("tasks.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return back()->with('success', 'Task Created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view("tasks.show", compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view("tasks.edit", compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        if($request->has('status')){
            $data['status'] = true;
        }else{
            $data['status'] = false;
        }

        $task->update($data);
        return back()->with('success', 'Task Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task Deleted successfully');
    }

    public function forceDelete(string $id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->forceDelete();
        return back()->with('success', 'Task Force Deleted successfully');
    }

    public function restore(string $id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        return back()->with('success', 'Task Restored from Soft Deleted successfully');
    }
}