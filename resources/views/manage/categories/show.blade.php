@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.categories.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-list-alt"></i>
        <span> Return to List</span>
    </a>   
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-list-alt"></i>
            <span>Category:</span>
        </h3>
    </div> 
    <div class="body-content bg-table">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Description</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td>
                    @if(isset($category->parent))
                    {{$category->parent->name}}
                    @endif
                </td>
                <td>{{$category->description or '' }}</td>
                <td>{{$category->created_at}}</td>
                <td>
                    <div class="show-action-group">
                        <a href="{{ route('manage.categories.edit',  ['id' => $category->id] ) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>
                        <a href="" class="btn btn-sm btn-danger delete-modal" data-id="{{ $category->id }}"
                            data-toggle="modal" 
                            data-target="#delete_modal"
                            onclick="event.preventDefault();">
                            <i class="fa fa-trash"></i><span>Delete</span>
                        </a>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>
@endsection

