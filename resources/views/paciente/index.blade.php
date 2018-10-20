@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-heart text-primary"></i> Pacientes</h1>
      <p>Gestión de pacientes del sistema</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
        <li class="breadcrumb-item"><a href="#">Pacientes</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="table-responsive">
              <table id="tabla-paciente" class="table table-striped table-bordered table-sm" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Apellido</th>
                  <th>Nombre</th>
                  <th>Documento</th>
                  <th>Email</th>
                  <th>Telefono</th>
                  <th>Creado</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody> 
                @foreach ($pacientes as $paciente)
                <tr id="row{{$paciente->id}}">
                  <td>{{ $paciente->id }}</td>
                  <td>{{ $paciente->apellido }}</td>
                  <td>{{ $paciente->nombre }}</td>
                  <td>{{ $paciente->documento }}</td>
                  <td>{{ $paciente->email }}</td>
                  <td>{{ $paciente->telefono }}</td>
                  <td><span class="paciente-created-at" data-date="{{ $paciente->created_at }}"></span></td>
                  <td>
                    <div class="wrapper text-center">
                      <div class="btn-group btn-group-sm display-1">
                          <a href="/pacientes/{{ $paciente->id }}/turnos/nuevo" class="btn btn-primary"><i class="fa fa-calendar fa-lg"></i></a>
                        <a href="/pacientes/{{ $paciente->id }}/editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                        <a href="#" class="btn btn-primary" id="btn-paciente-delete"
                        data-info="{{$paciente->id}},{{$paciente->nombre}},{{$paciente->apellido}}">
                          <i class="fa fa-trash"></i>
                        </a>    
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              </table>
            </div> <!-- table-responsive -->
         </div> <!-- tile -->
      </div> <!-- col -->
  </div> <!-- row -->
@endsection

