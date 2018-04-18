<?php
namespace App\Traits;

use Carbon\Carbon;

trait DatePicker
{
    public function setStartedAtAttribute($date)
    {
        return $date ?
            $this->attributes['started_at'] = Carbon::createFromFormat('d.m.Y', $date)->toDateString() :
            null;
    }
    public function getStartedAtLabelAttribute()
    {
        return $this->attributes['started_at'] ?
            date('d.m.Y', strtotime($this->attributes['started_at'])) :
            null;
    }
}
