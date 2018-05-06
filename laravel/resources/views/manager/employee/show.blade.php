@extends('manager.parent')

@section('title', $employee->name)

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    {{ $employee->name }}
    <small>You can show a employee in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('manager.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('manager.employee.index') }}">Employees</a>
    </li>
    <li class="active">{{ $employee->name }}</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Employee Details</h4>
        <div class="box-tools">
        </div>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body no-padding">
        <table class="table table-striped table-bordered">
          <tbody>
            <tr>
              <th>Name</th>
              <td>{{ $employee->name }}</td>
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
          <div class="row">
            <div class="col-md-10">
              {!! Form::select('task_id', $tasks, null, ['class' => 'select2 form-control'])
              !!}
            </div>
             <div class="col-md-1">
              <button id="add-task" employee-id="{{ $employee->id }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
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
          <tbody id="task-container">
            @forelse ($employee->tasks as $task)
            <tr id="task-{{ $task->id }}">
              <td>{{ $task->name }}</td>
              <td>{{ $task->description }}</td>
              <td>{{ date('d.m.Y', strtotime($task->started_at)) }}</td>
              <td>{{ $task->duration }} Days</td>
              <td>
                <button class="btn btn-danger btn-xs" onclick="deleteTask({{ $task->id }}, {{ $employee->id }})"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            @empty
            <tr>
              <th colspan="5">
                There is no task for this employee.
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
  // TASK ACTIONS
  $("#add-task").click(function () {
    var box = $("#task-box");
    var id = $(this).attr('employee-id');
    var task_id = $(box).find("select[name='task_id']").val();
    console.log(task_id);
    if (!task_id) {
      alert('Please, select a task!');
      return;
    }
    $(box).find(".overlay").show()
    $.ajax({
        method: "POST",
        url: "/manager/employee-task",
        data: {
          employee_id : id,
          task_id : task_id,
        }
      })
      .done(function (result) {
        console.log(result);
        $(box).find(".overlay").hide()
        $("#task-container").prepend(`
          <tr id="task-` + result.task_id + `">
            <td>` + result.task_name + `</td>
            <td>` + result.task_description + `</td>
            <td>` + result.task_started_at + `</td>
            <td>` + result.task_duration + ` Days</td>
            <td><button class='btn btn-danger btn-xs' onclick="deleteTask(` + result.task_id + `, ` + result.employee_id + `)"><i class='fa fa-trash'></i></button></td>
          </tr>
        `)
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  })

  function deleteTask(tid, eid) {
    var box = $("#task-box");
    $(box).find(".overlay").show()
    $.ajax({
        method: "DELETE",
        url: "/manager/employee-task",
        data: { task_id : tid, employee_id : eid}
      })
      .done(function (result) {
        $(box).find(".overlay").hide()
        $("#task-" + tid).remove()
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  }
</script>
@endsection
