<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;

use Gbrock\Table\Traits\Sortable;

class Employee extends Model
{
    use Base, Sortable;

    /**
     * The attributes which may be used for sorting dynamically.
     *
     * @var array
     */
    protected $sortable = ['id', 'name', 'created_at'];

    protected $table = 'employees';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['name'];

    public function tasks()
    {
        return $this->belongsToMany('App\Models\Task', 'employee_task');
    }

    public static function toSelect($placeholder = null)
    {
        $res = static::orderBy('name')->pluck('name', 'id');
        return $placeholder ? collect(['' => $placeholder])->union($res) : $res;
    }
}
