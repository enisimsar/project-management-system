<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;

class Task extends Model
{
    use Base, DatePicker;

    protected $table = 'tasks';

    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'started_at'];

    protected $fillable = ['project_id', 'decription', 'started_at', 'duration', 'completed'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'employee_task');
    }
}
