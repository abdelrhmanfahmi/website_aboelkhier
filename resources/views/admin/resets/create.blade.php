@extends('app.indexAdmin')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        body{
            overflow-y: scroll !important;
        }
        #translators_chosen{
            width:100% !important;
        }
    </style>
    <div class="create-recieved-reset">
        <h3>إضافة فاتورة جديدة</h3>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <form id="submitRecieveReset" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span>اسم العميل </label>
                    <input type="text" name="reset_client" id="reset_client" class="form-control" value="{{ old('reset_client') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span>رقم تليفون العميل </label>
                    <input type="text" name="reset_client_phone" id="reset_client_phone" class="form-control" value="{{ old('reset_client_phone') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>رقم تليفون العميل الاحتياطي</label>
                    <input type="text" name="reset_client_phone_second" id="reset_client_phone_second" class="form-control" value="{{ old('reset_client_phone_second') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>مسؤول التعديل</label>
                    <select name="edit_user_id" id="edit_user_id" class="form-control">
                        <option disabled selected>-- اختر مسؤول --</option>
                        @foreach ($edit_users_id as $edit_user_id)
                            <option value="{{ $edit_user_id->id }}">{{ $edit_user_id->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label>نوع الترجمة <span class="text-danger">*</span></label>
                    <select name="reset_translation" id="reset_translation" class="form-control">
                        <option disabled selected>-- اختر نوع الترجمة --</option>
                        <option value="معتمدة">معتمدة</option>
                        <option value="غير معتمدة">غير معتمدة</option>
                        <option value="طبي">طبي</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>الجهة <span class="text-danger">*</span></label>
                    <input type="text" name="reset_where" id="reset_where" class="form-control" value="{{ old('reset_where') }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>الغرض <span class="text-danger">*</span></label>
                    <textarea style="resize: none;" name="reset_for" id="reset_for" cols="30" rows="5" class="form-control">{{ old('reset_for') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>كود العميل</label>
                    <input type="text" name="client_code" id="client_code" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-5 mb-3">
                    <label><span class="text-danger">*</span> اسم المستند</label>
                    <input class="form-control fileNames"/>
                </div>
                <div class="col-md-5 mb-3">
                    <label><span class="text-danger">*</span> أصل أو صورة</label>
                    <select class="form-control fileOriginal">
                        <option disabled selected>-- اختر اصل او صورة --</option>
                        <option value="0">أصل</option>
                        <option value="1">صورة</option>
                    </select>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button id="rowAdder" type="button"
                        class="btn btn-dark">
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>
                </div>
            </div>

            <div id="newinput"></div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>عدد الاوراق <span class="text-danger">*</span></label>
                    <input type="text" name="reset_pages_number" id="reset_pages_number" class="form-control" value="{{ old('reset_pages_number') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>لغة الترجمة <span class="text-danger">*</span></label>
                    <select name="language_id" id="language_id" class="form-control" disabled>
                        <option disabled selected value="null">-- اختر لغة الترجمة --</option>
                        @foreach ($languages as $language)
                            <option value="{{ $language->id }}">{{ $language->first_language }} To {{ $language->second_language }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>فوري</label>
                    <input type="checkbox" name="nowsRushed" id="nows" disabled>

                    &nbsp;

                    <label>مستعجل</label>
                    <input type="checkbox" name="nowsRushed" id="rushed" disabled>
                </div>
                <div class="col-md-6">
                    <label>هل تريد عمل كوبي لملفات الشخص؟</label>
                    <input type="checkbox" name="copies" id="copies" disabled>
                </div>
            </div>

            <div class="row mb-3 d-none ifClickedCopy">
                <div class="col-md-5 mb-3">
                    <label><span class="text-danger">*</span>اسم المستند المراد عمل نسخة منه</label>
                    <input class="form-control fileNamesCopies"/>
                </div>
                <div class="col-md-5 mb-3">
                    <label><span class="text-danger">*</span>عدد النسخ</label>
                    <input type="number" class="form-control fileNumberCopies"/>
                </div>
                <div class="col-md-2 mb-3 d-flex align-items-end">
                    <button id="rowAdderCopies" type="button"
                        class="btn btn-dark">
                        <span class="bi bi-plus-square-dotted">
                        </span> +
                    </button>
                </div>
            </div>

            <div id="newinputCopies"></div>

            <div class="row mb-3">
                <div class="col-md-3 mb-3">
                    <label>المبلغ الكلي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_total_cost" id="reset_total_cost" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المدفوع<span class="text-danger">*</span></label>
                    <input type="text" name="reset_cost_paid" id="reset_cost_paid" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المتبقي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_cost_not_paid" id="reset_cost_not_paid" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>نوع عملية الدفع <span class="text-danger">*</span></label>
                    <select name="payment_type" id="payment_type" class="form-control">
                        <option disabled selected>-- اختر عملية الدفع --</option>
                        <option value="cash">cash</option>
                        <option value="visa">visa</option>
                        <option value="vodafone_cash">vodafone_cash</option>
                        <option value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>هل تريد عمل خصم للفاتورة ؟</label>
                    <input type="checkbox" name="has_discount" id="discount" disabled>
                </div>
            </div>

            <div class="row mb-3 d-none ifDiscount">
                <div class="col-md-6">
                    <label>رقم الخصم</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" name="discount_price" id="discount_price" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <label>وصف الخصم</label>
                    <input type="text" name="discount_desc" id="discount_desc" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label>موعد الاستلام <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="reset_recieved_date" id="reset_recieved_date" class="form-control" value="{{ old('reset_recieved_date') }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label>ملاحظات للفاتورة</label>
                    <textarea style="resize: none;" name="reset_notes" id="reset_notes" cols="30" rows="5" class="form-control">{{ old('reset_notes') }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label>ملاحظات للعميل عن الفاتورة</label>
                    <textarea style="resize: none;" name="reset_notes_client" id="reset_notes_client" cols="30" rows="5" class="form-control">{{ old('reset_notes_client') }}</textarea>
                </div>

            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>الاسماء باللغة الإنجليزية <span class="text-danger">*</span></label>
                    <textarea style="resize: none;" name="reset_name_english" id="reset_name_english" cols="30" rows="5" class="form-control">{{ old('reset_name_english') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>مترجمين الفاتورة </label>
                    <select name="translators[]" multiple id="translators" class="form-control">
                        @foreach ($translators as $translator)
                            <option value="{{ $translator->id }}">{{ $translator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>ملاحظات للمترجمين عن الفاتورة</label>
                    <textarea style="resize: none;" name="translator_notes" id="translator_notes" cols="30" rows="5" class="form-control">{{ old('translator_notes') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>هل للفاتورة عملية سكان؟</label>
                    <select name="is_scan" class="form-control" id="is_scan">
                        <option disabled selected>-- اختر --</option>
                        <option value="1">نعم له سكان</option>
                        <option value="0">ليس له سكان</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>هل للفاتورة عملية شحن؟</label>
                    <select name="has_delivered" class="form-control" id="has_delivered">
                        <option disabled selected>-- اختر --</option>
                        <option value="1">نعم له شحن</option>
                        <option value="0">ليس له شحن</option>
                    </select>
                </div>
            </div>

            <div class="row d-none isDisplayed">
                <div class="col-md-6 mb-3">
                    <label>مبلغ السكان </label>
                    <input type="text" name="scan_price" id="scan_price" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع السكان </label>
                    <select name="scan_payment_type" id="scan_payment_type" class="form-control">
                        <option disabled selected>-- اختر عملية الدفع --</option>
                        <option value="cash">cash</option>
                        <option value="visa">visa</option>
                        <option value="vodafone_cash">vodafone_cash</option>
                        <option value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row d-none isDisplayedTwo">
                <div class="col-md-6 mb-3">
                    <label>مبلغ الشحن </label>
                    <input type="text" name="deliver_price" id="deliver_price" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع الشحن </label>
                    <select name="deliver_payment_type" id="deliver_payment_type" class="form-control">
                        <option disabled selected>-- اختر عملية الدفع --</option>
                        <option value="cash">cash</option>
                        <option value="visa">visa</option>
                        <option value="vodafone_cash">vodafone_cash</option>
                        <option value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <input type="file" class="form-control mb-3" name="files[]" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
                    text/plain, application/pdf, image/*,.doc,.docx" multiple id="uploadRecievedResetFile">
                    <output class="d-flex" style="overflow: auto;"></output>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="checkbox" id="recieved_by" name="recieved_by" />
                    <label>هل المستلم ليس بشخصه؟</label>
                </div>
                <div class="col-md-6 d-none isRecievedBy">
                    <div class="row">
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>اسم المستلم</label>
                            <input type="text" name="recieved_by_name" id="recieved_by_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label><span class="text-danger">*</span>رقم تليفون المستلم</label>
                            <input type="text" name="recieved_by_phone" id="recieved_by_phone" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <input type="checkbox" id="is_company" name="is_company" /> &nbsp;
                    <label>هل العميل شركة؟</label>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <button type="submit" id="buttonToSubmit" class="btn btn-success">حفظ الفاتورة</button>
                    <a id="printReset" class="btn btn-primary" style="pointer-events: none">طباعة الفاتورة للعميل</a>
                    <a id="printResetSystem" class="btn btn-primary" style="pointer-events: none">طباعة الفاتورة للشركة</a>
                    <a href="{{ route('resets.index') }}" class="btn btn-warning" id="backIndex" style="pointer-events: none">رجوع</a>
                </div>
            </div>
        </form>
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

            $('#reset_translation').on('change' , function(e){
                $('#language_id').val('null');
                $('#rushed').prop('checked' , false);
                $('#nows').prop('checked' , false);
                $('#discount').prop('checked' , false);
                $('#reset_total_cost').val('');
                $('#reset_cost_not_paid').val('');
                $('#reset_cost_paid').val('');
                $('#reset_cost_paid').prop('disabled' , true);

                $('#copies').prop('checked' , false);
                $('.ifClickedCopy').addClass('d-none');
                $('.fileNamesCopies').each(function() {
                    $(this).val('');
                });
                $('.fileNumberCopies').each(function() {
                    $(this).val('');
                });

                if(e.target.value == 'معتمدة'){
                    localStorage.setItem('reset_translation' , 'certified');
                }else if(e.target.value == 'غير معتمدة'){
                    localStorage.setItem('reset_translation' , 'not_certified');
                }else{
                    localStorage.setItem('reset_translation' , 'medical');
                }
            });

            $("#rowAdder").click(function () {
                newRowAdd =`
                <div id="row" class="row">
                    <div class="col-md-5 mb-3">
                        <label><span class="text-danger">*</span> اسم المستند</label>
                        <input class="form-control fileNames" />
                    </div>
                    <div class="col-md-5 mb-3">
                        <label><span class="text-danger">*</span> أصل أو صورة</label>
                        <select class="form-control fileOriginal">
                            <option disabled selected>-- اختر أصل أو صورة --</option>
                            <option value="0">أصل</option>
                            <option value="1">صورة</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-center">
                        <button class="btn btn-danger" id="DeleteRow" type="button">
                            <i class="bi bi-trash"></i>
                            x
                        </button>
                    </div>
                </div>`;

                $('#newinput').append(newRowAdd);
            });

            $('#rowAdderCopies').click(function () {
                newRowAddCopies =`
                    <div id="row" class="row ifClickedCopy">
                        <div class="col-md-5 mb-3">
                            <label><span class="text-danger">*</span>اسم المستند المراد عمل نسخة منه</label>
                            <input class="form-control fileNamesCopies"/>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label><span class="text-danger">*</span>عدد النسخ</label>
                            <input type="number" class="form-control fileNumberCopies"/>
                        </div>
                        <div class="col-md-2 d-flex align-items-center">
                            <button class="btn btn-danger" id="DeleteRowCopies" type="button">
                                <i class="bi bi-trash"></i>
                                x
                            </button>
                        </div>
                    </div>
                `;
                $('#newinputCopies').append(newRowAddCopies);

                $('.fileNamesCopies').each(function(){
                    $(this).attr('required' , true);
                });
                $('.fileNumberCopies').each(function(){
                    $(this).attr('required' , true);
                });
            });

            $("body").on("click", "#DeleteRow", function () {
                $(this).parents("#row").remove();
            });

            $("body").on("click", "#DeleteRowCopies", function () {
                $('.ifClickedCopy').addClass('d-none');
                $('#copies').prop('checked' , false);
                $('.fileNamesCopies').each(function() {
                    $(this).val('');
                    $(this).attr('required' , false);
                });
                $('.fileNumberCopies').each(function() {
                    $(this).val('');
                    $(this).attr('required' , false);
                });

                $('#reset_cost_paid').val('');
                if($('#nows').is(':checked')){
                    $('#reset_total_cost').val(+TotalCostNows);
                }else if($('#rushed').is(':checked')){
                    $('#reset_total_cost').val(+TotalCostRushed);
                }else{
                    $('#reset_total_cost').val(+TotalCost);
                }
                $(this).parents("#row").remove();
            });

            let numberOfPages = 0;
            let TotalCost = 0;
            let TotalCostNows = 0;
            let TotalCostRushed = 0;
            let arrFilesNames = [];
            let arrFilesOriginal = [];
            let arrCopyFilesNames = [];
            let arrCopyNumbers = [];
            let languageCost = 0;
            let TotalCostFromCopies = 0;
            let OverAllCostFromCopies = 0;
            let isValid = false;

            let d = new Date();
            let month = d.getMonth()+1;
            let day = d.getDate();
            let minute = d.getMinutes();
            let second = d.getSeconds();
            let hour = d.getHours();

            if(month < 10){
                month = "0"+month;
            }
            if(day < 10){
                day = "0"+day;
            }
            if(minute < 10){
                minute = "0"+minute;
            }
            if(second < 10){
                second = "0"+second;
            }
            if(hour < 10){
                hour = "0"+hour;
            }

            let reset_date = d.getFullYear()  + "-" + month + "-" + day + " " +
            hour + ":" + minute + ":" + second;

            let today = new Date().toISOString().slice(0, 16);
            let originaImageFile = null;

            document.getElementById('reset_recieved_date').min = today;

            $('#reset_pages_number').on('keyup' , function(e){
                let valid = e.target.value.match(/^\d*[1-9]\d*$/) ? "true" : "false";
                if(e.target.value == "" || valid == "false"){
                    $('#language_id').prop('disabled' , true);
                    $('#rushed').prop('checked' , false);
                    $('#nows').prop('checked' , false);
                    $('#reset_total_cost').val('');
                    $('#reset_cost_not_paid').val('');
                    $('#reset_cost_paid').val('');


                    $('#discount').prop('checked' , false);
                    $('.ifDiscount').addClass('d-none');
                    $('#discount_price').val('');
                    $('#discount_desc').val('');

                    $('#copies').prop('checked' , false);
                    $('.ifClickedCopy').addClass('d-none');
                    $('.fileNamesCopies').each(function() {
                        $(this).val('');
                    });
                    $('.fileNumberCopies').each(function() {
                        $(this).val('');
                    });
                }else{
                    $('#language_id').prop('disabled' , false);
                    $('#language_id').val('null');
                    $('#rushed').prop('checked' , false);
                    $('#nows').prop('checked' , false);
                    $('#copies').prop('checked' , false);
                    $('#reset_total_cost').val('');
                    $('#reset_cost_not_paid').val('');
                    $('#reset_cost_paid').val('');
                    $('#reset_cost_paid').prop('disabled' , true);
                }
                numberOfPages = e.target.value;
            });

            $('#language_id').on('change' , function(e){
                let id = e.target.value;
                let resetTranslation = localStorage.getItem('reset_translation');
                $.ajax({
                    url:'/get/price/language/'+id,
                    method: 'GET',
                    success:function(res){
                        languageCost = res;
                        $('#reset_total_cost').prop('disabled' , true);
                        $('#reset_cost_paid').prop('disabled' , false);
                        $('#nows').prop('disabled' , false);
                        $('#rushed').prop('disabled' , false);

                        $('#discount').prop('disabled' , false);
                        $('#copies').prop('disabled' , false);

                        $('#nows').prop('checked' , false);
                        $('#rushed').prop('checked' , false);

                        $('#copies').prop('checked' , false);
                        $('.ifClickedCopy').addClass('d-none');
                        $('.fileNamesCopies').each(function() {
                            $(this).val('');
                        });
                        $('.fileNumberCopies').each(function() {
                            $(this).val('');
                        });


                        $('#discount').prop('checked' , false);
                        $('.ifDiscount').addClass('d-none');
                        $('#discount_price').val('');
                        $('#discount_desc').val('');

                        $('#reset_cost_not_paid').prop('disabled' , true);
                        $('#reset_total_cost').val('');
                        TotalCost = numberOfPages*res;
                        if(resetTranslation == 'certified'){
                            $('#reset_total_cost').val(numberOfPages*res);
                            TotalCost = numberOfPages*res;
                        }else if(resetTranslation == 'not_certified'){
                            let handlerNumPagesOne = numberOfPages*10;
                            $('#reset_total_cost').val((numberOfPages*res)-handlerNumPagesOne);
                            TotalCost = (numberOfPages*res)-handlerNumPagesOne;
                        }else{
                            let handlerNumPagesTwo = numberOfPages*50;
                            $('#reset_total_cost').val((numberOfPages*res)+handlerNumPagesTwo);
                            TotalCost = (numberOfPages*res)+handlerNumPagesTwo;
                        }
                    },
                });
            });

            $('#reset_cost_paid').on('keyup' , function(e){
                $('#reset_cost_not_paid').val(0);
                let valid = e.target.value.match(/^\d*[0-9]\d*$/) ? "true" : "false";
                if(e.target.value == "" || valid == "false"){
                    $('#reset_cost_not_paid').prop('disabled' , true);
                    $('#reset_cost_not_paid').val(0);
                }else{
                    $('#reset_cost_not_paid').prop('disabled' , true);
                    if($('#nows').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed four');
                        console.log(OverAllCostFromCopies);
                        // if(e.target.value > (+TotalCostNows+TotalCostFromCopies)){
                        if(e.target.value > (+OverAllCostFromCopies)){
                            $('#reset_cost_paid').val((+OverAllCostFromCopies));
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == (+OverAllCostFromCopies)){
                            $('#reset_cost_not_paid').val(0);
                        }else{
                            $('#reset_cost_not_paid').val((+OverAllCostFromCopies) - e.target.value);
                        }
                    }else if($('#rushed').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed five');
                        console.log(OverAllCostFromCopies);
                        if(e.target.value > (+OverAllCostFromCopies)){
                            $('#reset_cost_paid').val((+OverAllCostFromCopies));
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == (+OverAllCostFromCopies)){
                            $('#reset_cost_not_paid').val(0);
                        }else{
                            $('#reset_cost_not_paid').val((+OverAllCostFromCopies) - e.target.value);
                        }
                    }else if($('#copies').is(':checked')){
                        console.log('sayed three');
                        console.log(OverAllCostFromCopies);
                        if(e.target.value > +OverAllCostFromCopies){
                            $('#reset_cost_paid').val(+OverAllCostFromCopies);
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == +OverAllCostFromCopies){
                            $('#reset_cost_not_paid').val(0);
                        }else{
                            $('#reset_cost_not_paid').val(+OverAllCostFromCopies - e.target.value);
                        }
                    }else if($('#nows').is(':checked')){
                        console.log('sayed one');
                        if(e.target.value > +TotalCostNows){
                            $('#reset_cost_paid').val(+TotalCostNows);
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == +TotalCostNows){
                            $('#reset_cost_not_paid').val(0);
                        }else{
                            $('#reset_cost_not_paid').val(+TotalCostNows - e.target.value);
                        }
                    }else if($('#rushed').is(':checked')){
                        console.log('sayed two');
                        if(e.target.value > +TotalCostRushed){
                            $('#reset_cost_paid').val(+TotalCostRushed);
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == +TotalCostRushed){
                            $('#reset_cost_not_paid').val(0);
                        }else{
                            $('#reset_cost_not_paid').val(+TotalCostRushed - e.target.value);
                        }
                    }else{
                        console.log('sayed six');
                        if(e.target.value > +TotalCost){
                            $('#reset_cost_paid').val(+TotalCost);
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == +TotalCost){
                            $('#reset_cost_not_paid').val(0);
                        }else if(e.target.value == 0){
                            $('#reset_cost_not_paid').val(+TotalCost);
                        }else{
                            $('#reset_cost_not_paid').val(+TotalCost - e.target.value);
                        }
                    }
                }
            });

            $('#nows').on('change' , function(e){
                $('#copies').prop('checked' , false);
                $('.ifClickedCopy').addClass('d-none');

                $('.fileNamesCopies').each(function() {
                    $(this).val('');
                });
                $('.fileNumberCopies').each(function() {
                    $(this).val('');
                });

                $('#discount').prop('checked' , false);
                $('.ifDiscount').addClass('d-none');
                $('#discount_price').val('');
                $('#discount_desc').val('');
                if(e.target.checked == true){
                    let totalMoneyNows = $('#reset_total_cost').val(+TotalCost*2);
                    TotalCostNows = totalMoneyNows.val();
                    $('#rushed').prop('checked' , false);
                    $('#reset_cost_not_paid').val(0);
                    $('#reset_cost_paid').val(0);
                }else{
                    $('#reset_total_cost').val(+TotalCost);
                }
            });

            $('#rushed').on('change' , function(e){
                $('#copies').prop('checked' , false);
                $('.ifClickedCopy').addClass('d-none');

                $('.fileNamesCopies').each(function() {
                    $(this).val('');
                });
                $('.fileNumberCopies').each(function() {
                    $(this).val('');
                });

                $('#discount').prop('checked' , false);
                $('.ifDiscount').addClass('d-none');
                $('#discount_price').val('');
                $('#discount_desc').val('');
                if(e.target.checked == true){
                    let handler = Math.ceil(TotalCost/2);
                    let totalMoneyRushed = $('#reset_total_cost').val(+TotalCost+handler);
                    TotalCostRushed = totalMoneyRushed.val();
                    $('#nows').prop('checked' , false);
                    $('#reset_cost_not_paid').val(0);
                    $('#reset_cost_paid').val(0);
                }else{
                    $('#reset_total_cost').val(+TotalCost);

                }
            });

            $('#copies').on('change' , function(e){

                $('#discount').prop('checked' , false);
                $('.ifDiscount').addClass('d-none');
                $('#discount_price').val('');
                $('#discount_desc').val('');
                $('#reset_cost_paid').val('');

                if(e.target.checked == true){
                    $('.ifClickedCopy').removeClass('d-none');
                    $('.fileNamesCopies').each(function(){
                        $(this).attr('required' , true);
                    });
                    $('.fileNumberCopies').each(function(){
                        $(this).attr('required' , true);
                    });

                }else{
                    $('.ifClickedCopy').addClass('d-none');

                    $('.fileNamesCopies').each(function() {
                        $(this).val('');
                        $(this).attr('required' , false);
                    });
                    $('.fileNumberCopies').each(function() {
                        $(this).val('');
                        $(this).attr('required' , false);
                    });

                    if($('#nows').is(':checked')){
                        console.log('sayed three');
                        TotalCostNows = ((Number(languageCost) * Number(numberOfPages)) * 2);
                        $('#reset_total_cost').val(+TotalCostNows);
                    }else if($('#rushed').is(':checked')){
                        console.log('sayed four');
                        let handler = (Number(languageCost) * Number(numberOfPages))/2;
                        TotalCostRushed = ((Number(languageCost) * Number(numberOfPages)) + handler);
                        $('#reset_total_cost').val(+TotalCostRushed);
                    }else if($('#copies').is(':checked')){
                        let totalCopiesNumberForDiscount = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscount += $(this).val();
                        });
                        let totalNowForDiscount = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        $('#reset_total_cost').val(+totalNowForDiscount);
                    }else{
                        console.log('sayed six');
                        TotalCost = Number(languageCost) * Number(numberOfPages);
                        $('#reset_total_cost').val(+TotalCost);
                    }
                }
            });

            $('#discount').on('change' , function(e){
                $('#reset_cost_paid').val('');
                if(e.target.checked){
                    $('.ifDiscount').removeClass('d-none');
                    $('#discount_price').attr('required' , true);
                    $('#discount_desc').attr('required' , true);
                }else{
                    $('.ifDiscount').addClass('d-none');
                    $('#discount_price').attr('required' , false);
                    $('#discount_desc').attr('required' , false);

                    $('#reset_cost_paid').val('');

                    if($('#nows').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed one');
                        let totalCopiesNumberForDiscountHere = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscountHere += $(this).val();
                        });
                        let totale = (Number(totalCopiesNumberForDiscountHere) * (Number(languageCost)/2));
                        OverAllCostFromCopies = ((Number(languageCost) * Number(numberOfPages) * 2) + totale);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#rushed').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed two');
                        let totalCopiesNumberForDiscountHere = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscountHere += $(this).val();
                        });
                        let totale = (Number(totalCopiesNumberForDiscountHere) * (Number(languageCost)/2));
                        let handler = (Number(languageCost) * Number(numberOfPages))/2;
                        OverAllCostFromCopies = ((Number(languageCost) * Number(numberOfPages) + handler) + totale);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#nows').is(':checked')){
                        console.log('sayed three');
                        TotalCostNows = ((Number(languageCost) * Number(numberOfPages)) * 2);
                        $('#reset_total_cost').val(+TotalCostNows);
                    }else if($('#rushed').is(':checked')){
                        console.log('sayed four');
                        let handler = (Number(languageCost) * Number(numberOfPages))/2;
                        TotalCostRushed = ((Number(languageCost) * Number(numberOfPages)) + handler);
                        $('#reset_total_cost').val(+TotalCostRushed);
                    }else if($('#copies').is(':checked')){
                        let totalCopiesNumberForDiscount = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscount += $(this).val();
                        });
                        // let totalNowForDiscount = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        OverAllCostFromCopies = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else{
                        console.log('sayed six');
                        TotalCost = Number(languageCost) * Number(numberOfPages);
                        $('#reset_total_cost').val(+TotalCost);
                    }
                }
            });

            $("body").on("input", ".fileNumberCopies", function (e) {
                let totalCopiesNumber = 0;
                $('#reset_cost_not_paid').val(0);
                $('#reset_cost_paid').val(0);

                if($('#nows').is(':checked')){
                    $('.fileNumberCopies').each(function() {
                        totalCopiesNumber += +$(this).val();
                    });
                    TotalCostFromCopies = totalCopiesNumber * (languageCost/2);
                    let totalCostFileCopies = $('#reset_total_cost').val(+TotalCostNows+TotalCostFromCopies);
                    OverAllCostFromCopies = totalCostFileCopies.val();
                }else if($('#rushed').is(':checked')){
                    $('.fileNumberCopies').each(function() {
                        totalCopiesNumber += +$(this).val();
                    });
                    TotalCostFromCopies = totalCopiesNumber * (languageCost/2);
                    let totalCostFileCopies = $('#reset_total_cost').val(+TotalCostRushed+TotalCostFromCopies);
                    OverAllCostFromCopies = totalCostFileCopies.val();
                }else{
                    $('.fileNumberCopies').each(function() {
                        totalCopiesNumber += +$(this).val();
                    });
                    TotalCostFromCopies = totalCopiesNumber * (languageCost/2);
                    let totalCostFileCopies = $('#reset_total_cost').val(+TotalCost+TotalCostFromCopies);
                    OverAllCostFromCopies = totalCostFileCopies.val();
                }
            });

            $("body").on("change", "#discount_price", function (e) {
                $('#reset_cost_paid').val('');
                if(e.target.value != ''){
                    // let discountValue = Number(e.target.value)/100;
                    let discountValue = Number(e.target.value);
                    if($('#nows').is(':checked') && $('#copies').is(':checked')){
                        console.log('fahmy one');
                        OverAllCostFromCopies = Number(OverAllCostFromCopies) - Number(discountValue);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#rushed').is(':checked') && $('#copies').is(':checked')){
                        console.log('fahmy two');
                        OverAllCostFromCopies = Number(OverAllCostFromCopies) - Number(discountValue);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#nows').is(':checked')){
                        console.log('fahmy three');
                        TotalCostNows = Number(TotalCostNows) - Number(discountValue);
                        $('#reset_total_cost').val(+TotalCostNows);
                    }else if($('#rushed').is(':checked')){
                        console.log('fahmy four');
                        TotalCostRushed = Number(TotalCostRushed) - Number(discountValue);
                        $('#reset_total_cost').val(+TotalCostRushed);
                    }else if($('#copies').is(':checked')){
                        console.log('fahmy five');
                        let totalCopiesNumberForDiscount = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscount += $(this).val();
                        });
                        let totalNowForDiscount = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        // totalNowForDiscount = Number(totalNowForDiscount) - Number(discountValue);
                        OverAllCostFromCopies = Number(totalNowForDiscount) - Number(discountValue);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else{
                        console.log('fahmy six');
                        TotalCost = Number(TotalCost) - Number(discountValue);
                        $('#reset_total_cost').val(+TotalCost);
                    }
                }else{
                    if($('#nows').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed one');
                        let totalCopiesNumberForDiscountHere = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscountHere += $(this).val();
                        });
                        let totale = (Number(totalCopiesNumberForDiscountHere) * (Number(languageCost)/2));
                        OverAllCostFromCopies = ((Number(languageCost) * Number(numberOfPages) * 2) + totale);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#rushed').is(':checked') && $('#copies').is(':checked')){
                        console.log('sayed two');
                        let totalCopiesNumberForDiscountHere = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscountHere += $(this).val();
                        });
                        let totale = (Number(totalCopiesNumberForDiscountHere) * (Number(languageCost)/2));
                        let handler = (Number(languageCost) * Number(numberOfPages))/2;
                        OverAllCostFromCopies = ((Number(languageCost) * Number(numberOfPages) + handler) + totale);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else if($('#nows').is(':checked')){
                        console.log('sayed three');
                        TotalCostNows = ((Number(languageCost) * Number(numberOfPages)) * 2);
                        $('#reset_total_cost').val(+TotalCostNows);
                    }else if($('#rushed').is(':checked')){
                        console.log('sayed four');
                        let handler = (Number(languageCost) * Number(numberOfPages))/2;
                        TotalCostRushed = ((Number(languageCost) * Number(numberOfPages)) + handler);
                        $('#reset_total_cost').val(+TotalCostRushed);
                    }else if($('#copies').is(':checked')){
                        let totalCopiesNumberForDiscount = 0;
                        $('.fileNumberCopies').each(function() {
                            totalCopiesNumberForDiscount += $(this).val();
                        });
                        // let totalNowForDiscount = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        OverAllCostFromCopies = (Number(totalCopiesNumberForDiscount) * (Number(languageCost)/2)) + Number(TotalCost);
                        $('#reset_total_cost').val(+OverAllCostFromCopies);
                    }else{
                        console.log('sayed six');
                        TotalCost = Number(languageCost) * Number(numberOfPages);
                        $('#reset_total_cost').val(+TotalCost);
                    }
                }
            });

            const output = document.querySelector("output")
            let imagesArray = [];

            $('#uploadRecievedResetFile').on('change' , function(e){
                isValid = false;
                let fileSizes = e.target.files;
                for(let j = 0 ; j < fileSizes.length ; j++){
                    if(fileSizes[j].size > 5000000){
                        isValid = true;
                        toastr.error('مينفعش نرفع ملفات او صور اكتر من 5 ميجا');
                    }
                }
                console.log(isValid);
                if(!isValid){
                    const files = document.getElementById('uploadRecievedResetFile').files;
                    for (let i = 0; i < files.length; i++) {
                        imagesArray.push(files[i]);
                    }
                    displayImages();
                }else{
                    document.getElementById('uploadRecievedResetFile').value = '';
                    const imagesThumbnails = document.querySelectorAll('.image');

                    imagesThumbnails.forEach(image => {
                      image.remove();
                    });
                }
            });

            function displayImages() {
                let images = ""
                imagesArray.forEach((image, index) => {
                    console.log(image.type);
                    if(image.type == 'application/pdf'){
                        images += `<div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/pdf.png') }}" width="200" height="100" alt="image">
                                            <span id="deleteImage" class="d-flex align-items-center" data-id="${index}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                    </div>`
                    }else if(image.type == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
                        images += `<div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/word.png') }}" width="200" height="100" alt="image">
                                            <span id="deleteImage" class="d-flex align-items-center" data-id="${index}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                    </div>`
                    }else{
                        images += `<div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="${URL.createObjectURL(image)}" width="200" height="100" alt="image">
                                            <span id="deleteImage" class="d-flex align-items-center" data-id="${index}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                    </div>`
                    }

                });

                output.innerHTML = images;
            }

            $(document).on('click' , '#deleteImage' , function(e){
                let id = $(this).attr('data-id');
                imagesArray.splice(id, 1);
                for(let i = 0 ; i < imagesArray.length ; i++){
                    document.getElementById('uploadRecievedResetFile').files.value = imagesArray[i];
                }
                displayImages();
            });

            $('#is_scan').on('change' , function(e){
                if(e.target.value == 1){
                    $('.isDisplayed').removeClass('d-none');
                }else{
                    $('.isDisplayed').addClass('d-none');
                }
            });

            $('#has_delivered').on('change' , function(e){
                if(e.target.value == 1){
                    $('.isDisplayedTwo').removeClass('d-none');
                }else{
                    $('.isDisplayedTwo').addClass('d-none');
                }
            });

            $('#recieved_by').on('change' , function(e){
                if(e.target.checked){
                    $('.isRecievedBy').removeClass('d-none');
                }else{
                    $('.isRecievedBy').addClass('d-none');
                }
            });

            $('#translators').chosen();

            $('#printReset').on('click' , function(e){
                console.log('ali');
                let resetId = localStorage.getItem('reset_id');
                console.log(resetId);
                window.location.href = '/resets/'+resetId+'/print';
            });

            $('#printResetSystem').on('click' , function(e){
                console.log('ali');
                let resetId = localStorage.getItem('reset_id');
                console.log(resetId);
                window.location.href = '/resets/'+resetId+'/printForSystem';
            });

            $('#submitRecieveReset').on('submit' , function(e){
                e.preventDefault();

                let resetRecievedDate = $('#reset_recieved_date').val();
                let d2 = new Date(resetRecievedDate);
                let month = d2.getMonth()+1;
                let day = d2.getDate();
                let minute = d2.getMinutes();
                let second = d2.getSeconds();
                let hour = d2.getHours();

                if(month < 10){
                    month = "0"+month;
                }
                if(day < 10){
                    day = "0"+day;
                }
                if(minute < 10){
                    minute = "0"+minute;
                }
                if(second < 10){
                    second = "0"+second;
                }
                if(hour < 10){
                    hour = "0"+hour;
                }

                let resetRecievedDateUpdated = d2.getFullYear()  + "-" + month + "-" + day + " " +
                    hour + ":" + minute + ":" + '00';

                $('#buttonToSubmit').prop('disabled' , true);

                $('.fileNames').each(function(e){
                    let obj1 = {};
                    obj1.reset_file_name = $(this).val();
                    arrFilesNames.push(obj1);
                });

                $('.fileOriginal').each(function(){
                    let obj2 = {};
                    obj2.reset_file_original = $(this).val();
                    arrFilesOriginal.push(obj2);
                });

                let desiredResult = arrFilesNames.map((it, i) => ({...it, ...arrFilesOriginal[i]}));
                const results = desiredResult.filter(element => {
                if (element.reset_file_name != '' && element.reset_file_original != null) {
                    return true;
                }

                return false;
                });

                $('.fileNamesCopies').each(function(e){
                    let obj3 = {};
                    obj3.reset_file_copy_name = $(this).val();
                    arrCopyFilesNames.push(obj3);
                });

                $('.fileNumberCopies').each(function(){
                    let obj4 = {};
                    obj4.number_copies = $(this).val();
                    arrCopyNumbers.push(obj4);
                });


                let desiredResultCopies = arrCopyFilesNames.map((it, i) => ({...it, ...arrCopyNumbers[i]}));
                const resultsCopy = desiredResultCopies.filter(element => {
                if (element.reset_file_copy_name != '' && element.number_copies != '') {
                    return true;
                }

                return false;
                });

                let edit_user_id = $('#edit_user_id').val();
                let clientName = $('#reset_client').val();
                let resetClientPhone = $('#reset_client_phone').val();
                let resetClientPhoneSecond = $('#reset_client_phone_second').val();
                let resetTranslation = $('#reset_translation').val();
                let resetWhere = $('#reset_where').val();
                let resetFor = $('#reset_for').val();
                let resetPagesNumber = $('#reset_pages_number').val();
                let resetLanguage = $('#language_id').val();
                let resetTotalCost = $('#reset_total_cost').val();
                let resetCostPaid = $('#reset_cost_paid').val();
                let resetCostNotPaid = $('#reset_cost_not_paid').val();
                let paymentType = $('#payment_type').val();
                let resetNotes = $('#reset_notes').val();
                let resetNotesClient = $('#reset_notes_client').val();
                let translatorNotes = $('#translator_notes').val();
                let resetNameEnglish = $('#reset_name_english').val();
                let translators = $('#translators').val();
                let result = translators.map(function (x) {
                    return parseInt(x, 10);
                });
                let resetTranslatorIds = result;
                let scanPrice = $('#scan_price').val();
                let scanPaymentType = $('#scan_payment_type').val();
                let deliverPrice = $('#deliver_price').val();
                let deliverPaymentType = $('#deliver_payment_type').val();
                let discountPrice = $('#discount_price').val();
                let discountDesc = $('#discount_desc').val();
                let recievedByName = $('#recieved_by_name').val();
                let recievedByPhone = $('#recieved_by_phone').val();
                let client_code = $('#client_code').val();

                if(clientName == '' ||
                    results.length == 0 ||
                    resetClientPhone == '' ||
                    resetTranslation == '' ||
                    resetWhere == '' ||
                    resetFor == '' ||
                    resetNameEnglish == '' ||
                    resetPagesNumber == '' ||
                    resetLanguage == '' ||
                    resetTotalCost == '' ||
                    resetCostPaid == '' ||
                    resetCostNotPaid == '' ||
                    paymentType == '' ||
                    resetRecievedDate == '' ||
                    paymentType == null
                ){
                    unloading();
                    arrFilesNames = [];
                    arrFilesOriginal = [];
                    toastr.warning('أملأ البيانات بصورة صحيحة');
                    $('#buttonToSubmit').prop('disabled' , false);
                }else{
                    if($('#copies').is(':checked') && resultsCopy.length == 0){
                        unloading();
                        arrCopyFilesNames = [];
                        arrCopyNumbers = [];
                        toastr.warning('من فضلك أملأ المستند المراد نسخه وعدد النسخ');
                        $('#buttonToSubmit').prop('disabled' , false);
                    }else{
                        loading();
                        let formData = new FormData();
                        console.log(resetTranslatorIds);
                        formData.append('edit_user_id' , edit_user_id);
                        formData.append('reset_client' , clientName);
                        formData.append('reset_date' , reset_date);
                        formData.append('reset_file_names[]' , JSON.stringify(results));
                        formData.append('copy_reset_files[]' , JSON.stringify(resultsCopy));
                        formData.append('reset_client_phone' , resetClientPhone);
                        formData.append('reset_client_phone_second' , resetClientPhoneSecond);
                        formData.append('reset_translation' , resetTranslation);
                        formData.append('reset_for' , resetFor);
                        formData.append('reset_where' , resetWhere);
                        formData.append('reset_pages_number' , resetPagesNumber);
                        formData.append('reset_name_english' , resetNameEnglish);
                        formData.append('reset_total_cost' , resetTotalCost);
                        formData.append('reset_cost_paid' , resetCostPaid);
                        formData.append('reset_cost_not_paid' , resetCostNotPaid);
                        formData.append('change_reset' , resetCostNotPaid);
                        formData.append('payment_type' , paymentType);
                        formData.append('reset_recieved_date' , resetRecievedDateUpdated);
                        formData.append('reset_notes' , resetNotes);
                        formData.append('reset_notes_client' , resetNotesClient);
                        formData.append('translator_notes' , translatorNotes);
                        formData.append('language_id' , resetLanguage);
                        formData.append('translators[]' , resetTranslatorIds);
                        formData.append('is_revised' , 0);
                        formData.append('client_code' , client_code);

                        if(resetCostNotPaid == 0){
                            formData.append('is_payed' , 1);
                        }else{
                            formData.append('is_payed' , 0);
                        }

                        if($('#is_scan').val() == 1){
                            formData.append('is_scan' , 1);
                            formData.append('scan_price' , scanPrice);
                            formData.append('scan_payment_type' , scanPaymentType);
                        }else{
                            formData.append('is_scan' , 0);
                        }

                        if($('#has_delivered').val() == 1){
                            formData.append('has_delivered' , 1);
                            formData.append('deliver_price' , deliverPrice);
                            formData.append('deliver_payment_type' , deliverPaymentType);
                        }else{
                            formData.append('has_delivered' , 0);
                        }

                        if($('#discount').is(':checked')){
                            formData.append('has_discount' , 1);
                            formData.append('discount_price' , discountPrice);
                            formData.append('discount_desc' , discountDesc);
                        }else{
                            formData.append('has_discount' , 0);
                        }

                        if($('#recieved_by').is(":checked")){
                            formData.append('recieved_by' , 1);
                            formData.append('recieved_by_name' , recievedByName);
                            formData.append('recieved_by_phone' , recievedByPhone);
                        }else{
                            formData.append('recieved_by' , 0);
                        }

                        if($('#is_company').is(":checked")){
                            formData.append('is_company' , 1);
                        }else{
                            formData.append('is_company' , 0);
                        }

                        if($('#nows').is(':checked')){
                            formData.append('money_status' , 0);
                        }

                        if($('#rushed').is(':checked')){
                            formData.append('money_status' , 1);
                        }

                        if( document.getElementById("uploadRecievedResetFile").files.length == 0 ){
                            console.log("no files selected");
                        }else{
                            for(let i = 0 ; i < imagesArray.length ; i++){
                                formData.append('files[]' , imagesArray[i]);
                            }
                        }

                        $.ajax({
                            url:'/store/recieved/reset',
                            type:'post',
                            data:formData,
                            cache:false,
                            contentType:false,
                            processData:false,
                            success:function(res){
                                console.log(res);
                                if(res){
                                    localStorage.setItem('reset_id' , res.id);
                                    unloading();
                                    toastr.success('تم حفظ الفاتورة بنجاح');
                                    $('#printReset').css('pointer-events' , 'auto');
                                    $('#printResetSystem').css('pointer-events' , 'auto');
                                    $('#backIndex').css('pointer-events' , 'auto');
                                }
                            },error:function(err){
                                console.log(err.responseText);
                                unloading();
                                arrFilesNames = [];
                                arrFilesOriginal = [];
                                $('#buttonToSubmit').prop('disabled' , false);
                                let response = err.responseJSON.errors;
                                $.each(response , function( key, value) {
                                    toastr.error(value);
                                });
                            }
                        });
                    }
                }
            });
        });
    </script>

@endsection
