@extends('app.indexAdmin')
@section('main')

<div class="row">
    <form action="{{ route('why.update' , $why->id) }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $why->title }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" style="resize: none;" cols="30" rows="10">{{ $why->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control" />
                @if($why->image != null)
                    <img src="{{ asset('uploads/' . $why->image) }}" width="80px" height="80px" alt="">
                @else

                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector('#description'))
    .catch(error => {
        console.error(error);
    });
</script>

@endsection
