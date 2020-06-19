<?php

namespace App\Message\Hydrator;

use App\Message\Entity\Message;

class MessageHydrator
{
    public static function hydrate(Message $from, Message $to): void
    {
        $to->setId($from->id);
        $to->setName($from->name);
        $to->setContent($from->content);
        $to->setPhone($from->phone);
    }
}
