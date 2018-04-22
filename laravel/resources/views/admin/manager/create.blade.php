@extends('admin.parent')

@section('title', 'Add Project Manager')

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    Add Project Manager
    <small>You can add a project manager in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('admin.manager.index') }}">Project Managers</a>
    </li>
    <li class="active">Add Project Manager</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-danger">
      <!-- form start -->
      {!! Form::open(['method' => 'POST', 'route' => 'admin.manager.store', 'files' => true]) !!}
      <div class="box-body">
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Name *') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          {!! Form::label('email', 'Email *') !!}
          {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('email') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          {!! Form::label('password', 'Password *') !!}
          {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('password') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          {!! Form::label('password_confirmation', 'Confirm Password *') !!}
          {!! Form::password('password_confirmation', ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="btn-group pull-right">
          <a href="{{ route('admin.manager.index') }}" class="btn btn-danger">Back</a>
          {!! Form::submit("Add", ['class' => 'btn btn-success']) !!}
        </div>
      </div>
      <!-- /.box-footer -->
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection 

@section('scripts')
@endsection