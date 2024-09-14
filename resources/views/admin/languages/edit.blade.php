@extends('app.indexAdmin')
@section('main')

    <div class="edit-languages">
        <form action="{{ route('languages.update' , $language->id) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <div class="col-md-6">
                    <label><span style="color: red;">*</span>اللغة الاولي</label>
                    <input type="text" name="first_language" class="form-control" value="{{ $language->first_language }}">
                    @if($errors->has('first_language'))
                        <div class="text-danger errorFirstName">{{ $errors->first('first_language') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label><span style="color: red;">*</span>اللغة الثانية</label>
                    <input type="text" name="second_language" class="form-control" value="{{ $language->second_language }}">
                    @if($errors->has('second_language'))
                        <div class="text-danger errorSecondName">{{ $errors->first('second_language') }}</div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label><span style="color: red;">*</span>السعر بالجنيه المصري</label>
                    <input type="text" name="price" class="form-control" value="{{ $language->price }}">
                    @if($errors->has('price'))
                        <div class="text-danger errorPrice">{{ $errors->first('price') }}</div>
                    @endif
                </div>
            </div>

            <div class="col mb-3">
                <button type="submit" class="btn btn-success">تعديل اللغة</button>
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
            if ($(".errorFirstLanguage")){
                setTimeout(() => {
                    $('.errorFirstLanguage').fadeOut('slow');
                }, 4000);
            }
            if ($(".errorSecondLanguage")){
                setTimeout(() => {
                    $('.errorSecondLanguage').fadeOut('slow');
                }, 4000);
            }
            if ($(".errorEmail")){
                setTimeout(() => {
                    $('.errorPrice').fadeOut('slow');
                }, 4000);
            }
        });
    </script>

@endsection
