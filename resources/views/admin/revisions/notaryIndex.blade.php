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

    {{-- <div class="row mb-3">
        <div class="col-md-12">
            <select name="type" id="type" class="form-control">
                <option disabled selected>-- choose option search --</option>
                <option value="notary_number_id">By Notary Id</option>
                <option value="client_name">By Client Name</option>
                <option value="client_phone">By Client Phone</option>
                <option value="notary_date">By Notary Date</option>
                <option value="notary_recieved_date">By Notary Recieved Date</option>
            </select>
        </div>
    </div> --}}

    {{-- <div class="row mb-3">
        <div class="col-md-12">
            <div id="selectNotaryNumber" class="d-none">
                <input type="text" class="form-control w-50" id="notary_number_id" name="notary_number_id" placeholder="Search By Notary Number">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchNotary">Search</button>
            </div>
            <div id="selectClientName" class="d-none">
                <input type="text" class="form-control w-50" id="notary_client_name" name="notary_client_name" placeholder="Search By Notary Client Name">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchNotary">Search</button>
            </div>
            <div id="selectClientPhone" class="d-none">
                <input type="text" class="form-control w-50" id="notary_client_phone" name="notary_client_phone" placeholder="Search By Notary Client Phone">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchNotary">Search</button>
            </div>
            <div id="selectNotaryDate" class="d-none">
                <input type="date" class="form-control w-50" id="notary_date" name="notary_date" placeholder="Search By Notary Date">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchNotary">Search</button>
            </div>
            <div id="selectNotaryRecievedDate" class="d-none">
                <input type="date" class="form-control w-50" id="notary_recieved_date" name="notary_recieved_date" placeholder="Search By Notary Recieved Date">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary searchNotary">Search</button>
            </div>
        </div>
    </div> --}}

    <div class="notaryPublic">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اسم العميل</th>
                <th scope="col">عدد اوراق فاتورة النوتاري</th>
                <th scope="col">المبلغ الكلي للفاتورة</th>
                <th scope="col">الحالة</th>
                <th scope="col">إجراءات</th>
              </tr>
            </thead>
            <tbody id="ifDataHere">
                @if(count($notary) > 0)
                    @foreach ($notary as $index => $n)
                        <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $n->notary_client }}</td>
                            <td>{{ $n->notary_pages_number }}</td>
                            <td>{{ $n->notary_total_cost }}</td>
                            <td>
                                @if($n->is_revised == 1)
                                    <i class="fa fa-check" style="color: green;"></i>
                                @elseif($n->is_revised == 2)
                                    <i class="fa fa-check" style="color: green;"></i><i class="fa fa-check" style="color: green;"></i>
                                @else
                                    <i class="fa fa-times" style="color: red;"></i>
                                @endif
                            </td>
                            <td>
                                <a href="/show/notaryRevise/page/{{$n->id}}" class="btn btn-success">مراجعة الفاتورة</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center"><td colspan="5">لا توجد معلومات بعد</td></tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $notary->links() !!}
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

        $('#type').on('click' , function(e){
                console.log(e.target.value);
                typeSearch = e.target.value;
                if(typeSearch == 'notary_number_id'){
                    $('#selectNotaryNumber').removeClass('d-none');
                    $('#selectNotaryNumber').addClass('d-flex');

                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectNotaryDate').addClass('d-none');
                    $('#selectNotaryRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'client_name'){
                    $('#selectClientName').removeClass('d-none');
                    $('#selectClientName').addClass('d-flex');

                    $('#selectNotaryNumber').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectNotaryDate').addClass('d-none');
                    $('#selectNotaryRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'client_phone'){
                    $('#selectClientPhone').removeClass('d-none');
                    $('#selectClientPhone').addClass('d-flex');

                    $('#selectNotaryNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectNotaryDate').addClass('d-none');
                    $('#selectNotaryRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'notary_date'){
                    $('#selectNotaryDate').removeClass('d-none');
                    $('#selectNotaryDate').addClass('d-flex');

                    $('#selectNotaryNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectNotaryRecievedDate').addClass('d-none');
                }
                if(typeSearch == 'notary_recieved_date'){
                    $('#selectNotaryRecievedDate').removeClass('d-none');
                    $('#selectNotaryRecievedDate').addClass('d-flex');

                    $('#selectNotaryNumber').addClass('d-none');
                    $('#selectClientName').addClass('d-none');
                    $('#selectClientPhone').addClass('d-none');
                    $('#selectNotaryDate').addClass('d-none');
                }
            });

            $('.searchNotary').on('click' , function(e){
                loading();
                e.preventDefault();
                let inputValue = '';
                let formData = new FormData();
                if(typeSearch == 'notary_number_id'){
                    inputValue = $('#notary_number_id').val();
                    formData.append('notary_number_id' , inputValue);
                }

                if(typeSearch == 'client_name'){
                    inputValue = $('#notary_client_name').val();
                    formData.append('notary_client_name' , inputValue);
                }

                if(typeSearch == 'client_phone'){
                    inputValue = $('#notary_client_phone').val();
                    formData.append('notary_client_phone' , inputValue);
                }

                if(typeSearch == 'notary_date'){
                    inputValue = $('#notary_date').val();
                    formData.append('notary_date' , inputValue);
                }

                if(typeSearch == 'notary_recieved_date'){
                    inputValue = $('#notary_recieved_date').val();
                    formData.append('notary_recieved_date' , inputValue);
                }


                if(inputValue !== ''){
                    $.ajax({
                        url:'/search/notary/public',
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
    })
</script>
@endsection
