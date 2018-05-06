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

        $start_date = $task->started_at;
        $end_date = $task->started_at->addDays($task->duration);
        $sql = "
            SELECT DISTINCT tasks.id, duration, started_at, DATE_ADD(started_at, INTERVAL duration DAY) as ended_at 
            FROM tasks JOIN employee_task 
            ON tasks.id = employee_task.task_id
            AND employee_task.employee_id = ? 
            AND ((tasks.started_at BETWEEN ? AND ?)
            OR (? BETWEEN tasks.started_at AND DATE_ADD(tasks.started_at, INTERVAL duration DAY)));";

        $tasks = \DB::select($sql, [$employee->id, $start_date, $end_date, $start_date]);
        if (count($tasks) > 0) {
            dd('Error! In this period this employee is busy with another task!');
        }

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
