<?php

namespace Suainul\Rabbitmq;
class Rabbitmq
{
    public function publisher($routing)
    {
        return new Publisher($routing);
    }
    public function consumer($routing)
    {
        return new Consumer($routing);
    }
}