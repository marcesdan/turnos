@extends('layouts.app')
@section('content')
<div class="app-title">
  <div>
    <h1><i class="fa fa-edit text-primary"></i> Editar paciente</h1>
    <p>Modificación de pacientes en el sistema</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/paciente">Pacientes</a></li>
      <li class="breadcrumb-item"><a href="#">Editar paciente</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-6 offset-md-3">
    <form method="post" action="/paciente/{{$paciente->id}}">
      <div class="tile">
        <h3 class="tile-title">Datos del paciente</h3>
        <div class="tile-body">
          @csrf
          @method('PUT')
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Nombre</label>
              <input name="nombre" type="text" placeholder="Ingrese el o los nombres"
              class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}"
              value="{{ (old('nombre')) ? old('nombre') : $paciente->nombre }}"
              required autofocus autocomplete>
              @if ($errors->has('nombre'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('nombre') }}</strong>
                </span>
              @endif
            </div> <!-- form-group -->
            <div class="form-group col-md-6">
              <label class="control-label">Apellido</label>
              <input name="apellido" type="text" placeholder="Ingrese el o los apellidos"
              class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}"
              value="{{ (old('apellido')) ? old('apellido') : $paciente->apellido}}"
              required autocomplete>
              @if ($errors->has('apellido'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('apellido') }}</strong>
                  </span>
              @endif
            </div> <!-- form-group -->
          </div> <!-- form-row -->
          <div class="form-group">
            <label class="control-label">Documento</label>
            <input name="documento" type="number" placeholder="Ingrese el numero de documento del paciente"
                   class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}"
                   value="{{ (old('documento')) ? old('documento') : $paciente->documento}}"
                   required autocomplete>
            @if ($errors->has('documento'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('documento') }}</strong>
              </span>
            @endif
          </div> <!-- form-group -->
          <div class="form-row">
            <div class="form-group col-md-6">
              <label class="control-label">Email</label>
              <input name="email" type="email" placeholder="Ingrese la dirección email"
              class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
              value="{{ (old('email')) ? old('email') : $paciente->email }}"
              required autocomplete>
              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
            </div> <!-- form-group -->
            <div class="form-group col-md-6">
              <label class="control-label">Teléfono</label>
              <input name="telefono" type="tel" placeholder="Ingrese el teléfono del paciente"
                     class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                     value="{{ (old('telefono')) ? old('telefono') : $paciente->telefono }}"
                     required autocomplete>
              @if ($errors->has('telefono'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('telefono') }}</strong>
                </span>
              @endif
            </div> <!-- form-group -->
          </div> <!-- form-row -->
        </div> <!-- tile-body -->
        <div class="tile-footer text-center">
          <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="/paciente"><i class="fa fa-fw fa-lg fa-times-circle"></i>Volver</a>
        </div>
      </div> <!-- tile -->
    </form>
  </div> <!-- col -->
</div> <!-- row -->
@endsection
