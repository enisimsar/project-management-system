@extends('manager.parent')

@section('title', $task->name)

@section('styles')
@endsection 

@section('header')
<section class="content-header">
  <h1>
    {{ $task->name }}
    <small>You can show a task in this page.</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{ route('manager.dashboard') }}">
        <i class="fa fa-home"></i> Home Page</a>
    </li>
    <li>
      <a href="{{ route('manager.task.index') }}">Tasks</a>
    </li>
    <li class="active">{{ $task->name }}</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Task Details</h4>
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
              <td>{{ $task->name }}</td>
            </tr>
            <tr>
              <th>Project</th>
              <td>{{ $task->project->name }}
                <a class="pull-right btn btn-primary btn-xs" href="{{ route("manager.project.show", $task->project_id) }}" title="Project">
                  <i class="fa fa-external-link"></i>
                </a>
              </td>
            </tr>
            <tr>
              <th>Description</th>
              <td>{{ $task->description }}</td>
            </tr>
            <tr>
              <th>Started At</th>
              <td>{{ date('d.m.Y', strtotime($task->started_at)) }}</td>
            </tr>
            <tr>
              <th>Duration</th>
              <td>{{ $task->duration }} Days</td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-danger" id="employee-box">
      <div class="box-header with-border">
        <h4 class="box-title">Employees</h4>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
          <div class="row">
            <div class="col-md-10">
              {!! Form::select('employee_id', $employees, null, ['class' => 'select2 form-control'])
              !!}
            </div>
             <div class="col-md-1">
              <button id="add-employee" task-id="{{ $task->id }}" class="btn btn-success btn-sm">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Process</th>
            </tr>
          </thead>
          <tbody id="employee-container">
            @forelse ($task->employees as $employee)
            <tr id="employee-{{ $employee->id }}">
              <td>{{ $employee->name }}</td>
              <td>
                <button class="btn btn-danger btn-xs" onclick="deleteEmployee({{ $employee->id }}, {{ $task->id }})"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            @empty
            <tr>
              <th colspan="2">
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
  $("#add-employee").click(function () {
    var box = $("#employee-box");
    var id = $(this).attr('task-id');
    var employee_id = $(box).find("select[name='employee_id']").val();
    console.log(employee_id);
    if (!employee_id) {
      alert('Please, select an employee!');
      return;
    }
    $(box).find(".overlay").show()
    $.ajax({
        method: "POST",
        url: "/manager/employee-task",
        data: {
          task_id : id,
          employee_id : employee_id,
        }
      })
      .done(function (result) {
        console.log(result);
        $(box).find(".overlay").hide()
        $("#employee-container").prepend(`
          <tr id="employee-` + result.employee_id + `">
            <td>` + result.employee_name + `</td>
            <td><button class='btn btn-danger btn-xs' onclick="deleteEmployee(` + result.employee_id + `, ` + result.task_id + `)"><i class='fa fa-trash'></i></button></td>
          </tr>
        `)
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  })

  function deleteEmployee(eid, tid) {
    var box = $("#employee-box");
    $(box).find(".overlay").show()
    $.ajax({
        method: "DELETE",
        url: "/manager/employee-task",
        data: { task_id : tid, employee_id : eid}
      })
      .done(function (result) {
        $(box).find(".overlay").hide()
        $("#employee-" + eid).remove()
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  }
</script>
@endsection
