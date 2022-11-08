<?php

namespace Suainul\Rabbitmq;


class Rabbitmq
{
    public function publisher()
    {
        return new Publisher;
    }
}