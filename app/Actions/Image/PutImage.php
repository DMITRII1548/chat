<?php

namespace App\Actions\Image;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class PutImage
{
    public function handle(UploadedFile $imageFile): Image
    {
        $imageName = md5($imageFile->getClientOriginalName()) . '.' . $imageFile->getClientOriginalExtension();
        \Intervention\Image\Facades\Image::make($imageFile)->fit(55, 55)
            ->save(storage_path('app\public\images\\' . $imageName));

        return Image::create([
            'path' => 'images/' . $imageName,
            'url' => url('/storage/images/' . $imageName),
        ]);
    }
}
