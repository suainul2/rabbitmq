<?php

namespace Suainul\Rabbitmq;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqService
{
    protected AMQPChannel $channel;
    protected AMQPStreamConnection $connection;
    protected string $routing;
    public function __construct($routing)
    {
        $this->routing = $routing;
        $this->connection = new AMQPStreamConnection(config('rabbitmq.host'),config('rabbitmq.port') , config('rabbitmq.username'),config('rabbitmq.password'));
        $this->channel = $this->connection->channel();
    }
    protected function exchange($type = 'fanout')
    {
        $this->channel->exchange_declare($this->routing, $type, false, false, false);
        return $this;
    }
    protected function close()
    {
        $this->channel->close();
        $this->connection->close();
    }
}