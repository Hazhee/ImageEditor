<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
class ImageUpscalingStrategy implements ImageEditingStrategy
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,web|max:2048',
        ]);

        $resized_width = $request->resizedWidth;

        $resized_height = $request->resizedHeight;

        $rotation_angle = $request->angle;

        // create new manager instance with desired driver
        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
        $manager = new ImageManager(new Driver());
        $img = $manager->read($request->file('image'));

        if (($resized_width > 0 && $resized_height > 0) || $rotation_angle != null) {
            $img->rotate($rotation_angle ?? 0);
            $img->resize($resized_width, $resized_height);
        }

        $img->toJpeg(80)->save(base_path('public/' . $name_gen));
        $path = public_path($name_gen);
        // taking the image width
        $width = $img->width();
        // taking the image height
        $height = $img->height();

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', fopen($path, 'r'), 'image.jpg')
            ->attach('target_width', $width + 1000)
            ->attach('target_height', $height + 1000)
            ->post('https://clipdrop-api.co/image-upscaling/v1/upscale');

        // Check if the request was successful (HTTP status 200)
        if ($response->successful()) {
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return response()->json(['error' => 'Cleanup failed'], $response->status());
        }
    }
}
