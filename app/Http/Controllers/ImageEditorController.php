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

class ImageEditorController extends Controller
{

    public function removeBackground(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new RemoveBackgroundStrategy());

        return $context->executeStrategy($request);
    }

    public function replaceBackground(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new ReplaceBackgroundStrategy());

        return $context->executeStrategy($request);
    }
    public function cleanUp(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new CleanUpStrategy());

        return $context->executeStrategy($request);
    }

    public function cropImage(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new ImageCropStrategy());

        return $context->executeStrategy($request);
    }

    public function imageUpscaling(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new ImageUpscalingStrategy());

        return $context->executeStrategy($request);
    }

    public function textToImage(Request $request)
    {
        $context = new ImageEditingContext();
        $context->setStrategy(new TextToImageStrategy());

        return $context->executeStrategy($request);
    }

    public function downloadImage($editedImagePath)
    {
        $path = public_path($editedImagePath);
        return response()->download($path);
    }
}
