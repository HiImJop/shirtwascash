@extends('app')

@section('content')

<div class="auth">
	<a href="/"><img src="{{ asset('/img/shirtwascash_logo.png') }}"></a>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}" class="input">
		<input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="email">
		<input type="password" name="password" class="input"  placeholder="password">
		<button type="submit" class="submit">Login</button>
		<label class="remember_me"><input type="checkbox" name="remember"> Remember Me</label>
		<a class="forgot_password" href="{{ url('/password/email') }}">Forgot Your Password?</a>
	</form>

	@if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
	@endif
</div>
@endsection
