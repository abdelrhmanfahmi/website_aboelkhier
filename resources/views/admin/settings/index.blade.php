@extends('app.indexAdmin')
@section('main')


<div class="users">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">key</th>
                <th scope="col">value</th>
                <th scope="col">image</th>
                <th scope="col">إجراءات</th>
              </tr>
        </thead>
        <tbody id="ifDataHere">
            @if(count($settings) > 0)
                @foreach ($settings as $index => $setting)
                    <tr>
                        <th scope="row">{{ $index+1 }}</th>
                        <td>{{ $setting->key }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($setting->value, 30, $end='...') }}</td>
                        <td>
                            <?php $ext = pathinfo($setting->image, PATHINFO_EXTENSION); ?>
                            @if ($setting->image != null && ($ext == 'svg' || $ext == 'png' || $ext == 'jpeg' || $ext == 'jpg'))
                                <img src="{{ asset('/uploads/' . $setting->image) }}" width="30px" height="30px" alt="">
                            @else

                            @endif
                        </td>
                        <td>
                            <a href="/admin/settings/{{$setting->id}}/edit" class="btn btn-success">Edit</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center"><td colspan="7">No Data Yet</td></tr>
            @endif
        </tbody>
    </table>
</div>

@endsection
