<?php

namespace App\Http\Controllers\ProjectManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Task;

class EmployeeTaskController extends Controller
{
    public function store(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $task = Task::findOrFail($request->task_id);
        $employee->tasks()->attach($task);
        return [
            'employee_id' => $employee->id,
            'employee_name' => $employee->name,
            'task_id' => $task->id,
            'task_name' => $task->name,
            'task_description' => $task->description,
            'task_started_at' => date('d.m.Y', strtotime($task->started_at)),
            'task_duration' => $task->duration,
        ];
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(Request $request)
    {
        $employee = Employee::findOrFail($request->employee_id);
        $task = Task::findOrFail($request->task_id);
        $employee->tasks()->detach($task);
        return ['status' => 'success', 'message' => 'Successfully detached'];
    }
}
