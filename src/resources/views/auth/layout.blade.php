<!doctype html>
<html lang="en">

<head>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	@yield('header')
	<!-- App favicon -->
	<link rel="shortcut icon" href="{{url("assets/images/favicon.ico")}}">

	@include('userpage/partials/css')
    @yield('style')

</head>

<body>

    {!! $content ?? "" !!}

    <!-- JAVASCRIPT -->
    @include('userpage/partials/javascript')
    @yield('javascript')

</body>

</html>