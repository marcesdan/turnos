@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-medkit text-primary text-primary"></i> Turnos confirmados</h1>
      <p>Listado de los turnos ya confirmados</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-medkit fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Turnos confirmados</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla-turnos-confirmados" class="table table-striped table-bordered" style="width:100%">
            <thead>
              <tr>
                <th class="d-none">ID</th>
                <th>Nombre</th>
                <th>Documento</th>
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

