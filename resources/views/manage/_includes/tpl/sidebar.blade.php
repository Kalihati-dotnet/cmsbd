@auth
<div class="sidebar-wrapper">
    <div class="sidebar-ctrl">
        <button id="btnExpandSidebar">
            <i class="fa fa-arrows-h"></i>
        </button>
        <span class="sr-btn-sidebar">
            <i class="fa fa-arrow-left"></i>
        </span>
    </div>
    <div class="scrollbar">
        <nav class="x_nav">
            <ul class="nav" id="x_navmenu">
                <li><a href="{{ route('manage.dashboard') }}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
                
                <li><a href="#"><i class="fa fa-th"></i><span>Categories</span></a>
                    <ul class="level-2">
                        @can(['add_categories'])
                            <li><a href="{{ route('manage.categories.create') }}"><span>Add New</span></a></li>
                        @endcan
                        @can(['browse_categories'])
                            <li><a href="{{ route('manage.categories.index') }}"><span>All Categories</span></a></li>
                        @endcan
                    </ul>
                </li>

                <li><a href="#"><i class="fa fa-bars"></i><span>Menus</span><i class="fa fa-level-up"></i></a>
                    <ul class="level-2">
                        @can(['add_menus'])
                            <li><a href="{{ route('manage.menus.create') }}"><span>Add New</span></a></li>
                        @endcan
                        @can(['browse_menus'])
                            <li><a href="{{ route('manage.menus.index') }}"><span>All Menus</span></a></li>
                        @endcan
                    </ul>
                </li>
                
                <li><a href="#"><i class="fa fa-newspaper-o"></i><span>Posts</span></a>
                    <ul class="level-2">
                        @can(['add_posts'])
                            <li><a href="{{ route('manage.posts.create') }}"><span>Add New</span></a></li>
                        @endcan
                        @can(['browse_posts'])
                            <li><a href="{{ route('manage.posts.index') }}"><span>All Posts</span></a></li>
                        @endcan
                    </ul>
                </li>
               
                @can(['browse_users','read_users'])
                    <li><a href="{{ route('manage.users.index') }}"><i class="fa fa-user"></i><span>Users</span></a>
                        <ul class="level-2">
                            @can(['add_users'])
                                <li><a href="{{ route('manage.users.create') }}"><span>Add New</span></a></li>
                            @endcan
                            @can(['browse_users'])
                                <li><a href="{{ route('manage.users.index') }}"><span>All Users</span></a></li>
                            @endcan
                            @can(['browse_roles','read_roles'])
                                <li><a href="{{ route('manage.roles.index') }}"><i class="fa fa-user"></i><span>Roles</span></a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                

            </ul>
        </nav>
    </div>
</div>
@endauth