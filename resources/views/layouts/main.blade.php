<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Foxic HTML Template - Blog</title>
  <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" />
  <!-- Vendor CSS -->
  <link href="{{ asset('css/vendor/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/vendor/vendor.min.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <!-- Custom font -->
  <link href="{{ asset('fonts/icomoon/icons.css') }}" rel="stylesheet">
  <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Open%20Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    @include('layout.commoncssfunctions')
</head>

<body class="has-smround-btns has-loader-bg equal-height has-sm-container">
 
@include('layouts.navbar')

  @yield('contentt')

@include('layouts.footer')

@include('layout.customnotification')
  
@include('layout.commonjsfunctions')
  <script src="{{ asset('js/vendor-special/lazysizes.min.js')}}"></script>
  <script src="{{ asset('js/vendor-special/ls.bgset.min.js')}}"></script>
  <script src="{{ asset('js/vendor-special/ls.aspectratio.min.js')}}"></script>
  <script src="{{ asset('js/vendor-special/jquery.min.js')}}"></script>
  <script src="{{ asset('js/vendor-special/jquery.ez-plus.js')}}"></script>
  <script src="{{ asset('js/vendor/vendor.min.js')}}"></script>
  <script src="{{ asset('js/app-html.js')}}"></script>
</body>

</html>