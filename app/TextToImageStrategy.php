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
        $this->apiKey = config('app.api_key');
    }
    public function process(Request $request)
    {
        $request->validate([
            'promt' => 'required|max:1000',
        ]);

        dd($request->promt);

    //     $response = Http::withHeaders([
    //         'x-api-key' => $this->apiKey,
    //     ])
    //     ->attach('prompt', $request->promt)
    //     ->post('https://clipdrop-api.co/text-to-image/v1');

    //     if ($response->successful()) {
    //         // Save the result image to storage or perform further actions
    //         $buffer = $response->getBody()->getContents(); // Get the binary representation of the returned image
    //         $editedImagePath = 'edited_image.jpg';
    //         Storage::disk('local')->put("{$editedImagePath}", $buffer); //save the image to a new location
    //         // You may also return a response to the user or redirect as needed
    //         return view('edited_image')->with('editedImagePath', $editedImagePath);
    //     } else {
    //         // Handle the case when the API request is not successful
    //         return back()->with(['error' => 'failed'], $response->status());
    //     }
     }
}
