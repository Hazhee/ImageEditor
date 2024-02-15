@extends('layouts.app')
@section('content')

    <h1 class="mb-4 text-center">Image Editor - Crop Image</h1>
    <h5>Crop IMAGE. Crop JPG, PNG or GIF by defining a rectangle in pixels. Cut your image online. Upload your file and transform it. Select images.</h5>
    <form action="{{ url('https://elijahimageeditor-bf08cb0934b4.herokuapp.com/crop/image') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="file-upload text-center">
            <div class="image-upload-wrap">
                <input class="file-upload-input" id="image" type='file' name="image" onchange="showImage(this);"
                    accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop an image, or select an Image</h3>
                </div>
            </div>

            <input type="hidden" id="resizedWidth" name="resizedWidth" readonly>
            <input type="hidden" id="resizedHeight" name="resizedHeight" readonly>
            <input type="hidden" id="xPosition" name="xPosition" readonly>
            <input type="hidden" id="yPosition" name="yPosition" readonly>
            <input type="hidden" id="rotationAngle" name="rotationAngle" readonly>


            <div class="file-upload-content">
                <img class="file-upload-image" id="preview" src="#" alt="your image" style="display: block; max-width: 100%;" /> <br>
                <!-- Rotation Controls -->
                <button class="btn btn-info" type="button" id="rotate-left">Rotate Left</button>
                <button class="btn btn-info"  type="button" id="rotate-right">Rotate Right</button>
                <br>
            </div>

            @error('image')
                <span class="text-danger mt-3">{{ $message }}</span> <br>
            @enderror
            
            <button type="submit" class="btn btn-lg btn-success mt-3 mb-3" onclick="submitForm()">Crop Image</button>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Processing Image...</p>
        </div>
    </form>

    <script>
        
        function showImage(input) {
            if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();

            };

            reader.readAsDataURL(input.files[0]);

            }
        }


$(document).ready(function() {
    var cropper;

    // Initialize Cropper.js
    function initCropper() {
        cropper = new Cropper(document.getElementById('preview'), {
            aspectRatio: 1,
            viewMode: 1,
        });
    }

    initCropper();

    // Handle file input change
    $('#image').change(function(e) {
        var input = e.target;
        var reader = new FileReader();

        reader.onload = function() {
            var dataURL = reader.result;
            cropper.replace(dataURL);
        };

        reader.readAsDataURL(input.files[0]);
    });

    // Handle rotation controls
    $('#rotate-left').click(function() {
        cropper.rotate(-90);
    });

    $('#rotate-right').click(function() {
        cropper.rotate(90);
    });

    // Re-initialize Cropper on submit (optional)
    $('form').submit(function() {
        // Get the dimensions after cropping/resizing
        var croppedData = cropper.getData();
        $('#resizedWidth').val(croppedData.width);
        $('#resizedHeight').val(croppedData.height);
        $('#xPosition').val(croppedData.x);
        $('#yPosition').val(croppedData.y);
        $('#rotationAngle').val(croppedData.rotate);

        // Destroy and reinitialize Cropper
        cropper.destroy();
        initCropper();
    });
});
    </script>
   
@endsection
