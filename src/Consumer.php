<?php

namespace Suainul\Rabbitmq;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class Consumer extends RabbitmqService
{
    private $routing = "";
    public function __constructor($routing)
    {
        parent::__constructor();
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