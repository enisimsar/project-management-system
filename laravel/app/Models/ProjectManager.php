<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\Completed;
use Gbrock\Table\Traits\Sortable;

class ProjectManager extends Authenticatable
{
    use Notifiable, Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['id','name', 'email'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'project_manager_project');
    }

    public static function toSelect($placeholder = null)
    {
        $res = static::orderBy('name')->pluck('name', 'id');
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }

    public static function findByEmail($email)
    {
        return static::where('email', $email)->first();
    }
}
