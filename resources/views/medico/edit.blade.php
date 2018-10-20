@extends('layouts.app')
@section('content')

<div class="app-title">
  <div>
    <h1><i class="fa fa-edit text-primary"></i> Editar médico</h1>
    <p>Modificación de médicos en el sistema</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/admin/medicos">Médicos</a></li>
      <li class="breadcrumb-item"><a href="#">Editar médico</a></li>
  </ul>
</div>
<div class="row">
  <div class="col-md-6 offset-md-3">
    <form method="post" action="/admin/medicos/{{$medico->id}}">
      <div class="tile">
        <h3 class="tile-title">Datos del médico</h3>
        <div class="tile-body">
            @csrf
            @method('PUT')
            <input type="hidden" value="{{$medico->user->id}}" name="user_id">
            <div class="form-row">
              <div class="form-group col-md-6">
                <laasdbel class="control-label">Nombre</laasdbel>
                <input name="nombre" type="text" placeholder="Ingrese el o los nombres"
                class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" 
                value="{{ (old('nombre')) ?: $medico->user->nombre }}"
                required autofocus autocomplete>
                @if ($errors->has('nombre'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif
              </div> <!--form-group -->
              <div class="form-group col-md-6">
                <label class="control-label">Apellido</label>

                <input name="apellido" type="text" placeholder="Ingrese el o los apellidos"
                class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" 
                value="{{ (old('apellido')) ?: $medico->user->apellido}}"
                required autocomplete>

                @if ($errors->has('apellido'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('apellido') }}</strong>
                    </span>
                @endif
              </div> <!--form-group -->
            </div> <!--form-row -->
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="control-label">Email</label>
                <input name="email" type="email" placeholder="Ingrese la dirección email"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                value="{{ (old('email')) ?: $medico->user->email }}"
                required autocomplete>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div> <!--form-group -->
              <div class="form-group col-md-6">
                <label class="control-label">Teléfono</label>
                <input name="telefono" type="tel" placeholder="Ingrese un número telefónico"
                class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" 
                value="{{ (old('telefono')) ?: $medico->user->telefono }}"
                required autocomplete>
                @if ($errors->has('telefono'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('telefono') }}</strong>
                    </span>
                @endif
              </div> <!--form-group -->
            </div> <!--form-row -->
            <div class="form-group {{ $errors->has('especialidad') ? ' is-invalid' : '' }}" id="form-group-especialidad">
              <label for="especialidad">Especialidad</label>

              <select class="form-control" id="especialidad" name="especialidad" required>
                  <option></option>
                  @foreach ($especialidades as $especialidad)
                      <option value="{{ $especialidad->nombre }}">{{ $especialidad->nombre }}</option>
                  @endforeach
                  <option value="{{ old('especialidad') ?: $medico->especialidad->nombre }}" selected>{{ $medico->especialidad->nombre }}</option>
              </select>

              <!--En caso de querer crear una nueva especialidad -->
              <input name="especialidad" id="nueva-especialidad" type="text" placeholder="Nueva especialidad"
              class="d-none form-control {{ $errors->has('especialidad') ? ' is-invalid' : '' }}"
              value="{{ old('especialidad') }}" disabled>
              @if ($errors->has('especialidad'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('especialidad') }}</strong>
                </span>
              @endif
              <!--"tipo toogle"-->
              <p class="semibold-text text-right mt-2">
                <a href="#" id="crear-nueva-especialidad">Crear nueva especialidad</a>
              </p>
            </div>
        </div> <!-- tile-body -->
        <div class="tile-footer text-center">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-fw fa-lg fa-check-circle"></i>Guardar
          </button>&nbsp;&nbsp;&nbsp;
          <a class="btn btn-secondary" href="/admin/medicos">
            <i class="fa fa-fw fa-lg fa-times-circle"></i>Volver
          </a>
        </div> <!-- tile-footer -->
      </div> <!-- tile -->
    </form>
  </div> <!-- col -->
</div> <!-- row -->
@endsection
