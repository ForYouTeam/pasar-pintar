<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{route('dashboard')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Menu</li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('hewan')}}">
          <i class="menu-icon mdi mdi-dog-side"></i>
          <span class="menu-title">Hewan</span>
        </a>
      </li>
      @hasrole('super-admin')
      <li class="nav-item">
        <a class="nav-link" href="{{route('profile')}}">
          <i class="menu-icon mdi mdi-account-edit"></i>
          <span class="menu-title">Profile</span>
        </a>
      </li>
      @endhasrole
      <li class="nav-item">
        <a class="nav-link" href="{{route('jenis')}}">
          <i class="menu-icon mdi mdi-book"></i>
          <span class="menu-title">Jenis</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('update')}}">
          <i class="menu-icon mdi mdi-cash"></i>
          <span class="menu-title">Discon</span>
        </a>
      </li>
      @hasrole('super-admin')
      <li class="nav-item nav-category">Akun</li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('akun')}}">
          <i class="menu-icon mdi mdi-account"></i>
          <span class="menu-title">Manage User</span>
        </a>
      </li>
      @endhasrole
    </ul>
  </nav>