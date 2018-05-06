@extends('manager.parent')

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
              <a href="{{ route('manager.project.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-globe"></i></a>
              <a href="{{ route('manager.project.index', ['filter' => 1]) }}" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a>
              <a href="{{ route('manager.project.index', ['filter' => -1]) }}" class="btn btn-danger btn-sm"><i class="fa fa-times"></i></a>
              <a href="{{ route('manager.project.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
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
                <th class="two-button">Process</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($projects as $project)
                <tr id="project-{{ $project->id }}">
                  <td>{{ $project->id }}</td>
                  <td>{{ $project->name }}</td>
                  <td>{{ $project->description }}</td>
                  <td>{{ date('d.m.Y', strtotime($project->started_at)) }}</td>
                  <td>
                    <div class="btn-group">
                     <button id="complete-project-{{ $project->id }}"
                      class="complete btn btn-default btn-xs @if($project->isCompleted()) hidden @endif"
                      complete-id="{{ $project->id }}" complete-name="{{ $project->name }}" is-complete="1"
                      title="Completed">
                      <i class="fa fa-square-o"></i>
                    </button>
                    <button id="uncomplete-project-{{ $project->id }}"
                      class="complete btn btn-success btn-xs @unless($project->isCompleted()) hidden @endunless"
                      complete-id="{{ $project->id }}" complete-name="{{ $project->name }}" is-complete="0"
                      title="Not Completed">
                      <i class="fa fa-check-square-o"></i>
                    </button>
                      <a class="edit btn btn-primary btn-xs" href="{{ route("manager.project.show", $project->id) }}" title="Show">
                        <i class="fa fa-search"></i>
                      </a>
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
  completeItem("project",
      "manager",
      "will be completed?",
      "will not be completed?"
    );
  </script>
@endsection
