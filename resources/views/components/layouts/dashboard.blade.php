<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>abon.md</title>
  <link href="{{ asset('css/colorscheme.css') }}" rel="stylesheet">
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>
<body>
  <div class="dashboard-container">
    
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">Menu</div>
      <ul class="nav-menu">
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('books.index') }}" class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">My Books</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">Profile</a>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</a>
          </form>
        </li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <header class="header">
        <!-- <h1 class="header-title">{{ $header ?? 'Dashboard' }}</h1> -->
        <span class="user-email">{{ Auth::user()->email }}</span>
      </header>

      <main class="content">
        {{ $slot }}
      </main>
    </div>
  </div>
</body>
</html>