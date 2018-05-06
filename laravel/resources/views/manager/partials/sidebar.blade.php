<section class="sidebar">
  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="{{ set_active('*manager/dashboard*') }}">
      <a href="{{ route('manager.dashboard') }}"><i class="fa fa-compass"></i> <span>Control Panel</span></a>
    </li>
    <li class="{{ set_active('*manager/project*') }}">
      <a href="{{ route('manager.project.index') }}"><i class="fa fa-book"></i> <span>Projects</span></a>
    </li>
    <li class="{{ set_active('*manager/task*') }}">
      <a href="{{ route('manager.task.index') }}"><i class="fa fa-tasks"></i> <span>Tasks</span></a>
    </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
