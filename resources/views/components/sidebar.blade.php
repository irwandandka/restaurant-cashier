<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">Cashier.IO</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
          <li class="menu-header">Dashboard</li>
          <li class="nav-item">
            @if (Auth::user()->role === 'owner')
            <a class="nav-link" href="{{ route('owner.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            @else
            <a class="nav-link" href="{{ route('cashier.dashboard') }}"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            @endif
          </li>
          <li class="menu-header">Tabel</li>
          <li class="nav-item {{ request()->routeIs('category.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('category.index') }}"><i class="fa-solid fa-bars"></i><span>Kategori Makanan</span></a>
          </li>
          <li class="nav-item {{ request()->routeIs('food.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('food.index') }}"><i class="fa-solid fa-burger"></i><span>Makanan</span></a>
          </li>
          <li class="nav-item {{ request()->routeIs('table.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('table.index') }}"><i class="fa-solid fa-table"></i><span>Meja</span></a>
          </li>
          @if (Auth::user()->role === 'owner')
          <li class="nav-item {{ request()->routeIs('setting.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('setting.index') }}"><i class="fa-solid fa-gear"></i><span>Setting</span></a>
          </li>
          <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i><span>User</span></a>
          </li>
          @else
          <li class="nav-item {{ request()->routeIs('order') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('order') }}"><i class="fa-solid fa-utensils"></i>Order Makanan</span></a>
          </li>
          @endif
          <li class="nav-item {{ request()->routeIs('transaction.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaction.index') }}"><i class="fa-solid fa-utensils"></i>Transaksi</span></a>
          </li>
        </ul>
    </aside>
  </div>