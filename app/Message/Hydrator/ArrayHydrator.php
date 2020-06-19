<?php

namespace App\Message\Hydrator;

use App\Message\Entity\Message;

class ArrayHydrator
{
    public static function hydrate(array $from): Message
    {
        $message = new Message();
        $message->setId($from['id']);
        $message->setName($from['name']);
        $message->setPhone($from['phone']);
        $message->setContent($from['content']);

        return $message;
    }
}
