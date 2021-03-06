<?php

namespace App\Http\Controllers\ProjectManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Project;
use App\Models\Employee;
use Carbon\Carbon;

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
        $projects = \Auth::guard('web')->user()->projects()->get();
        $project_ids = [];
        foreach ($projects as $project) {
            $project_ids[] = $project->id;
        }
        $tasks = Task::whereIn('project_id', $project_ids)->orderBy('name');
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
        $projects = Project::toSelect(\Auth::guard('web')->user(), $placeholder = 'Please, select a project.');
        return view('manager.task.create', compact(['projects']));
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
            'description' => 'required|max:255',
            'started_at' => 'required',
            'duration' => 'required|integer',
            'project_id' => 'required|integer',
        ]);
        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'started_at' => $request->started_at,
            'duration' => $request->duration,
            'project_id' => $request->project_id
        ]);
        session_success("{$task->name} Task is successfully added.");
        return redirect()->route('manager.task.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $employees = Employee::toSelect($placeholder = 'Please, select a Employee.');

        return view('manager.task.show', compact(['task', 'employees']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $projects = Project::toSelect(\Auth::guard('web')->user(), $placeholder = 'Please, select a project.');
        return view('manager.task.edit', compact(['task', 'projects']));
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
            'description' => 'required|max:255',
            'started_at' => 'required',
            'duration' => 'required',
        ]);
        $employees = $task->employees;
        $start_date = Carbon::createFromFormat('d.m.Y', $request->started_at);
        $end_date = $start_date->addDays($request->duration);
        foreach ($employees as $employee) {
            $sql = "
            SELECT DISTINCT tasks.id, duration, started_at, DATE_ADD(started_at, INTERVAL duration DAY) as ended_at 
            FROM tasks JOIN employee_task 
            ON tasks.id = employee_task.task_id
            WHERE employee_task.employee_id = ? 
            AND ((tasks.started_at BETWEEN ? AND ?)
            OR (? BETWEEN tasks.started_at AND DATE_ADD(tasks.started_at, INTERVAL duration DAY)));";

            $tasks = \DB::select($sql, [$employee->id, $start_date, $end_date, $start_date]);
            if (count($tasks) > 0) {
                session_error("{$employee->name} is busy with another task in this period.");
                return back();
            }
        }
        $task->update([
            'description' => $request->description,
            'started_at' => $request->started_at,
            'duration' => $request->duration
        ]);
        session_success("{$task->name} Task is successfully updated.");
        return redirect()->route('manager.task.index');
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

    public function complete(Request $request, Task $task)
    {
        $task->completed($request->complete);
        return $task;
    }
}
