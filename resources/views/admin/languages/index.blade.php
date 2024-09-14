@extends('app.indexAdmin')
@section('main')

    <div class="users">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">اللغة الاولي</th>
                <th scope="col">اللغة الثانية</th>
                <th scope="col">السعر بالجنيه المصري</th>
                <th scope="col">إجراءات</th>
              </tr>
            </thead>
            <tbody>
                @if(count($languages) > 0)
                    @foreach ($languages as $index => $language)
                        <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $language->first_language }}</td>
                            <td>{{ $language->second_language }}</td>
                            <td>{{ $language->price }}</td>
                            <td class="d-flex">
                                <a href="languages/{{$language->id}}/edit" class="btn btn-success">تعديل</a>
                                &nbsp;
                                <form method="POST" action="languages/{{$language->id}}">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <div class="">
                                        <input type="submit" class="btn btn-danger" value="مسح">
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-center"><td colspan="5">لا توجد معلومات بعد</td></tr>
                @endif
            </tbody>
        </table>
        <div class="d-flex">
            {!! $languages->links() !!}
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            loading();
            setTimeout(() => {
                unloading();
            },1500);
        });
    </script>
@endsection
