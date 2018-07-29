<?php

namespace farenas\AdodbConect\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Collective\Html\HtmlBuilder
 */
class AdodbConectFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'farenas\AdodbConect\classAdodb\AdodbConect';
    }
}