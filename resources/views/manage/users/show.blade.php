@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
  <a href="{{ route('manage.users.index')}}" class="btn btn-warning btn-sm"><i class="fa fa-list"></i> Return to List</a>
  <a href="{{ route('manage.users.edit', $user->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> Edit User</a>
  <a href="javascript:;" id="___delete" class="btn btn-sm btn-danger delete-modal" data-id="{{ $user->id }}"
    data-toggle="modal" 
    data-target="#delete_modal"
    onclick="event.preventDefault();">
    <i class="fa fa-trash"></i><span>Delete</span>
  </a>
</div>
<div class="page-body">
  <div class="body-heading">
      <h3>
          <i class="fa fa-user"></i>
          <span>View User Details</span>
      </h3>
  </div>  
  <div class="body-content">    
    <div class="field">
      <label for="username" class="label">Unername</label>
      <pre>{{$user->username}}</pre>
    </div>
    <div class="field">
      <label for="email" class="label">Email</label>
      <pre>{{$user->email}}</pre>
    </div>
    <div class="field">
      <label for="email" class="label">Roles</label>
      <ul>
        @forelse ($user->roles as $role)
          <li>{{$role->name}}</li>
        @empty
          <p>This user has not been assigned any roles yet</p>
        @endforelse
      </ul>
    </div>       
  </div>
</div>
@endsection