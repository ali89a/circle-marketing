<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
  <li class="{{ (Request::segment(2) == 'home' )?'active':''}} nav-item"><a class="d-flex align-items-center" href="{{ url('/admin/home') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a>
  </li>
  <li class="{{ (Request::segment(2) == 'user' )?'active':''}} nav-item"><a class="d-flex align-items-center" href="{{ url('/admin/user') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Customer</span></a>
  </li>

  <li class="{{ (Request::segment(2) == 'role' )?'has-sub sidebar-group-active open':''}} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Work Order</span></a>
    <ul class="menu-content">
    
      <li class="{{ (Request::segment(2) == 'role' )?'active':''}}"><a class="d-flex align-items-center" href="{{ route('role.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Role</span></a>
      </li>
      <li class="{{ (Request::segment(2) == 'admin' )?'active':''}}"><a class="d-flex align-items-center" href="{{ route('admin.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Admin</span></a>
      </li>
    </ul>
  </li>
  <li class="{{ (Request::segment(2) == 'role' )?'has-sub sidebar-group-active open':''}} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span class="menu-title text-truncate" data-i18n="Page Layouts">Access Control</span><span class="badge badge-light-danger badge-pill ml-auto mr-1">2</span></a>
    <ul class="menu-content">
      <li><a class="d-flex align-items-center" href="{{ route('permission.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Permission</span></a>
      </li>
      <li class="{{ (Request::segment(2) == 'role' )?'active':''}}"><a class="d-flex align-items-center" href="{{ route('role.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Role</span></a>
      </li>
      <li class="{{ (Request::segment(2) == 'admin' )?'active':''}}"><a class="d-flex align-items-center" href="{{ route('admin.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Without Menu">Admin</span></a>
      </li>
    </ul>
  </li>
</ul>