@extends('layouts.auth')
@section('content')
  <div class="login-box" style="min-height: 420px";>
    <form class="login-form" method="POST" action="/password/change">
        @csrf
        @method('PUT')
        <h4 class="login-head"><i class="fa fa-lg fa-fw fa-lock "></i>Cambiar contraseña</h4>
        <div class="form-group">
          <div class="form-group">
            <label for="password">Contraseña actual</label>
            <input id="password" type="password" name="password"
            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
            required>
            @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group">
            <label for="new_password">Contraseña nueva</label>
            <input id="new_password" type="password" class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" name="new_password" required>
            @if ($errors->has('new_password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('new_password') }}</strong>
                </span>
            @endif
          </div>
          <div class="form-group mb-3">
            <label for="new_password_confirm">Confirmación de contraseña</label>
            <input id="new_password_confirm" type="password" class="form-control" name="new_password_confirmation" required>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block">
                Cambiar contraseña
            </button>
          </div> 
    </form>
  </div>
@endsection

@section('scripts')
  @includeWhen(session('error'), 'auth.passwords.change-error')
@endsection

