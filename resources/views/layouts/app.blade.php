<!DOCTYPE html>
<html>
<head>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('fav/apple-icon-57x57.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('fav/apple-icon-60x60.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('fav/apple-icon-72x72.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('fav/apple-icon-76x76.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('fav/apple-icon-114x114.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('fav/apple-icon-120x120.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('fav/apple-icon-144x144.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('fav/apple-icon-152x152.png?v=11') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('fav/apple-icon-180x180.png?v=11') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('fav/android-icon-192x192.png?v=11') }}">
    {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('fav/fav-32x32.png?v=11') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('fav/fav-96x96.png?v=11') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('fav/fav-16x16.png?v=11') }}"> --}}
    <link rel="manifest" href="{{ asset('fav/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png?v=11">

    <title>PT. ABC ERP</title>
    <meta name="keywords" content="MBSS ERP" />
    <meta name="description" content="MBSS ERP" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- select2 -->
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom css -->
    <link rel="stylesheet" href="{{ asset('css/kuiper.css?v=1166') }}">
    <link rel="stylesheet" href="{{ asset('css/nav.css?v=1166') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile.css?v=1166') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css?v=1166') }}">
</head>
<body>
	<!-- Menu -->
	@include('layouts.navbar')

	<section id="content" class="font-inter">
		{{ $slot }}
	</section>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- select2 -->
	<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>

	<!-- select2 -->
	<link rel="stylesheet" href="http://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

	<!-- custom scripts -->
	<script src="{{ asset('js/functions.js?v=334') }}"></script>

	<!-- Scripts for ALL pages -->
	<script type="text/javascript">
		$(document).ready(function() {

			// general scripts
			kuiperUi();
			kuiperTableFilters();

			// select2
			$('.initiate-select2').select2({width: '100%',});

		});
	</script>
	@yield('script')
</body>
</html>