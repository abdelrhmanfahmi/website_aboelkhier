@extends('app.indexAdmin')
@section('main')

    <div class="index-recieved-reset mb-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم العميل</th>
                <th scope="col">نوع الترجمة للفاتورة</th>
                <th scope="col">عدد أوراق الترجمة للفاتورة</th>
                <th scope="col">المبلغ الكلي للفاتورة</th>
            </tr>
            </thead>
            <tbody id="ifDataHere">
                @if(count($recieved_resets) > 0)
                    @foreach ($recieved_resets as $recieved_reset)
                        <tr>
                            <th scope="row">{{ $recieved_reset->id }}</th>
                            <td>{{ $recieved_reset->reset_client }}</td>
                            <td>{{ $recieved_reset->reset_translation }}</td>
                            <td>{{ $recieved_reset->reset_pages_number }}</td>
                            <td>{{ $recieved_reset->reset_total_cost }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center"><td colspan="6">لا توجد فواتير ممسوحة بعد</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
        });
    </script>
@endsection
