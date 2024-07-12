@extends('app.indexAdmin')
@section('main')

<div class="row">
    <form>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Name</label>
                <input type="text" name="title" id="title" readonly class="form-control" value="{{ $contact->name }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>E-mail</label>
                <input type="text" name="title" id="title" readonly class="form-control" value="{{ $contact->email }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Phone</label>
                <input type="text" name="title" id="title" readonly class="form-control" value="{{ $contact->phone }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Subject</label>
                <input type="text" name="title" id="title" readonly class="form-control" value="{{ $contact->subject }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Message</label>
                <textarea name="description" id="description" readonly class="form-control" style="resize: none;" cols="30" rows="10">{{ $contact->message }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('contact.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
</div>

@endsection
