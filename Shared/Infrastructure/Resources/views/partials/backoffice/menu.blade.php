<ul class="nav flex-column">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('backoffice.dashboard') }}">
            <svg class="bi"><use xlink:href="#house-fill"/></svg>
            Dashboard
        </a>
    </li>
    {{--@can('content_management_access')
        @can('category_access')--}}
            <li class="nav-item">
                <a href="{{ route('backoffice.categories.index') }}"
                   class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/categories') || request()->is('dashboard/categories/*') ? 'active' : '' }}">
                    <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                    Categories
                </a>
            </li>
        {{--@endcan
        @can('tag_access')--}}
            <li class="nav-item">
                <a href="{{ route('backoffice.tags.index') }}"
                   class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/tags') || request()->is('dashboard/tags/*') ? 'active' : '' }}">
                    <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                    Tags
                </a>
            </li>
        {{--@endcan
        @can('post_access')--}}
            <li class="nav-item">
                <a href="{{ route('backoffice.posts.index') }}"
                   class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/posts') || request()->is('dashboard/posts/*') ? 'active' : '' }}">
                    <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
                    Posts
                </a>
            </li>
        {{--@endcan
    @endcan--}}
</ul>

<hr class="my-3">

<ul class="nav flex-column mb-auto">
    {{-- @can('user_management_access') --}}
        <li class="nav-item">
            <span class="nav-link d-flex align-items-center gap-2">
                <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
                Settings
            </span>
        </li>
        {{-- @can('role_access') --}}
            <li class="nav-item">
                <a href="{{ route('backoffice.roles.index') }}"
                   class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/roles') || request()->is('dashboard/roles/*') ? 'active' : '' }}">
                    <svg class="bi"><use xlink:href="#people"/></svg>
                    Roles
                </a>
            </li>
        {{-- @endcan
        @can('user_access') --}}
            <li class="nav-item">
                <a href="{{ route('backoffice.users.index') }}"
                   class="nav-link d-flex align-items-center gap-2 {{ request()->is('dashboard/users') || request()->is('dashboard/users/*') ? 'active' : '' }}">
                    <svg class="bi"><use xlink:href="#people"/></svg>
                    Users
                </a>
            </li>
        {{-- @endcan
    @endcan --}}
</ul>

<ul class="nav flex-column mb-auto">
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#door-closed"/></svg>
            Log out
        </a>
    </li>
</ul>


