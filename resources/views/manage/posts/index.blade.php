@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.posts.create') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus"></i>
        <span>Add New</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-newspaper-o"></i>
            <span>Posts</span>
        </h3>
    </div>  
    <div class="body-content bg-table">
        
        @if(count($posts)>0)
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Category</th>
                <th></th>
            </tr>
            @foreach($posts as $post)
                <tr>
                    <td><a href="{{ route('manage.posts.show',  ['id' => $post->id] )}}">{{$post->id}}</a></td>
                    <td>{{ str_limit($post->title)}}</td>
                    <td>{{ucfirst(strtolower($post->status))}}</td>
                @if(isset($post->category->name))
                    <td>{{ $post->category->name }}</td>
                    @else
                    <td>No Category</td>
                    @endif
                    <td>
                        <a href="{{ route('manage.posts.show',  ['id' => $post->id] )}}" class="btn btn-sm btn-warning">
                            <i class="fa fa-eye"></i><span>View</span>
                        </a>
                        <a href="{{ route('manage.posts.edit',  ['id' => $post->id] )}}" class="btn btn-sm btn-primary">
                            <i class="fa fa-edit"></i><span>Edit</span>
                        </a>
                        @can(['delete_posts'])
                            <a href="{{ route('manage.posts.destroy',  ['id' => $post->id] )}}" class="btn btn-sm btn-danger delete-paginate" data-id="{{ $post->id }}"
                                data-toggle="modal" 
                                data-target="#delete_modal"
                                onclick="event.preventDefault();">
                                <i class="fa fa-trash"></i><span>Delete</span>
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $posts->links() }}
        @else
            <p>No category found</p>
        @endif
    </div>
</div>
@endsection