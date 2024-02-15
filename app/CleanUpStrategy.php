<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class CleanUpStrategy implements ImageEditingStrategy
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    public function process(Request $request)
    {
        // Validate the incoming form data (you may need to customize this)
        $request->validate([
            'image' => 'required|image',
            'mask' => 'required|image',
        ]);

        // Get the image and mask files from the form
        $image = $request->file('image');
        $mask = $request->file('mask');

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', file_get_contents($image->getPathname()), 'image.jpg')
            ->attach('mask_file', file_get_contents($mask->getPathname()), 'mask.png')
            ->post('https://clipdrop-api.co/cleanup/v1');

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
