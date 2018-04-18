<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Schema;
use Carbon\Carbon;

trait Base
{
    use SoftDeletes;

    public function getCreatedAtLabelAttribute()
    {
        return date('d.m.Y H:i', strtotime($this->attributes['created_at']));
    }
    public function getUpdatedAtLabelAttribute()
    {
        return date('d.m.Y H:i', strtotime($this->attributes['updated_at']));
    }
}
