@extends('manager.parent')

@section('title', 'Edit Task')

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    Edit Task
    <small>You can edit a task in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('manager.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('manager.task.index') }}">Tasks</a>
    </li>
    <li class="active">Edit Task</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-8">
    <!-- Horizontal Form -->
    <div class="box box-danger">
      <!-- form start -->
      {!! Form::model($task, [ 'method' => 'PUT', 'route' => ['manager.task.update', $task->id]]) !!}
      <div class="box-header with-border">
        <h3 class="box-title">Task Details</h3>
      </div>
      <div class="box-body">
        <div class="col-md-6 form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', 'Name *') !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('project_id') ? ' has-error' : '' }}">
            {!! Form::label('project_id', 'Which project does this task belong? *') !!}
            {!! Form::select('project_id', $projects, $task->project_id, ['class' => 'select2 form-control']) !!}
        </div>
        <div class="col-md-6 form-group{{ $errors->has('started_at') ? ' has-error' : '' }}">
          {!! Form::label('started_at', 'Started At *') !!}
          {!! Form::text('started_at', null, ['class' => 'form-control date-picker'])
          !!}
          <small class="text-danger">{{ $errors->first('started_at') }}</small>
        </div>
        <div class="col-md-6 form-group{{ $errors->has('duration') ? ' has-error' : '' }}">
          {!! Form::label('duration', 'Duration *') !!}
          {!! Form::number('duration', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('duration') }}</small>
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
          <a href="{{ route('manager.task.index') }}" class="btn btn-danger">Back</a>
          {!! Form::submit("Update", ['class' => 'btn btn-success']) !!}
        </div>
      </div>
      <!-- /.box-footer -->
      {!! Form::close() !!}
    </div>
  </div>
@endsection 