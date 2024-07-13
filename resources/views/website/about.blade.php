@extends('app.index')
@section('main')

<style>
    .styleImage{
        width: 50%;
        height: 100%;
    }
    .styleParagraph{
        line-height: 2;
    }
</style>

<section class="about-us mb-5 pt-5">
    <div class="container-fluid">
        <div class="row mb-5">
            <div class="col-md-12">
                <h3 class="text-center styleBorder">عن وكالة أبوالخير للسفريات</h3>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                @if($settings[6]->image != null)
                    <img src="{{ asset('uploads/' . $settings[6]->image) }}" class="styleImage" alt="">
                @else
                    <img src="{{ asset('assets/images/firstLogo.JPG') }}" class="styleImage" alt="">
                @endif
            </div>
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <p class="styleParagraph">{!! $settings[5]->value !!}</p>
            </div>
        </div>
    </div>
</section>

@endsection
