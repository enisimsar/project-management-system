<?php

namespace App\Http\Controllers\ProjectManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('name');
        $tasks = $tasks->paginate(25);

        return view('manager.task.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:project_managers',
            'password' => 'required|min:6|confirmed',
        ]);
        $task = Task::create([
            'name'          => $request->name,
            'email'        => $request->email,
            'password'      => bcrypt($request->password),
            
        ]);
        session_success("{$task->name} Task is successfully added.");
        return redirect()->route('manager.task.show', $task->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('manager.task.show', compact(['task']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('manager.task.edit', compact(['task']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
        ]);
        $task->update([
            'name'          => $request->name,
            'password'      => bcrypt($request->password),
        ]);
        session_success("{$task->name} Task is successfully updated.");
        return redirect()->route('manager.task.show', $task->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return ['status' => 'success', 'message' => 'Successfully Deleted.'];
    }
}
