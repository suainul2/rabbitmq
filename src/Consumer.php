<?php

namespace Suainul\Rabbitmq;
class Consumer extends RabbitmqService
{
    private $routing = "";
    public function __construct($routing)
    {
        parent::__construct();
        $this->routing = $routing;
    }

    public function direct($callback)
    {
        $this->channel->queue_declare($this->routing, false, false, false, false);
        $this->channel->basic_consume($this->routing, '', false, true, false, false, $callback);
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
    }
}