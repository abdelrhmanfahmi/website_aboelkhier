@extends('app.indexAdmin')
@section('main')

    <div>
        <h3>Welcome {{ auth()->user()->name }} !</h3>
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
