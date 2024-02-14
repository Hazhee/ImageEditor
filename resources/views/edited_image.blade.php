@extends('layouts.app')
@section('content')
    <div class="container text-center mt-5">
        <h1 class="mb-3 text-center"><a href="{{ route('background.remove.index') }}" class="btn btn-primary">Back</a> Edited Image </h1>
        <a href="{{ route('download', $editedImagePath) }}" id="downloadLink" class="btn btn-lg btn-success" style="d">Download Edited Image</a> <br> <br>
        @if (isset($editedImagePath))
            <img src="{{ asset('storage/public/' . $editedImagePath) }}" width="50%" height="50%" alt="Edited Image" style="border-radius: 20px;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;">
            <br> <br>
        @else
            <p>No edited image available.</p>
        @endif
    </div>
@endsection
