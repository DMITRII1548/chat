<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Http\Resources\Message\MessageResource;
use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

use function PHPUnit\Framework\isEmpty;

class MessageController extends Controller
{
    public function index(Chat $chat): array
    {
        $messages = $chat->messages()->get();

        return MessageResource::collection($messages)->resolve();
    }

    public function store(Chat $chat, StoreRequest $request): array
    {
        $data = $request->validated();
        $user = Auth::user();

        $message = Message::create([
            'body' => $data['body'],
            'user_id' => $user->id,
            'chat_id' => $chat->id,
        ]);

        return MessageResource::make($message)->resolve();
    }
}
