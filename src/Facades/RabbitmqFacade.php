<?php

namespace Suainul\Rabbitmq\Facades;

use Illuminate\Support\Facades\Facade;
use Suainul\Rabbitmq\Rabbitmq;

class RabbitmqFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'rabbitmq';
    }
}