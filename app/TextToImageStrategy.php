<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TextToImageStrategy implements ImageEditingStrategy
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.clipdrop.api_key');
    }
    public function process(Request $request)
    {
        $request->validate([
            'promt' => 'required|max:1000',
        ]);

        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
        ->attach('prompt', $request->promt)
        ->post('https://clipdrop-api.co/text-to-image/v1');

        if ($response->successful()) {
            $editedImagePath = hexdec(uniqid()) . '.png';
            file_put_contents($editedImagePath, $response->body());
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return back()->with(['error' => 'failed'], $response->status());
        }
    }
}
