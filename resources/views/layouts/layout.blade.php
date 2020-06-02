<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  @include('layouts.components.head')
</head>

<body class="fixed sidebar-mini sidebar-mini-expand-feature skin-blue-light" style="height: auto; min-height: 100%;">
  <div class="wrapper">

    <header class="main-header">
      @include('layouts.components.header')
    </header>
    <aside class="main-sidebar">
      {{-- BEGIN SIDEBAR  --}}
      @include('layouts.components.sidebar')
      {{-- END SIDEBAR  --}}
    </aside>

    {{-- BEGIN CONTENT WRAPPER  --}}
    <div class="content-wrapper">

      {{-- BEGIN CONTENT --}}
      <section class="content">
        @yield('content')
      </section>
      {{-- END CONTENT --}}
    </div>
    {{-- END CONTENT WRAPPER  --}}

    <footer class="main-footer">
      @include('layouts.components.footer')
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  {{-- END CONTENT WRAPPER --}}
</body>
@include('layouts.components.scripts')

</html>