@extends('app.indexAdmin')
@section('main')

    <div class="users">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">الاسم</th>
                <th scope="col">البريد الالكتروني</th>
                <th scope="col">رقم التليفون</th>
                <th scope="col">الدور</th>
                <th scope="col">إجراءات</th>
              </tr>
            </thead>
            <tbody>
                @if(count($users) > 0)
                    @foreach ($users as $index => $user)
                        <tr>
                            <th scope="row">{{ $index+1 }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->type }}</td>
                            <td class="d-flex">
                                <a href="users/{{$user->id}}/edit" class="btn btn-success">تعديل</a>
                                &nbsp;
                                <form method="POST" action="users/{{$user->id}}">
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
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        loading();
            setTimeout(() => {
                unloading();
            },1500);
    })
</script>
@endsection
