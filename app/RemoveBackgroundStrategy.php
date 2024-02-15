<?php
namespace App;

require './vendor/autoload.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

class RemoveBackgroundStrategy implements ImageEditingStrategy
{

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('app.api_key');
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

        // create new manager instance with desired driver
        $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
        $manager = new ImageManager(new Driver);

        $img = $manager->read($request->file('image'));
        if ($resized_width > 0 && $resized_height > 0 || $rotation_angle != NULL) {
            $img->resize($resized_width, $resized_height);
            $img->rotate($rotation_angle);
        }
        $img->toJpeg(80)->save(base_path('public/storage/public/' . $name_gen));

        $path = public_path('storage/public/' . $name_gen);

        
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', fopen($path, 'r'), 'image.jpg')
            ->post('https://clipdrop-api.co/remove-background/v1');

        // Check if the response is successful
        if ($response->getStatusCode() === 200) {
            $buffer = $response->getBody()->getContents(); // Get the binary representation of the returned image
            $editedImagePath = 'edited_image.jpg';
            Storage::disk('local')->put("{$editedImagePath}", $buffer); //save the image to a new location
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle non-OK response
            throw new \Exception('Error: ' . $response->getStatusCode());
        }

    }
}
