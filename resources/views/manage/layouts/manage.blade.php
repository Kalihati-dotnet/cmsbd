<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    @include('manage._includes.tpl.head')
<body>
    <div class="nv__root">
        <div class="nv__header">
            @include('manage._includes.tpl.header')
        </div>
     
        <div class="nv__sidebar" id="nvSidebar">
            @include('manage._includes.tpl.sidebar')
        </div>
        <div class="nv__pageview">
            <div class="nv__breadcrumb">
                {{-- @include('manage._includes.widgets.breadcrumb') --}}
            </div>
            <div class="nv__content" role="main">
                 @yield('content')
            </div>
        </div>
        <div class="nv__footer">
            @include('manage._includes.tpl.footer')
        </div>
    </div>

    <div class="opacity-layer"></div>
    <div class="snackbar" style="display:none"></div>
    @include('manage._includes.messages')
    @include('manage._includes.tpl.scripts')
</body>
</html>