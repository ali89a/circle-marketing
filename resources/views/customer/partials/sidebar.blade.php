<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
  <li class="{{ Request::segment(2) == 'home' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center" href="{{ url('/home') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Home">Home</span></a>
  </li>

  <li class="{{ Request::segment(2) == 'order' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="layout">
      </i><span class="menu-title text-truncate" data-i18n="Page Layouts">Work Order</span></a>
    <ul class="menu-content">

      <li class="{{ Request::segment(2) == 'order' && Request::segment(3) == '' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('customer.order.index') }}"><i data-feather="circle">
          </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Work Order List</span></a>
      </li>
      <li class="{{ Request::segment(2) == 'order' && Request::segment(3) == 'create' ? 'active' : '' }}">
        <a class="d-flex align-items-center" href="{{ route('customer.order.create') }}"><i data-feather="circle">
          </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Work Order Create</span></a>
      </li>
    </ul>
  </li>
</ul>