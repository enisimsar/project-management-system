<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;
use Gbrock\Table\Traits\Sortable;
use Carbon\Carbon;

class Task extends Model
{
    use Base, DatePicker, Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['id', 'name', 'project_id', 'description', 'started_at', 'duration', 'completed'];

    protected $table = 'tasks';

    protected $dates = ['created_at', 'updated_at', 'started_at'];

    protected $fillable = ['project_id', 'name', 'description', 'started_at', 'duration', 'completed'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function employees()
    {
        return $this->belongsToMany('App\Models\Employee', 'employee_task');
    }

    protected function getRenderedCompletedAttribute()
    {
        $ended_at = (new Carbon($this->started_at))->addDays($this->duration);

        return $ended_at < Carbon::now() ? 'Yes' : 'No';
    }

    protected function getRenderedDurationAttribute()
    {
        return $this->duration.' Days';
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

    public function getCompletedAttribute()
    {
        $ended_at = (new Carbon($this->started_at))->addDays($this->duration);

        return $ended_at < Carbon::now() ? 'Yes' : 'No';
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
