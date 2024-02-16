@extends('layouts.app')
@section('content')
    <h1 class="mb-4">Image Editor Tools</h1>
    <h5 class="mb-4">Select from the captivating options below!</h5>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="card">
                <img src="https://www.slazzer.com/static/images/home-page/home_banner.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Image Remove Background</h5>
                    <p class="card-text">Image Remove Background tool, allowing you to seamlessly eliminate distracting backgrounds from images, spotlighting your products or subjects with professional precision.
                    </p>
                    <a href="{{ route('background.remove.index') }}" class="btn btn-info">Remove background</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <img src="https://assets.snapedit.app/images/feature-2.webp"
                    class="card-img-top" height="100%" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Image Clean Up</h5>
                    <p class="card-text">Elevate your images with our Image Clean Up tool, effortlessly removing unwanted elements and enhancing visual clarity for a polished and refined appearance that captivates your audience."</p>
                    <a href="{{route('clean')}}" class="btn btn-info">Clean up</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="https://miro.medium.com/v2/resize:fit:1400/1*s3kX4m3CfG_IesMa9nakMg.png"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Image upscaling</h5>
                    <p class="card-text">Ensuring stunning clarity and detail by magnifying your visuals to higher resolutions, providing an elevated and captivating viewing experience.</p>
                    <a href="{{route('image.upscaling.index')}}" class="btn btn-info">Image upscaling</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="https://assets.monica.im/tools-web/static/imageGeneratorFeatureIntro1-AQU1zYPO.webp"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Text To Image</h5>
                    <p class="card-text">Effortlessly transforming your text into visually captivating images, making your messages come to life with vibrant and personalized designs.</p>
                    <a href="{{route('text.image.index')}}" class="btn btn-info">Text To Image</a>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card">
                <img src="https://plugins-media.makeupar.com/smb/blog/post/2022-09-02/23aa77d0-67eb-49fe-a515-b31bced529bf.jpg"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Image Crop</h5>
                    <p class="card-text">Allowing you to precisely frame and focus on the most impactful elements, ensuring your visuals are customized to suit your unique vision.</p>
                    <a href="{{route('image.crop.index')}}" class="btn btn-info">Crop Image</a>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <img src="https://jacfoto.com/en/wp-content/uploads/2022/07/replace-the-background-in-a-click-with-luminar-neo-1024x576.jpg"
                    class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Replace background</h5>
                    <p class="card-text">Offering the flexibility to seamlessly swap out backgrounds, adding a touch of creativity and personalization to your visuals with just a click.</p>
                    <a href="{{route('replace.background.index')}}" class="btn btn-info">Replace Background</a>
                </div>
            </div>
        </div>
    </div>
@endsection
