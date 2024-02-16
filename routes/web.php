<?php

use App\Http\Controllers\ImageEditorController;
use Illuminate\Support\Facades\Route;

// Home route
Route::get('/', function () {
    return view('home');
});

Route::get('/slaw', function () {
    return phpinfo();
});
// Routes related to removing background
Route::view('background/remove', 'background_remove')->name('background.remove.index');
Route::post('remove/background', [ImageEditorController::class, 'removeBackground'])->name('background.remove');

// Route for clean-up operation
Route::view('cleanup', 'cleanup')->name('clean');
Route::post('cleanup/image', [ImageEditorController::class, 'cleanUp'])->name('cleanup');

// Route for editing image
Route::get('edit-image', [ImageEditorController::class, 'removeBackground'])->name('edited.image');

// Route for downloading edited image
Route::get('download/{editedImagePath}', [ImageEditorController::class, 'downloadImage'])->name('download');

// Routes related to image upscaling
Route::view('image/upscaling', 'image_upscaling')->name('image.upscaling.index');
Route::post('image/upscaling', [ImageEditorController::class, 'imageUpscaling'])->name('image.upscaling');

// Routes related to text to image conversion
Route::view('text/to/image', 'text_to_image')->name('text.image.index');
Route::post('text/to/image', [ImageEditorController::class, 'textToImage'])->name('text.image');

// Routes related to cropping image
Route::view('crop/image', 'image_crop')->name('image.crop.index');
Route::post('crop/image', [ImageEditorController::class, 'cropImage'])->name('crop.image');

// Routes related to replacing image background
Route::view('replace/image/background', 'replace_background')->name('replace.background.index');
Route::post('replace/image/background', [ImageEditorController::class, 'replaceBackground'])->name('replace.background');