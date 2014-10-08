<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    @section('head')
        {{ HTML::style('css/main.css'); }}
        {{ HTML::style('css/flashmessage.css'); }}
    @show
</head>
<body>
		@if (Session::has('message'))
			<div class="message {{ Session::get('messageclass') }}">
				<h1>{{ Session::get('messagetitle') }}</h1>
				<p>{{ Session::get('message') }}</p>
			</div>
		@endif
	<div id='wrapper'>
    	@yield('body')
    </div>
</body>

@section('scripts')
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>
		$(document).ready(function(){
			// $('.error').slideDown(500);
			$('.error').animate({
				"marginTop" : "+=115px"
			});
			$('.success').animate({
				"marginTop" : "+=115px"
			});
		});
	</script>
@show
</html>