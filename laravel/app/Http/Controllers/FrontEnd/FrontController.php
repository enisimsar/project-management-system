<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Employee;

class FrontController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getProjects()
    {
        $rows = Project::sorted()->paginate(20);
        $table = \Table::create($rows);

        $table->addColumn('export', 'Project Link', function ($model) {
            return '<a class="btn btn-primary btn-xs" href="/project/'.$model->id.'" title="Project"><i class="fa fa-external-link"></i></a>';
        });

        $title = 'All Projects';

        return view('projects', compact('table', 'title'));
    }

    public function getEmployees()
    {
        $rows = Employee::sorted()->paginate(20);
        $table = \Table::create($rows);

        $table->addColumn('export', 'Employee Link', function ($model) {
            return '<a class="btn btn-primary btn-xs" href="/employee/' . $model->id . '" title="Employee"><i class="fa fa-external-link"></i></a>';
        });

        $title = 'All Employees';

        return view('employees', compact('table', 'title'));
    }

    public function getProject(Project $project)
    {
        $manager_rows = $project->project_managers()->sorted()->paginate(20);
        $manager_table = \Table::create($manager_rows, ['id', 'name', 'email']);

        $task_rows = $project->tasks()->sorted()->paginate(20);
        $task_table = \Table::create($task_rows, ['id', 'project_id', 'name', 'description', 'started_at', 'duration', 'completed']);

        $title = 'Project: '.$project->name;

        return view('project', compact('title', 'manager_table', 'task_table'));
    }

    public function getEmployee(Employee $employee)
    {
        $task_rows = $employee->tasks()->sorted()->paginate(20);
        $task_table = \Table::create($task_rows, ['id', 'project_id', 'name', 'description', 'started_at', 'duration', 'completed']);

        $title = 'Employee: ' . $employee->name;

        return view('employee', compact('title', 'task_table'));
    }
}
