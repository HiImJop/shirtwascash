@extends('app')

@section('content')
<div class="auth">
	<a href="/"><img src="{{ asset('/img/shirtwascash_logo.png') }}"></a>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<input type="text" class="input" name="name" value="{{ old('name') }}" placeholder="username">
		<input type="email" class="input" name="email" value="{{ old('email') }}" placeholder="email">
		<input type="password" class="input" name="password" placeholder="password">
		<input type="password" class="input" name="password_confirmation" placeholder="confirm password">
		<button type="submit" class="submit">
			Register
		</button>
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
