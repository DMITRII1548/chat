<?php

namespace App\Http\Controllers;

use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class ChatController extends Controller
{
    public function index(): Response
    {
        $user = Auth::user();
        $chats = $user->chats;

        $chats = ChatResource::collection($chats)->resolve();

        return inertia('Chat/Index', compact('chats', 'user'));
    }
}
