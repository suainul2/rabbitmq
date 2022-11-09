<?php

namespace Suainul\Rabbitmq;

use PhpAmqpLib\Message\AMQPMessage;

class Publisher extends RabbitmqService
{
    private $body = [];
    public function __construct($routing)
    {
        parent::__construct($routing);
    }

    public function direct()
    {
        $this->channel->queue_declare($this->routing, false, false, false, false);
        $msg = new AMQPMessage(json_encode($this->body));
        $this->channel->basic_publish($msg, '', $this->routing);
        $this->close();
    }

    public function fanOut()
    {   
        $this->exchange();
        $msg = new AMQPMessage($this->body);
        $this->channel->basic_publish($msg, $this->routing);
        $this->close();
    }

    public function topic($routing_key = 'anonymous.info')
    {
        $this->exchange("topic");
        $msg = new AMQPMessage($this->body);
        $this->channel->basic_publish($msg, $this->routing, $routing_key);
        $this->close();
    }

    /**
     * Set the value of body
     *
     * @return  self
     */ 
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }
}