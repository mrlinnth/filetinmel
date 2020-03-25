<?php

namespace Mrlinnth\Filetinmel\Facades;

use Illuminate\Support\Facades\Facade;

class Filetinmel extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'filetinmel';
    }
}
