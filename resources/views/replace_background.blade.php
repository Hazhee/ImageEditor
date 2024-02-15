@extends('layouts.app')
@section('content')
    <h1 class="mb-4 text-center">Image Editor - Replace Background</h1>
    <h5>The input image should be a PNG, a JPG or a WEBP file, with a maximum width and height of 2048 pixels and a max file size of 20 Mb.</h5>
    <form action="{{ url('https://elijahimageeditor-b7a88b3db0fa.herokuapp.com/replace/image/background') }}" method="post" enctype="multipart/form-data">
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
            <button type="submit" class="btn btn-lg btn-success mt-3 mb-3" onclick="submitForm()">Replace Background</button>
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
