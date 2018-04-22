<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account Menu -->
      <li class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <!-- The user image in the navbar-->
          <img src="{{ admin_asset('img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">{{ $authUser->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- The user image in the menu -->
          <li class="user-header">
            <img src="{{ admin_asset('img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">

            <p>
              {{ $authUser->name }}
              <small>{{ $authUser->email }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="#" class="btn btn-default btn-flat">Profil</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('/admin/logout') }}" class="btn btn-default btn-flat"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i> Çıkış Yap
              </a>
              <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>

            </div>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
