@extends('layouts.app')
@section('content')
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user text-primary text-primary"></i> Usuarios</h1>
      <p>Gestión de usuarios del sistema</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Usuarios</a></li>
    </ul>
  </div> <!-- app-title -->
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla-user-index" class="table table-striped table-bordered table-sm" style="width:100%">
            <thead>
              <tr>
                <th>#</th>
                <th>Apellido</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Rol</th>
                <th>Creado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr id="row{{$user->id}}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->nombre }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->role->nombre }}</td>
                <td>
                <span class="user-created-at" data-date="{{ $user->created_at }}"></span>
                </td>
                <td>
                  <div class="wrapper text-center">
                    <div class="btn-group btn-group-sm display-1">
                      <a href="/admin/usuarios/{{ $user->id }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                      <a href="/admin/usuarios/{{ $user->id }}/editar" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                      <a href="#" class="btn btn-primary btn-delete" id="btn-user-delete"
                          data-info="{{$user->id}},{{$user->nombre}},{{$user->apellido}}">
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
