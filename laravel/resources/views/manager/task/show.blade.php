@extends('admin.parent')

@section('title', $manager->name)

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    {{ $manager->name }}
    <small>You can show a project manager in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('admin.manager.index') }}">Project Managers</a>
    </li>
    <li class="active">{{ $manager->name }}</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-3">
    <!-- Horizontal Form -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Project Manager Details</h4>
        <div class="box-tools">
          <div class="btn-group">
            <a href="{{ route('admin.manager.edit', $manager->id) }}" class="btn btn-warning btn-sm">
              <i class="fa fa-pencil"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body no-padding">
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <th>Name</th>
              <td>{{ $manager->name }}</td>
            </tr>
            <tr>
              <th>Email</th>
              <td>{{ $manager->email }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection 
