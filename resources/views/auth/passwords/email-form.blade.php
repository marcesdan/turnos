<form class="forget-form" method="POST" action="{{ route('password.email') }}">
  @csrf
  <h5 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Olvidaste tu contraseña ?</h3>
  <div class="form-group">
    <label for="email" class="control-label">Email</label>

    <input id="email" type="email" name="email" 
    class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
    value="{{ old('email') }}" 
    required autofocus="">

    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
    
  </div>
  <div class="form-group btn-container">
    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Restablecer</button>
  </div>
  <div class="form-group mt-3">
    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Volver al login</a></p>
  </div>
</form>