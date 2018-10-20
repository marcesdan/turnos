@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user-md text-primary text-primary"></i> Médicos</h1>
      <p>Gestión de médicos del sistema</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Médicos</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla-medico" class="table table-striped table-bordered table-sm" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Especialidad</th>
                <th>Creado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($medicos as $medico)
              <tr id="row{{$medico->id}}">
                <td>{{ $medico->id }}</td>
                <td>{{ $medico->user->apellido }}</td>
                <td>{{ $medico->user->nombre }}</td>
                <td>{{ $medico->user->email }}</td>
                <td>{{ $medico->user->telefono }}</td>
                <td>{{ $medico->especialidad->nombre }}</td>
                <td>
                <span class="medico-created-at" data-date="{{ $medico->user->created_at }}"></span>
                </td>
                <td>
                  <div class="wrapper text-center">
                    <div class="btn-group btn-group-sm display-1">
                      <a href="/admin/medicos/{{ $medico->id }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                      <a href="/admin/medicos/{{ $medico->id }}/editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="#" class="btn btn-primary btn-delete" id="btn-medico-delete"
                          data-info="{{$medico->id}},{{$medico->user->nombre}},{{$medico->user->apellido}}">
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
