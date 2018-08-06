@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.categories.create') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-plus"></i>
        <span>Add New</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-list-alt"></i>
            <span>Categories</span>
        </h3>
    </div>  
    <div class="body-content">
        @if(isset($manageCategories) && is_object($manageCategories))
            @include('manage._includes.widgets.renderChildrenTreeList',[
                'treeParent' => $manageCategories,
                'treeName' => 'categories'
            ])
        @else
            <h1>No category exists.</h1>
        @endif
    </div>
</div>
@endsection
