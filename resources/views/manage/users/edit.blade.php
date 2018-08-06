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
            <span>Edit User</span>
        </h3>
    </div>  
    <div class="body-content">
        <div class="bg-form">
            <div><b>usename: </b><span>{{ $user->username }}</span></div>
            <div><b>email: </b><span>{{ $user->email }}</span></div>
            <form action="{{ route('manage.users.update', $user->id) }}" method="POST" novalidate>
                {{ csrf_field() }}
            <div class="form-stuf">
                <div class="row">
                    <div class="col-md-8">
                        {{--
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ $user->username or old('username') }}" required>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">E-Mail Address</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email or old('email') }}" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        --}}
                        <div class="form-group">
                            <label for="display_name">Display Name</label>
                            <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="{{ $user->display_name or old('display_name') }}">
                            @if ($errors->has('display_name'))
                                <span class="invalid-feedback">
                                <strong>{{ $errors->first('display_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input id="new_password" type="text" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password"
                            placeholder="Leave empty to keep the same">
                            {{-- @if ($errors->has('new_password'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('new_password') }}</strong>
                            </span>
                            @endif --}}
                        </div>
                        <div class="form-group"> 
                            <label for="roles">Roles:</label>
                            <select class="form-control select-two" id="roles" name="roles">
                                @if($user->roles()->pluck('id')->first() == null)
                                    <option value="" selected>--None--</option>
                                @endif
                                @foreach($roles as $rk => $rv)
                                        <option value="{{$rk}}" @if($rk == $user->roles()->pluck('id')->first()) selected @endif>{{$rv}}</option>
                                @endforeach
                            </select>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div id="submitdiv" class="asidebox">
                            <div class="form-group">
                                <input name="_method" value="PUT" type="hidden">
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
