<?php

namespace App\Traits;

trait Completed
{
    public function completed($completed = true)
    {
        if ($completed) {
            $this->completed = true;
        } else {
            $this->completed = false;
        }
        return $this->save();
    }

    public function isCompleted()
    {
        return $this->completed;
    }
}
