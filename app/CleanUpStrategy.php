<?php
namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CleanUpStrategy implements ImageEditingStrategy
{
    // API key for ClipDrop service
    private $apiKey;

    // Constructor to set up the strategy with necessary configurations
    public function __construct()
    {
        // Fetch the API key from the environment variables
        $this->apiKey = env('CLIPDROP_API_KEY');
    }
    // Image cleanup process using the ClipDrop API
    public function process(Request $request)
    {
        // Validate the incoming form data
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|dimensions:max_width=4928,max_height=3264|max:25000',
            'mask' => 'required|image|mimes:png|max:25000',
        ]);

        // Get the image and mask files from the form
        $image = $request->file('image');
        $mask = $request->file('mask');

        // Make a POST request to the ClipDrop API for image cleanup withheaders to send the api key with it
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])
            ->attach('image_file', file_get_contents($image->getPathname()), 'image.jpg') //original image
            ->attach('mask_file', file_get_contents($mask->getPathname()), 'mask.png') //the mask image
            ->post('https://clipdrop-api.co/cleanup/v1');

        // Check if the request was successful (HTTP status 200)
        if ($response->successful()) {
            // Generate a unique name for the edited image
            $editedImagePath = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            // Save the edited image content to a file
            file_put_contents($editedImagePath, $response->body());
            // Return the view with the path to the edited image
            return view('edited_image')->with('editedImagePath', $editedImagePath);
        } else {
            // Handle the case when the API request is not successful
            return back()->with(['error' => $response->json()['error']]);
        }
    }
}
