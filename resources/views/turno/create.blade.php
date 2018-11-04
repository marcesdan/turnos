@extends('layouts.app')
@section('content')

<div class="app-title">
  <div>
    <h1><i class="fa fa-plus-square text-primary"></i> Nuevo turno</h1>
    <p>Alta de turnos en el sistema</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="/pacientes">Pacientes</a></li>
      <li class="breadcrumb-item"><a href="#">Nuevo turno</a></li>
  </ul>
</div>
<div class="row-fluid">
  <form method="post" action="/pacientes/{{$paciente->id}}/turnos">
    <div class="tile">
      <h3 class="tile-title">Filtros de búsqueda</h3>
      <div class="tile-body">
        @csrf
        <input name="id" id="id" type="number" class="form-control" value="{{$paciente->id}}" hidden>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label class="control-label">Paciente</label>
            <input name="nombre" id="nombre" type="text" class="form-control" 
            value="{{$paciente->getFullNameAttribute()}}" disabled>
          </div> <!--form-group -->
          <div class="form-group col-md-4 {{ $errors->has('especialidad') ? ' is-invalid' : '' }}">
            <label for="especialidad">Especialidad</label>
            <select class="form-control" id="especialidad" name="especialidad" required>
              <option></option>
              @foreach ($especialidades as $especialidad)
                  <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
              @endforeach
              @if (old('especialidad'))
                  <option value="{{ old('especialidad') }}" selected> {{ old('especialidad') }} </option>
              @endif
            </select>
            @if ($errors->has('especialidad'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('especialidad') }}</strong>
              </span>
            @endif
          </div> <!-- form-group -->
          <div class="form-group col-md-4 {{ $errors->has('medico') ? ' is-invalid' : '' }}">
            <label for="medico">Médico</label>
            <select class="form-control" id="medico" name="medico" required>
              <option></option>
              @foreach ($medicos as $medico)
                <option value="{{ $medico->id}}">{{ $medico->user->getFullNameAttribute() }}</option>
              @endforeach
              @if (old('medico'))
                <option value="{{ old('medico') }}" selected> Usted ya ha elegido al médico </option>
              @endif
            </select>
            @if ($errors->has('medico'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('medico') }}</strong>
              </span>
            @endif
          </div> <!-- form-group -->
        </div> <!--form-row -->
      </div> <!-- tile-body -->
      <hr>
      <div id="calendar-create"></div>
      <div class="tile-footer text-right">
        <a class="btn btn-secondary" href="/pacientes">
          <i class="fa fa-fw fa-lg fa-times-circle"></i>Volver
        </a>
      </div>
    </div> <!-- tile -->
  </form>
</div> <!-- row-fluid -->
@endsection
@section('scripts')
@endsection
