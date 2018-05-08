@extends('admin.parent')

@section('title', 'Projects')

@section('styles')
@endsection

@section('header')
  <section class="content-header">
    <h1>
      Projects
      <small> Show all Projects in the system. </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home Page</a></li>
      <li class="active">Projects</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ count($projects) }} Project</h3>
          <div class="box-tools">
            <div class="btn-group">
              <a href="{{ route('admin.project.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-globe"></i></a>
              <a href="{{ route('admin.project.index', ['filter' => 1]) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
              <a href="{{ route('admin.project.index', ['filter' => -1]) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
              <a href="{{ route('admin.project.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
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
                <th>Completed</th>
                <th>Task Count</th>
                <th class="three-button">Process</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($projects as $project)
                <tr id="project-{{ $project->id }}">
                  <td>{{ $project->id }}</td>
                  <td>{{ $project->name }}</td>
                  <td>{{ $project->description }}</td>
                  <td>{{ date('d.m.Y', strtotime($project->started_at)) }}</td>
                  <td>{{ $project->completed }}</td>
                  <td>{{ $project->tasks()->count() }}</td>
                  <td>
                    <div class="btn-group">
                      <a class="edit btn btn-primary btn-xs" href="{{ route("admin.project.show", $project->id) }}" title="Show">
                        <i class="fa fa-search"></i>
                      </a>
                      <a class="edit btn btn-warning btn-xs" href="{{ route("admin.project.edit", $project->id) }}" title="Edit">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <button class="delete btn btn-danger btn-xs" delete-id="{{ $project->id }}" delete-name="{{ $project->name }}" title="Remove">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">There is no Project in the system.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{ $projects->links() }}
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  deleteItem("project", " will be removed the system?");
  completeItem("project",
      "admin",
      "will be completed?",
      "will not be completed?"
    );
  </script>
@endsection
