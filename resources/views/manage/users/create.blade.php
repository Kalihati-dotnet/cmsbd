@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.users.index') }}{{ isPage(url()->previous()) }}" class="btn btn-warning btn-sm">
        <i class="fa fa-list-alt"></i>
        <span> All Users</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-user"></i>
            <span>Add User</span>
        </h3>
    </div>  
    <div class="body-content">
        <div class="bg-form">
            <form action="{{ route('manage.users.store') }}" method="POST" novalidate>
                {{ csrf_field() }}
                <div class="form-stuf">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ old('display_name') }}">
                                @if ($errors->has('display_name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('display_name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                            </div>
                            <div class="form-group">
                                <div id="auto_password">
                                    <input type="checkbox" disabled>
                                    Auto Generate Password
                                </div>
                                <div id="inputPassword">
                                    {{-- need to dev --}}
                                    {{old('role')}}
                                </div>
                            </div>
                        <div class="form-group">
                            @include('manage._includes.form.selectOptions', [
                                'name' => 'role',
                                'options' => $roles,
                                'selected' => (old('role')) ? old('role') : 4
                            ])
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div id="submitdiv" class="asidebox">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit" class="btn">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('bottom')
<script>
    var ck = document.querySelector('#auto_password input[type="checkbox"]');
    var p = document.getElementById('auto_password');
    ck.checked = true;
    p.addEventListener('click', function(e){
        (ck.checked)? false:true;
        if(ck.checked === false){
        } else{
            document.querySelector('#password').style.display = 'none';
        }
        console.log(ck.checked);
    });
</script>
@endsection