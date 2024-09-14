@extends('app.indexAdmin')
@section('main')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <style>
        body{
            overflow-y: scroll !important;
        }
    </style>
    <div class="applications">
        <form enctype="multipart/form-data">
            <div class="row mb-3">
                <h3>أبليكشن</h3>
                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span> البلاد الموجودة في الابليكشن</label>
                    <select name="state_id" id="state_id" class="form-control" disabled>
                        <option disabled selected>-- اختر بلد الابليشكن --</option>
                        @foreach ($states as $state)
                            <option {{old('state_id',$state->id) == $application->state_id ? 'selected' : ''}} value="{{ $state->id }}">{{ $state->state }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('state_id'))
                        <div class="text-danger errorStateId">{{ $errors->first('state_id') }}</div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label>مسؤول الاستلام</label>
                    <select name="user_id" id="user_id" class="form-control" disabled>
                        <option selected disabled>-- اختر ابليكشن --</option>
                        @foreach ($users as $user)
                            <option {{old('user_id',$user->id) == $application->user_id ? 'selected' : ''}} value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>مسؤول التنفيذ</label>
                    <select name="execution_id" disabled id="execution_id" class="form-control">
                        <option selected disabled>-- اختر مسؤول --</option>
                        @foreach ($executions as $execution)
                            <option {{old('execution_id',$execution->id) == $application->execution_id ? 'selected' : ''}} value="{{ $execution->id }}">{{ $execution->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label> الاستشاري</label>
                    <select name="advisor_id" disabled id="advisor_id" class="form-control">
                        <option selected disabled>-- اختر استشاري --</option>
                        @foreach ($advisors as $advisor)
                            <option {{old('advisor_id',$advisor->id) == $application->advisor_id ? 'selected' : ''}} value="{{ $advisor->id }}">{{ $advisor->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span> اسم العميل</label>
                    <input type="text" name="client_name" class="form-control" disabled value="{{ $application->client_name }}">
                    @if($errors->has('client_name'))
                        <div class="text-danger errorClientName">{{ $errors->first('client_name') }}</div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span> رقم نليفون العميل</label>
                    <input type="text" name="client_phone" class="form-control" disabled value="{{ $application->client_phone }}">
                    @if($errors->has('client_phone'))
                        <div class="text-danger errorClientPhone">{{ $errors->first('client_phone') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <label>كود العميل</label>
                    <input type="text" name="client_code" id="client_code" disabled class="form-control" value="{{ $application->client_code }}">
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <label>نوع الابليكشن</label>
                    <select name="application_type" id="application_type" class="form-control" disabled>
                        <option disabled selected>-- اختر نوع الابليكشن --</option>
                        <option {{ $application->application_type == 'هجرة' ? "selected" : "" }} value="هجرة">هجرة</option>
                        <option {{ $application->application_type == 'تجديد باسبور' ? "selected" : "" }} value="تجديد باسبور">تجديد باسبور</option>
                        <option {{ $application->application_type == 'إصدار باسبور' ? "selected" : "" }} value="إصدار باسبور">إصدار باسبور</option>
                        <option {{ $application->application_type == 'سياحة/زيارة' ? "selected" : "" }} value="سياحة/زيارة">سياحة/زيارة</option>
                        <option {{ $application->application_type == 'سفر للعلاج' ? "selected" : "" }} value="سفر للعلاج">سفر للعلاج</option>
                        <option {{ $application->application_type == 'سفر للدراسة' ? "selected" : "" }} value="سفر للدراسة">سفر للدراسة</option>
                        <option {{ $application->application_type == 'بحث علاجي' ? "selected" : "" }} value="بحث علاجي">بحث علاجي</option>
                        <option {{ $application->application_type == 'بحث دراسي' ? "selected" : "" }} value="بحث دراسي">بحث دراسي</option>
                        <option {{ $application->application_type == 'حجز معاد توثيق' ? "selected" : "" }} value="حجز معاد توثيق">حجز معاد توثيق</option>
                        <option id="others" {{ $application->application_type == 'خدمة آخري' ? "selected" : "" }} value="خدمة آخري">خدمة آخري</option>
                    </select>
                    <div id="isDisplayedForService" style="{{ $application->application_type == 'خدمة آخري' ? "display:block" : "display:none" }}">
                        <label><span class="text-danger">*</span> اسم الخدمة</label>
                            @foreach ($extraServices as $idx => $extraService)
                            <div class="row mb-3" id=row>
                                <div class="col-md-5 mb-3">
                                    <input disabled type = "text" class="form-control extra_service_names" name="extra_service_names[]" value="{{ $extraService->extra_service_name }}" placeholder="أدخل اسم الخدمة"/>
                                </div>
                                <div class="col-md-5 mb-3">
                                    <input disabled type = "number" class="form-control extra_service_prices" id="extra_service_prices" name="extra_service_prices[]" value="{{ $extraService->price }}" placeholder="أدخل سعر الخدمة" />
                                </div>
                                @if($idx == 0)
                                    <div class="col-md-2 mb-3">
                                        <button disabled id="rowAdder" type="button"
                                            class="btn btn-dark d-flex align-items-center justify-content-center">
                                            <span class="bi bi-plus-square-dotted">
                                            </span> +
                                        </button>
                                    </div>
                                @else
                                    <div class="col-md-2 d-flex align-items-center">
                                        <button disabled class="btn btn-danger" id="DeleteRow" type="button">
                                            <i class="bi bi-trash"></i>
                                            x
                                        </button>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        <div id="newinput"></div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <label><span class="text-danger">*</span> تفاصيل الخدمة</label>
                <br>
                @foreach ($services as $service)
                    <div class="col-md-3">
                        <input type="checkbox" class="isSelected{{ $service->id }} selectedServices checkIfOthers mb-3" name="services[]" disabled value="{{ $service->id }}"/> {{ $service->service_name }} &nbsp;
                    </div>
                @endforeach
                @if($errors->has('services'))
                    <div class="text-danger errorServices">{{ $errors->first('services') }}</div>
                @endif
                <div style="{{ $application->other_service != null ? "display:block" : "display:none" }}" id="isDisplayedOtherService" class="mb-3">
                    <label>خدمة آخري</label>
                    <input type="text" id="other_service_id" name="other_service" required class="form-control" disabled value="{{ $application->other_service }}" placeholder="أدخل خدمة آخري">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label><span class="text-danger">*</span> المبلغ الكلي</label>
                    <input type="text" name="total_cost" id="total_cost" class="form-control" disabled value="{{ $application->total_cost }}" readonly/>
                    @if($errors->has('total_cost'))
                        <div class="text-danger errorTotalCost">{{ $errors->first('total_cost') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label><span class="text-danger">*</span> المبلغ المدفوع</label>
                    <input type="text" name="paid_cost" id="paid_cost" class="form-control" disabled value = "{{ $application->paid_cost }}" readonly/>
                    @if($errors->has('paid_cost'))
                        <div class="text-danger errorPaidCost">{{ $errors->first('paid_cost') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label><span class="text-danger">*</span> نوع عملية الدفع</label>
                    <select name="payment_type" id="payment_type" class="form-control" disabled>
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option {{ $application->payment_type == 'cash' ? "selected" : "" }} value="cash">cash</option>
                        <option {{ $application->payment_type == 'visa' ? "selected" : "" }} value="visa">visa</option>
                        <option {{ $application->payment_type == 'vodafone_cash' ? "selected" : "" }} value="vodafone_cash">vodafone_cash</option>
                        <option {{ $application->payment_type == 'online' ? "selected" : "" }} value="online">online</option>
                    </select>
                    @if($errors->has('payment_type'))
                        <div class="text-danger errorPaymentType">{{ $errors->first('payment_type') }}</div>
                    @endif
                </div>

                <div class="col-md-3">
                    <label><span class="text-danger">*</span> موعد الدفع</label>
                    <input type="date" name="payment_date" id="payment_date" class="form-control" disabled value="{{ $application->payment_date }}"/>
                    @if($errors->has('payment_date'))
                        <div class="text-danger errorPaymentDate">{{ $errors->first('payment_date') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>المبلغ المتبقي الذي لم يتم دفعه بعد</label>
                    <input type="text" name="rest_cost" id="rest_cost" class="form-control" disabled readonly value="{{ $application->rest_cost }}"/>
                    @if($errors->has('rest_cost'))
                        <div class="text-danger errorRestCost">{{ $errors->first('rest_cost') }}</div>
                    @endif
                </div>

                <div class="col-md-6 d-flex align-items-center mb-3">
                    <label>هل تريد عمل خصم للفاتورة ؟</label>
                    <input type="checkbox" name="has_discount" disabled {{ $application->has_discount == '1' ? 'checked' : ''}} id="discount">
                </div>
            </div>

            @if ($application->has_discount == '1')
                <div class="row mb-3 ifDiscount">
                    <div class="col-md-6">
                        <label>نسبة الخصم</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="number" name="discount_price" disabled value="{{ $application->discount_price }}" id="discount_price" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>وصف الخصم</label>
                        <input type="text" name="discount_desc" disabled value="{{ $application->discount_desc }}" id="discount_desc" class="form-control">
                    </div>
                </div>
            @else
                <div class="row mb-3 d-none ifDiscount">
                    <div class="col-md-6">
                        <label>نسبة الخصم</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">%</span>
                            </div>
                            <input type="number" disabled name="discount_price" id="discount_price" class="form-control">
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

            <div class="row">
                <div class="col-md-6">
                    <label>البريد الإلكتروني للعميل في سفارة بلد الابليكشن</label>
                    <input type="email" name="client_email" id="client_email" class="form-control" disabled value="{{ $application->client_email }}"/>
                    @if($errors->has('client_email'))
                        <div class="text-danger errorClientEmail">{{ $errors->first('client_email') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label> كلمة المرور للعميل في سفارة بلد الابليكشن</label>
                    <input type="text" name="client_password" id="client_password" class="form-control" disabled value="{{ $application->client_password }}">
                    @if($errors->has('client_password'))
                        <div class="text-danger errorClientPassword">{{ $errors->first('client_password') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>ملاحظات</label>
                    <textarea name="notes" id="notes" cols="30" rows="10" class="form-control" disabled>{{ $application->notes }}</textarea>
                    @if($errors->has('notes'))
                        <div class="text-danger errorNotes">{{ $errors->first('notes') }}</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label>ملاحظات للعميل</label>
                    <textarea name="client_notes" id="client_notes" cols="30" rows="10" class="form-control" disabled>{{ $application->client_notes }}</textarea>
                    @if($errors->has('client_notes'))
                        <div class="text-danger errorClientNotes">{{ $errors->first('client_notes') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <label>خطوات الأبليكشن</label>
                <br>
                @foreach ($steps as $step)
                    <div class="col-md-12">
                        <input type="checkbox" class="isCheckedStep{{ $step->id }} checkedSteps checkIfOthersSteps mb-3" name="application_steps[]" disabled id="application_steps" value="{{ $step->id }}" /> {{ $step->steps }} &nbsp;
                    </div>
                @endforeach
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <button id="submitApplication" class="btn btn-success">مراجعة</button>
                    <a id="printReset" class="btn btn-primary">طباعة الفاتورة للعميل</a>
                    <a id="printResetForSystem" class="btn btn-primary">طباعة الفاتورة للشركة</a>
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

            let dataServices = "{{ $application->services }}";
            let dataAfterTransfrom = JSON.parse(dataServices.replace(/&quot;/g,'"'));
            let selected = $('.selectedServices');

            const arr1 = dataAfterTransfrom[0].split(',');

            for(let i = 0 ; i < selected.length ; i++){
                if(arr1.includes(selected[i].value)){
                    $('.isSelected'+selected[i].value).attr('checked' , true);
                }else{
                    $('.isSelected'+selected[i].value).attr('checked' , false);
                }
            }

            let dataSteps = "{{ $application->application_steps }}";
            if(dataSteps != '[null]'){
                let dataAfterTransSetps = JSON.parse(dataSteps.replace(/&quot;/g,'"'));
                let checked = $('.checkedSteps');

                const arr2 = dataAfterTransSetps[0].split(',');

                for(let i = 0 ; i < checked.length ; i++){
                    if(arr2.includes(checked[i].value)){
                        $('.isCheckedStep'+checked[i].value).attr('checked' , true);
                    }else{
                        $('.isCheckedStep'+checked[i].value).attr('checked' , false);
                    }
                }
            }

            let currentURL = document.location.pathname;
            // $('#revertToSecratary').attr('disabled' , true);
            let id = currentURL.split("/")[4];
            console.log(id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#printReset').on('click' , function(e){
                window.location.href = '/application/print/revision/'+id
            });

            $('#printResetForSystem').on('click' , function(e){
                window.location.href = '/application/print/revisionForSystem/'+id
            });

            $('#submitApplication').on('click' , function(e){
                loading();
                e.preventDefault();
                $.ajax({
                    url:'/application/'+id+'/revise',
                    method:'GET',
                    success:function(res){
                        console.log(res);
                        if(res == 1){
                            unloading();
                            toastr.success('الفاتورة تم مراجعتها بنجاح');
                            setTimeout(() => {
                                window.location.href = '/revisions/applications';
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
