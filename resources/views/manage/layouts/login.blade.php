<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Manage') }}</title>
    <link href="{{ asset('manage/css/manage.css') }}" rel="stylesheet">
    <!-- Styles -->
    <style>
        body{background:#101010;}
        .nv__notice{margin-bottom: 100px;}
       .nv__login{
           max-width: 480px;
           margin-left: auto;
           margin-right: auto;
           background: #f1f1f1;
           margin-top:10vh;
       }
       .nv__login .panel{
           padding: 20px;
       }
       .nv__login form .form-group{
           display: grid;
           grid-template-columns: 1fr 1.5fr;
           margin: 10px;
       }
       .btn-login{
            padding: .5rem 2rem;
            font-size: 1rem;
            width: 100%;
       }
       .btn-login-forgot{
           align-self: center;
       }
       .alert-danger,
       .has-error{
           color: #721c24;
       }
       .alert{
            text-align: center;
       }
   </style>
    <!-- head scripts -->
     @yield('head')
</head>
<body>
    <div class="nv__login">
        <div class="nv__notice">
            @include('manage._includes.messages')
        </div>
        @yield('content')
    </div>
</body>
</html>
