<?php

namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth:admin');
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
            $projects = Project::hydrate(DB::select('call not_completed_projects(?)', ['ALL']));
        } elseif ($filter == "1") {
            $projects = Project::hydrate(DB::select('call completed_projects(?)', ['ALL']));
        } else {
            $not_completed_projects = Project::hydrate(DB::select('call not_completed_projects(?)', ['ALL']));
            $completed_projects = Project::hydrate(DB::select('call completed_projects(?)', ['ALL']));
            $projects = $completed_projects->merge($not_completed_projects);
        }

        $projects = $projects->sortBy('id');

        $perPage = 25;
        $projects = new Paginator($projects, $perPage);

        return view('admin.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.project.create');
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
            'started_at'      => 'required',
        ]);
        $project = Project::create([
            'name'          => $request->name,
            'description'        => $request->description,
            'started_at'      => $request->started_at,
            
        ]);
        session_success("{$project->name} Project is successfully added.");
        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $managers = Manager::toSelect($placeholder = 'Please, select a project manager.');

        return view('admin.project.show', compact(['project', 'managers']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('admin.project.edit', compact(['project']));
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
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'started_at'      => 'required',
        ]);
        $project->update([
            'name'          => $request->name,
            'description'        => $request->description,
            'started_at'      => $request->started_at,
            
        ]);

        session_success("{$project->name} Project is successfully updated.");
        return redirect()->route('admin.project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return ['status' => 'success', 'message' => 'Successfully Deleted.'];
    }

    public function complete(Request $request, Project $project)
    {
        $project->completed($request->complete);
        return $project;
    }
}
