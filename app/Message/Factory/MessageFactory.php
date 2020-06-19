<?php

namespace App\Message\Factory;

use App\Message\Entity\Message;
use Illuminate\Http\Request;

class MessageFactory
{
    public function create(Request $request): Message
    {
        $message = new Message();
        $message->setName($request->input('name'));
        $message->setContent($request->input('content'));
        $message->setPhone($request->input('phone'));

        return $message;
    }
}
