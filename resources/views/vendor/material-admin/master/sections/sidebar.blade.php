<aside id="sidebar" class="{{ isset($sidebar_classes) && $sidebar_classes ? $sidebar_classes : 'sidebar sidebar-alt c-overflow' }}">
    @hasSection('sidebar')
        @yield('sidebar')
    @else
        @if (Auth::check())
            <div class="s-profile">
                <a href="#" data-ma-action="profile-menu-toggle">
                    @if(Auth::user()->photo && Auth::user()->photo->original)
                        <div class="sp-pic">
                            <img src="{{ Auth::user()->photo->original->url }}" alt="{{ Auth::user()->name }}">
                        </div>
                    @endif

                    <div class="sp-info">
                        {{ Auth::user()->name }}<i class="zmdi zmdi-caret-down"></i>
                    </div>
                </a>

                <ul class="main-menu">
                    <li>
                        <a href="{{ route(sprintf('%s.logout', prefix_name())) }}"><i class="zmdi zmdi-sign-in zmdi-hc-rotate-180"></i> {{ trans('material-admin::auth.logout.logout') }}</a>
                    </li>
                </ul>
            </div>
        @endif

        <ul class="main-menu">
            @if(isset($sidebar))
                @foreach($sidebar as $group)
                    @include('material-admin::master.sections._submenu', [
                        'admin' => isset($group['admin']) && $group['admin'] === true,
                        'title' => $group['title'],
                        'resources' => $group['resources'],
                        'active' => is_active_sidebar_group($group)
                    ])
                @endforeach
            @endif
        </ul>
    @endif
</aside>