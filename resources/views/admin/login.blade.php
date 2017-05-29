@extends('admin.login_layout')
@section('content')
    <div class="login-logo">
    <a href="javascript:void(0)"><b>Admin</b>Section</a>
  </div>
  <div class="login-box-body">
    @if(Session::has('login-status'))
      <p class="login-box-msg">{{ Session::get('login-status') }}</p>
    @else
      <p class="login-box-msg">Sign in to start your session</p>
    @endif

    <form method="post" action="/admin/login" novalidate="novalidate">
      {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
        <input type="email" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('email') }}</span>
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error': '' }}">
        <input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger">{{ $errors->first('password') }}</span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" id="remember"> Remember Me
            </label>
          </div>
        </div>
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <a href="javascript:void(0)">I forgot my password</a><br>
@stop
