<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" integrity="sha512-Ez0cGzNzHR1tYAv56860NLspgUGuQw16GiOOp/I2LuTmpSK9xDXlgJz3XN4cnpXWDmkNBKXR/VDMTCnAaEooxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>طباعة الفاتورة</title>
    <style>
        .bg-image{
            background-image: url("../../../../assets/images/britanya.jpeg");
        }
        .page-header{
            position: relative;
            bottom: 0;
            width: 20%;
            height:20px;
        }
    </style>
</head>
<body>
    <div class="container pt-5" id="toPrintScreen">
        <div class="d-flex bd-highlight" style="-webkit-print-color-adjust: exact;">
            <div class="p-2 flex-grow-1 bd-highlight">
                <img src="{{ asset('assets/images/firstLogo.JPG') }}" width="100" height="100" alt="">
            </div>
            <div class="p-2 bd-highlight">
                <h5>Mob. (+2) 01210504674</h5>
                <h5>Tel (+2) 03-5439537</h5>
                <p>http://abulkhiergroup.com/</p>
                <p>abulkhiergroup@gmail.com</p>
            </div>
        </div>
        <hr>
        <div >
            <div class="row">
                <div class="col-md-12 mb-3 text-center">
                    <h3>إيصال داخلي فاتورة ترجمة رقم <span style="font-weight:bold;font-size:36px;">{{ $printedReset->id }}</span></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label style="font-weight:bold;font-size:24px;">اليوم</label>
                    @if(Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Saturday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="السبت">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Sunday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الأحد">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Monday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الاثنين">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Tuesday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الثلاثاء">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Wednesday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الاربعاء">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_date)->format('l') == 'Thursday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الخميس">
                    @else
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الجمعة">
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label style="font-weight:bold;font-size:24px;">التاريخ</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ Carbon\Carbon::parse($printedReset->reset_date)->format('Y-m-d') }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label style="font-weight:bold;font-size:24px;">اسم العميل</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ $printedReset->reset_client }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight:bold;font-size:24px;">رقم تليفون العميل</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ $printedReset->reset_client_phone }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label style="font-weight:bold;">الجهة</label>
                    <textarea cols="30" rows="5" class="form-control" style="font-weight:bold;" disabled>{{ $printedReset->reset_where }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label style="font-weight:bold;font-size:24px;">المستندات</label>
                    <ol class="list-group list-group-numbered">
                        @foreach($printedFileNames as $printedFileName)
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">{{ $printedFileName->reset_file_name }}</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{ $printedFileName->reset_file_original == 0 ? 'أصل' : 'صورة' }}</span>
                            </li>
                        @endforeach
                      </ol>
                </div>
            </div>

            @if(count($copies) > 0)
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label style="font-weight:bold;font-size:24px;">الملفات المنسوخة</label>
                        <ol class="list-group list-group-numbered">
                            @foreach($copies as $copy)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ $copy->reset_file_copy_name }}</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $copy->number_copies }}</span>
                                </li>
                                <br>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @else

            @endif

            <div class="row mb-3">
                <div class="col-md-6">
                    <label style="font-weight:bold;font-size:24px">عدد الأوراق</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->reset_pages_number }}">
                </div>
                <div class="col-md-6">
                    <label style="font-weight:bold;font-size:24px">نوع الفاتورة</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ $printedReset->reset_translation }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label style="font-weight:bold;font-size:24px">اللغة</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ App\Models\Language::where('id', $printedReset->language_id)->value('first_language') }} إلي {{ App\Models\Language::where('id', $printedReset->language_id)->value('second_language') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label style="font-weight:bold;font-size:24px;">المترجمين</label>
                    <ul class="list-group list-group">
                        @foreach(json_decode($printedReset->translators) as $translator)
                            <?php $translatorsEmails = explode(',', $translator); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                @foreach($translatorsEmails as $trans)
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">{{ App\Models\Translator::find($trans)->name ?? '' }}</div>
                                    </div>
                                    <br>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">المبلغ الإجمالي</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->reset_total_cost }}">
                </div>
                @if($printedReset->is_payed == '0')
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">المدفوع</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->reset_cost_paid }}">
                </div>
                @else
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">المدفوع</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->reset_total_cost }}">
                </div>
                @endif
                @if($printedReset->is_payed == '0')
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">المتبقي</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->reset_cost_not_paid }}">
                </div>
                @else
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">المتبقي</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="0">
                </div>
                @endif
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px">طريقة الدفع</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ $printedReset->payment_type }}">
                </div>
            </div>

            <div class="row mb-3">
                @if($printedReset->is_scan == '1')
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">مبلغ السكان</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->scan_price }}">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">طريقة الدفع</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->scan_payment_type }}">
                    </div>
                @else

                @endif
            </div>

            <div class="row mb-3">
                @if($printedReset->has_delivered == '1')
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">مبلغ الشحن</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->deliver_price }}">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">طريقة الدفع</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->deliver_payment_type }}">
                    </div>
                @else

                @endif
            </div>

            <div class="row">
                <h3>موعد التسليم</h3>
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px;">اليوم</label>
                    @if(Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Saturday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="السبت">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Sunday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الأحد">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Monday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الاثنين">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Tuesday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الثلاثاء">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Wednesday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الاربعاء">
                    @elseif (Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('l') == 'Thursday')
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الخميس">
                    @else
                        <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="الجمعة">
                    @endif
                </div>
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px;">التاريخ</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('Y-m-d') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px;">الساعة</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="{{ Carbon\Carbon::parse($printedReset->reset_recieved_date)->format('g:i:s a') }}">
                </div>
                <div class="col-md-3 mb-3">
                    <label style="font-weight:bold;font-size:24px;">إلي الساعة</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px;" value="10:00 pm">
                </div>
            </div>

            <div class="row mb-3">
                @if($printedReset->recieved_by == '1')
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">اسم متسلم الاوراق</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->recieved_by_name }}">
                    </div>
                    <div class="col-md-6">
                        <label style="font-weight:bold;font-size:24px">رقم تليفون متسلم الاوراق</label>
                        <input type="text" class="form-control" style="font-weight:bold;font-size:24px" disabled value="{{ $printedReset->recieved_by_phone }}">
                    </div>
                @else
                    <div class="col-md-12">
                        <label style="font-weight:bold;font-size:24px">متسلم الاوراق</label>
                        <h5>من قام بعمل الفاتورة سوف يتسلم الاوراق بشخصه</h5>
                    </div>
                @endif
            </div>

            <div class="row">
                <p class="font-weight-bold">نوع الفاتورة</p>
                @if($printedReset->money_status == '0')
                    <h5>فاتورة فوري</h5>
                @elseif($printedReset->money_status == '1')
                    <h5>فاتورة مستعجلة</h5>
                @else
                    <h5>فاتورة عادية</h5>
                @endif
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>ملاحظات للعميل</label>
                    <textarea cols="30" rows="5" class="form-control" style="font-weight:bold;font-size:24px" disabled>{{ $printedReset->reset_notes_client }}</textarea>
                </div>
                <div class="col-md-6">
                    <label>ملاحظات الفاتورة</label>
                    <textarea cols="30" rows="5" class="form-control" style="font-weight:bold;font-size:24px" disabled>{{ $printedReset->reset_notes }}</textarea>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label>ملاحظات للمترجمين</label>
                    <textarea cols="30" rows="5" class="form-control" style="font-weight:bold;font-size:24px" disabled>{{ $printedReset->translator_notes }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label style="font-weight:bold;font-size:24px">الاسماء باللغة الإنجليزية</label>
                    <textarea cols="30" rows="5" class="form-control" style="font-weight:bold;font-size:24px" disabled>{{ $printedReset->reset_name_english }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mb-3">
                    <label>المسؤول</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ auth()->user()->name }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>رقم تليفون المسؤول</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="{{ auth()->user()->phone }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>رقم متابعة العملاء</label>
                    <input type="text" disabled class="form-control" style="font-weight:bold;font-size:24px" value="01226098418">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3 d-flex justify-content-center">
            <button id="printReset" onclick="printDiv('toPrintScreen')" class="btn btn-success">طباعة الفاتورة</button>
        </div>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <a href="/revisions/resets" class="btn btn-primary">رجوع</a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>
