
@if(isset($errors) && count($errors)>0)
    <div class="notification danger">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach 
        </div>
    </div>
@endif
@if(session('success'))
    <div class="notification success">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
@endif
@if(session('error'))
<div class="notification danger">
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
</div>
@endif
@if(session('info'))
<div class="notification info">
    <div class="alert alert-info">
        {{session('info')}}
    </div>
</div>
@endif
@if(session('redirect'))
<div class="notification">
    <div class="alert">
        {{session('redirect')}}
    </div>
</div>
@endif
