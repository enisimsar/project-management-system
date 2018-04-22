@extends('admin.parent')

@section('title', 'Köpekler')

@section('styles')
@endsection

@section('header')
  <section class="content-header">
    <h1>
      Köpekler
      <small> Sistemdeki bütün görüntüleyin </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Ana Sayfa</a></li>
      <li class="active">Köpekler</li>
    </ol>
  </section>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{ $managers->total() }} Project Manager</h3>
          <div class="box-tools">
            <div class="btn-group">
              <a href="{{ route('admin.blank') }}" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-globe"></i></a>
              <a href="{{ route('admin.manager.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
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
                <th class="three-button">İşlem</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($managers as $manager)
                <tr id="dog-{{ $manager->id }}">
                  <td>{{ $manager->id }}</td>
                  <td>{{ $manager->name }}</td>
                  <td>{{ $manager->email }}</td>
                  <td>
                    <div class="btn-group">
                      <a class="edit btn btn-primary btn-xs" href="{{ route("admin.manager.show", $manager->id) }}" title="Show">
                        <i class="fa fa-search"></i>
                      </a>
                      <a class="edit btn btn-warning btn-xs" href="{{ route("admin.manager.edit", $manager->id) }}" title="Edit">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <button class="delete btn btn-danger btn-xs" delete-id="{{ $manager->id }}" delete-name="{{ $manager->name }}" title="Remove">
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>

                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">There is no Project Manager in the system.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          {{ $managers->links() }}
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
  deleteItem("manager", " will be removed the system?");
  </script>
@endsection
