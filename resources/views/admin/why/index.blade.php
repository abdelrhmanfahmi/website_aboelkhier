@extends('app.indexAdmin')
@section('main')


<div class="users">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">image</th>
                <th scope="col">Actions</th>
              </tr>
        </thead>
        <tbody id="ifDataHere">
            @if(count($why) > 0)
                @foreach ($why as $index => $w)
                    <tr>
                        <th scope="row">{{ $index+1 }}</th>
                        <td>{{ $w->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($w->description, 90, $end='...') }}</td>
                        <td>
                            @if ($w->image != null)
                                <img src="{{ asset('/uploads/' . $w->image) }}" width="30px" height="30px" alt="">
                            @else

                            @endif
                        </td>
                        <td>
                            <a href="why/{{$w->id}}/edit" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                            <a href="why/delete/{{$w->id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center"><td colspan="7">No Data Yet</td></tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex">
        {!! $why->links() !!}
    </div>
</div>

@endsection
