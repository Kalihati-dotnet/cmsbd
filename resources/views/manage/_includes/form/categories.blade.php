<option value="0">--none--</option>
<?php if(!isset($name)) $name = ''; ?>
@if(isset($manageCategories))
@foreach($manageCategories as $category)
    @if(old($name) == $category->id)
        <option value="{{$category->id}}" selected>{{ $category->name }}</option>
    @else
        <option value="{{ $category->id }}"> {{ $category->name }} </option>
    @endif
    @if(count($category->children)>0)
        @include('manage._includes.form._inc.children_render',[
            'children' => $category->children,
            'level'=>'-',
            'name'=>$name
        ])
    @endif
@endforeach
@endif
