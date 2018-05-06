@extends('manager.parent')

@section('title', 'Control Panel')

@section('header')
<section class="content-header">
  <h1>
    Control Panel
    <small>Over All</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('manager.dashboard') }}"><i class="fa fa-home"></i> Home Page</a></li>
    <li class="active">Control Panel</li>
  </ol>
</section>
@endsection

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
      <div class="inner">
        <h3>{{ $manager->projects->count() }}</h3>
        <p>Project</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-book"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
      <div class="inner">
        <?php

        $project_ids = [];
        foreach ($manager->projects as $project) {
            $project_ids[] = $project->id;
        }
        $count = App\Models\Task::whereIn('project_id', $project_ids)->count();

        ?>
        <h3>{{ $count }}</h3>
        <p>Task</p>
      </div>
      <div class="icon">
        <i class="ion ion-paperclip"></i>
      </div>
    </div>  
  </div>
  <div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-teal">
      <div class="inner">
        <h3>{{ App\Models\Employee::count() }}</h3>
        <p>Employee</p>
      </div>
      <div class="icon">
        <i class="ion ion-ios-people"></i>
      </div>
    </div>  
  </div>
  <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
{{--  <div class="row">
  <div class="col-md-4">
    <!-- USERS LIST -->
    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="box-title">Son Üyeler</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body no-padding">
        <ul class="users-list clearfix">
          <li>
            <img src="{{ admin_asset('img/user1-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Alexander Pierce</a>
            <span class="users-list-date">Today</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user8-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Norman</a>
            <span class="users-list-date">Yesterday</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user7-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Jane</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user6-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">John</a>
            <span class="users-list-date">12 Jan</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user3-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Alexander</a>
            <span class="users-list-date">13 Jan</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user5-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Sarah</a>
            <span class="users-list-date">14 Jan</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user4-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Nora</a>
            <span class="users-list-date">15 Jan</span>
          </li>
          <li>
            <img src="{{ admin_asset('img/user3-128x128.jpg') }}" alt="User Image">
            <a class="users-list-name" href="#">Nadia</a>
            <span class="users-list-date">15 Jan</span>
          </li>
        </ul>
        <!-- /.users-list -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer text-center">
        <a href="javascript:void(0)" class="uppercase">Tüm Üyeleri Görüntele</a>
      </div>
      <!-- /.box-footer -->
    </div>
    <!--/.box -->
  </div>
  <!-- /.col -->
</div>  --}}
<!-- /.row -->
@endsection

@section('scripts')
@endsection
