@extends('manage.layouts.login')
@section('content')

<div class="panel">
    <div class="panel-heading">Login</div>
    <div class="panel-body">
        <form class="form-auth" method="POST" action="{{ route('manage.login') }}" novalidate>
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">E-Mail Address</label>
                <div class="">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <div>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>
            </div>
            <div class="form-group">
                <div class="free-space"></div>
                <div class="">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="btn-login-forgot" ></div>
               <div>
                   <button type="submit" class="btn-login">Login</button>
                </div> 
            </div>
        </form>
    </div>
</div>
@endsection