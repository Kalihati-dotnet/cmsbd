@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.menus.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-list-alt"></i>
        <span> Return to List</span>
    </a>   
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-list-alt"></i>
            <span>Menu:</span>
        </h3>
    </div> 
    <div class="body-content bg-table">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Url</th>
                <th>Target</th>
                <th>Icon</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>{{$menu->id}}</td>
                <td>{{$menu->name}}</td>
                <td>
                    @if(isset($menu->parent))
                    {{$menu->parent->name}}
                    @endif
                </td>
                <td>{{$menu->url or '' }}</td>
                <td>{{$menu->target}}</td>
                <td>{{$menu->icon_class}}</td>
                <td>
                    <div class="show-action-group">
                        <a href="{{ route('manage.menus.edit',  ['id' => $menu->id] ) }}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>

                        <a href="" class="btn btn-sm btn-danger delete-modal" data-id="{{ $menu->id }}"
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

