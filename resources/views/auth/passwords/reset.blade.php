@extends('layouts.auth')
@section('content')
  <div class="login-box" style="min-height: 410px";>
    <form class="login-form" method="POST" action="{{ route('password.update') }}" >
        @csrf
        <h4 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Restablecer contraseña</h4>
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
          <label for="email">Email</label>
              <input id="email" type="email" name="email"
              class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  
              value="{{ $email ?? old('email') }}" 
              required autofocus autocomplete>

              @if ($errors->has('email'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
          <div class="form-group">
          <label for="password">Contraseña</label>
              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

              @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
              @endif
          </div>
          <div class="form-group mb-3">
            <label for="password-confirm">Confirmación de contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block">
                Restablacer contraseña
            </button>
          </div> 
    </form>
  </div>
@endsection