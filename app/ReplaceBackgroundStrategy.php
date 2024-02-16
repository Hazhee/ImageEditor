<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ReplaceBackgroundStrategy implements ImageEditingStrategy
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|dimensions:max_width=2048,max_height=2048|max:25000',
        ]);

        // Get the image file from the form
        $image = $request->file('image');

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
        ->attach('image_file', file_get_contents($image->getPathname()), 'image.jpg')
        ->attach('prompt', $request->promt)
        ->post('https://clipdrop-api.co/replace-background/v1');

        if ($response->successful()) {
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension(); //unique name
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return back()->with(['error' => 'failed'], $response->status());
        }
    }
}
