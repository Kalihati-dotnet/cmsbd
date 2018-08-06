@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
  <a href="{{ route('manage.roles.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-list"></i> Return to List</a>
  <a href="{{ route('manage.roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit </a>
  <a href="javascript:;" id="___delete" class="btn btn-sm btn-danger delete-modal" data-id="{{ $role->id }}"
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
          <span>View Role Details</span>
      </h3>
  </div>  
  <div class="body-content">   
        
    <div class="field">
      <div class="field-heading">
        <h3>Name</h3>
      </div>
      <div class="field-body">
        <pre>{{$role->name}}</pre>  
      </div> 
    </div>
    <div class="field">
        <div class="field-heading">
            <h3>Display Name</h3>
          </div>
          <div class="field-body">
            <pre>{{$role->display_name}}</pre>  
          </div>
    </div>
    <div class="field">
          <div class="field-heading">
            <h3>Permissions</h3>
          </div>
          <div class="field-body">
            <ul class="permissions checkbox">
                @foreach($permissions as $table => $permission)
                    <li>
                        <label><strong>{{title_case(str_replace('_',' ', $table))}}</strong></label>
                        <ul>
                            @foreach($permission as $perm)
                                <li>
                                    @if(in_array($perm->key, $role->perms->pluck('key')->toArray()))
                                      <span class="text-green">&#9745;</span>
                                      @else
                                      <span class="text-red">&#9744;</span>
                                    @endif
                                    <label for="permission-{{$perm->id}}">{{title_case(str_replace('_', ' ', $perm->key))}}</label>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
          </div>
    </div>
  </div>
</div>
@endsection