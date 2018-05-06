<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Base;

class Employee extends Model
{
    use Base;

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
