<?php

namespace App\Message\Repository;

use App\Http\Resources\MessageResource;
use App\Message\Entity\Message;
use App\Message\Exception\NotFoundException;
use App\Message\Hydrator\ArrayHydrator;
use App\Message\Storage\File;

class FileRepository implements RepositoryInterface
{
    private File $file;

    public function __construct()
    {
        $this->file = new File('messages.txt', [
            'id',
            'name',
            'phone',
            'content'
        ]);
    }

    public function get(int $id): Message
    {
        $this->guardHas($id);

        $row = $this->file->getRowWithConditions([
            'id' => $id
        ]);

        return ArrayHydrator::hydrate($row);
    }

    public function all(): array
    {
        return array_map(
            'App\Message\Hydrator\ArrayHydrator::hydrate',
            $this->file->getRows()
        );
    }

    public function add(Message $message): void
    {
        $id = $this->file->generateId();
        $message->setId($id);

        $content = (new MessageResource($message))->toArray(null);
        $this->file->append($content);
    }

    public function remove($message): void
    {
        $this->guardHas($message);

        $id = $message instanceof Message ? $message->getId() : $message;

        $this->file->remove([
            'id' => $id
        ]);
    }

    public function has($id): bool
    {
        if($id instanceof Message) {
            $id = $id->getId();
        }

        $row = $this->file->getRowWithConditions([
            'id' => $id
        ]);

        return !is_null($row);
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
