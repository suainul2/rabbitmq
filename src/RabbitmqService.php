<?php

namespace Suainul\Rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitmqService
{
    protected $channel,$connection;
    public function __construct()
    {
        $this->connection = new AMQPStreamConnection(config('rabbitmq.host'),config('rabbitmq.port') , config('rabbitmq.username'),config('rabbitmq.password'));
        $this->channel = $this->connection->channel();
    }
}