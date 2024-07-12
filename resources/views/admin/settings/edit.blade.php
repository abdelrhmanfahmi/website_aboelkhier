@extends('app.indexAdmin')
@section('main')

<div class="row">
    <form action="{{ route('settings.update' , $setting->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Key</label>
                <input type="text" name="key" id="key" class="form-control" value="{{ $setting->key }}"/>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Value</label>
                @if ($setting->id == 5 || $setting->id == 6)
                    <textarea name="value" id="value" class="form-control" style="resize: none;" cols="30" rows="10">{{ $setting->value }}</textarea>
                @else
                    <textarea name="value" id="valueType" class="form-control" style="resize: none;" cols="30" rows="10">{{ $setting->value }}</textarea>
                @endif

            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label>Image</label>
                <input type="file" name="image" id="image" class="form-control" />
                @if($setting->image != null)
                    <img src="{{ asset('uploads/' . $setting->image) }}" width="80px" height="80px" alt="">
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
    ClassicEditor.create(document.querySelector('#value'))
    .catch(error => {
        console.error(error);
    });
</script>

@endsection
