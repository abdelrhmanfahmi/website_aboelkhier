@extends('app.indexAdmin')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                <option value="client_code">باستخدام كود العميل</option>
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
            <div id="selectClientCode" class="d-none">
                <input type="text" class="form-control w-50" id="client_code" name="client_code" placeholder="بحث باستخدام كود العميل">
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
                    <th scope="col">نوع الترجمة للفاتورة</th>
                    <th scope="col">هل الفاتورة مكتملة؟</th>
                    <th scope="col">الحالة</th>
                    <th scope="col">إجراءات</th>
                  </tr>
            </thead>
            <tbody id="ifDataHere">
                @if(count($resets) > 0)
                    @foreach ($resets as $recieved_reset)
                        <tr>
                            <th scope="row">{{ $recieved_reset->id }}</th>
                            <td>{{ $recieved_reset->reset_client }}</td>
                            <td>{{ $recieved_reset->reset_translation }}</td>
                            <td>{{ $recieved_reset->is_draft == 1 ? 'مكتمل' : 'غير مكتمل' }}</td>
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
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">

                                            <li><a href="/resets/{{$recieved_reset->id}}/print" class="dropdown-item">طباعة الفاتورة احتياطي</a></li>
                                            &nbsp;
                                            @if($recieved_reset->reset_cost_not_paid == 0)
                                                <li><a href="/resets/{{$recieved_reset->id}}/print" class="dropdown-item">طباعة الفاتورة للعميل</a></li>
                                            @else
                                                <li><a href="/reset/check/payed/{{ $recieved_reset->id }}" class="dropdown-item">طباعة الفاتورة للعميل</a></li>
                                            @endif
                                            &nbsp;
                                            <li><a href="/resets/{{$recieved_reset->id}}/printForSystem" class="dropdown-item">طباعة الفاتورة للشركة</a></li>
                                            &nbsp;
                                            <li><a href="/resets/{{$recieved_reset->id}}/edit" class="btn btn-success dropdown-item">تعديل الفاتورة</a></li>
                                            &nbsp;
                                            <li><a data-id="{{ $recieved_reset->id }}" class="btn btn-primary copyReset dropdown-item">نسخ الفاتورة</a></li>
                                            &nbsp;
                                            <!--<li><a href="/showCopyFilesReset/{{$recieved_reset->id}}" class="btn btn-primary dropdown-item">كوبي للملفات</a></li>-->
                                            <!--&nbsp;-->

                                            <li>
                                                <form method="POST" action="resets/{{$recieved_reset->id}}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <div class="">
                                                        <input type="submit" class="btn btn-danger dropdown-item" value="مسح الفاتورة">
                                                    </div>
                                                </form>
                                            </li>

                                            &nbsp;

                                            @if ($recieved_reset->is_revised == 0 && $recieved_reset->is_draft == 0)
                                                <li><a class="btn btn-secondary disabledLink dropdown-item" >هذه الفاتورة لم يتم استكمالها </a></li>
                                            @elseif($recieved_reset->is_revised == 0 && $recieved_reset->is_draft == 1)
                                                <li><a data-id="{{ $recieved_reset->id }}" class="btn btn-warning SendRevise dropdown-item">مراجعة</a></li>
                                            @elseif($recieved_reset->is_revised == 3)
                                                <li><a href="/show/reset/reason/{{ $recieved_reset->id }}" class="dropdown-item">تم استرحعها من المراجع</a></li>
                                            @else
                                                <li>
                                                    @if($recieved_reset->is_payed == '1' && $recieved_reset->is_company == 1)
                                                        <li><a href="/resets/{{$recieved_reset->id}}/printForCompany" class="dropdown-item">جاهزة للاستلام</a></li>
                                                    @elseif ($recieved_reset->is_payed == '1' && $recieved_reset->is_company == 0)
                                                        <li><a href="/resets/{{$recieved_reset->id}}/print" class="dropdown-item">جاهزة للاستلام</a></li>
                                                    @else
                                                        <a href="/reset/check/payed/{{ $recieved_reset->id }}" class="btn btn-secondary dropdown-item" >جاهزة للاستلام</a>
                                                    @endif
                                                </li>
                                            @endif

                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center"><td colspan="6">لا توجد معلومات بعد</td></tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $resets->links() !!}
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
                $.ajax({
                    url:'/send/revision/'+id,
                    method:'GET',
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            toastr.success('تم إرسالها للمراجع بنجاح');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }else{
                            toastr.error('حدث خطأ ما');
                        }
                    }
                });
            });

            $(document).on('click' , '.copyReset' , function(e){
                let id = $(this).attr('data-id');
                e.preventDefault();
                $.ajax({
                    url:'/copy/resets/'+id,
                    method:'GET',
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            toastr.success('الفاتورة تم نسخها بنجاح');
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        }else{
                            toastr.error('حدث خطأ ما');
                        }
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
                    $('#selectClientCode').addClass('d-none');
                }

                if(typeSearch == 'client_code'){
                    $('#selectClientCode').removeClass('d-none');
                    $('#selectClientCode').addClass('d-flex');

                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                    $('#selectResetNumber').addClass('d-none');
                }

                if(typeSearch == 'client_name'){
                    $('#selectClientName').removeClass('d-none');
                    $('#selectClientName').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                    $('#selectClientCode').addClass('d-none');
                }
                if(typeSearch == 'client_phone'){
                    $('#selectClientPhone').removeClass('d-none');
                    $('#selectClientPhone').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                    $('#selectClientCode').addClass('d-none');
                }
                if(typeSearch == 'reset_date'){
                    $('#selectResetDate').removeClass('d-none');
                    $('#selectResetDate').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-none');
                    $('#selectClientCode').addClass('d-none');
                }
                if(typeSearch == 'reset_recieved_date'){
                    $('#selectResetRecievedDate').removeClass('d-none');
                    $('#selectResetRecievedDate').addClass('d-flex');

                    $('#selectResetNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectResetDate').addClass('d-none');
                    $('#selectClientCode').addClass('d-none');
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

                if(typeSearch == 'client_code'){
                    inputValue = $('#client_code').val();
                    formData.append('client_code' , inputValue);
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
                        url:'/search',
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
