<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{asset('assets/images/britanya.jpeg')}}" />
    <title>تسجيل الدخول</title>
    <style>
        body{
            height: 100vh;
            /* background-color: #000; */
            overflow:hidden;
            margin: 0;
            padding: 0;
        }
        .ifScreenResized{
            display: none;
        }
        .bigScreen{
            display: flex;
        }
        .styleCard{
            position:relative;
            bottom:8rem;
        }
        .styleImage{
            width: 80%;
            height: 50%;
        }
        @media only screen and(max-width: 1024px) and (orientation:landscape){
            .ifScreenResized{
                display: flex;
            }
            .imgInWidths{
                width: 290px;
            }
            .styleTextInWidths{
                font-size:10px;
            }
            body{
                background-color: #000;
            }
            .bigScreen{
                display: none;
            }
        }
        @media (max-width: 992px){
            .ifScreenResized{
                display: flex;
            }
            .imgInWidths{
                width: 290px;
            }
            .styleTextInWidths{
                font-size:10px;
            }
            body{
                background-color: #000;
            }
            .bigScreen{
                display: none;
            }
        }
        @media only screen and (orientation:portrait){
            .ifScreenResized{
                display: flex;
            }
            .imgInWidths{
                width: 290px;
            }
            .styleTextInWidths{
                font-size:10px;
            }
            body{
                background-color: #000;
            }
            .bigScreen{
                display: none;
            }
        }
        #show_eye{
            cursor: pointer;
        }
        #hide_eye{
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container-fluid h-100 justify-content-center align-items-center ifScreenResized">
        <div class="row d-flex h-100 justify-content-center align-items-center">
            <div class="col-md-12 d-flex h-100 justify-content-center align-items-center">
                <div class="d-block">
                    <div class="mb-3">
                        <img src="{{ asset('assets/images/bigScreen.jpg') }}" class="imgInWidths" alt="">
                    </div>
                    <div>
                        <h3 class="text-white text-center styleTextInWidths">This Website For Only Big Screens And Tablets</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid h-100 w-100 d-flex bigScreen">
        <div class="row h-100 w-100 d-flex">
            <div class="col-md-6 d-flex justify-content-center align-items-start" style="background-color: #f4f4f4;">
                <img src="{{ asset('assets/images/loginImage.png') }}" alt="" class="img-fluid">
            </div>

            <div class="col-md-6 d-flex justify-content-center align-items-center styleCard">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('login.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">E-mail</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                                @if($errors->has('email'))
                                    <div class="text-danger errorEmail">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="password" name="password" class="form-control" />
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" style="font-size: 1.4rem;" onclick="password_show_hide();">
                                        <i class="fa fa-eye" id="show_eye"></i>
                                        <i class="fa fa-eye-slash d-none" id="hide_eye"></i>
                                      </span>
                                    </div>
                                  </div>
                                @if($errors->has('password'))
                                    <div class="text-danger errorPassword">{{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </form>
                    </div>
                  </div>
                    @if($errors->has('msg'))
                        <div class="text-danger errorMessage">{{ $errors->first('msg') }}</div>
                    @endif
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            document.body.style.zoom = 1.25;
            if ($(".errorEmail")){
                setTimeout(() => {
                    $('.errorEmail').fadeOut('slow');
                }, 4000);
            }
            if ($(".errorPassword")){
                setTimeout(() => {
                    $('.errorPassword').fadeOut('slow');
                }, 4000);
            }
            if($(".errorMessage")){
                setTimeout(() => {
                    $('.errorMessage').hide('slow');
                } , 4000);
            }
        });
        function password_show_hide() {
            var x = document.getElementById("password");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            }else{
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</body>
</html>
