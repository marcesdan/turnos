@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-medkit text-primary text-primary"></i> Turnos</h1>
      <p>Gestión de turnos del sistema</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-medkit fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Turnos</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
        <div class="tile">
          <div id="calendar"></div>
         </div> <!-- tile -->
      </div> <!-- col -->
  </div> <!-- row -->
  @include('turno.planificar-modal')
@endsection
@section('scripts')
@endsection

