<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function getImageUrl(object $image, string $path = 'admin/assets/images/')
    {
        $imageName = rand(111111111, 999999999).'_'. time().'_'.$image->getClientOriginalName();
        $image->move($path, $imageName);
        return asset($path.$imageName);
    }
}
