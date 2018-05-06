@extends('admin.parent')

@section('title', 'Employees')

@section('styles')
@endsection

@section('header')
  <section class="content-header">
    <h1>
      Employees
      <small> Show all Employees in the system. </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home Page</a></li>
      <li class="active">Employees</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ $employees->total() }} Employee</h3>
          <div class="box-tools">
            <div class="btn-group">
              <a href="{{ route('admin.blank') }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-globe"></i></a>
              <a href="{{ route('admin.employee.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
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
                <th>Task Count</th>
                <th class="two-button">Process</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($employees as $employee)
                <tr id="employee-{{ $employee->id }}">
                  <td>{{ $employee->id }}</td>
                  <td>{{ $employee->name }}</td>
                  <td>{{ $employee->tasks()->count() }}</td>
                  <td>
                    <div class="btn-group">
                      <a class="edit btn btn-warning btn-xs" href="{{ route("admin.employee.edit", $employee->id) }}" title="Edit">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <button class="delete btn btn-danger btn-xs" delete-id="{{ $employee->id }}" delete-name="{{ $employee->name }}" title="Remove">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">There is no Employee in the system.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{ $employees->links() }}
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  deleteItem("employee", " will be removed the system?");
  </script>
@endsection
