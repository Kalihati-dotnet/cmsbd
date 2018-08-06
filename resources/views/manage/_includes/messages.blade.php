
@if(isset($errors) && count($errors)>0)
    <div class="notification">
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{$error}}</p>
            @endforeach 
        </div>
    </div>
@endif
@if(session('success'))
    <div class="notification">
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    </div>
@endif
@if(session('error'))
<div class="notification">
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
</div>
@endif
@if(session('warning'))
<div class="notification">
    <div class="alert alert-warning">
        {{session('warning')}}
    </div>
</div>
@endif