<?php

namespace App\Actions\Image;

use App\Models\Chat;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateImage
{
    public function handle(Chat $chat, UploadedFile | null $image): void
    {
        if ($image) {
            $imageName = md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();
            \Intervention\Image\Facades\Image::make($image)->fit(55, 55)
                ->save(storage_path('app\public\images\\' . $imageName));

            Storage::disk('public')->delete($chat->image->path);

            $chat->image->update([
                'path' => 'images/' . $imageName,
                'url' => url('/storage/images/' . $imageName),
            ]);
        }
    }
}
