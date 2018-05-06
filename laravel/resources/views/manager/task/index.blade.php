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
                <th>Email</th>
                <th class="three-button">Process</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($tasks as $task)
                <tr id="task-{{ $task->id }}">
                  <td>{{ $task->id }}</td>
                  <td>{{ $task->name }}</td>
                  <td>{{ $task->email }}</td>
                  <td>
                    <div class="btn-group">
                      <a class="edit btn btn-primary btn-xs" href="{{ route("manager.task.show", $task->id) }}" title="Show">
                        <i class="fa fa-search"></i>
                      </a>
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
  </script>
@endsection
