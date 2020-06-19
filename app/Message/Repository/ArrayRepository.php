<?php

namespace App\Message\Repository;

use App\Message\Entity\Message;
use App\Message\Exception\NotFoundException;

class ArrayRepository implements RepositoryInterface
{
    /** @var Message[] */
    private array $messages;

    public function get(int $id): Message
    {
        $this->guardHas($id);

        return $this->messages[$id];
    }

    public function all(): array
    {
        return $this->messages;
    }

    public function add(Message $message): void
    {
        $id = count($this->messages);
        $message->setId($id);
        $this->messages[$id] = $message;
    }

    public function remove($message): void
    {
        $this->guardHas($message);

        unset($this->messages[$message->getId()]);
    }

    /**
     * @return Message|null
     * @throws NotFoundException
     */
    public function last(): ?Message
    {
        $id = count($this->messages) - 1;

        $this->guardHas($id);

        return $this->messages[count($this->messages) - 1];
    }

    /**
     * @param int|Message
     * @return bool
     */
    public function has($id): bool
    {
        if($id instanceof Message) {
            $id = $id->getId();
        }

        return !!$this->messages[$id];
    }

    /**
     * @param int|Message $id
     * @throws NotFoundException
     * @return void
     */
    private function guardHas($id): void
    {
        if(!$this->has($id)) {
            throw new NotFoundException();
        }
    }
}
