@extends('layouts.app')
@section('content')
    <h2 class="mb-4 text-center">Image Editor - Replace Background</h2>
    <h6>Upscale your images by 2x or 4x in seconds. It can also remove noise and recover beautiful details.</h6>
    <span class="text-danger">*The original image should be a PNG, JPEG or WebP file, with a maximum resolution of 16 megapixels and a max file size of 30 Mb.</span>
    <form action="{{ url('https://elijahimageeditor-bf08cb0934b4.herokuapp.com/replace/image/background') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="file-upload text-center">
            <div class="image-upload-wrap">
                <input class="file-upload-input" id="image" type='file' name="image" onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop an image, or select an Image</h3>
                </div>
            </div>

            <div class="file-upload-content">
                <img class="file-upload-image" id="preview" src="#" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="btn btn-danger">Remove Uploaded
                        Image</span></button>
                </div>
            </div>

            <div class="input-group flex-nowrap" style="width: 70%; margin:80px auto">
                <input id="promt" type="text" name="promt" class="form-control" placeholder="Type a prompt here" aria-label="Promot"
                    aria-describedby="addon-wrapping">
            </div>

            @error('image')
                <span class="text-danger mt-3">{{ $message }}</span> <br>
            @enderror
            <button type="submit" class="btn btn-success mt-3 mb-3" onclick="submitForm()">Replace Background</button>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Processing Image...</p>
        </div>
    </form>
@endsection
