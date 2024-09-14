<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <title>البريد الإلكتروني</title>
</head>
<body>
    <div>
        <h3>رقم الفاتورة</h3>
        <p>{{ $recieveReset['id'] }}</p>
    </div>

    <div>
        <h3>ملاحظات</h3>
        <p>{{ $recieveReset['translator_notes'] }}</p>
    </div>

    <h3>الملفات المرفقة</h3>
    @foreach ($recieveReset->files_recieved_resets as $recieved_r)
        @if(\File::extension($recieved_r->file) == 'docx' || \File::extension($recieved_r->file) == 'doc')
            <div class="image mb-3 px-3">
                <div class="d-flex">
                    <!--<img src="{{ asset('assets/images/word.png') }}" width="200" height="100" alt="">-->
                    <img src="https://abulkhiergroup.com/assets/images/word.png" width="200" height="100" alt="">
                    {{-- <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span> --}}
                </div>
                <div class="mt-2">
                    <a href="https://abulkhiergroup.com/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                    <a href="https://abulkhiergroup.com/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                </div>
            </div>
        @elseif (\File::extension($recieved_r->file) == 'pdf')
            <div class="image mb-3 px-3">
                <div class="d-flex">
                    <!--<img src="{{ asset('assets/images/pdf.png') }}" width="200" height="100" alt="">-->
                    <img src="https://abulkhiergroup.com/assets/images/pdf.png" width="200" height="100" alt="">
                    {{-- <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span> --}}
                </div>
                <div class="mt-2">
                    <a href="https://abulkhiergroup.com/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                    <a href="https://abulkhiergroup.com/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                </div>
            </div>
        @else
            <div class="image mb-3 px-3">
                <div class="d-flex">
                    <!--<img src="{{ asset('uploads/' . $recieved_r->file) }}" width="200" height="100" alt="">-->
                    <img src="https://abulkhiergroup.com/uploads/{{$recieved_r->file}}" width="200" height="100" alt="">
                    {{-- <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span> --}}
                </div>
                <div class="mt-2">
                    <a href="https://abulkhiergroup.com/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                    <a href="https://abulkhiergroup.com/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                </div>
            </div>
        @endif
    @endforeach

    <p>شكرا لك</p>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
