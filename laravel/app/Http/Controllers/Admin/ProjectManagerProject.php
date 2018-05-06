<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectManager as Manager;
use Carbon\Carbon;

class ProjectManagerProjectController extends Controller
{
    public function store(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $manager = Manager::findOrFail($request->manager_id);

        foreach ($manager->projects as $manager_project) {
            if ($manager_project->id == $project->id) {
                dd('This project manager has been already added to this project.');
            }
        }

        $project->project_managers()->attach($manager);
        return [
            'project_id' => $project->id,
            'project_name' => $project->name,
            'manager_id' => $manager->id,
            'manager_name' => $manager->name,
        ];
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(Request $request)
    {
        $project = Project::findOrFail($request->project_id);
        $manager = Manager::findOrFail($request->manager_id);
        $project->project_managers()->detach($manager);
        return ['status' => 'success', 'message' => 'Successfully detached'];
    }
}
