<?php

namespace App\Message\Repository;

use App\Message\Entity\Message;
use App\Message\Hydrator\ArrayHydrator;
use App\Message\Hydrator\MessageHydrator;

class DatabaseRepository implements RepositoryInterface
{
    public function get(int $id): Message
    {
        /** @var Message $message */
        $message = Message::findOrFail($id);
        MessageHydrator::hydrate($message, $message);

        return $message;
    }

    public function all(): array
    {
        return array_map(
            fn(array $from) => ArrayHydrator::hydrate($from),
            Message::all()->toArray()
        );
    }

    public function add(Message $message): void
    {
        $id = Message::create([
            'name' => $message->getName(),
            'content' => $message->getContent(),
            'phone' => $message->getPhone(),
        ])->id;

        $message->setId($id);
    }

    public function remove($message): void
    {
        $id = $message instanceof Message ? $message->getId() : $message;

        Message::destroy($id);
    }
}
