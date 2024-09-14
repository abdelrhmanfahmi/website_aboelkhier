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
        .allImages{
            overflow: auto;
        }
    </style>
    <div class="edit-recieved-reset">
        <h3>تعديل فاتورة رقم <span class="text-danger">{{ $recieved_reset->id }}</span></h3>
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>

        <form id="submitRecieveReset" enctype="multipart/form-data">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>اسم العميل <span class="text-danger">*</span></label>
                    <input type="text" name="reset_client" id="reset_client" class="form-control" value="{{ $recieved_reset->reset_client }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>رقم تليفون العميل <span class="text-danger">*</span></label>
                    <input type="text" name="reset_client_phone" id="reset_client_phone" class="form-control" value="{{ $recieved_reset->reset_client_phone }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>رقم تليفون العميل الاحتياطي</label>
                    <input type="text" name="reset_client_phone_second" id="reset_client_phone_second" class="form-control" value="{{ $recieved_reset->reset_client_phone_second }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label>مسؤول التعديل</label>
                    <select name="edit_user_id" id="edit_user_id" class="form-control">
                        <option disabled selected>-- اختر مسؤول --</option>
                        @foreach ($edit_users_id as $edit_user_id)
                        <option {{old('edit_user_id',$edit_user_id->id) == $recieved_reset->edit_user_id ? 'selected' : ''}} value="{{ $edit_user_id->id }}">{{ $edit_user_id->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label>نوع الترجمة <span class="text-danger">*</span></label>
                    <select name="reset_translation" id="reset_translation" class="form-control">
                        <option disabled selected>-- اختر نوع الترجمة --</option>
                        <option {{ $recieved_reset->reset_translation == 'معتمدة' ? 'selected' : '' }} value="معتمدة">معتمدة</option>
                        <option {{ $recieved_reset->reset_translation == 'غير معتمدة' ? 'selected' : '' }} value="غير معتمدة">غير معتمدة</option>
                        <option {{ $recieved_reset->reset_translation == 'طبي' ? 'selected' : '' }} value="طبي">طبي</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>الجهة <span class="text-danger">*</span></label>
                    <input type="text" name="reset_where" id="reset_where" class="form-control" value="{{ $recieved_reset->reset_where }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>الغرض <span class="text-danger">*</span></label>
                    <textarea style="resize: none;" name="reset_for" id="reset_for" cols="30" rows="5" class="form-control">{{ $recieved_reset->reset_for }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>كود العميل</label>
                    <input type="text" name="client_code" id="client_code" class="form-control" value="{{ $recieved_reset->client_code }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                @foreach ($resetFiles as $index => $resetFile)
                    <div id="row" class="d-flex bd-highlight">
                        <div class="col-md-5 p-2 flex-grow-1 bd-highlight mb-3">
                            <label><span class="text-danger">*</span> اسم المستند</label>
                            <input class="form-control fileNames" value="{{ $resetFile->reset_file_name }}"/>
                        </div>
                        <div class="col-md-5 p-2 bd-highlight mb-3">
                            <label><span class="text-danger">*</span> أصل أو صورة</label>
                            <select class="form-control fileOriginal">
                                <option disabled selected>-- اختر اصل أو صورة --</option>
                                <option {{ $resetFile->reset_file_original == '0' ? 'selected' : '' }} value="0"> أصل </option>
                                <option {{ $resetFile->reset_file_original == '1' ? 'selected' : '' }} value="1"> صورة </option>
                            </select>
                        </div>
                        @if($index == 0)
                            <div class="col-md-2 mb-3 d-flex align-items-center">
                                <button id="rowAdder" type="button"
                                    style="position: relative;top:11px"
                                    class="btn btn-dark">
                                    <span class="bi bi-plus-square-dotted">
                                    </span> +
                                </button>
                            </div>
                        @else
                            <div class="col-md-2 d-flex align-items-center">
                                <button class="btn btn-danger" id="DeleteRow" type="button">
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
                <div class="col-md-6 mb-3">
                    <label>عدد الاوراق <span class="text-danger">*</span></label>
                    <input type="text" name="reset_pages_number" id="reset_pages_number" class="form-control" value="{{ $recieved_reset->reset_pages_number }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>لغة الترجمة <span class="text-danger">*</span></label>
                    <select name="language_id" id="language_id" class="form-control" readonly>
                        <option disabled selected value="null">-- اختر لغة الترجمة --</option>
                        @foreach ($languages as $language)
                            <option {{old('language_id',$language->id) == $recieved_reset->language_id ? 'selected' : ''}} value="{{ $language->id }}">{{ $language->first_language }} To {{ $language->second_language }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>فوري</label>
                    <input type="checkbox" disabled name="nowsRushed" id="nows" {{ $recieved_reset->money_status == '0' ? 'checked' : '' }}>

                    &nbsp;

                    <label>مستعجل</label>
                    <input type="checkbox" disabled name="nowsRushed" id="rushed" {{ $recieved_reset->money_status == '1' ? 'checked' : '' }}>
                </div>
                <div class="col-md-6">
                    <label>هل تريد عمل كوبي لملفات الشخص؟</label>
                    <input disabled type="checkbox" name="copies" id="copies" {{ count($resetFilesCopies) > 0 ? 'checked' : '' }}>
                </div>
            </div>

            @if(count($resetFilesCopies) > 0)
                <div class="ifClickedCopy">
                    @foreach ($resetFilesCopies as $index => $resetFileCopy)
                        <div id="row" class="row">
                            <div class="col-md-5 mb-3">
                                <label><span class="text-danger">*</span>اسم المستند المراد عمل نسخة منه</label>
                                <input readonly class="form-control fileNamesCopies" value="{{ $resetFileCopy->reset_file_copy_name }}"/>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label><span class="text-danger">*</span>عدد النسخ</label>
                                <input readonly type="number" readonly class="form-control fileNumberCopies" value="{{ $resetFileCopy->number_copies }}"/>
                            </div>
                            @if($index == 0)
                                <div class="col-md-2 mb-3 d-flex align-items-center">
                                    <button disabled id="rowAdderCopies" type="button"
                                        style="position: relative;top:11px"
                                        class="btn btn-dark">
                                        <span class="bi bi-plus-square-dotted">
                                        </span> +
                                    </button>
                                </div>
                            @else
                                <div class="col-md-2 d-flex align-items-center">
                                    <button disabled class="btn btn-danger" id="DeleteRowCopies" type="button">
                                        <i class="bi bi-trash"></i>
                                        x
                                    </button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
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
            @endif

            <div id="newinputCopies"></div>

            <div class="row mb-3">
                <div class="col-md-3 mb-3">
                    <label>المبلغ الكلي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_total_cost" id="reset_total_cost" value="{{ $recieved_reset->reset_total_cost }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المدفوع<span class="text-danger">*</span></label>
                    <input type="text" readonly name="reset_cost_paid" id="reset_cost_paid" value="{{ $recieved_reset->reset_cost_paid }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>المبلغ المتبقي<span class="text-danger">*</span></label>
                    <input type="text" name="reset_cost_not_paid" id="reset_cost_not_paid" value="{{ $recieved_reset->reset_cost_not_paid }}" class="form-control" disabled>
                </div>

                <div class="col-md-3 mb-3">
                    <label>نوع عملية الدفع <span class="text-danger">*</span></label>
                    <select name="payment_type" disabled id="payment_type" class="form-control">
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $recieved_reset->payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $recieved_reset->payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $recieved_reset->payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $recieved_reset->payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>هل تريد عمل خصم للفاتورة ؟</label>
                    <input disabled type="checkbox" {{ $recieved_reset->has_discount == '1' ? 'checked' : ''}} name="has_discount" id="discount">
                </div>
            </div>

            @if ($recieved_reset->has_discount == '1')
                <div class="row mb-3 ifDiscount">
                    <div class="col-md-6">
                        <label>رقم الخصم</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input readonly type="number" name="discount_price" value="{{ $recieved_reset->discount_price }}" id="discount_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>وصف الخصم</label>
                        <input readonly type="text" name="discount_desc" value="{{ $recieved_reset->discount_desc }}" id="discount_desc" class="form-control">
                    </div>
                </div>
            @else
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
            @endif

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label>موعد الاستلام <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="reset_recieved_date" id="reset_recieved_date" class="form-control" value="{{ $recieved_reset->reset_recieved_date }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label>ملاحظات للفاتورة</label>
                    <textarea style="resize: none;" name="reset_notes" id="reset_notes" cols="30" rows="5" class="form-control">{{ $recieved_reset->reset_notes }}</textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label>ملاحظات للعميل عن الفاتورة</label>
                    <textarea style="resize: none;" name="reset_notes_client" id="reset_notes_client" cols="30" rows="5" class="form-control">{{ $recieved_reset->reset_notes_client }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>الاسماء باللغة الإنجليزية <span class="text-danger">*</span></label>
                    <textarea style="resize: none;" name="reset_name_english" id="reset_name_english" cols="30" rows="5" class="form-control">{{ $recieved_reset->reset_name_english }}</textarea>
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
                            <option class="isSelected{{ $translator->id }} dataSelected" value="{{ $translator->id }}">{{ $translator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>ملاحظات للمترجمين عن الفاتورة</label>
                    <textarea style="resize: none;" name="translator_notes" id="translator_notes" cols="30" rows="5" class="form-control">{{ $recieved_reset->translator_notes }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>هل للفاتورة عملية سكان؟</label>
                    <select name="is_scan" class="form-control" id="is_scan">
                        <option disabled selected>-- اختر --</option>
                        <option {{ $recieved_reset->is_scan == '1' ? 'selected' : '' }} value="1">نعم له سكان</option>
                        <option {{ $recieved_reset->is_scan == '0' ? 'selected' : '' }} value="0">ليس له سكان</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>هل للفاتورة عملية شحن؟</label>
                    <select name="has_delivered" class="form-control" id="has_delivered">
                        <option disabled selected>-- اختر --</option>
                        <option {{ $recieved_reset->has_delivered == '1' ? 'selected' : '' }} value="1">نعم له شحن</option>
                        <option {{ $recieved_reset->has_delivered == '0' ? 'selected' : '' }} value="0">ليس له شحن</option>
                    </select>
                </div>
            </div>


            <div class="row mb-3 {{ $recieved_reset->is_scan == '1' ? "d-flex" : "d-none" }} isDisplayed">
                <div class="col-md-6 mb-3">
                    <label>مبلغ السكان </label>
                    <input type="text" name="scan_price" id="scan_price" value="{{ $recieved_reset->scan_price }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع السكان </label>
                    <select name="scan_payment_type" id="scan_payment_type" class="form-control">
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $recieved_reset->scan_payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $recieved_reset->scan_payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $recieved_reset->scan_payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $recieved_reset->scan_payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3 {{ $recieved_reset->has_delivered == '1' ? "d-flex" : "d-none" }} isDisplayedTwo">
                <div class="col-md-6 mb-3">
                    <label>مبلغ الشحن </label>
                    <input type="text" name="deliver_price" id="deliver_price" value="{{ $recieved_reset->deliver_price }}" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>نوع عملية دفع الشحن </label>
                    <select name="deliver_payment_type" id="deliver_payment_type" class="form-control">
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $recieved_reset->deliver_payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $recieved_reset->deliver_payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $recieved_reset->deliver_payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $recieved_reset->deliver_payment_type == 'online' ? "selected" : "" }} value="online">online</option>
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

            @if(count($recieved_reset->files_recieved_resets) > 0 )
                <div class="row mb-3">
                    <div class="col-md-12">
                        <h3>ملفات الفاتورة </h3>
                        <div class="allImages d-flex">
                            @foreach ($recieved_reset->files_recieved_resets as $recieved_r)
                                @if(\File::extension($recieved_r->file) == 'docx' || \File::extension($recieved_r->file) == 'doc')
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/word.png') }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                                        </div>
                                    </div>
                                @elseif (\File::extension($recieved_r->file) == 'pdf')
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/images/pdf.png') }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="image mb-3 px-3">
                                        <div class="d-flex">
                                            <img src="{{ asset('uploads/' . $recieved_r->file) }}" width="200" height="100" alt="">
                                            <span class="deleteImageServer d-flex align-items-center" data-id="{{ $recieved_r->id }}" style="cursor:pointer;font-size:20px">&times;</span>
                                        </div>
                                        <div class="mt-2">
                                            <a href="/uploads/{{ $recieved_r->file }}" target="_blank" class="btn btn-primary">عرض</a>
                                            <a href="/download/image/{{ $recieved_r->id }}" class="btn btn-dark">تحميل</a>
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
                    <input type="checkbox" {{ $recieved_reset->recieved_by == '1' ? "checked" : "" }} id="recieved_by" name="recieved_by" />
                    <label>هل المستلم ليس بشخصه؟</label>
                </div>
                <div class="col-md-6 {{ $recieved_reset->recieved_by == '1' ? "d-block" : "d-none" }} isRecievedBy">
                    <div class="row">
                        <div class="col-md-6">
                            <label>اسم المستلم</label>
                            <input type="text" name="recieved_by_name" id="recieved_by_name" value="{{ $recieved_reset->recieved_by_name }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>رقم تليفون المستلم</label>
                            <input type="text" name="recieved_by_phone" id="recieved_by_phone" value="{{ $recieved_reset->recieved_by_phone }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <input type="checkbox" {{ $recieved_reset->is_company == '1' ? "checked" : "" }} id="is_company" name="is_company" /> &nbsp;
                    <label>هل العميل شركة؟</label>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">تعديل الفاتورة</button>
                    <a id="printReset" class="btn btn-primary" >طباعة الفاتورة للعميل</a>
                    <a id="printResetSystem" class="btn btn-primary" >طباعة الفاتورة للشركة</a>
                    <a href="{{ route('resets.index') }}" class="btn btn-warning" id="backIndex" >رجوع</a>
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

            let languageCost = 0;
            let resetTranslation = '{{ $recieved_reset->reset_translation }}';
            $.ajax({
                url:'/get/price/language/{{ $recieved_reset->language_id }}',
                method: 'GET',
                success:function(res){
                    console.log(res);
                    languageCost = res;
                },
            });

            if (localStorage.getItem("reset_translation") === null) {
                if(resetTranslation == 'معتمدة'){
                    localStorage.setItem('reset_translation' , 'certified');
                }else if(resetTranslation == 'غير معتمدة'){
                    localStorage.setItem('reset_translation' , 'not_certified');
                }else{
                    localStorage.setItem('reset_translation' , 'medical');
                }
            }


            let currentURL = document.location.pathname;
            let recieveResetId = currentURL.split("/")[2];
            let originaImageFile = "{{ $recieved_reset->reset_file_original }}";

            let dataTranslators = "{{ $recieved_reset->translators }}";
            let dataAfterTransfrom = JSON.parse(dataTranslators.replace(/&quot;/g,'"'));
            let selected = $('.dataSelected');

            if(dataTranslators != '[null]'){
                const arr1 = dataAfterTransfrom[0].split(',');
                for(let i = 0 ; i < selected.length ; i++){
                    if(arr1.includes(selected[i].value)){
                        $('.isSelected'+selected[i].value).attr('selected' , true);
                    }else{
                        $('.isSelected'+selected[i].value).attr('selected' , false);
                    }
                }
            }

            $('#translators').chosen();

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
                let valueOfNumberCopy = $('#DeleteRowCopies').parent().prev().find("input[type=number]").val();
                let valueDeletedFromTotalCost = valueOfNumberCopy*(+languageCost/2);

                if($('#nows').is(':checked')){
                    $('#reset_total_cost').val(TotalCostNows-valueDeletedFromTotalCost);
                    TotalCostNows = TotalCostNows-valueDeletedFromTotalCost;
                }else if($('#rushed').is(':checked')){
                    $('#reset_total_cost').val(TotalCostRushed-valueDeletedFromTotalCost);
                    TotalCostRushed = TotalCostRushed-valueDeletedFromTotalCost;
                }else{
                    $('#reset_total_cost').val(TotalCost-valueDeletedFromTotalCost);
                    TotalCost = TotalCost-valueDeletedFromTotalCost;
                }

                $('#reset_cost_paid').val(0);
                $(this).parents("#row").remove();
            });

            let numberOfPages = '{{ $recieved_reset->reset_pages_number }}';
            let TotalCost = '{{ $recieved_reset->reset_total_cost }}';
            $('#language_id').prop('disabled' , false);
            $('#reset_total_cost').prop('disabled' , true);
            $('#reset_cost_paid').prop('disabled' , false);
            $('#reset_cost_not_paid').prop('disabled' , true);

            let TotalCostNows = 0;
            let TotalCostRushed = 0;
            let arrFilesNames = [];
            let arrFilesOriginal = [];
            let arrCopyFilesNames = [];
            let arrCopyNumbers = [];

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

            // let today = new Date().toISOString().slice(0, 16);
            // document.getElementById('reset_recieved_date').min = today;

            $('#reset_pages_number').on('keyup' , function(e){
                let valid = e.target.value.match(/^\d*[1-9]\d*$/) ? "true" : "false";
                if(e.target.value == "" || valid == "false"){
                    $('#language_id').prop('disabled' , true);
                    $('#language_id').attr('readonly' , false);
                    $('#rushed').prop('checked' , false);
                    $('#nows').prop('checked' , false);
                    $('#reset_total_cost').val('');
                    $('#reset_cost_not_paid').val('');
                    $('#reset_cost_paid').val('');

                    $('#reset_total_cost').prop('readonly' , false);
                    $('#reset_cost_not_paid').prop('readonly' , false);
                    $('#reset_cost_paid').prop('readonly' , false);

                    $('#discount').prop('checked' , false);
                    $('#discount').prop('disabled' , false);
                    $('.ifDiscount').addClass('d-none');
                    $('#discount_price').val('');
                    $('#discount_desc').val('');

                    $('#copies').prop('checked' , false);
                    $('#copies').prop('disabled' , false);
                    $('.ifClickedCopy').addClass('d-none');
                    $('.fileNamesCopies').each(function() {
                        $(this).val('');
                    });
                    $('.fileNumberCopies').each(function() {
                        $(this).val('');
                    });
                }else{
                    $('#language_id').prop('disabled' , false);
                    $('#language_id').attr('readonly' , false);
                    $('#language_id').val('null');
                    $('#rushed').prop('checked' , false);
                    $('#nows').prop('checked' , false);
                    $('#copies').prop('checked' , false);

                    $('#reset_total_cost').val('');
                    $('#reset_cost_paid').val('');
                    $('#reset_cost_not_paid').val('');
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
                        console.log(res);
                        $('#reset_total_cost').val('');
                        // numberOfPages = $('#reset_pages_number').val();
                        console.log(numberOfPages);
                        languageCost = res;
                        $('#reset_total_cost').prop('disabled' , true);
                        $('#reset_cost_paid').prop('disabled' , false);
                        $('#reset_cost_paid').prop('readonly' , false);
                        $('#nows').prop('disabled' , false);
                        $('#rushed').prop('disabled' , false);

                        $('#nows').prop('checked' , false);
                        $('#rushed').prop('checked' , false);
                        $('#payment_type').attr('disabled' , false);

                        $('#discount').prop('disabled' , false);
                        $('#discount').prop('checked' , false);
                        $('.ifDiscount').addClass('d-none');
                        $('#discount_price').val('');
                        $('#discount_desc').val('');


                        $('#copies').prop('disabled' , false);
                        $('.ifClickedCopy').addClass('d-none');
                        $('.fileNamesCopies').prop('readonly' , false);
                        $('.fileNumberCopies').prop('readonly' , false);

                        $('.fileNamesCopies').each(function() {
                            $(this).val('');
                        });
                        $('.fileNumberCopies').each(function() {
                            $(this).val('');
                        });

                        $('#reset_cost_not_paid').prop('disabled' , true);
                        $('#reset_total_cost').val('');
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
                        // $('#reset_total_cost').val(numberOfPages*res);
                        // TotalCost = numberOfPages*res;
                    },
                });
            });

            if($('#nows').is(':checked')){
                TotalCostNows = '{{ $recieved_reset->reset_total_cost }}';
            }else if($('#rushed').is(':checked')){
                TotalCostRushed = '{{ $recieved_reset->reset_total_cost }}';
            }

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
                    let handler = Math.ceil(+TotalCost/2);
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

                    $('#reset_cost_paid').val('');
                    $('.fileNumberCopies').prop('readonly' , false);

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
                    $('#discount_price').attr('readonly' , false);
                    $('#discount_desc').attr('readonly' , false);
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
                        $('#reset_total_cost').val(+totalNowForDiscount);
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

            $('.deleteImageServer').on('click' , function(e){
                let id = $(this).attr('data-id');
                console.log(id);
                $.ajax({
                    url:'/delete/exist/image/'+id,
                    method:'get',
                    success:function(res){
                        if(res == 1){
                            toastr.success('تم مسح الصورة بنجاح');
                            setTimeout(() => {
                                location.reload();
                            } , 1500);
                        }
                        console.log(res);
                    },error:function(err){
                        console.log(err);
                    }
                });
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
                displayImages()
            });

            $('#printReset').on('click' , function(e){
                var url =window.location.href;
                var data = (url.match(/(\d+)/g) || []);
                var resetId = data;
                console.log(resetId);
                window.location.href = '/resets/'+resetId+'/print';
            });

            $('#printResetSystem').on('click' , function(e){
                var url =window.location.href;
                var data = (url.match(/(\d+)/g) || []);
                var resetId = data;
                console.log(resetId);
                window.location.href = '/resets/'+resetId+'/printForSystem';
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

            $('#submitRecieveReset').on('submit' , function(e){
                e.preventDefault();
                console.log(originaImageFile);

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
                    hour + ":" + minute + ":" + second;

                $('.fileNames').each(function(){
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
                if (element.reset_file_name != '' && element.reset_file_original != '') {
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
                let discountPrice = $('#discount_price').val();
                let discountDesc = $('#discount_desc').val();
                let deliverPrice = $('#deliver_price').val();
                let deliverPaymentType = $('#deliver_payment_type').val();
                let recievedByName = $('#recieved_by_name').val();
                let recievedByPhone = $('#recieved_by_phone').val();
                let client_code = $('#client_code').val();

                if(clientName == '' ||
                    results.length == 0 ||
                    resetClientPhone == '' ||
                    resetTranslation == '' ||
                    resetWhere == '' ||
                    resetFor == '' ||
                    resetPagesNumber == '' ||
                    resetPagesNumber == '' ||
                    resetLanguage == '' ||
                    resetTotalCost == '' ||
                    resetCostPaid == '' ||
                    resetCostNotPaid == '' ||
                    paymentType == '' ||
                    paymentType == null ||
                    resetRecievedDate == ''
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
                            formData.append('scan_price' , null);
                        formData.append('scan_payment_type' , null);
                        }

                        if($('#has_delivered').val() == 1){
                        formData.append('has_delivered' , 1);
                        formData.append('deliver_price' , deliverPrice);
                        formData.append('deliver_payment_type' , deliverPaymentType);
                        }else{
                            formData.append('has_delivered' , 0);
                            formData.append('deliver_price' , null);
                        formData.append('deliver_payment_type' , null);
                        }

                        if($('#discount').is(':checked')){
                            formData.append('has_discount' , 1);
                            formData.append('discount_price' , discountPrice);
                            formData.append('discount_desc' , discountDesc);
                        }else{
                            formData.append('has_discount' , 0);
                            formData.append('discount_price' , null);
                            formData.append('discount_desc' , null);
                        }

                        if($('#recieved_by').is(":checked")){
                        formData.append('recieved_by' , 1);
                        formData.append('recieved_by_name' , recievedByName);
                        formData.append('recieved_by_phone' , recievedByPhone);
                        }else{
                            formData.append('recieved_by' , 0);
                            formData.append('recieved_by_name' , null);
                            formData.append('recieved_by_phone' , null);
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
                            url:'/update/recieved/reset/'+recieveResetId,
                            type:'post',
                            data:formData,
                            cache:false,
                            contentType:false,
                            processData:false,
                            success:function(res){
                                if(res == 1){
                                    unloading();
                                    toastr.success('الفاتورة تم تعديلها بنجاح');
                                    $('#printReset').css('pointer-events' , 'auto');
                                    $('#printResetSystem').css('pointer-events' , 'auto');
                                    $('#backIndex').css('pointer-events' , 'auto');
                                    setTimeout(() => {
                                        window.location.reload();
                                    },1500)
                                }
                            },error:function(err){
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
