<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Elijah Image Editor</title>

    <!-- Bootstrap CSS link with integrity check -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <!-- Cropper.js CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <!-- Custom stylesheet link -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body>
    @section('sidebar')
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Elijah's Image Editor</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class=" collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ms-auto ">
                        <li class="nav-item">
                            <a class="nav-link mx-2 active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('background.remove.index') }}">Background Remove</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('clean') }}">Image Clean Up </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('image.upscaling.index') }}">Image upscaling
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('text.image.index') }}">Text To Image
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('image.crop.index') }}">Crop Image </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link mx-2" href="{{ route('replace.background.index') }}">Replace background
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    @show
    <!-- Container div for the content -->
    <div class="container mt-5">
        <!-- Placeholder for the content, to be filled by the specific view -->
        @yield('content')
    </div>

    <!-- Cropper.js script link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

    <!-- Custom script link for additional functionality -->
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>

</html>
