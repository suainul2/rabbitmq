<?php

namespace Suainul\Rabbitmq;


class Rabbitmq
{
    public function publisher()
    {
        return new Publisher;
    }
    public function consumer()
    {
        return new Consumer;
    }
}