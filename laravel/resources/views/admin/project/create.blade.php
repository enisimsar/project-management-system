@extends('admin.parent')

@section('title', 'Add Project')

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    Add Project
    <small>You can add a project in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('admin.project.index') }}">Projects</a>
    </li>
    <li class="active">Add Project</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-danger">
      <!-- form start -->
      {!! Form::open(['method' => 'POST', 'route' => 'admin.project.store', 'files' => true]) !!}
      <div class="box-body">
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Name *') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('started_at') ? ' has-error' : '' }}">
          {!! Form::label('started_at', 'Started At *') !!}
          {!! Form::text('started_at', null, ['class' => 'form-control date-picker'])
          !!}
          <small class="text-danger">{{ $errors->first('started_at') }}</small>
        </div>
        <div class="col-md-12 form-group{{ $errors->has('description') ? ' has-error' : '' }}">
          {!! Form::label('description', 'Description *') !!}
          {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('description ') }}</small>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="btn-group pull-right">
          <a href="{{ route('admin.project.index') }}" class="btn btn-danger">Back</a>
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