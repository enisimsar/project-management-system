<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;

class FrontController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getProjects()
    {
        $projects = Project::orderBy('name');
        $projects = $projects->paginate(25);

        return view('projects', compact('projects'));
    }
}
