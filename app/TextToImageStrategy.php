<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

// Strategy class for generating an image from text using ClipDrop API
class TextToImageStrategy implements ImageEditingStrategy
{
    private $apiKey;

    // Constructor to initialize API key
    public function __construct()
    {
        $this->apiKey = env('CLIPDROP_API_KEY');
    }

    // Method to process text-to-image conversion based on the given request
    public function process(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'promt' => 'required|max:1000',
        ]);

        // Make a request to the ClipDrop API for text-to-image conversion
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('prompt', $request->promt)
            ->post('https://clipdrop-api.co/text-to-image/v1');

        // Check if the response is successful
        if ($response->successful()) {
            // Save the result image to storage or perform further actions
            $editedImagePath = hexdec(uniqid()) . '.png';
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return back()->with(['error' => 'failed'], $response->status());
        }
    }
}
