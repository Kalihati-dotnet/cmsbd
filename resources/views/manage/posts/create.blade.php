@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.posts.index') }}" class="btn btn-primary btn-sm">
        <i class="fa fa-list-alt"></i>
        <span> Return to List</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
    </div>
    <div class="body-content">
        <div class="bd-form-md">
            <form action="{{ route('manage.posts.store') }}" method="POST">
                    {{ csrf_field() }}
                <div class="form-stuf">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" id="post_title" name="title" class="form-control" value="{{ old('title') }}">
                            </div>
                            <div class="form-group">
                                <span>{{url('/')}}</span><span>/post/</span>
                                <input type="text" id="editable-slug" name="slug" value="{{ old('slug') }}" readonly>
                                <span id="edit-slug-button">
                                    <button type="button" class="btn hide-if-no-js">Edit</button>
                                </span>
                            </div>
                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="text-editor" cols="30" rows="10" class="form-control richTextBox">{{ old('body') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="excerpt">Excerpt:</label>
                                <textarea name="excerpt" cols="30" rows="3" class="form-control">{{ old('excerpt') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags:</label>
                                <select name="tags[]" id="" class="form-control select-two" multiple>
                                    @foreach($manageTags as $key=>$val)
                                        <option value="{{ $key }}"
                                            @if(old('tags'))
                                                @foreach(old('tags') as $otag)
                                                    @if($otag == $key)
                                                    selected 
                                                    @endif
                                                @endforeach
                                            @endif
                                            >{{ $val }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col-md-4">
                            <div id="submitdiv" class="asidebox">
                                <h2>Publish</h2>
                                <div class="inside">
                                    <div class="form-group">
                                       <input type="submit" name="submitDraft" value="Save Draft" class="btn">
                                       <input type="submit" name="submitPublish" value="Publish" class="btn btn-primary">
                                    </div>
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="comment" {{ old('comment') ? 'checked' : '' }}>Comments Off
                                            </label>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="category">Parent Category:</label>
                                <select name="category" class="form-control select2-select"> 
                                    @include('manage._includes.form.categories', ['name'=>'category'])
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{asset('manage/js/vendor/tinymce.min.js')}}"></script>
<script>
    tinymce.init({
      menubar: false,
      selector:'textarea.richTextBox',
      skin: 'custom',
      height: 400,
      resize: 'vertical',
      plugins: 'link, image, code, table, textcolor, lists', // youtube, giphy
      extended_valid_elements : 'input[id|name|value|type|class|style|required|placeholder|autocomplete|onclick]',
      file_browser_callback: function(field_name, url, type, win) {
              if(type =='image'){
                $('#upload_file').trigger('click');
              }
          },
      toolbar: 'styleselect bold italic underline | forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image table | code', //youtube giphy
      convert_urls: false,
      image_caption: true,
      image_title: true,
    });
</script>
@endsection
@section('bottom')
<script src="{{ asset('manage/js/vendor/slug.js') }}"></script>
<script>
  slug.defaults.mode ='rfc3986';
  $('#post_title').bind('keyup change', function(){
    let pt = $('#post_title').val();
    $('#editable-slug').val(slug(pt));
  });
$('#edit-slug-button button').bind('click', function(){
    $('#editable-slug').removeAttr('readonly');
});
</script>
@endsection