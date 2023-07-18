<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
      <a class="sidebar-brand brand-logo text-white" style="text-decoration: none" href="{{ url('dashboard') }}" >
        {{-- <img src="{{asset('inventory/assets/images/logo.svg')}}" alt="logo" /> --}}Inventory
    </a>
      <a class="sidebar-brand brand-logo-mini text-white" style="text-decoration: none" href="{{ url('dashboard') }}" title="Inventory">
        Inv
        {{-- <img src="{{asset('inventory/assets/images/logo-mini.svg')}}" alt="logo" /> --}}
    </a>
    </div>
    <ul class="nav">

      <li class="nav-item menu-items @if(request()->segment(1) == 'dashboard') active @endif">
        <a class="nav-link" href="{{ url('dashboard') }}">
          <span class="menu-icon">
            <i class="mdi mdi-speedometer"></i>
          </span>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item menu-items @if(request()->segment(1) == 'supplier') active @endif">
        <a class="nav-link" href="{{ url('supplier') }}">
          <span class="menu-icon">
            <i class="mdi mdi-airplane-landing"></i>
          </span>
          <span class="menu-title">Supplier</span>
        </a>
      </li>

      <li class="nav-item menu-items @if(request()->segment(1) == 'technician' || request()->segment(1) == 'technician_edit') active @endif">
        <a class="nav-link" href="{{ url('technician') }}">
          <span class="menu-icon">
            <i class="mdi mdi-account-multiple"></i>
          </span>
          <span class="menu-title">Technician</span>
        </a>
      </li>

      <li class="nav-item menu-items @if(request()->segment(1) == 'problemSetup') active @endif">
        {{-- <a class="nav-link" href="{{ route('problemSetup.index') }}"> --}}
        <a class="nav-link" href="{{ url('problemSetup') }}">
          <span class="menu-icon">
            <i class="mdi mdi-settings-box"></i>
          </span>
          <span class="menu-title">Problem Setup</span>
        </a>
      </li>

      <li class="nav-item menu-items @if(request()->segment(1) == 'products') active @endif">
        <a class="nav-link" href="{{ url('products') }}">
          <span class="menu-icon">
            <i class="mdi mdi-table-large"></i>
          </span>
          <span class="menu-title">Product</span>
        </a>
      </li>



      <li class="nav-item menu-items @if(request()->segment(1) == 'customers') active @endif">
        <a class="nav-link" href="{{ url('customers') }}">
          <span class="menu-icon">
            <i class="mdi mdi-account-multiple"></i>
          </span>
          <span class="menu-title">Customer</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" href="javascript:void(0)">
          <span class="menu-icon">
            <i class="mdi mdi-folder-account"></i>
          </span>
          <span class="menu-title">Account</span>
        </a>
      </li>

      <li class="nav-item menu-items">
        <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <span class="menu-icon">
            <i class="mdi mdi-chart-bar"></i>
          </span>
          <span class="menu-title">Report</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Invoice</a></li>
              <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Acknowledgement Receipt </a></li>
          </ul>
        </div>
      </li>

      {{-- <li class="nav-item menu-items">
        <a class="nav-link" href="javascript:void(0)">
          <span class="menu-icon">
            <i class="mdi mdi-chart-bar"></i>
          </span>
          <span class="menu-title">Invoice</span>
        </a>
      </li> --}}

      <li class="nav-item menu-items">
        <a class="nav-link" href="javascript:void(0)">
          <span class="menu-icon">
            <i class="mdi mdi-settings"></i>
          </span>
          <span class="menu-title">Settings</span>
        </a>
      </li>
    </ul>
  </nav>
