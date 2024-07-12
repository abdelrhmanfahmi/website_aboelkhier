<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('assets/images/firstLogo.JPG')}}"  />
    {{-- <meta http-equiv="Refresh" content="300"> --}}
    <title>british</title>
    <style>
        body{
            height: 100vh;
            /* background-color: #000; */
            overflow-y: scroll !important;
            margin: 0;
            padding: 0;
        }
        .ifScreenResized{
            display: none;
        }
        .bigScreen{
            display: block;
        }
        @media screen and (max-width: 1280px){
            #sidebar{
                width:25% !important;
            }
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
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('//upload.wikimedia.org/wikipedia/commons/thumb/e/e5/Phi_fenomeni.gif/50px-Phi_fenomeni.gif')
                        50% 50% no-repeat rgb(249,249,249);
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% { -webkit-transform: rotate(0deg); }
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        #translators_chosen{
            width:100% !important;
        }
        .styleCssData p{
            color: #181414;
            background-color: #f2b5b5;
            text-align: center;
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

    <div class="bigScreen" style="overflow: hidden;">
        @include('layouts.headerAdmin')
        <div class="container-fluid">
            <div class="row flex-nowrap">
                @include('layouts.sidebar')
                <div class="col py-3">

                    <div class="ifLoader">
                        <i class="fa-solid fa-circle-left" id="checkToggle" style="cursor: pointer"></i>
                        @yield('main')
                    </div>

                    <div class="loader" style="display: none;">

                    </div>

                </div>
            </div>
        </div>

        @include('layouts.footerAdmin')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.2-1/js/bootstrap.min.js" integrity="sha512-73t+oD9YRdVZBwLUw/FLF+4+mt6JyUhm8xUEgwA2/+QI3pM+t/6ALkELMcin6caoV1GVt3OMudVlHiMei0DXfQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
            document.body.style.zoom = 1.25;
            $("#checkToggle").on('click' , function(){
                $("#sidebar").fadeToggle('slow', function(){
                    if($("#sidebar").is(":visible")){
                        $('#checkToggle').removeClass('fa-circle-right');
                        $('#checkToggle').addClass('fa-circle-left');
                    } else{
                        $('#checkToggle').removeClass('fa-circle-left');
                        $('#checkToggle').addClass('fa-circle-right');
                    }
                });
            });
        });
        function loading(){
            $('.ifLoader').css('display' , 'none');
            $('.loader').css('display' , 'block');
        }

        function unloading(){
            $('.ifLoader').css('display' , 'block');
            $('.loader').css('display' , 'none');
        }
    </script>
</body>
</html>
