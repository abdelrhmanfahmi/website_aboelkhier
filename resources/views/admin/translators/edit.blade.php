@extends('app.indexAdmin')
@section('main')

    <div class="container-fluid">
        <div class="row">
            <form action="{{ route('translators.update' , $translator->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label><span style="color: red;">*</span>الاسم</label>
                        <input type="text" name="name" class="form-control" value="{{ $translator->name }}">
                    </div>
                </div>
                <div class="row">
                    @foreach($dateTranslators as $index => $dateTranslator)
                        <div id="row" class="d-flex bd-highlight">
                            <div class="col-md-5 p-2 flex-grow-1 bd-highlight mb-3">
                                <label><span style="color: red;">*</span>البريد الالكتروني</label>
                                <input type="text" name="emails[]" value="{{ $dateTranslator->email }}" class="form-control emailsData">
                            </div>
                            <div class="col-md-5 p-2 bd-highlight mb-3">
                                <label><span style="color: red;">*</span>رقم التليفون</label>
                                <input type="text" name="phones[]" value="{{ $dateTranslator->phone }}" class="form-control phonesData">
                            </div>
                            @if($index == 0)
                                <div class="col-md-2 mb-3 d-flex align-items-center">
                                    <button id="rowAdder" type="button"
                                        style="position: relative;top:11px"
                                        class="btn btn-dark">
                                        <span class="bi bi-plus-square-dotted">
                                        </span> إضافة
                                    </button>
                                </div>
                            @else
                                <div class="col-md-2 d-flex align-items-center">
                                    <button class="btn btn-danger" id="DeleteRow" type="button">
                                        <i class="bi bi-trash"></i>
                                        مسح
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div id="newinput"></div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-success">تعديل مترجم</button>
                    </div>
                </div>
            </form>
        </div>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="text-danger dataAll">{{$error}}</div>
            @endforeach
        @endif
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            loading();
            setTimeout(() => {
                unloading();
            },1500);
            $("#rowAdder").click(function () {
                newRowAdd =`
                <div id="row" class="row d-flex">
                    <div class="col-md-5 mb-3">
                        <label><span style="color: red;">*</span>البريد الالكتروني</label>
                        <input type="text" name="emails[]" class="form-control emailsData">
                    </div>
                    <div class="col-md-5 mb-3">
                        <label><span style="color: red;">*</span>رقم التليفون</label>
                        <input type="text" name="phones[]" class="form-control phonesData">
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button class="btn btn-danger" id="DeleteRow" type="button">
                            <i class="bi bi-trash"></i>
                            مسح
                        </button>
                    </div>
                </div>`;

                $('#newinput').append(newRowAdd);
            });

            $("body").on("click", "#DeleteRow", function () {
                $(this).parents("#row").remove();
            });

            if ($(".dataAll")){
                setTimeout(() => {
                    $('.dataAll').fadeOut('slow');
                }, 7000);
            }
        });
    </script>

@endsection
