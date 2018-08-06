@if(isset($name) && isset($options))
<label for="{{ $name }}">{{ ucfirst($name) }}</label>
<select name="{{ $name }}" id="" class="form-control select-two">
    @foreach($options as $key=>$val)
        <option value="{{$key}}" @if($selected == $key) selected @endif >{{$val}}</option>
    @endforeach
</select>
@endif