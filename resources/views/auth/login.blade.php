@extends('layouts.auth')
@section('styles')
<style type="text/css">
	.login-content .login-box {
		min-height: 400px;
	}
</style>
@endsection
@section('content')
    <div class="login-box">
        @include('auth.login-form')
        @include('auth.passwords.email-form')
    </div>
@endsection
