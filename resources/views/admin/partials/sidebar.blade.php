<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    <li class="{{ Request::segment(2) == 'home' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
            href="{{ url('/admin/home') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                data-i18n="Home">Home</span></a>
    </li>
    <li class="{{ Request::segment(2) == 'user' ? 'active' : '' }} nav-item"><a class="d-flex align-items-center"
            href="{{ url('/admin/user') }}"><i data-feather="home"></i><span class="menu-title text-truncate"
                data-i18n="Home">Customer</span></a>
    </li>

    <li
        class="{{ Request::segment(2) == 'work-order' || Request::segment(2) == 'service' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#"><i data-feather="layout">
            </i><span class="menu-title text-truncate" data-i18n="Page Layouts">Work Order</span></a>
        <ul class="menu-content">

            <li class="{{ Request::segment(2) == 'work-order' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('work-order.index') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Work Order List</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'work-order' && Request::segment(3) == 'create' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('work-order.create') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Work Order Create</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'service' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('service.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Collapsed Menu">Services</span></a>
            </li>
            {{-- <li class="{{ (Request::segment(2) == 'admin' )?'active':''}}">
      <a class="d-flex align-items-center" href="{{ route('admin.index') }}"><i data-feather="circle">
        </i><span class="menu-item text-truncate" data-i18n="Without Menu">Admin</span></a>
  </li> --}}
        </ul>
    </li>

    <li
        class="{{ Request::segment(2) == 'marketing-work-limit' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#"><i data-feather="layout">
            </i><span class="menu-title text-truncate" data-i18n="Page Layouts">Marketing Work Limit</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(2) == 'marketing-work-limit' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('marketingWorkLimit') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Collapsed Menu">Marketing Work Limit</span></a>
            </li>
        </ul>
    </li>

    <li class="{{ Request::segment(2) == 'report' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a
            class="d-flex align-items-center" href="#"><i data-feather="layout">
            </i><span class="menu-title text-truncate" data-i18n="Page Layouts">Report</span></a>
        <ul class="menu-content">

            <li class="{{ Request::segment(2) == 'report' && Request::segment(3) == 'create' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('report.create') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Add New Report</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'followup' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('followUp') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Followup/Reconnect</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'report' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('report.index') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">View Report</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'pending-list' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('pendingList') }}"><i data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Pending List</span></a>
            </li>
            <li
                class="{{ Request::segment(2) == 'marketing-report-analysis' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('marketingReportAnalysis') }}"><i
                        data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Marketing Report
                        Analysis</span></a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::segment(2) == 'customer-relation' ? 'has-sub sidebar-group-active open' : '' }} nav-item">
        <a class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                class="menu-title text-truncate" data-i18n="Page Layouts">CRM</span><span
                class="badge badge-light-danger badge-pill ml-auto mr-1">3</span></a>
        <ul class="menu-content">
            <li
                class="{{ Request::segment(2) == 'customer-relation' && Request::segment(3) == 'create' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('customer-relation.create') }}"><i
                        data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">Add New Issue</span></a>
            </li>
            <li class="{{ Request::segment(2) == '' && Request::segment(3) == 'view' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('customer-relation.index') }}"><i
                        data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">View All</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'crm-work-limit' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('customerWorkLimit') }}"><i
                        data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">CRM Work Limit</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'crm-work-analysis' && Request::segment(3) == '' ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('customerWorkAnalysis') }}"><i
                        data-feather="circle">
                    </i><span class="menu-item text-truncate" data-i18n="Layout Boxed">CRM Work Analysis</span></a>
            </li>
        </ul>
    </li>






    <li class="{{ Request::segment(2) == 'role' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a
            class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                class="menu-title text-truncate" data-i18n="Page Layouts">Access Control</span><span
                class="badge badge-light-danger badge-pill ml-auto mr-1">3</span></a>
        <ul class="menu-content">
            <li><a class="d-flex align-items-center" href="{{ route('permission.index') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate"
                        data-i18n="Collapsed Menu">Permission</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'role' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('role.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Layout Boxed">Role</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'admin' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('admin.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Without Menu">Admin</span></a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::segment(2) == 'env-dynamic' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a
            class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                class="menu-title text-truncate" data-i18n="Page Layouts">Settings</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(2) == 'env-dynamic' ? 'active' : '' }}"><a
                    class="d-flex align-items-center" href="{{ route('env-dynamic.index') }}"><i
                        data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Collapsed Menu">Env
                        Dynamic</span></a>
            </li>

        </ul>
    </li>
    <li class="{{ Request::segment(2) == 'district' ? 'has-sub sidebar-group-active open' : '' }} nav-item"><a
            class="d-flex align-items-center" href="#"><i data-feather="layout"></i><span
                class="menu-title text-truncate" data-i18n="Page Layouts">Location</span></a>
        <ul class="menu-content">
            <li class="{{ Request::segment(2) == 'division' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('division.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Collapsed Menu">Division</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'district' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('district.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Collapsed Menu">District</span></a>
            </li>
            <li class="{{ Request::segment(2) == 'upazila' ? 'active' : '' }}"><a class="d-flex align-items-center"
                    href="{{ route('upazila.index') }}"><i data-feather="circle"></i><span
                        class="menu-item text-truncate" data-i18n="Collapsed Menu">Upazila</span></a>
            </li>

        </ul>
    </li>
</ul>
