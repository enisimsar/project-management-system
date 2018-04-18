<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;

class Project extends Model
{
    use Base, DatePicker;

    protected $table = 'projects';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'started_at'];

    protected $fillable = ['name', 'started_at', 'description', 'completed'];

    public function project_managers()
    {
        return $this->belongsToMany('App\Models\ProjectManager', 'project_manager_project');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
