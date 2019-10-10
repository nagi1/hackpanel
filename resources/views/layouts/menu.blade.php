














<li class="{{ Request::is('apps*') ? 'active' : '' }}">
    <a href="{!! route('apps.index') !!}"><i class="fa fa-edit"></i><span>Apps</span></a>
</li>

<li class="{{ Request::is('keys*') ? 'active' : '' }}">
    <a href="{!! route('keys.index') !!}"><i class="fa fa-edit"></i><span>Keys</span></a>
</li>

<li class="{{ Request::is('plans*') ? 'active' : '' }}">
    <a href="{!! route('plans.index') !!}"><i class="fa fa-edit"></i><span>Plans</span></a>
</li>

<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>

<li class="{{ Request::is('users*') ? 'active' : '' }}">
    <a href="{!! route('users.index') !!}"><i class="fa fa-edit"></i><span>Users</span></a>
</li>

