<?php
namespace App\Http\Controllers;

use App\CleanUpStrategy;
use App\ImageCropStrategy;
use App\ImageUpscalingStrategy;
use App\ReplaceBackgroundStrategy;
use App\TextToImageStrategy;
use Illuminate\Http\Request;
use App\RemoveBackgroundStrategy;
use App\ImageEditingContext;

// Controller for handling image editing operations
class ImageEditorController extends Controller
{
    // Remove background operation
    public function removeBackground(Request $request)
    {
        // Create an image editing context with the RemoveBackgroundStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new RemoveBackgroundStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Replace background operation
    public function replaceBackground(Request $request)
    {
        // Create an image editing context with the ReplaceBackgroundStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new ReplaceBackgroundStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Clean-up operation
    public function cleanUp(Request $request)
    {
        // Create an image editing context with the CleanUpStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new CleanUpStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Crop image operation
    public function cropImage(Request $request)
    {
        // Create an image editing context with the ImageCropStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new ImageCropStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Image upscaling operation
    public function imageUpscaling(Request $request)
    {
        // Create an image editing context with the ImageUpscalingStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new ImageUpscalingStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Text to image operation
    public function textToImage(Request $request)
    {
        // Create an image editing context with the TextToImageStrategy
        $context = new ImageEditingContext();
        $context->setStrategy(new TextToImageStrategy());

        // Execute the strategy and return the result
        return $context->executeStrategy($request);
    }

    // Download image operation
    public function downloadImage($editedImagePath)
    {
        // Get the path of the edited image and return it for download
        $path = public_path($editedImagePath);
        return response()->download($path);
    }
}
