<?php

namespace CreatvStudio\Itexmo;

use Illuminate\Support\Fluent;

class Message extends Fluent
{
    protected $priorities = ['NORMAL', 'HIGH'];

    public function priority($priority)
    {
        $priority = strtoupper($priority);

        if (! in_array($priority, $this->priorities)) {
            throw new Exception('Priority must be one of ' . implode($this->priorities, ', '));
        }

        return $this->priority = $priority;
    }
}
