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
            <i class="fa fa-plus"></i>
            <span>Add Category</span>
        </h3>
    </div>  
    <div class="body-content">
        <div class="form-content-sm">
            <form action="{{ route('manage.categories.store')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="parent_id">Parent Category:</label>
                    <select name="parent_id" class="form-control select2-select"> 
                        @include('manage._includes.form.categories', ['name'=>'parent_id'])
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Submit" class="btn">
                </div>
            </form>
        </div>
    </div> 
</div>
@endsection
