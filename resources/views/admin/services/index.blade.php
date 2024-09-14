@extends('app.indexAdmin')
@section('main')


<div class="users">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">title</th>
                <th scope="col">description</th>
                <th scope="col">icon</th>
                <th scope="col">Actions</th>
              </tr>
        </thead>
        <tbody id="ifDataHere">
            @if(count($services) > 0)
                @foreach ($services as $index => $service)
                    <tr>
                        <th scope="row">{{ $index+1 }}</th>
                        <td>{{ $service->title }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($service->description, 90, $end='...') }}</td>
                        <td>
                            @if ($service->icon != null)
                                <img src="{{ asset('/uploads/' . $service->icon) }}" width="30px" height="30px" alt="">
                            @else

                            @endif
                        </td>
                        <td>
                            <a href="services/{{$service->id}}/edit" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                            <a href="services/delete/{{$service->id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center"><td colspan="7">No Data Yet</td></tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex">
        {!! $services->links() !!}
    </div>
</div>

@endsection
