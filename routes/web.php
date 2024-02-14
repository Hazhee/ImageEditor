<?php

use App\Http\Controllers\ImageEditorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::view('/background/remove', 'background_remove')->name('background.remove.index');
Route::view('/cleanup', 'cleanup')->name('clean');
Route::post('/remove/background', [ImageEditorController::class, 'removeBackground'])->name('background.remove');

Route::post('/cleanup/image', [ImageEditorController::class, 'cleanUp'])->name('cleanup');
Route::get('/edit-image', [ImageEditorController::class, 'removeBackground'])->name('edited.image');
Route::get('/download/{editedImagePath}', [ImageEditorController::class, 'downloadImage'])->name('download');


Route::view('image/upscaling', 'image_upscaling')->name('image.upscaling.index');
Route::post('image/upscaling', [ImageEditorController::class, 'imageUpscaling'])->name('image.upscaling');

Route::view('text/to/image', 'text_to_image')->name('text.image.index');
Route::post('text/to/image', [ImageEditorController::class, 'textToImage'])->name('text.image');

Route::view('crop/image', 'image_crop')->name('image.crop.index');
Route::post('crop/image', [ImageEditorController::class, 'cropImage'])->name('crop.image');

Route::view('replace/image/background', 'replace_background')->name('replace.background.index');
Route::post('replace/image/background', [ImageEditorController::class, 'replaceBackground'])->name('replace.background');





