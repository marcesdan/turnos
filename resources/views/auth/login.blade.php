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

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script type="text/javascript">
    $(function () {
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function () {
            $('.login-box').toggleClass('flipped');
            //return false;
        });
    });
</script>
</body>
</html>
