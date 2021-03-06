<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>

        <li class="{{ request()->is("admin/notifications") || request()->is("admin/notifications/*") ? "active" : "" }}">
            <a href="{{ route("admin.notifications.index") }}">
                <i class="fa-fw fas fa-bell">

                </i>
                <span>Notifications</span>

            </a>
        </li>           
       



            @can('game_access')
    

<li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-dice">

                        </i>
                        <span>Game Mangement</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
        
                            <li class="{{ request()->is("admin/games") || request()->is("admin/games/*") ? "active" : "" }}">
                    <a href="{{ route("admin.games.index") }}">
                                    <i class="fa-fw fas fa-gamepad">

                                    </i>
                                    <span>Games</span>

                                </a>
                            </li>  

                            <li class="{{ request()->is("admin/worlds") || request()->is("admin/worlds/*") ? "active" : "" }}">
                    <a href="{{ route("admin.worlds.index") }}">
                                    <i class="fa-fw fas fa-gamepad">

                                    </i>
                                    <span>Worlds</span>

                                </a>
                            </li>                             

                            <li class="{{ request()->is("admin/levelinterfaces") || request()->is("admin/levelinterfaces/*") ? "active" : "" }}">
                    <a href="{{ route("admin.levelinterfaces.index") }}">
                                    <i class="fa-fw fas fa-gamepad">

                                    </i>
                                    <span>Level Interfaces</span>

                                </a>
                            </li> 


                            <li class="{{ request()->is("admin/levels") || request()->is("admin/levels/*") ? "active" : "" }}">
                    <a href="{{ route("admin.levels.index") }}">
                                    <i class="fa-fw fas fa-gamepad">

                                    </i>
                                    <span>Levels</span>

                                </a>
                            </li>

                    </ul>
                </li>


<li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>System Mangement</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
        


                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.analytics.index") }}">
                                    <i class="fa-fw fas fa-puzzle-piece">

                                    </i>
                                    <span>Analytics</span>

                                </a>
                            </li>

                    </ul>
                </li>




            @endcan
           
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>Admin Management</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')

 <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
            <a href="{{ route("admin.users.index") }}">
                <i class="fa-fw fas fa-user">

                </i>
                <span>Admins</span>

            </a>
        </li>        
                        
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan



                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>