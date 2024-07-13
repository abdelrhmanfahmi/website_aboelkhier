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
                <?php $ext = pathinfo($settings[6]->image, PATHINFO_EXTENSION); ?>
                @if($settings[6]->image != null && ($ext == 'svg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jpg'))
                    <img src="{{ asset('uploads/' . $settings[6]->image) }}" class="styleImage" alt="">
                @elseif ($settings[6]->image != null && ($ext == 'mp4' || $ext == 'mov'))
                    <video width="600" controls style="max-width: 100%;">
                        <source src="{{ asset('uploads/' . $settings[6]->image) }}" type="video/mp4">
                        Your browser does not support HTML video.
                    </video>
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
