<form class="login-form" method="POST" action="{{ route('login') }}">
@csrf
<h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
  <div class="form-group">
    <label for="email" class="control-label">Email</label>

    <input id="email" name="email" type="email" 
    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
    value="{{ old('email') }}" 
    placeholder="Email" 
    required autofocus>

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div>

  <div class="form-group">
    <label for="password" class="control-label">Contraseña</label>

    <input id="password" name="password" type="password" 
    class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"  
    placeholder="Contraseña"
    required>

    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
  </div>

  <div class="form-group">
    <div class="utility">
      <div class="animated-checkbox">
        <label for="remember">
          <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <span class="label-text">Recordame</span>
        </label>
      </div>
      <p class="semibold-text mb-2"><a href="#" data-toggle="flip">Olvidaste tu contraseña?</a></p>
    </div>
  </div>

  <div class="form-group btn-container">
    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button>
  </div>
</form>