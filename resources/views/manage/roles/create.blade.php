@extends('manage.layouts.manage')
@section('content')
<div class="page-nav">
    <a href="{{ route('manage.roles.index') }}{{ isPage(url()->previous()) }}" class="btn btn-warning btn-sm">
        <i class="fa fa-list-alt"></i>
        <span> All Roles</span>
    </a>
</div>
<div class="page-body">
    <div class="body-heading">
        <h3>
            <i class="fa fa-lock"></i>
            <span>Add Role</span>
        </h3>
    </div>  
    <div class="body-content">
        <form class="form-role-new" role="form" action="{{ route('manage.roles.store') }}" accept-charset="UTF-8" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-stuf">
                <div class="row">
                    <div class="col-md-8">
                        @include('manage._includes.html.form-group.name', ['f_label'=>['for'=>'name','text'=>'Name [Alphabets only]']])
                        @include('manage._includes.html.form-group.display_name', 
                                [
                                    'f_label'=>
                                    [
                                        'for'=>'display_name',
                                        'text'=>'Display Name'
                                    ]
                                ])
                    </div>
                    <div class="col-md-4">
                        <div id="submitdiv" class="asidebox">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <h3>{{ __('generic.permissions') }}</h3>
                            <a href="#" class="permission-select-all">{{ __('generic.select_all') }}</a> / <a href="#"  class="permission-deselect-all">{{ __('generic.deselect_all') }}</a>
                            <ul class="permissions checkbox">
                                @foreach($permissions as $table => $permission)
                                    <li>
                                        <input type="checkbox" id="{{$table}}" class="permission-group">
                                        <label for="{{$table}}"><strong>{{title_case(str_replace('_',' ', $table))}}</strong></label>
                                        <ul>
                                            @foreach($permission as $perm)
                                                <li>
                                                    <input type="checkbox" id="permission-{{$perm->id}}" name="permissions[]" class="the-permission" value="{{$perm->id}}" >
                                                    <label for="permission-{{$perm->id}}">{{title_case(str_replace('_', ' ', $perm->key))}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('bottom')
<script>
    $('document').ready(function () {
        $('.permission-group').on('change', function(){
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
        });
        $('.permission-select-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
            return false;
        });
        $('.permission-deselect-all').on('click', function(){
            $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
            return false;
        });
        function parentChecked(){
            $('.permission-group').each(function(){
                var allChecked = true;
                $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                    if(!this.checked) allChecked = false;
                });
                $(this).prop('checked', allChecked);
            });
        }
        parentChecked();
        $('.the-permission').on('change', function(){
            parentChecked();
        });
    });
</script>
@endsection