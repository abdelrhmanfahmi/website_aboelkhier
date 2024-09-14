@extends('app.indexAdmin')
@section('main')

    <div class="edit-users">
        <form action="{{ route('users.update' , $user->id) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>الاسم</label>
                    <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                    @if($errors->has('name'))
                        <div class="text-danger errorName">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>البريد الالكتروني</label>
                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                    @if($errors->has('email'))
                        <div class="text-danger errorEmail">{{ $errors->first('email') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>رقم التليفون</label>
                    <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                    @if($errors->has('phone'))
                        <div class="text-danger errorPhone">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <div class="col-md-6 mb-3">
                    <label>كلمة المرور</label>
                    <input type="password" name="password" class="form-control">
                    @if($errors->has('password'))
                        <div class="text-danger errorPassword">{{ $errors->first('password') }}</div>
                    @endif
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mb-3">
                    <label>تأكيد كلمة المرور</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label><span style="color: red;">*</span>اختر دور يقوم به المستخدم</label>
                    <select name="type" class="form-control" id="type">
                        <option disabled selected>-- اختر دور يقوم به المستخدم --</option>
                        <option @if($user->type == 'admin') selected @endif value="admin">admin</option>
                        <option @if($user->type == 'user') selected @endif value="user">User</option>
                        <option @if($user->type == 'revision') selected @endif value="revision">Revision</option>
                    </select>
                </div>
            </div>

            <div class="col mb-3">
                <button type="submit" class="btn btn-success">تعديل مستخدم</button>
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
        });
    </script>

@endsection
