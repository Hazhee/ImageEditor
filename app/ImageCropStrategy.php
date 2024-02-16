<?php

namespace App;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageCropStrategy implements ImageEditingStrategy
{
    // API key for ClipDrop service
    private $apiKey;

    // Constructor to set up the strategy with necessary configurations
    public function __construct()
    {
        // Fetch the API key from the environment variables
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    
    // Image cropping process using the ClipDrop API
    public function process(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:25000',
        ]);

        // Extract dimensions and position data from the request
        $resized_width = $request->resizedWidth;
        $resized_height = $request->resizedHeight;
        $x_possition = $request->xPosition;
        $y_possition = $request->yPosition;
        $rotation_angle = $request->rotationAngle;

        // Generate a unique name for the edited image
        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

        // Create a new instance of the ImageManager with the Gd driver
        $manager = new ImageManager(new Driver());

        // Read the original image file using Intervention Image
        $img = $manager->read($request->file('image'));

        // Apply rotation if angle is specified
        if ($rotation_angle != null) {
            $img->rotate(-$rotation_angle);
        }

        // Crop the image based on provided dimensions and position
        $img->crop($resized_width, $resized_height, $x_possition, $y_possition);

        // Save the edited image to a new location
        $img->toJpeg(80)->save(base_path('public/' . $name_gen));

        // Return the view with the path to the edited image
        return view('edited_image')->with('editedImagePath', $name_gen);
    }
}
