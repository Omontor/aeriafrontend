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
            @can('game_access')
                <li class="{{ request()->is("admin/games") || request()->is("admin/games/*") ? "active" : "" }}">
                    <a href="{{ route("admin.games.index") }}">
                        <i class="fa-fw fas fa-gamepad">

                        </i>
                        <span>{{ trans('cruds.game.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('message_access')
                <li class="{{ request()->is("admin/messages") || request()->is("admin/messages/*") ? "active" : "" }}">
                    <a href="{{ route("admin.messages.index") }}">
                        <i class="fa-fw fas fa-comments">

                        </i>
                        <span>{{ trans('cruds.message.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('world_access')
                <li class="{{ request()->is("admin/worlds") || request()->is("admin/worlds/*") ? "active" : "" }}">
                    <a href="{{ route("admin.worlds.index") }}">
                        <i class="fa-fw fas fa-globe">

                        </i>
                        <span>{{ trans('cruds.world.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('level_access')
                <li class="{{ request()->is("admin/levels") || request()->is("admin/levels/*") ? "active" : "" }}">
                    <a href="{{ route("admin.levels.index") }}">
                        <i class="fa-fw fas fa-dice">

                        </i>
                        <span>{{ trans('cruds.level.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('analytic_access')
                <li class="{{ request()->is("admin/analytics") || request()->is("admin/analytics/*") ? "active" : "" }}">
                    <a href="{{ route("admin.analytics.index") }}">
                        <i class="fa-fw fas fa-chart-line">

                        </i>
                        <span>{{ trans('cruds.analytic.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('custom_key_access')
                <li class="{{ request()->is("admin/custom-keys") || request()->is("admin/custom-keys/*") ? "active" : "" }}">
                    <a href="{{ route("admin.custom-keys.index") }}">
                        <i class="fa-fw fab fa-keycdn">

                        </i>
                        <span>{{ trans('cruds.customKey.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
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
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

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