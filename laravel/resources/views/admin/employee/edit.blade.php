@extends('admin.parent')

@section('title', 'Edit Employee')

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    Edit Employee
    <small>You can edit a employee in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('admin.employee.index') }}">Employees</a>
    </li>
    <li class="active">Edit Employee</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-danger">
      <!-- form start -->
      {!! Form::model($employee, [ 'method' => 'PUT', 'route' => ['admin.employee.update', $employee->id]]) !!}
      <div class="box-header with-border">
        <h3 class="box-title">Employee Details</h3>
      </div>
      <div class="box-body">
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Name *') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="btn-group pull-right">
          <a href="{{ route('admin.employee.index') }}" class="btn btn-danger">Back</a>
          {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
        </div>
      </div>
      <!-- /.box-footer -->
      {!! Form::close() !!}
    </div>
  </div>
@endsection 