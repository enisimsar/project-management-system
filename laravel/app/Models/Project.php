<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;
use App\Traits\DatePicker;
use Carbon\Carbon;

use Gbrock\Table\Traits\Sortable;

class Project extends Model
{
    use Base, DatePicker, Sortable;

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
        $sql = "
            SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
            FROM tasks
            WHERE tasks.project_id = ?
            GROUP BY project_id
        ";

        $ended_at = \DB::select($sql, [$this->attributes['id']]);

        $bool = count($ended_at) > 0 ?
            new Carbon($ended_at[0]->ended_at) < Carbon::now() :
            false;

        return $bool ? 'Yes' : 'No';
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
        $sql = "
            SELECT project_id, MAX(DATE_ADD(tasks.started_at, INTERVAL tasks.duration DAY)) as ended_at
            FROM tasks
            WHERE tasks.project_id = ?
            GROUP BY project_id
        ";

        $ended_at = \DB::select($sql, [$this->attributes['id']]);

        if (count($ended_at) > 0) {
            $ended_at = new Carbon($ended_at[0]->ended_at);
            if ($ended_at < Carbon::now()) {
                return 'Yes';
            }
        }

        return 'No';
    }

    public static function toSelect($manager, $placeholder = null)
    {
        $res = $manager->projects()->where('completed', false)->orderBy('name')->pluck('name', 'id');
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }
}
