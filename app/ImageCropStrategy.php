<?php

namespace App;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageCropStrategy implements ImageEditingStrategy
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    public function process(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,web|max:2048',
        ]);

        $resized_width = $request->resizedWidth;

        $resized_height = $request->resizedHeight;

        $x_possition = $request->xPosition;
        $y_possition = $request->yPosition;

        $rotation_angle = $request->rotationAngle;

        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
        $manager = new ImageManager(new Driver);

        $img = $manager ->read($request->file('image'));
        if($rotation_angle != NULL){
            $img->rotate(-$rotation_angle);
        }
        $img->crop($resized_width, $resized_height, $x_possition, $y_possition);
        $img->toJpeg(80)->save(base_path('public/storage/public/' . $name_gen));
        return view('edited_image')->with('editedImagePath', $name_gen);
    }
}
