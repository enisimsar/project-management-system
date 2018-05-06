<?php
namespace App\Traits;

use Auth;
use Schema;
use Carbon\Carbon;

trait Base
{
    public function getCreatedAtLabelAttribute()
    {
        return date('d.m.Y H:i', strtotime($this->attributes['created_at']));
    }
    public function getUpdatedAtLabelAttribute()
    {
        return date('d.m.Y H:i', strtotime($this->attributes['updated_at']));
    }
}
