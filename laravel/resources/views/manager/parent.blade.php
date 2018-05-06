<!DOCTYPE html>
<!--
  Developer: Enis Simsar
-->

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Project III For Manager</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- Meta-data -->
  <meta name="description" content="Project III Control Panel"/>
  <meta name="author" content="Enis Simsar" />

  <!-- Plugin styles, Bootstrap etc. -->
  <link rel="stylesheet" href="{{ admin_asset('css/plugins.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ admin_asset('css/AdminLTE.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ admin_asset('css/app.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic&amp;subset=latin-ext">

  @yield('styles')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Scripts -->
  <script>
      window.Laravel = <?php echo json_encode([
          'csrfToken' => csrf_token(),
      ]); ?>;
      window.AuthUser = {!! json_encode($authUser->toArray()) !!};
  </script>
</head>

<body class="hold-transition skin-ls sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('manager.dashboard') }}" class="logo" style="background-color:#EF6C00">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>P</b>III</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Project III</b></span>
    </a>
    <!-- Header Navbar -->
    @include('manager.partials.navbar')
    <!-- /.navbar -->
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    @include('manager.partials.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('header')
    <!-- Main content -->
    <section class="content container-fluid">
      @include('manager.partials.messages')
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    2018 &copy; Enis Simsar. Project III Control Panel. v1.0.1
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- Plugins - JQuery, Bootstrap etc. -->
<script src="{{ admin_asset('js/plugins.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ admin_asset('js/adminlte.min.js') }}"></script>
<!-- App -->
<script src="{{ admin_asset('js/app.min.js') }}"></script>

@yield('scripts')
</body>
</html>
