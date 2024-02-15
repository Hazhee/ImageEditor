@extends('layouts.app')
@section('content')
    <h1 class="mb-4 text-center">Image Editor - Remove Background</h1>
    <h5>The original image should be a PNG, a JPG or a WEBP file, with a maximum resolution of 25 megapixels and a max file
        size of 30 Mb</h5>
    <form action="{{url('https://elijahimageeditor-b7a88b3db0fa.herokuapp.com/remove/background')}}" method="post" enctype="multipart/form-data">
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

                <div class="m-3">
                    <label for="basic-url" class="form-label m-4" style="font-size: 20px">Would you like to resize the image
                        before removing the background? <br> Please write the desired width and height to be resized bellow.
                        (optional) </label>
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Width</span>
                        <input type="number" id="promt" name="resizedWidth" class="form-control"
                            placeholder="Write the desired width in pixel" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div> <br>
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Height</span>
                        <input type="number" id="promt" name="resizedHeight" class="form-control"
                            placeholder="Write the desired height in pixel" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div>
                </div>

                <div class="m-3">
                    <label for="basic-url" class="form-label m-4" style="font-size: 20px">Would you like to rotate the image
                        before removing the background? <br> Please write the desired rotation angle bellow. (optional)
                    </label>
                    <p class="text-danger">Remember possative numbers mean rotate to left and vice versa.</p>
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Angle</span>
                        <input type="number" id="promt" name="angle" class="form-control"
                            placeholder="Write the desired rotation angle" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div> <br>
                </div>
            </div>




            @error('image')
                <span class="text-danger mt-3">{{ $message }}</span> <br>
            @enderror
            <button type="submit" class="btn btn-lg btn-success mt-3 mb-3" onclick="submitForm()">Remove
                Background</button>
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
