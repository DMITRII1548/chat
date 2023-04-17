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
        if ($chat->users()->find(Auth::user()->id)) {
            $messages = $chat->messages()->get();

            return MessageResource::collection($messages)->resolve();
        }

        abort(419);
    }

    public function store(Chat $chat, StoreRequest $request): array
    {
        $data = $request->validated();
        $user = Auth::user();

        if(!$chat->users()->find($user->id)){
            abort(419);
        }

        $message = Message::create([
            'body' => $data['body'],
            'user_id' => $user->id,
            'chat_id' => $chat->id,
        ]);

        return MessageResource::make($message)->resolve();
    }
}
