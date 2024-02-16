@extends('layouts.app')
@section('content')
    <div class="container text-center mt-5">
        <h2 class="mb-3 text-center">Edited Image </h2>
        <a href="{{url('https://elijahimageeditor-9687250f9a6e.herokuapp.com/download/'.$editedImagePath)}}" id="downloadLink" class="btn btn-success" style="d">Download Edited Image</a> <br> <br>
        @if (isset($editedImagePath))
            <img src="{{ asset($editedImagePath) }}" width="50%" height="50%" alt="Edited Image" style="border-radius: 20px;   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);;">
            <br> <br>
        @else
            <p>No edited image available.</p>
        @endif
    </div>
@endsection
