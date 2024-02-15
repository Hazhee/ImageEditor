@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Image Editor - Cleanup</h1>
    <h5>Remove object, defect, people, or text from your pictures in seconds</h5>
    <form action="{{ url('https://elijahimageeditor-bf08cb0934b4.herokuapp.com/cleanup/image')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="file-upload">
            <div class="image-upload-wrap">
                <input class="file-upload-input" type='file' name="image" onchange="readURL(this);" accept="image/*" />
                <div class="drag-text">
                    <h3>Drag and drop an image, or select an Image</h3>
                </div>
            </div>
            <div class="file-upload-content">
                <img class="file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap">
                    <button type="button" onclick="removeUpload()" class="btn btn-danger">Remove Uploaded
                        Image</span></button>
                </div>

                <div class="m-3">
                    <label for="basic-url" class="form-label m-4" style="font-size: 20px">The mask image, defining the areas
                        that need to be removed. <br> The mask should be black and white with no grey pixels (e.g. values of
                        only 0 or 255), the value of 0 indicating a pixel to keep as is and 255 a pixel to 'clean up'
                    </label>
                    <div class="input-group" style="width: 40%; margin: auto">
                        <span class="input-group-text" id="promt">Mask File</span>
                        <input type="file" id="promt" name="mask" class="form-control"
                            placeholder="Write the desired width in pixel" id="basic-url"
                            aria-describedby="basic-addon3 basic-addon4">
                    </div> <br>
                </div>
            </div>
            @error('image')
                <span class="text-danger mt-3">{{ $message }}</span> <br>
            @enderror
            <button type="submit" class="btn btn-success mt-3 mb-3" onclick="submitForm()">Clean Up</button>
        </div>

        <!-- Loading Indicator -->
        <div id="loadingIndicator" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Processing Image...</p>
        </div>
    </form>
@endsection
