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
  <div class="col-md-3">
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
  <div class="col-md-5">
    <!-- Horizontal Form -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">Tasks</h4>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <div class="box-body">
        <h4>Türkçe</h4>
        <h4>İngilizce</h4>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <!-- Horizontal Form -->
    <div class="box box-danger" id="manager-box">
      <div class="box-header with-border">
        <h3 class="box-title">Project Manager</h3>
        <div class="box-tools">
          <div class="btn-group">
          </div>
        </div>
      </div>
      <!-- form start -->
      <div class="box-body">
          <div class="row">
            <div class="col-md-11">
              {!! Form::select('manager_id', $managers, null, ['class' => 'select2 form-control'])
              !!}
            </div>
            <div class="col-md-1">
              <button id="add-manager" project-id="{{ $project->id }}" class="btn btn-success btn-sm">
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
          <tbody id="manager-container">
            @forelse ($project->project_managers as $manager)
            <tr id="manager-{{ $manager->id }}">
              <td>{{ $manager->name }}</td>
              <td>
                <button class="btn btn-danger btn-xs" onclick="deleteManager({{ $manager->id }}, {{ $project->id }})"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            @empty
            <tr>
              <th colspan="5">
                There is no project manager for this project.
              </th>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
      </div>
      <!-- /.box-footer -->
    </div>
  </div>
  <!-- /.box -->
</div>
@endsection 

@section('scripts')
<script>
  // MANGER ACTIONS
  $("#add-manager").click(function () {
    var box = $("#manager-box");
    var id = $(this).attr('project-id');
    var manager_id = $(box).find("select[name='manager_id']").val();
    console.log(manager_id);
    if (!manager_id) {
      alert('Please, select a project manager!');
      return;
    }
    $(box).find(".overlay").show()
    $.ajax({
        method: "POST",
        url: "/admin/manager-project",
        data: {
          project_id : id,
          manager_id : manager_id,
        }
      })
      .done(function (result) {
        console.log(result);
        $(box).find(".overlay").hide()
        $("#manager-container").prepend(`
          <tr id="manager-` + result.manager_id + `">
            <td>` + result.manager_name + `</td>
            <td><button class='btn btn-danger btn-xs' onclick="deleteManager(` + result.manager_id + `, ` + result.project_id + `)"><i class='fa fa-trash'></i></button></td>
          </tr>
        `)
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  })

  function deleteManager(mid, pid) {
    var box = $("#manager-box");
    $(box).find(".overlay").show()
    $.ajax({
        method: "DELETE",
        url: "/admin/manager-project",
        data: { manager_id : mid, project_id : pid}
      })
      .done(function (result) {
        $(box).find(".overlay").hide()
        $("#manager-" + mid).remove()
      }).fail(function (xhr, ajaxOptions, thrownError) {
        ajaxError(xhr, ajaxOptions, thrownError);
      });
  }
</script>
@endsection
