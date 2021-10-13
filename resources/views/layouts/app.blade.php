<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>NYAYO:: @yield('title')</title>

    <!-- Favicon icon -->
   <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
   <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

   <!-- Google font-->
   <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,700" rel="stylesheet">

   <!-- themify -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/themify-icons/themify-icons.css') }}">

   <!-- iconfont -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/icofont/css/icofont.css') }}">

   <!-- simple line icon -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/simple-line-icons/css/simple-line-icons.css') }}">

   <!-- Required Fremwork -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">

   <!-- Chartlist chart css -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/chartist/dist/chartist.css') }}" type="text/css" media="all">

   <!-- Weather css -->
   <link href="{{ asset('assets/css/svg-weather.css') }}" rel="stylesheet">


   <!-- Style.css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">

   <!-- Little changes.css -->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/littlechanges.css') }}">
 
   <!-- Responsive.css-->
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body class="sidebar-mini fixed">
    
   <div class="loader-bg">
      <div class="loader-bar">
          Loading...
      </div>
   </div>
   


    
    @yield('content')



     <!-- Warning Section Starts -->
   <!-- Older IE warning message -->
   <!--[if lt IE 9]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
          <div class="iew-container">
              <ul class="iew-download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="assets/images/browser/chrome.png" alt="Chrome">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="assets/images/browser/firefox.png" alt="Firefox">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="assets/images/browser/opera.png" alt="Opera">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="assets/images/browser/safari.png" alt="Safari">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="assets/images/browser/ie.png" alt="">
                          <div>IE (9 & above)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
      <![endif]-->
   <!-- Warning Section Ends -->

   <!-- Required Jqurey -->
   <script src="{{ asset('assets/plugins/Jquery/dist/jquery.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/tether/dist/js/tether.min.js') }}"></script>

   <!-- Required Fremwork -->
   <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

   <!-- Scrollbar JS-->
   <script src="{{ asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
   <script src="{{ asset('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>

   <!--classic JS-->
   <script src="{{ asset('assets/plugins/classie/classie.js') }}"></script>

   <!-- notification -->
   <script src="{{ asset('assets/plugins/notification/js/bootstrap-growl.min.js') }}"></script>

   <!-- Sparkline charts -->
   <script src="{{ asset('assets/plugins/jquery-sparkline/dist/jquery.sparkline.js') }}"></script>

   <!-- Counter js  -->
   <script src="{{ asset('assets/plugins/waypoints/jquery.waypoints.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/countdown/js/jquery.counterup.js') }}"></script>

   <!-- Echart js -->
   <script src="{{ asset('assets/plugins/charts/echarts/js/echarts-all.js') }}"></script>

   <script src="{{ asset('assets/js/highcharts.js') }}"></script>
   <script src="{{ asset('assets/js/modules/exporting.js') }}"></script>
   <script src="{{ asset('assets/js/highcharts-3d.js') }}"></script>

   <!-- custom js -->
   <script type="text/javascript" src="{{ asset('assets/js/main.min.js') }}"></script>
   <script type="text/javascript" src="{{ asset('assets/pages/dashboard.js') }}"></script>
   <script type="text/javascript" src="{{ asset('assets/pages/elements.js') }}"></script>
   <script src="{{ asset('assets/js/menu.min.js') }}"></script>
<script>
var $window = $(window);
var nav = $('.fixed-button');
$window.scroll(function(){
    if ($window.scrollTop() >= 200) {
       nav.addClass('active');
    }
    else {
       nav.removeClass('active');
    }
});
</script>

</body>

</html>
