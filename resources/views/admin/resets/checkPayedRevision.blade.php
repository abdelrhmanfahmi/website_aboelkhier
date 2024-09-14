@extends('app.indexAdmin')
@section('main')

    <style>
        body{
            overflow-y: scroll !important;
        }
    </style>

    <div class="container-fluid">
        <h5>العميل يجب أن يدفع <span class="text-danger">{{ $checkReset->reset_cost_not_paid }}</span> جنيه لكي يستلم الفاتورة في موعد <span class="text-danger">{{ \Carbon\Carbon::parse($checkReset->reset_recieved_date)->format('y-m-d h:i:s') }}</span></h5>
        <br>
        <form action="{{ route('reset.checkPayedDateRevision' , $checkReset->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label><span class="text-danger">*</span> نوع عملية الدفع</label>
                    <select name="payment_type_two" id="payment_type_two" class="form-control">
                        <option disabled selected>-- اختر نوع عملية الدفع --</option>
                        <option value="visa">visa</option>
                        <option value="cash">cash</option>
                        <option value="vodafone_cash">vodafone_cash</option>
                        <option value="online">online</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>المبلغ المتبقي الذي لم يتم دفعه بعد</label>
                    <input type="text" readonly name="reset_cost_not_paid" id="reset_cost_not_paid" class="form-control">
                </div>
                <div>
                    <button type="submit" id="btnSubmit" class="btn btn-success" disabled>تعديل</button>
                </div>
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
            let restCost = "{{ $checkReset->reset_cost_not_paid }}";
            let dateNow = "{{ $checkReset->reset_recieved_date }}";
            let dateToday = new Date();
            let dateFuture = new Date(dateNow);
            $('#payment_type_two').on('change' , function(e){
                $('#reset_cost_not_paid').prop('readonly' , false);
            });
            $('#reset_cost_not_paid').on('keyup' , function(e){
                if(e.target.value == +restCost && $('#payment_type_two').val() != null){
                    $('#btnSubmit').prop('disabled' , false);
                }else{
                    $('#btnSubmit').prop('disabled' , true);
                }
            });
        });
    </script>

@endsection
