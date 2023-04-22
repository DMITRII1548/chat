<?php

namespace App\Http\Controllers;

use App\Events\MessageSended;
use App\Http\Requests\Chat\IncludeUserRequest;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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

    public function create(): Response
    {
        return inertia('Chat/Create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $chat = Chat::create($data);
        $chat->users()->attach(Auth::user()->id);

        return redirect()->route('chats.index');
    }

    public function settings(Chat $chat): Response
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $users = $chat->users;

        return inertia('Chat/Settings', compact('users', 'chat'));
    }

    public function addUser(Chat $chat): Response
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }
        
        $users = User::whereNotIn('id', $chat->users->pluck('id'))->get();

        return inertia('Chat/AddUser', compact('users', 'chat'));
    }

    public function includeUser(Chat $chat, IncludeUserRequest $request): RedirectResponse
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $data = $request->validated();

        $chat->users()->attach($data['user_id']);

        return redirect()->route('chats.settings', $chat->id);
    }

    public function destroyUser(Chat $chat, User $user): RedirectResponse
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $chat->users()->detach($user->id);

        return redirect()->route('chats.settings', $chat->id);
    }
}
