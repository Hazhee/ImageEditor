<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

// Strategy class for removing background from an image
class RemoveBackgroundStrategy implements ImageEditingStrategy
{
    private $apiKey;

    // Constructor to initialize API key
    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }

    // Method to process background removal based on the given request
    public function process(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|dimensions:max_width=6048,max_height=4024|max:25000',
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
        if ($resized_width > 0 && $resized_height > 0 || $rotation_angle != NULL) {
            $img->rotate($rotation_angle ?? 0);
            $img->resize($resized_width, $resized_height);
        }

        // Save the edited image to the public directory
        $img->toJpeg(80)->save(base_path('public/' . $name_gen));
        $path = public_path($name_gen);

        // Make a request to the ClipDrop API for background removal
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', fopen($path, 'r'), 'image.jpg')
            ->post('https://clipdrop-api.co/remove-background/v1');

        // Check if the response is successful
        if ($response->getStatusCode() === 200) {
            // Save the result image to storage or perform further actions
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle non-OK response
            throw new \Exception('Error: ' . $response->getStatusCode());
        }
    }
}
