<?php

namespace App\Message\Repository;

use App\Message\Entity\Message;
use App\Message\Exception\NotFoundException;

interface RepositoryInterface
{
    /**
     * @param int $id
     * @return Message
     * @throws NotFoundException
     */
    public function get(int $id): Message;

    /**
     * @return Message[]
     */
    public function all(): array;

    /**
     * @param Message $message
     * @return Message
     */
    public function add(Message $message): void;

    /**
     * @param int|Message $message
     * @throws NotFoundException
     * return void
     */
    public function remove($message): void;
}
