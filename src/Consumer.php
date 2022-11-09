<?php

namespace Suainul\Rabbitmq;
class Consumer extends RabbitmqService
{
    public function __construct($routing)
    {
        parent::__construct($routing);
    }

    public function direct($callback)
    {
        $this->channel->queue_declare($this->routing, false, false, false, false);
        $this->channel->basic_consume($this->routing, '', false, true, false, false, $callback);
        while ($this->channel->is_open()) {
            $this->channel->wait();
        }
        $this->close();
    }

    public function fanOut($callback)
    {   
        $this->exchange();
        
        list($queue_name, ,) = $this->channel->queue_declare("", false, false, true, false);

        $this->channel->queue_bind($queue_name, $this->routing);

        $this->channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }

        $this->close();
    }

    public function topic($binding_keys = [],$callback)
    {
        $this->exchange('topic');
        list($queue_name, ,) = $this->channel->queue_declare("", false, false, true, false);

        foreach ($binding_keys as $binding_key) {
            $this->channel->queue_bind($queue_name, $this->routing, $binding_key);
        }

        $this->channel->basic_consume($queue_name, '', false, true, false, false, $callback);

        while ($this->channel->is_open()) {
            $this->channel->wait();
        }

        $this->close();
    }
}