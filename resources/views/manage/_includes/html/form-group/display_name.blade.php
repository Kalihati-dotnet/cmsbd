<div class="form-group">
    @if(isset($f_label))
        <label for="{{$f_label['for']}}">{{__s($f_label["text"])}}</label>
    @endif
    <input id="display_name" type="text" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" name="display_name" value="@if(old('display_name')){{old('display_name')}}@elseif(__s($edit_val)){{$edit_val}}@endif">
        @if ($errors->has('display_name'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('display_name') }}</strong>
            </span>
        @endif
  </div>