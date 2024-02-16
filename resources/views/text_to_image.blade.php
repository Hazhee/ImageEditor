@extends('layouts.app')
@section('content')
    <h2 class="mb-4 text-center">Image Editor - Text To Image</h2>
    <h6>Real-Time Text-to-Image Generation</h6>
    <form action="{{url('text/to/image')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group flex-nowrap" style="width: 70%; margin:80px auto">
            <input id="promt" type="text" name="promt" class="form-control" placeholder="Type the prompt here" aria-label="Promot"
                aria-describedby="addon-wrapping">
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
        
        @error('promt')
            <div class="alert alert-danger text-danger mt-3">{{ $message }}</div> <br>
        @enderror

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </form>
@endsection
