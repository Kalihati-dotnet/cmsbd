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
            <i class="fa fa-edit"></i>
            <span>Edit Category</span>
        </h3>
    </div>  
    <div class="body-content">
        <div class="form-content-sm">
            <form action="{{ route('manage.categories.update', ['id'=>$category->id])}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="parent_id">Parent Category:</label>
                    <select name="parent_id" class="form-control select2-select"> 
                        @if(isset($category->parent)>0)
                            <option value="{{$category->parent->id}}" selected>{{$category->parent->name}}</option>
                        @endif
                            @include('manage._includes.form.categories')
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <input type="hidden" name="_method" value="PUT">
                    <input type="submit" name="submit" value="Update" class="btn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
