@extends('app.indexAdmin')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        body{
            overflow-y: scroll !important;
        }
        ::-webkit-scrollbar {
            width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
    <div class="edit-recieved-reset">
        <h3>Edit Recieve Reset</h3>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <form enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>اسم العميل <span class="text-danger">*</span></label>
                    <input type="text" name="reset_client" id="reset_client" class="form-control" disabled value="{{ $notaryPublic->notary_client }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>رقم تليفون العميل <span class="text-danger">*</span></label>
                    <input type="text" name="reset_client_phone" id="reset_client_phone" class="form-control" disabled value="{{ $notaryPublic->notary_client_phone }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>الجهة <span class="text-danger">*</span></label>
                    <input type="text" name="reset_where" id="reset_where" disabled class="form-control" value="{{ $notaryPublic->notary_where }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>الغرض <span class="text-danger">*</span></label>
                    <textarea style="resize: none;" name="reset_for" id="reset_for" disabled cols="30" rows="5" class="form-control">{{ $notaryPublic->notary_for }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>كود العميل</label>
                    <input type="text" name="client_code" id="client_code" disabled class="form-control" value="{{ $notaryPublic->client_code }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                @foreach ($notaryFiles as $index => $notaryFile)
                    <div id="row" class="d-flex bd-highlight">
                        <div class="col-md-5 p-2 flex-grow-1 bd-highlight mb-3">
                            <label><span class="text-danger">*</span> اسم المستند</label>
                            <input class="form-control fileNames" disabled value="{{ $notaryFile->notary_file_name }}"/>
                        </div>
                        <div class="col-md-5 p-2 bd-highlight mb-3">
                            <label><span class="text-danger">*</span> أصل أو صورة</label>
                            <select class="form-control fileOriginal" disabled>
                                <option disabled selected>-- اختر أصل أو صورة --</option>
                                <option {{ $notaryFile->notary_file_original == '0' ? 'selected' : '' }} value="0"> أصل </option>
                                <option {{ $notaryFile->notary_file_original == '1' ? 'selected' : '' }} value="1"> صورة </option>
                            </select>
                        </div>
                        @if($index == 0)
                            <div class="col-md-2 mb-3 d-flex align-items-center">
                                <button id="rowAdder" type="button" disabled
                                    style="position: relative;top:11px"
                                    class="btn btn-dark">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> +
                                </button>
                            </div>
                        @else
                            <div class="col-md-2 d-flex align-items-center">
                                <button class="btn btn-danger" disabled id="DeleteRow" type="button">
                                    <i class="bi bi-trash"></i>
                                    x
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <div id="newinput"></div>

            <div class="row mb-3">
                <div class="col-md-12 mb-3">
                    <label>عدد الاوراق <span class="text-danger">*</span></label>
                    <input type="text" name="reset_pages_number" id="reset_pages_number" disabled class="form-control" value="{{ $notaryPublic->notary_pages_number }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-3">
                    <label>المبلغ الكلي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_total_cost" id="reset_total_cost" value="{{ $notaryPublic->notary_total_cost }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المدفوع<span class="text-danger">*</span></label>
                    <input type="text" name="reset_cost_paid" id="reset_cost_paid" value="{{ $notaryPublic->notary_cost_paid }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المتبقي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_cost_not_paid" id="reset_cost_not_paid" value="{{ $notaryPublic->notary_cost_not_paid }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>نوع عملية الدفع <span class="text-danger">*</span></label>
                    <select name="payment_type" id="payment_type" class="form-control" disabled>
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $notaryPublic->payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $notaryPublic->payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $notaryPublic->payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $notaryPublic->payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label>هل تريد عمل خصم للفاتورة ؟</label>
                    <input type="checkbox" {{ $notaryPublic->has_discount == '1' ? 'checked' : '' }} disabled name="has_discount" id="discount" disabled>
                </div>
            </div>

            @if ($notaryPublic->has_discount == '1')
                <div class="row mb-3 ifDiscount">
                    <div class="col-md-6">
                        <label>نسبة الخصم</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="discount_price" disabled value="{{ $notaryPublic->discount_price }}" id="discount_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>وصف الخصم</label>
                        <input type="text" name="discount_desc" disabled value="{{ $notaryPublic->discount_desc }}" id="discount_desc" class="form-control">
                    </div>
                </div>
            @else
                <div class="row mb-3 d-none ifDiscount">
                    <div class="col-md-6">
                        <label>نسبة الخصم</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="discount_price" disabled id="discount_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>وصف الخصم</label>
                        <input type="text" name="discount_desc" disabled id="discount_desc" class="form-control">
                    </div>
                </div>
            @endif



            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>موعد الاستلام <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="reset_recieved_date" id="reset_recieved_date" disabled class="form-control" value="{{ $notaryPublic->notary_recieved_date }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>ملاحظات للفاتورة</label>
                    <textarea style="resize: none;" name="reset_notes" id="reset_notes" cols="30" disabled rows="5" class="form-control">{{ $notaryPublic->notary_notes }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span>هل للفاتورة عملية سكان؟</label>
                    <select name="is_scan" class="form-control" id="is_scan" disabled>
                        <option disabled selected>-- اختر --</option>
                        <option {{ $notaryPublic->is_scan == '1' ? 'selected' : '' }} value="1">نعم له سكان</option>
                        <option {{ $notaryPublic->is_scan == '0' ? 'selected' : '' }} value="0">ليس له سكان</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span>هل للفاتورة عملية شحن؟</label>
                    <select name="has_delivered" class="form-control" id="has_delivered" disabled>
                        <option disabled selected>-- اختر --</option>
                        <option {{ $notaryPublic->has_delivered == '1' ? 'selected' : '' }} value="1">نعم له شحن</option>
                        <option {{ $notaryPublic->has_delivered == '0' ? 'selected' : '' }} value="0">ليس له شحن</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3 {{ $notaryPublic->is_scan == '1' ? "d-flex" : "d-none" }} isDisplayed">
                <div class="col-md-6 mb-3">
                    <label>مبلغ السكان <span class="text-danger">*</span></label>
                    <input type="text" name="scan_price" id="scan_price" disabled value="{{ $notaryPublic->scan_price }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع السكان <span class="text-danger">*</span></label>
                    <select name="scan_payment_type" id="scan_payment_type" class="form-control" disabled>
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $notaryPublic->scan_payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $notaryPublic->scan_payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $notaryPublic->scan_payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $notaryPublic->scan_payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 {{ $notaryPublic->has_delivered == '1' ? "d-flex" : "d-none" }} isDisplayedTwo">
                <div class="col-md-6 mb-3">
                    <label>مبلغ الشحن <span class="text-danger">*</span></label>
                    <input type="text" name="deliver_price" id="deliver_price" disabled value="{{ $notaryPublic->deliver_price }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع الشحن <span class="text-danger">*</span></label>
                    <select name="deliver_payment_type" id="deliver_payment_type" class="form-control" disabled>
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $notaryPublic->deliver_payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $notaryPublic->deliver_payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $notaryPublic->deliver_payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $notaryPublic->deliver_payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>


            @if(count($notaryPublic->notary_files) > 0 )
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h3>ملفات الفاتورة </h3>
                        <div class="allImages d-flex">
                            @foreach ($notaryPublic->notary_files as $recieved_r)
                                @if(\File::extension($recieved_r->file) == 'docx' || \File::extension($recieved_r->file) == 'doc')
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/word.png') }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:not-allowed;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/notary/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                                        </div>
                                    </div>
                                @elseif (\File::extension($recieved_r->file) == 'pdf')
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/pdf.png') }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:not-allowed;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/notary/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('uploads/' . $recieved_r->file) }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:not-allowed;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/notary/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            @else

            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="checkbox" {{ $notaryPublic->recieved_by == '1' ? "checked" : "" }} disabled id="recieved_by" name="recieved_by" />
                    <label><span class="text-danger">*</span>هل المستلم ليس بشخصه؟</label>
                </div>
                <div class="col-md-6 {{ $notaryPublic->recieved_by == '1' ? "d-block" : "d-none" }} isRecievedBy">
                    <div class="row">
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>اسم المستلم</label>
                            <input type="text" name="recieved_by_name" id="recieved_by_name" disabled value="{{ $notaryPublic->recieved_by_name }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>رقم تليفون المستلم</label>
                            <input type="text" name="recieved_by_phone" id="recieved_by_phone" disabled value="{{ $notaryPublic->recieved_by_phone }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <button id="submitRecieveReset" class="btn btn-success">مراجعة</button>
                    <a id="printReset" class="btn btn-primary">طباعة الفاتورة</a>
                    {{-- @if($notaryPublic->notary_cost_not_paid == 0)
                        <a id="printReset" class="btn btn-primary">طباعة الفاتورة</a>
                    @else
                        <a id="printResetTwo" class="btn btn-primary">طباعة الفاتورة</a>
                    @endif --}}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <textarea name="revert_reason" style="resize: none;" class="form-control" id="revert_reason" placeholder="Reason for reject reset" cols="30" rows="7"></textarea>
                    <br>
                    <button class="btn btn-primary" id="revertToSecratary">استرجاع الفاتورة بسبب خطأ ما</button>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function(){
            let currentURL = document.location.pathname;
            $('#revertToSecratary').attr('disabled' , true);
            let id = currentURL.split("/")[4];
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#printReset').on('click' , function(e){
                window.location.href = '/notary-public/'+id+'/printNotaryRevision';
            });

            $('#printResetTwo').on('click' , function(e){
                window.location.href = '/notary/check/payed/revision/'+id;
            });

            $('#submitRecieveReset').on('click' , function(e){
                loading();
                e.preventDefault();
                $.ajax({
                    url:'/notary/'+id+'/revise',
                    method:'GET',
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            unloading();
                            toastr.success('فاتورة النوتاري تم مراجعتها بنجاح');
                            setTimeout(() => {
                                window.location.href = '/revisions/notary';
                            }, 1500);
                        }else{
                            toast.error('something went wrong');
                        }
                    },error:function(err){
                        toastr.error(err);
                    }
                });
            });

            $('#revert_reason').on('keyup' , function(e){
                if(e.target.value !== ''){
                    $('#revertToSecratary').attr('disabled' , false);
                }else{
                    $('#revertToSecratary').attr('disabled' , true);
                }
            });

            $('#revertToSecratary').on('click' , function(e){
                loading();
                e.preventDefault();
                let formData = new FormData();
                let reason = $('#revert_reason').val();
                formData.append('revert_reason' , reason);

                $.ajax({
                    url:'/notary/'+id+'/revert',
                    method:'POST',
                    data:formData,
                    cache:false,
                    contentType:false,
                    processData:false,
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            unloading();
                            toastr.success('فاتورة النوتاري تم استرجاعها للسكرتيرة بسبب خطأ ما');
                            setTimeout(() => {
                                window.location.href = '/revisions/notary';
                            }, 1500);
                        }else{
                            toast.error('something went wrong');
                        }
                    },error:function(err){
                        toastr.error(err);
                    }
                });
            });
        });
    </script>

@endsection
