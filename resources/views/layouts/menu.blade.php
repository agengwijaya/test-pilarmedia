<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link {{ Request::is('dashboard') ? '' : 'collapsed' }}" href="{{ url('/') }}">
      <i class="bi bi-grid"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-item">
    <a class="nav-link {{ Request::is('oop') ? '' : 'collapsed' }}" href="{{ url('oop') }}">
      <i class="bi bi-grid"></i>
      <span>OOP</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-item">
    <a class="nav-link {{ Request::is('dropdown') ? '' : 'collapsed' }}" href="{{ url('dropdown') }}">
      <i class="bi bi-grid"></i>
      <span>Dropdown</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-item">
    <a class="nav-link {{ Request::is('sales') ? '' : 'collapsed' }}" href="{{ url('sales') }}">
      <i class="bi bi-grid"></i>
      <span>Sales</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-item">
    <a class="nav-link {{ Request::is('sales-person') ? '' : 'collapsed' }}" href="{{ url('sales-person') }}">
      <i class="bi bi-grid"></i>
      <span>Sales Person</span>
    </a>
  </li><!-- End Blank Page Nav -->

  <li class="nav-item">
    <a class="nav-link {{ Request::is('product') ? '' : 'collapsed' }}" href="{{ url('product') }}">
      <i class="bi bi-grid"></i>
      <span>Product</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>
