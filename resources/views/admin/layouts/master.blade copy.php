<!DOCTYPE html>
<html lang="en">

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
  <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  @yield('style')
  @stack('css')
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  @include('admin.partials.topbar')
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">

    @include('admin.partials.sidebar')
  </aside>
  <main class="app-content">
    @yield('content')
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
  @yield('js')
  <!-- The javascript plugin to display page loading on top-->
  <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
  <script src="{{asset('printjs/jquery.printPage.js')}}" type="text/javascript"></script>
  {!! Toastr::message() !!}
  <!-- Google analytics script-->
  <script type="text/javascript">
    @if($errors->any())
    @foreach($errors->all() as $error)
    toastr.error('{{$error}}', 'Error', {
      closeButton: true,
      progressBar: true,
    });
    @endforeach
    @endif

    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
  @stack('script')
</body>

</html>