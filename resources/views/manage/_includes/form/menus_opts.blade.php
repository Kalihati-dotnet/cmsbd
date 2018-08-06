<option value="0">--none--</option>
<?php if(!isset($name)) $name = ''; ?>
@if(isset($manageMenus))
@foreach($manageMenus as $menu)
    @if(old($name) == $menu->id)
        <option value="{{$menu->id}}" selected>{{ $menu->name }}</option>
    @else
        <option value="{{ $menu->id }}"> {{ $menu->name }} </option>
    @endif
    @if(count($menu->children)>0)
        @include('manage._includes.form._inc.children_render',[
            'children' => $menu->children,
            'level'=>'-',
            'name'=>$name
        ])
    @endif
@endforeach
@endif
