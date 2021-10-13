<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Nyayo:Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('css/welcome.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">


  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style>
   
  </style>

  <script>
    
$(function(){
  $('.hide-show').show();
  $('.hide-show span').addClass('show')
  
  $('.hide-show span').click(function(){
    if( $(this).hasClass('show') ) {
      $(this).text('Hide');
      $('input[name="login[password]"]').attr('type','text');
      $(this).removeClass('show');
    } else {
       $(this).text('Show');
       $('input[name="login[password]"]').attr('type','password');
       $(this).addClass('show');
    }
  });
  
  $('form button[type="submit"]').on('click', function(){
    $('.hide-show span').text('Show').addClass('show');
    $('.hide-show').parent().find('input[name="login[password]"]').attr('type','password');
  }); 
});
  </script>
</head>
<body class="hold-transition login-page">
<div class="login_form">
  
  <setion class="login-wrapper">
  @include('pages.components.ifmessage')
    <div class="logo">
    <a href="{{ url('/') }}" class="logo"><img class="img-fluid able-logo" src="{{ asset('assets/images/logow.png') }}" alt="Theme-logo"></a>
    </div>
    
    @error('phone')
        <span class="invalid-feedback text-danger" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror

    <form method="POST" id="login" action="{{ route('login') }}">
                @csrf

      <input  required name="phone" type="number" autocapitalize="off" autocorrect="off" placeholder="Phone e.g 0712345678"/>


      <input class="password" required name="password" type="password" placeholder="Password"/>

    
      <button class="button" type="submit">Login</button>
    </form>
    
  </section>
  <a href="{{ url('login') }}" class="login_form">Register</a>
</div>
</body>
</html>
