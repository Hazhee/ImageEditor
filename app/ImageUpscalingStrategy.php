<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

// Strategy class for image upscaling
class ImageUpscalingStrategy implements ImageEditingStrategy
{
    private $apiKey;

    // Constructor to initialize API key
    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }

    // Method to process image upscaling based on the given request
    public function process(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:25000',
        ]);

        // Extract parameters from the request
        $resized_width = $request->resizedWidth;
        $resized_height = $request->resizedHeight;
        $rotation_angle = $request->angle;

        // Generate a unique name for the edited image
        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

        // Create a new ImageManager instance with the desired driver
        $manager = new ImageManager(new Driver());
        $img = $manager->read($request->file('image'));

        // Apply rotation and resizing if specified
        if (($resized_width > 0 && $resized_height > 0) || $rotation_angle != null) {
            $img->rotate($rotation_angle ?? 0);
            $img->resize($resized_width, $resized_height);
        }

        // Save the edited image to the public directory
        $img->toJpeg(80)->save(base_path('public/' . $name_gen));
        $path = public_path($name_gen);

        // Get the original width and height of the image
        $width = $img->width();
        $height = $img->height();

        // Make a request to the ClipDrop API for image upscaling
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', fopen($path, 'r'), 'image.jpg')
            ->attach('target_width', $width + 1000)
            ->attach('target_height', $height + 1000)
            ->post('https://clipdrop-api.co/image-upscaling/v1/upscale');

        // Check if the request was successful
        if ($response->successful()) {
            // Save the result image to storage or perform further actions
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return response()->json(['error' => 'Cleanup failed'], $response->status());
        }
    }
}
