@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.posts.index') }}{{ isPage(url()->previous()) }}" class="btn btn-warning btn-sm">
        <i class="fa fa-list"></i>
       <span>Return to List</span>
    </a>
    <a href="{{ route('manage.posts.edit',  ['id' => $post->id] )}}" class="btn btn-sm btn-primary">
        <i class="fa fa-edit"></i><span>Edit</span>
    </a>
    <a href="{{ route('manage.posts.create') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus"></i>
        <span>Add New</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3><i class="fa fa-newspaper-o"></i> Title: {{ $post->title }}</h3>
    </div>  
    <div class="body-content">
        <div>
            {!! $post->body !!}
        </div>
        <small>Written on {{ $post->created_at }}</small>
    </div>
</div>
@endsection