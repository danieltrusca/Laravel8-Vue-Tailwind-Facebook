<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserImage;
use App\Http\Resources\UserImageResource;

class UserImageController extends Controller
{
    public function store()
    {
        $data=request()->validate([
            'image' => '',
            'width' => '',
            'height' => '',
            'location' => '',
        ]);

        $image=$data['image']->store('user-images', 'public');

        $userImage=auth()->user()->images()->create([
            'path'=>$image,
            'width'=>$data['width'],
            'height'=>$data['height'],
            'location'=>$data['location']
        ]);

        return new UserImageResource($userImage);
    }
}