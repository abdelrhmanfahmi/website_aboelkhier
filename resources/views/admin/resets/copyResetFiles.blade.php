@extends('app.indexAdmin')
@section('main')
    <style>
        body{
            overflow-y: scroll !important;
        }
    </style>

    <div class="container-fluid">
        <form action="{{ route('reset.copyFilesFromReset') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-12">
                    <label>رقم الفاتورة</label>
                    <input type="number" class="form-control" name="reset_id" value="{{request()->id}}" readonly/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>اسم الملف المراد نسخه</label>
                    <input type="text" class="form-control" name="reset_file_copy_name" />
                </div>
                 <div class="col-md-6">
                    <label>عدد النسخ</label>
                    <input type="number" class="form-control" name="number_copies" />
                </div>
            </div>
            <div class="row mb-3 w-100">
                <div class="col-md-12 w-100">
                    <button class="btn btn-success" type="submit" disabled>Copy</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            loading();
            setTimeout(() => {
                unloading();
            },1500);
        });
    </script>

@endsection
