<?php

namespace CreatvStudio\Itexmo\Laravel\Facades;

use Illuminate\Support\Facades\Facade;

class Itexmo extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'itexmo';
    }
}
