@extends('app.index')
@section('main')

<style>
    .styleBackgroundImage{
        width: 100%;
        height: 50% !important;
        object-fit:cover;
    }
    .containerStyleNew {
        position: relative;
        text-align: center;
        color: white;
    }
    .centered {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .styleParagraphService{
        line-height: 2;
    }
    .styleImage{
        width: 50%;
        height: 100%;
    }
</style>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="containerStyleNew">
            <img src="https://www.trusttranslations.net/images/resources/banner.webp" class="styleBackgroundImage" alt="">
            <div class="centered">
                <h1>{{ $service->title }}</h1>
            </div>
        </div>
    </div>
</div>

<section class="services mb-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 d-flex justify-content-center">
                @if($service->image != null)
                    <img src="{{ asset('uploads/' . $service->image) }}" class="styleImage" alt="">
                @else
                    <img src="https://www.trusttranslations.net/uploads/service_items/7d72ca7133a5452bcf4450fb3029ab6d1.webp" alt="">
                @endif
            </div>
        </div>

        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-12">
                <h3 class="text-danger">{{ $service->title }}</h3>
                <p class="styleParagraphService">{!! $service->description !!}</p>
            </div>
        </div>
    </div>
</section>


@endsection
