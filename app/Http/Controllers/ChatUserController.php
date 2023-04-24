<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChatUser\StoreRequest;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Response;

class ChatUserController extends Controller
{
    public function index(Chat $chat): Response
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $users = $chat->users;

        return inertia('Chat/Settings', compact('users', 'chat'));
    }

    public function create(Chat $chat): Response
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $users = User::whereNotIn('id', $chat->users->pluck('id'))->get();

        return inertia('Chat/AddUser', compact('users', 'chat'));
    }

    public function store(Chat $chat, StoreRequest $request): RedirectResponse
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $data = $request->validated();

        $chat->users()->attach($data['user_id']);

        return redirect()->route('chat.users.index', $chat->id);
    }

    public function destroy(Chat $chat, User $user): RedirectResponse
    {
        if (!$chat->users()->find(Auth::user()->id)) {
            abort(419);
        }

        $chat->users()->detach($user->id);

        return redirect()->route('chat.users.index', $chat->id);
    }
}
