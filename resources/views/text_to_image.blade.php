@extends('layouts.app')
@section('content')
    <h2 class="mb-4 text-center">Image Editor - Text To Image</h2>
    <h6>Real-Time Text-to-Image Generation</h6>
    <form action="{{url('https://elijahimageeditor-bf08cb0934b4.herokuapp.com/text/to/image')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group flex-nowrap" style="width: 70%; margin:80px auto">
            <input id="promt" type="text" name="promt" class="form-control" placeholder="Type the prompt here" aria-label="Promot"
                aria-describedby="addon-wrapping">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        @error('promt')
            <span class="text-danger m-4">*{{ $message }}</span>
        @enderror
    </form>
@endsection
