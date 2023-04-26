<?php

namespace App\Http\Controllers;

use App\Actions\Image\PutImage;
use App\Events\MessageSended;
use App\Http\Requests\Chat\IncludeUserRequest;
use App\Http\Requests\Chat\StoreRequest;
use App\Http\Resources\Chat\ChatResource;
use App\Models\Chat;
use App\Models\Image;
use App\Models\User;
use Carbon\Carbon;
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

    public function store(StoreRequest $request, PutImage $putImage): RedirectResponse
    {
        $data = $request->validated();

        $image = $putImage->put($data['image']);

        $chat = Chat::create([
            'title' => $data['title'],
            'image_id' => $image->id,
        ]);
        $chat->users()->attach(Auth::user()->id);

        return redirect()->route('chats.index');
    }
}
