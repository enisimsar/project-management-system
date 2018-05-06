<?php

namespace App\Http\Controllers\ProjectManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;

class ProjectTaskController extends Controller
{
    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, Task $task)
    {
        //
    }

    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $task->delete();
    }
}
