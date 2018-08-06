@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.roles.create') }}" class="btn btn-success btn-add-new">
        <i class="fa fa-plus"></i>
        <span>Add New</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-user"></i>
            <span>Roles</span>
        </h3>
    </div>  
    <div class="body-content">
        <div class="bg-table">
            <table class="table table-bordered">
                <tr role="row">
                    <th><input type="checkbox" class="select_all"></th>
                    <th>Role</th>
                    <th>Display Name</th>
                    <th>Actions</th>
                </tr>
                @foreach($roles as $role)
                    <tr>
                        <td>--</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->display_name }}</td>
                        <td>
                        
                                <a href="{{ route('manage.roles.show',  ['id' => $role->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-eye"></i><span>View</span>
                                </a>
                                <a href="{{ route('manage.roles.edit',  ['id' => $role->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i><span>Edit</span>
                                </a>
                                <a href="" class="btn btn-sm btn-danger delete-modal" data-id="{{ $role->id }}"
                                    data-toggle="modal" 
                                    data-target="#delete_modal"
                                    onclick="event.preventDefault();">
                                    <i class="fa fa-trash"></i><span>Delete</span>
                                </a>
                            
                        </td>
                    </tr> 
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection