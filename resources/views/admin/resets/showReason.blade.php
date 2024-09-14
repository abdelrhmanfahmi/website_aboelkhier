@extends('app.indexAdmin')
@section('main')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="container">
        <div class="row">
            <div class="col-md-12 w-100">
                <textarea disabled cols="30" class="form-control" rows="10">{{ $reset->revert_reason }}</textarea>
                <br>
                <a href="{{ route('recieved-resets.index') }}" class="btn btn-primary">رجوع</a>
                <button data-id="{{ $reset->id }}" class="btn btn-success SendRevise">إرسال للمراجع مرة آخري</button>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            loading();
            setTimeout(() => {
                unloading();
            },1500);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.SendRevise').on('click' , function(e){
                let id = $(this).attr('data-id');
                $.ajax({
                    url:'/send/revision/'+id,
                    method:'GET',
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            toastr.success('تم إرسالها للمراجع بنجاح');
                            setTimeout(() => {
                                window.location.href = '/resets';
                            }, 1500);
                        }else{
                            toastr.error('حدث خطأ ما');
                        }
                    }
                });
            });
        });
    </script>

@endsection
