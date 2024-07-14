@extends('app.index')
@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    .carousel-inner>.carousel-item>img, .carousel-inner>.carousel-item>a>img {
        display: block;
        height: auto;
        max-width: 100%;
        line-height: 1;
        width: 100%;
    }
    .styleImage{
        width: 50%;
        height: 100%;
    }
    .myCard{
        transition: 0.7s;
    }
    .myCard:hover {
        border-color:#303958;
    }
    .myCardTwo{
        padding: 1rem;
        background-color: #303958;
    }
    .styleBorder{
        text-decoration: underline;
        text-decoration-color: #89cff0;
    }
    .styleParagraph{
        line-height: 2;
    }
    .styleImageTwo{
        width: 100%;
        height: 100%;
    }
    label{
        color: #fff;
    }
    .styleBtnSubmit{
        background-color: #303958;
        color: #fff;
    }
    .myCardTwo p{
        color:#fff;
    }
</style>

<section class="header-slider mb-5">
    <div class="row">
        <div class="col-md-12">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    @foreach ($services as $index => $service)
                        @if ($index == 0)
                            <a href="/show/service/{{ $service->id }}">
                                <div class="carousel-item active">
                                    <img src="https://www.trusttranslations.net/images/resources/banner.webp" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $service->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="/show/service/{{ $service->id }}">
                                <div class="carousel-item">
                                    <img src="https://www.trusttranslations.net/images/resources/banner.webp" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $service->title }}</h5>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</section>

<section class="about-us mb-5">
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

<section class="services mb-5">
    <div class="container">
        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-12">
                <h3 class="text-center styleBorder">خدماتنا</h3>
            </div>
        </div>

        <div class="row mb-5 d-flex justify-content-center">
            <div class="col-md-12">
                <h5 class="text-center" style="line-height: 2">
                    وإدراكًا منّا لحاجة عملاءنا وأنماط الحياة السريعة التي تفرض يوميًا التوجه نحو مجالات بعينها، فنحن

                    في شركة أبو الخير للترجمة المعتمدة نوفر خدماتنا في كافة المجالات
                </h5>
            </div>
        </div>

        <div class="row mb-3">
            @foreach ($services as $service)
                <div class="col-md-4 mb-3">
                    <a href="/show/service/{{ $service->id }}" style="text-decoration: none;">
                        <div class="card myCard">
                            <div class="text-center">
                                @if($service->image != null)
                                    <img src="{{ asset('uploads/' . $service->icon) }}" width="80" height="80" alt="">
                                @else
                                    <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="80" height="80" alt="">
                                @endif
                            </div>
                            <div class="card-body text-center">

                            <h5 class="card-title">{{ $service->title }}</h5>
                            {{-- <div class="card-text">{!! \Str::limit($service->description, 30) !!}</div> --}}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="why mb-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12 d-flex justify-content-center">
                <h3 class="text-center styleBorder">لماذا تختار وكالة أبوالخير للسفريات ؟</h3>
            </div>
        </div>
        <div class="row mb-5">
            @foreach ($why as $w)
                <div class="col-md-4 mb-3">
                    <div class="card myCardTwo">
                        <div class="text-center">
                            @if($w->image != null)
                                <img src="{{ asset('uploads/' . $w->image) }}" width="80" height="80" alt="">
                            @else
                                <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="80" height="80" alt="">
                            @endif
                        </div>
                        <div class="card-body text-center">
                        <h5 class="card-title text-white">{{ $w->title }}</h5>
                        <p class="card-text">{{ $w->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<div class="row mb-5">
    <div class="col-md-12 d-flex justify-content-center">
        <h3 class="text-center styleBorder">تواصل معنا</h3>
    </div>
</div>

<section class="contact-us mb-5 pt-5" style="background-color: #4071a1">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <form id="submitContact">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label>الاسم</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="ادخل الاسم">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="ادخل البريد الإلكتروني">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label>رقم الهاتف</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="ادخل رقم الهاتف">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>الموضوع</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="ادخل الموضوع">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label>الرسالة</label>
                            <textarea name="message" class="form-control" id="message" placeholder="ادخل رسالتك" cols="30" rows="10" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <button class="btn styleBtnSubmit w-100">حفظ</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img src="{{ asset('assets/images/callerService.png') }}" class="styleImageTwo" alt="">
            </div>

        </div>
    </div>
</section>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#submitContact').on('submit' , function(e){
            e.preventDefault();
            let name = $('#name').val();
            let email = $('#email').val();
            let phone = $('#phone').val();
            let subject = $('#subject').val();
            let message = $('#message').val();

            let formData = new FormData();
            formData.append('name' , name);
            formData.append('email' , email);
            formData.append('phone' , phone);
            formData.append('subject' , subject);
            formData.append('message' , message);

            $.ajax({
                url:'/store/contact',
                type:'post',
                data:formData,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){
                    if(res == 1){
                        toastr.success('Your Message Was Stored Successfully !');
                        $('#name').val('');
                        $('#email').val('');
                        $('#phone').val('');
                        $('#subject').val('');
                        $('#message').val('');
                    }
                },error:function(e){
                    let response = err.responseJSON.errors;
                    $.each(response , function( key, value) {
                        toastr.error(value);
                    });
                }

            })
        });
    });
</script>
@endsection
