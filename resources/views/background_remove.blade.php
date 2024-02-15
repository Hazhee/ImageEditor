@extends('layouts.app')

@section('content')
    <!-- Page title and description -->
    <h1 class="mb-4 text-center">Image Editor - Remove Background</h1>
    <h5>The original image should be a PNG, a JPG or a WEBP file, with a maximum resolution of 25 megapixels and a max file
        size of 30 Mb</h5>

    <!-- Image removal form -->
    <form action="{{ url('https://elijahimageeditor-bf08cb0934b4.herokuapp.com/remove/background') }}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="file-upload text-center">
            <!-- Image upload section -->
            <div class="image-upload-wrap">
                <input class="file-upload-input" id="image" type='file' name="image" onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop an image, or select an Image</h3>
                </div>
            </div>

            <!-- Display uploaded image with options -->
            <div class="file-upload-content">
                <img class="file-upload-image" id="preview" src="#" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="btn btn-danger">Remove Uploaded Image</button>
                </div>

                <!-- Image resizing options -->
                <div class="m-3">
                    <label for="basic-url" class="form-label m-4" style="font-size: 20px">Would you like to resize the image
                        before removing the background? <br> Please write the desired width and height to be resized below.
                        (optional) </label>
                    <!-- Width input -->
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Width</span>
                        <input type="number" id="promt" name="resizedWidth" class="form-control"
                            placeholder="Write the desired width in pixel" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div> <br>
                    <!-- Height input -->
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Height</span>
                        <input type="number" id="promt" name="resizedHeight" class="form-control"
                            placeholder="Write the desired height in pixel" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div>
                </div>

                <!-- Image rotation options -->
                <div class="m-3">
                    <label for="basic-url" class="form-label m-4" style="font-size: 20px">Would you like to rotate the image
                        before removing the background? <br> Please write the desired rotation angle below. (optional)
                    </label>
                    <p class="text-danger">Remember positive numbers mean rotate to the left and vice versa.</p>
                    <!-- Angle input -->
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Angle</span>
                        <input type="number" id="promt" name="angle" class="form-control"
                            placeholder="Write the desired rotation angle" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div> <br>
                </div>

            </div>

            <!-- Display error message if image validation fails -->
            @error('image')
                <span class="text-danger mt-3">{{ $message }}</span> <br>
            @enderror

            <!-- Submit button -->
            <button type="submit" class="btn btn-success mt-3 mb-3" onclick="submitForm()">Remove Background</button>
        </div>

        <!-- Loading indicator while processing the image -->
        <div id="loadingIndicator" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Processing Image...</p>
        </div>
    </form>
@endsection
