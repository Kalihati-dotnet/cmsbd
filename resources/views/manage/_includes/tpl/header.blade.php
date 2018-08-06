@auth
<header class="header-wrapper __fixed-top">
 <div class="header-grid">
        <div class="h-left">
            <a href="#nvSidebar" id="btn_sidebar" class="sr-btn">
                <i class="fa fa-bars"></i>
            </a>
            <a href="/manage/dashboard" class="nv-logo-text">AdminManage</a>
        </div>
            <div class="h-right">
                <ul class="manage-utils">
                    <li>
                        <span id="time"></span>
                    </li>
                    <li>
                    <span id="date">{{ date("D M j") }}</span>
                    </li>
                </ul>
            <nav class="navbar-manage"> 
            {{--  <span class="label label-counter"></span>  --}}
              <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle __flash-notify" data-toggle="dropdown" role="button" aria-expanded="false">
                        <i class="fa fa-envelope fa-fw"></i>
                        <span class="label label-info">5</span>
                    </a>
                    <div class="dropdown-menu" role="menu">
                        <h1>Message</h1>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::guard('manage')->user()->username }} <span class="fa fa-caret-down"></span>
                    </a>
    
                    <ul class="dropdown-menu" role="menu">
                        
                        <li><a href="/manage/dashboard">Dashboard</a></li>
                        <li>
                            <a href="{{ route('manage.logout') }}" 
                                onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();"> 
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('manage.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
              </ul>
            </nav>
        </div>
 </div>	
</header>

@endauth