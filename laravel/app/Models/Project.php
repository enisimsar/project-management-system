<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;
use App\Traits\Completed;

class Project extends Model
{
    use Base, DatePicker, Completed;

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

    public static function toSelect($manager, $placeholder = null)
    {
        $res = $manager->projects()->where('completed', false)->orderBy('name')->pluck('name', 'id');
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }
}
