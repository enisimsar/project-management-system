<?php

namespace App\Http\Controllers\ProjectManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectManager as Manager;

use DB;
use Illuminate\Pagination\Paginator;

class ProjectController extends Controller
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
    public function index(Request $request)
    {
        $filter = $request->filter;
        $projects = null;
        if ($filter == "-1") {
            $projects = Project::hydrate(DB::select('call not_completed_projects(?)', [\Auth::guard('web')->user()->id]))->toBase();
        } elseif ($filter == "1") {
            $projects = Project::hydrate(DB::select('call completed_projects(?)', [\Auth::guard('web')->user()->id]))->toBase();
        } else {
            $not_completed_projects = Project::hydrate(DB::select('call not_completed_projects(?)', ['ALL']))->toBase();
            $completed_projects = Project::hydrate(DB::select('call completed_projects(?)', ['ALL']));
            $projects = $completed_projects->toBase()->merge($not_completed_projects);
        }

        $projects = $projects->sortByDesc('id');

        $perPage = 25;
        $projects = new Paginator($projects, $perPage);

        return view('manager.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.blank');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return view('manager.blank');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $tasks = Task::toSelect($placeholder = 'Please, select a task.');

        return view('manager.project.show', compact(['project', 'tasks']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('manager.blank', compact(['project']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        return view('manager.blank');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }

    public function complete(Request $request, Project $project)
    {
        $project->completed($request->complete);
        return $project;
    }
}
