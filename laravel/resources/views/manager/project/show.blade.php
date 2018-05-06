@extends('manager.parent')

@section('title', $project->name)

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    {{ $project->name }}
    <small>You can show a project in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('admin.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('admin.project.index') }}">Projects</a>
    </li>
    <li class="active">{{ $project->name }}</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Project Details</h4>
        <div class="box-tools">
          <div class="btn-group">
            <a href="{{ route('admin.project.edit', $project->id) }}" class="btn btn-warning btn-sm">
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
              <td>{{ $project->name }}</td>
            </tr>
            <tr>
              <th>Description</th>
              <td>{{ $project->description }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-danger" id="task-box">
      <div class="box-header with-border">
        <h4 class="box-title">Tasks</h4>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">  
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Started At</th>
              <th>Duration</th>
              <th>Process</th>
            </tr>
          </thead>
          <tbody id="manager-container">
            @forelse ($project->tasks as $task)
            <tr id="task-{{ $task->id }}">
              <td>{{ $task->name }}</td>
              <td>{{ $task->description }}</td>
              <td>{{ date('d.m.Y', strtotime($task->started_at)) }}</td>
              <td>{{ $task->duration }} Days</td>
              <td>
                <button class="btn btn-danger btn-xs" onclick="deleteTask({{ $task->id }}, {{ $project->id }})"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            @empty
            <tr>
              <th colspan="5">
                There is no task for this project.
              </th>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
@endsection 

@section('scripts')
<script>
  function deleteTask(tid, pid) {
    $.ajax({
        method: "DELETE",
        url: "/manager/project-task",
        data: { task_id : tid, project_id : pid}
      })
      .done(function (result) {
        $("#task-" + tid).remove()
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  }
</script>
@endsection
