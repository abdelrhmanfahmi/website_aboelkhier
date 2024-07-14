@extends('app.indexAdmin')
@section('main')

<div class="row">
    <form action="{{ route('why.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Title</label>
                <input type="text" name="title" id="title" class="form-control"/>
                @if($errors->has('title'))
                    <div class="text-danger errorName">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Description</label>
                <textarea name="description" id="description" class="form-control" style="resize: none;" cols="30" rows="10"></textarea>
                @if($errors->has('description'))
                    <div class="text-danger errorDescription">{{ $errors->first('description') }}</div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control" />
                @if($errors->has('image'))
                    <div class="text-danger errorImage">{{ $errors->first('image') }}</div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-success" type="submit">Create</button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    // ClassicEditor.create(document.querySelector('#description'))
    // .catch(error => {
    //     console.error(error);
    // });

    $(document).ready(function(e){
        if ($(".errorName")){
            setTimeout(() => {
                $('.errorName').fadeOut('slow');
            }, 4000);
        }
        if ($(".errorDescription")){
            setTimeout(() => {
                $('.errorDescription').fadeOut('slow');
            }, 4000);
        }
        if ($(".errorImage")){
            setTimeout(() => {
                $('.errorImage').fadeOut('slow');
            }, 4000);
        }
    });
</script>

@endsection
