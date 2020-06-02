<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>{{ $title ?? 'Sistema Pocitos' }}</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- FONTS --}}
{{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
<link href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
{{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

{{-- STYLES --}}
<link href="{{ asset('plugins/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin-lte/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin-lte/dist/css/skins/skin-blue-light.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{-- PLUGINS --}}
<link href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2/dist/css/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" rel="stylesheet">
{{-- HEADS ADICIONALES PARA CADA PÁGINA --}}
@yield('css')