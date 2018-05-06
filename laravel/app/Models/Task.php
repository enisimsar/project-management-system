<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;
use App\Traits\Completed;

class Task extends Model
{
    use Base, DatePicker, Completed;

    protected $table = 'tasks';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'started_at'];

    protected $fillable = ['project_id', 'name', 'description', 'started_at', 'duration', 'completed'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'employee_task');
    }

    public static function toSelect($placeholder = null, $manager = null)
    {
        if ($manager) {
            $projects = $manager->projects()->where('completed', false)->get();
            $project_ids = [];
            foreach ($projects as $project) {
                $project_ids[] = $project->id;
            }
            $res = static::where('completed', false)->whereIn('project_id', $project_ids)->orderBy('name')->pluck('name', 'id');
        } else {
            $res = static::orderBy('name')->pluck('name', 'id');
        }
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }
}
