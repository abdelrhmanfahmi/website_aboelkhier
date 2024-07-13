<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('assets/images/firstLogo.JPG')}}"  />
    <title>AboElKhier</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
            background-color: #d3e2f1;
        }
        .navbar-nav {
            float:none;
            margin:0 auto;
            display: block;
            text-align: center;
        }

        .navbar-nav > li {
            display: inline-flex;
            float:none;
        }
        @media (max-width: 912px) {
            .navbar-nav {
                float:none;
                margin:0 auto;
                display: flex;
            }

            .navbar-nav > li {
                float:none;
            }
        }
        .styleFooterText{
        color:#674df0;
    }
    footer {
        background: #303958;
        color: #fff;
    }

    .titleHolder {
        padding: 20px 0
    }

    a {
        line-height: 40px
    }

    .text-gray,
    .text-gray-dark {
        color: #fff !important;
    }

    .gray-only {
        color: $gray !important;
    }
    .aligned-row{
        display: flex;
        align-items: center;
        justify-items: center;
    }
    </style>
</head>
<body>
    <div>
        @include('layouts.header')
        {{-- <div class="container-fluid w-100"> --}}
             {{-- <div class="row flex-nowrap"> --}}
                {{-- <div class="col py-3"> --}}
                    @yield('main')
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
