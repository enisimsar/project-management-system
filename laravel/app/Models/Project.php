<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;
use App\Traits\Completed;

use Gbrock\Table\Traits\Sortable;

class Project extends Model
{
    use Base, DatePicker, Completed, Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['id', 'name', 'description', 'started_at', 'completed', 'created_at'];

    protected $table = 'projects';

    protected $dates = ['created_at', 'updated_at', 'started_at'];

    protected $fillable = ['name', 'started_at', 'description', 'completed'];

    public function project_managers()
    {
        return $this->belongsToMany('App\Models\ProjectManager', 'project_manager_project');
    }

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    protected function getRenderedCompletedAttribute()
    {
        return $this->completed ? 'Yes' : 'No';
    }

    protected function getRenderedCreatedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->created_at));
    }

    protected function getRenderedStartedAtAttribute()
    {
        return date('d.m.Y', strtotime($this->started_at));
    }

    public function setStartedAttribute($date)
    {
        return $date ?
            $this->attributes['started_at'] = Carbon::createFromFormat('d.m.Y', $date)->toDateString() :
            null;
    }

    public function getStartedAtAttribute()
    {
        return $this->attributes['started_at'] ?
            date('d.m.Y', strtotime($this->attributes['started_at'])) :
            null;
    }

    public static function toSelect($manager, $placeholder = null)
    {
        $res = $manager->projects()->where('completed', false)->orderBy('name')->pluck('name', 'id');
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }
}
