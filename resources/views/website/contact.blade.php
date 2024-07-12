@extends('app.index')
@section('main')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<style>
    label{
        color: #fff;
    }
    .styleBtnSubmit{
        background-color: #303958;
        color: #fff;
    }
    .styleImageTwo{
        width: 100%;
        height: 100%;
    }
</style>

<div class="row mb-5 pt-5">
    <div class="col-md-12 d-flex justify-content-center">
        <h3>Contact Us</h3>
    </div>
</div>

<section class="contact-us mb-5 pt-5" style="background-color: #4071a1">
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <form id="submitContact">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter E-mail">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label>Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <label>Message</label>
                            <textarea name="message" class="form-control" id="message" cols="30" rows="10" style="resize: none"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 mb-3">
                            <button class="btn styleBtnSubmit w-100">Save</button>
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
