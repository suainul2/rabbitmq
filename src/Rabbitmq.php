<?php

namespace Suainul\Rabbitmq;
class Rabbitmq
{
    private string $routing = "";
    public function setRouting(string $routing)
    {
        $this->routing = $routing;
        return $this;
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