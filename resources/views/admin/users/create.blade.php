@extends('app.indexAdmin')
@section('main')

    <div class="users">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <div class="text-danger errorName">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>البريد الإلكتروني</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    @if($errors->has('email'))
                        <div class="text-danger errorEmail">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>رقم التليفون</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                    @if($errors->has('phone'))
                        <div class="text-danger errorPhone">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>كلمة المرور</label>
                    <input type="password" name="password" class="form-control">
                    @if($errors->has('password'))
                        <div class="text-danger errorPassword">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @if($errors->has('password_confirmation'))
                        <div class="text-danger errorPasswordConfirmation">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>اختر دور يقوم به المستخدم</label>
                    <select name="type" class="form-control" id="role">
                        <option disabled selected>-- اختر دور يقوم به المستخدم --</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                        <option value="revision">Revision</option>
                    </select>
                    @if($errors->has('type'))
                        <div class="text-danger errorRole">{{ $errors->first('type') }}</div>
                    @endif
                </div>
            </div>

            <div class="col mb-3">
                <button type="submit" class="btn btn-success">إضافة مستخدم</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            loading();
            setTimeout(() => {
                unloading();
            },1500);
            if ($(".errorName")){
                setTimeout(() => {
                    $('.errorName').fadeOut('slow');
                }, 7000);
            }
            if ($(".errorEmail")){
                setTimeout(() => {
                    $('.errorEmail').fadeOut('slow');
                }, 7000);
            }
            if ($(".errorPhone")){
                setTimeout(() => {
                    $('.errorPhone').fadeOut('slow');
                }, 7000);
            }
            if ($(".errorPassword")){
                setTimeout(() => {
                    $('.errorPassword').fadeOut('slow');
                }, 7000);
            }
            if ($(".errorPasswordConfirmation")){
                setTimeout(() => {
                    $('.errorPasswordConfirmation').fadeOut('slow');
                }, 7000);
            }
            if ($(".errorRole")){
                setTimeout(() => {
                    $('.errorRole').fadeOut('slow');
                }, 7000);
            }
        });
    </script>

@endsection
