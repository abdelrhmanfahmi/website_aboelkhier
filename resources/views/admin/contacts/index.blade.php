@extends('app.indexAdmin')
@section('main')


<div class="users">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Subject</th>
                <th scope="col">Actions</th>
              </tr>
        </thead>
        <tbody id="ifDataHere">
            @if(count($contacts) > 0)
                @foreach ($contacts as $index => $contact)
                    <tr>
                        <th scope="row">{{ $index+1 }}</th>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email}}</td>
                        <td>{{ $contact->phone}}</td>
                        <td>{{ $contact->subject}}</td>
                        <td>
                            <a href="/admin/contacts/{{$contact->id}}/show" class="btn btn-primary">Show</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="text-center"><td colspan="7">No Data Yet</td></tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex">
        {!! $contacts->links() !!}
    </div>
</div>

@endsection
