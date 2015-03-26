<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title></title>
    <script src="{{ asset('/js/vendor/modernizr.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/foundation.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/jquery-ui.css') }}" />
    <link rel="stylesheet" href="{{ asset('/css/spectrum.css') }}" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="stylesheet/less" type="text/css" href="{{ asset('style.less') }} ">
    <script src="{{ asset('/js/less-1.6.2.min.js') }}"></script>
  </head>
  <body>




	@yield('content')

	<!-- Scripts -->
    <script src="{{ asset('/js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/js/html2canvas.js') }}"></script>
    <script src="{{ asset('/js/spectrum.js') }}"></script>
    <script src="{{ asset('/js/jquery.filedrop.js') }}"></script>
    <script src="{{ asset('/js/dropperredux.js') }}"></script>
    <script src="{{ asset('/js/jquery.leanModal.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script>
    </script>
  </body>
</html>
