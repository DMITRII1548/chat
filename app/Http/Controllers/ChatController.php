<?php

namespace App\Http\Controllers;

use App\Events\MessageSended;
use App\Http\Requests\Chat\IncludeUserRequest;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

        $path = Storage::disk('public')->put('/images', $data['image']);
        $image = Image::create([
            'path' => $path,
            'url' => url('/storage/' . $path),
        ]);

        $chat = Chat::create([
            'title' => $data['title'],
            'image_id' => $image->id,
        ]);
        $chat->users()->attach(Auth::user()->id);

        return redirect()->route('chats.index');
    }
}
