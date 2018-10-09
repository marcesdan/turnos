<!DOCTYPE html>
<html>
  <head>
    @include('layouts.head')
    <title>Login</title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1>Turnos</h1>
      </div>
      <div class="login-box">
        @include('auth.login-form')
        @include('auth.passwords.email-form')
      </div>
    </section>
    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
