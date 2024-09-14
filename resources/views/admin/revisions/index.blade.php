@extends('app.indexAdmin')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        .disabledLink{
            pointer-events: none;
            cursor: default;
        }
    </style>

    <div class="row mb-3">
        <div class="col-md-12">
            <select name="type" id="type" class="form-control">
                <option disabled selected>-- اختر عملية البحث --</option>
                <option value="reset_number_id">باستخدام رقم الفاتورة</option>
                <option value="client_name">باستخدام اسم العميل</option>
                <option value="client_phone">باستخدام رقم تليفون العميل</option>
                <option value="reset_date">باستخدام تاريخ إنشاء الفاتورة</option>
                <option value="reset_recieved_date">باستخدام تاريخ استلام الفاتورة</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <div id="selectResetNumber" class="d-none">
                <input type="text" class="form-control w-50" id="reset_number_id" name="reset_number_id" placeholder="بحث باستخدام رقم الفاتورة">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchReset">بحث</button>
            </div>
            <div id="selectClientName" class="d-none">
                <input type="text" class="form-control w-50" id="reset_client_name" name="reset_client_name" placeholder="بحث باستخدام اسم العميل">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchReset">بحث</button>
            </div>
            <div id="selectClientPhone" class="d-none">
                <input type="text" class="form-control w-50" id="reset_client_phone" name="reset_client_phone" placeholder="بحث باستخدام رقم تليفون العميل">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchReset">بحث</button>
            </div>
            <div id="selectResetDate" class="d-none">
                <input type="date" class="form-control w-50" id="reset_date" name="reset_date" placeholder="بحث باستخدام تاريخ إنشاء الفاتورة">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchReset">بحث</button>
            </div>
            <div id="selectResetRecievedDate" class="d-none">
                <input type="date" class="form-control w-50" id="reset_recieved_date" name="reset_recieved_date" placeholder="بحث باستخدام تاريخ استلام الفاتورة">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchReset">بحث</button>
            </div>
        </div>
    </div>

    <div class="index-recieved-reset mb-3">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم العميل</th>
                <th scope="col">نوع الترجمة</th>
                <th scope="col">الحالة</th>
                <th scope="col">إجراءات</th>
              </tr>
            </thead>
            <tbody id="ifDataHere">
                @if(count($recieved_resets) > 0)
                    @foreach ($recieved_resets as $recieved_reset)
                        <tr>
                            <th scope="row">{{ $recieved_reset->id }}</th>
                            <td>{{ $recieved_reset->reset_client }}</td>
                            <td>{{ $recieved_reset->reset_translation }}</td>
                            <td>
                                @if($recieved_reset->is_revised == 1)
                                    <i class="fa fa-check" style="color: green;"></i>
                                @elseif($recieved_reset->is_revised == 2)
                                    <i class="fa fa-check" style="color: green;"></i><i class="fa fa-check" style="color: green;"></i>
                                @elseif($recieved_reset->is_revised == 3)
                                    <i class="fa fa-times" style="color: red;"></i>
                                @else
                                    <p>لم ترسل للمراجع بعد</p>
                                @endif
                            </td>
                            <td>
                                <a href="/show/revise/page/{{$recieved_reset->id}}" class="btn btn-success">مراجعة</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center"><td colspan="6">لا توجد معلومات بعد</td></tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $recieved_resets->links() !!}
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            let typeSearch = '';
            loading();
            setTimeout(() => {
                unloading();
            },1500);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click' , '.SendRevise' , function(e){
                let id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url:'/send/revision/'+id,
                    method:'GET',
                    success:function(res){
                        if(res == 1){
                            toastr.success('تم إرسالها للمراجع بنجاح');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }else{
                            toastr.error('something went wrong');
                        }
                    },error:function(err){
                        toastr.error(err);
                    }
                });
            });


            $('#type').on('click' , function(e){
                console.log(e.target.value);
                typeSearch = e.target.value;
                if(typeSearch == 'reset_number_id'){
                    $('#selectResetNumber').removeClass('d-none');
                    $('#selectResetNumber').addClass('d-flex');

                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'client_name'){
                    $('#selectClientName').removeClass('d-none');
                    $('#selectClientName').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'client_phone'){
                    $('#selectClientPhone').removeClass('d-none');
                    $('#selectClientPhone').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'reset_date'){
                    $('#selectResetDate').removeClass('d-none');
                    $('#selectResetDate').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'reset_recieved_date'){
                    $('#selectResetRecievedDate').removeClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                }
            });

            $('.searchReset').on('click' , function(e){
                loading();
                e.preventDefault();
                let inputValue = '';
                let formData = new FormData();
                if(typeSearch == 'reset_number_id'){
                    inputValue = $('#reset_number_id').val();
                    formData.append('reset_number_id' , inputValue);
                }

                if(typeSearch == 'client_name'){
                    inputValue = $('#reset_client_name').val();
                    formData.append('reset_client_name' , inputValue);
                }

                if(typeSearch == 'client_phone'){
                    inputValue = $('#reset_client_phone').val();
                    formData.append('reset_client_phone' , inputValue);
                }

                if(typeSearch == 'reset_date'){
                    inputValue = $('#reset_date').val();
                    formData.append('reset_date' , inputValue);
                }

                if(typeSearch == 'reset_recieved_date'){
                    inputValue = $('#reset_recieved_date').val();
                    formData.append('reset_recieved_date' , inputValue);
                }


                if(inputValue !== ''){
                    $.ajax({
                        url:'/search/revision',
                        method:'POST',
                        data:formData,
                        cache:false,
                        contentType:false,
                        processData:false,
                        success:function(res){
                            console.log(res.html);
                            if(res.html){
                                $('#ifDataHere').empty();
                                $("#ifDataHere").html(res.html);

                                setTimeout(() => {
                                    unloading();
                                },1500)
                            }else{
                                setTimeout(() => {
                                    console.log('hassan');
                                    unloading();
                                },1500);
                                console.log('nothing');
                            }
                        },
                    });
                }else{
                    window.location.reload();
                }
            });
        });
    </script>
@endsection
