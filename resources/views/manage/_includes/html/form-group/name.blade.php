<div class="form-group">
    @if(isset($f_label))
        <label for="{{$f_label['for']}}">{{__s($f_label["text"])}}</label>
    @endif
<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value ="@if(old('name')){{old('name')}}@elseif(__s($edit_val)){{$edit_val}}@endif" required>
    @if ($errors->has('name'))
        <span class="invalid-feedback">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>