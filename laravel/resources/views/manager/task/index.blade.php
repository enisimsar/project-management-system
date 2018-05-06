@extends('manager.parent')

@section('title', 'Tasks')

@section('styles')
@endsection

@section('header')
  <section class="content-header">
    <h1>
      Tasks
      <small> Show all tasks in the system </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home Page</a></li>
      <li class="active">Tasks</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ $tasks->total() }} Tasks</h3>
          <div class="box-tools">
            <div class="btn-group">
              <a href="{{ route('manager.blank') }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-globe"></i></a>
              <a href="{{ route('manager.task.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-striped table-hover table-bordered table-condensed">
            <thead>
              <tr>
                <th class="id-column">ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Started At</th>
                <th>Duration</th>
                <th class="three-button">Process</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tasks as $task)
                <tr id="task-{{ $task->id }}">
                  <td>{{ $task->id }}</td>
                  <td>{{ $task->name }}</td>
                  <td>{{ $task->description }}</td>
                  <td>{{ date('d.m.Y', strtotime($task->started_at)) }}</td>
                  <td>{{ $task->duration }} Days</td>
                  <td>
                    <div class="btn-group">
                    <div class="btn-group">
                     <button id="complete-task-{{ $task->id }}"
                      class="complete btn btn-default btn-xs @if($task->isCompleted()) hidden @endif"
                      complete-id="{{ $task->id }}" complete-name="{{ $task->name }}" is-complete="1"
                      title="Completed">
                      <i class="fa fa-square-o"></i>
                    </button>
                    <button id="uncomplete-task-{{ $task->id }}"
                      class="complete btn btn-success btn-xs @unless($task->isCompleted()) hidden @endunless"
                      complete-id="{{ $task->id }}" complete-name="{{ $task->name }}" is-complete="0"
                      title="Not Completed">
                      <i class="fa fa-check-square-o"></i>
                    </button>
                      <a class="edit btn btn-warning btn-xs" href="{{ route("manager.task.edit", $task->id) }}" title="Edit">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <button class="delete btn btn-danger btn-xs" delete-id="{{ $task->id }}" delete-name="{{ $task->name }}" title="Remove">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">There is no Task in the system.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{ $tasks->links() }}
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  deleteItem("task", " will be removed the system?");
  completeItem("task",
      "manager",
      "will be completed?",
      "will not be completed?"
    );
  </script>
@endsection
