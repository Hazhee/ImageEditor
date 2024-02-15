<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RemoveBackgroundStrategy implements ImageEditingStrategy
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

        $rotation_angle = $request->angle;

        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();

        $manager = new ImageManager(new Driver());

        $img = $manager->read($request->file('image'));

        
        $img->resize($resized_width, $resized_height);
        $img->rotate($rotation_angle);
        $img->toJpeg(80)->save(base_path('public/' . $name_gen));
        $path = public_path($name_gen);
        

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', fopen($path, 'r'), 'image.jpg')
            ->post('https://clipdrop-api.co/remove-background/v1');

        // Check if the response is successful
        if ($response->getStatusCode() === 200) {
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle non-OK response
            throw new \Exception('Error: ' . $response->getStatusCode());
        }

    }
}
