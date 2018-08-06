@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.users.create') }}" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i>
        <span> Add New</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-user"></i>
            <span>Users</span>
        </h3>
    </div>  
   
    <div class="body-content">
        <div class="bg-table">
            <table class="table table-bordered">
                <tr role="row">
                    <th><input type="checkbox" class="select_all"></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Display Name</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>--</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->display_name }}</td>
                        <td>{{ $user->roles->pluck('name')->first() }}</td>
                        <td>
                         
                                <a href="{{ route('manage.users.show',  ['id' => $user->id]) }}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-eye"></i><span>View</span>
                                </a>
                                <a href="{{ route('manage.users.edit',  ['id' => $user->id]) }}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-edit"></i><span>Edit</span>
                                </a>
                                <a href="" class="btn btn-sm btn-danger delete-modal" data-id="{{ $user->id }}"
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