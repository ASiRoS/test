<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MessageResource as MessageResource;
use App\Message\Factory\MessageFactory;
use App\Message\Repository\RepositoryInterface;
use Illuminate\Http\Request;

class MessageController
{
    public function index(RepositoryInterface $repository): array
    {
        return [
            'data' => MessageResource::collection($repository->all())
        ];
    }

    public function show(int $id, RepositoryInterface $repository): MessageResource
    {
        return new MessageResource($repository->get($id));
    }

    public function store(Request $request, MessageFactory $factory, RepositoryInterface $repository): MessageResource
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'phone' => 'required'
        ]);

        $message = $factory->create($request);
        $repository->add($message);

        return new MessageResource($message);
    }

    public function destroy(int $id, RepositoryInterface $repository): void
    {
        $repository->remove($id);
    }
}
