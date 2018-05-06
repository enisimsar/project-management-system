@extends('manager.parent')

@section('title', 'Empty')

@section('styles')
@endsection

@section('header')
  <section class="content-header">
    <h1>
      Page Header
      <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('manager.dashboard') }}"><i class="fa fa-home"></i> Anasayfa</a></li>
      <li class="active">Boş Sayfa</li>
    </ol>
  </section>
@endsection

@section('content')
  <h3>Sayfa İçeriği</h3>
@endsection

@section('scripts')
@endsection
