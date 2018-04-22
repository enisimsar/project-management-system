<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="{{ set_active('*admin/dashboard*') }}">
      <a href="{{ route('admin.dashboard') }}"><i class="fa fa-compass"></i> <span>Control Panel</span></a>
    </li>
    <li class="{{ set_active('*admin/manager*') }}">
      <a href="{{ route('admin.manager.index') }}"><i class="fa fa-paw"></i> <span>Project Managers</span></a>
    </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
