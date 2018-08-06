<optgroup label="" class="level-">
    @foreach($children as $child)
        @if(old($name) == $child->id)
            <option value="{{$child->id}}" selected>{{ $child->name }}</option>
        @else
            <option value="{{ $child->id }}"><i>{{$level}}</i>{{ $child->name }}  </option>
        @endif
        @if(count($child->children))
            @include('manage._includes.form._inc.children_render',['children' => $child->children,'level'=>$level .='-'])
        @endif
    @endforeach
</optgroup>