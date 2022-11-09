<?php

namespace Suainul\Rabbitmq;
class Rabbitmq
{
    private string $routing = "";
    public function setRouting($routing)
    {
        $this->routing = $routing;
    }
    public function publisher()
    {
        return new Publisher($this->routing);
    }
    public function consumer()
    {
        return new Consumer($this->routing);
    }
}