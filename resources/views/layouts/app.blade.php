<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('_includes._global.head')
    </head>
<body>
    <div id="bd__app">
        <header class="bd__header">
            <nav class="">
                @include('_includes._global.nav')
            </nav>
        </header>
        <div class="bd__navigator">
            {{-- <nav class="bd-nav">
                @if(isset($mainMenu))
                <ul>
                    @foreach($mainMenu as $mm)
                        <li><a href="{{ $mm['url'] }}" target="{{ $mm['target'] }}">{{ $mm['name'] }}</a></li>
                    @endforeach
                </ul>
                @endif
            </nav> --}}
        </div>
        <main class="bd__main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <div class="bd-main-sidebar">
                            @include('_includes._global.sidebar')
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="bd-main-content" id="bd__mc">
                            @yield('content')
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="bd-main-aside">
                            aside
                          
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="bd__footer">
            @include('_includes._global.footer')
        </footer>

    </div>
    @include('_includes._global.scripts')
    @include('_includes.messages')
</body>
</html>