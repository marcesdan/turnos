@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-medkit text-primary text-primary"></i> Turnos sin confirmar</h1>
      <p>Listado de los turnos próximos a ser confirmados</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-medkit fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Turnos sin confirmar</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla-turnos-sin-confirmar" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="d-none">ID</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidad</th>
                <th>Hora</th>
                <th>Acciones</th>
              </tr>
            </thead>
          </table>
        </div> <!-- table-responsive -->
      </div> <!-- tile -->
    </div> <!-- col -->
  </div> <!-- row -->
@endsection

