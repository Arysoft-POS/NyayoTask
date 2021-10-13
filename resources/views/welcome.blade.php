<!DOCTYPE HTML>
<html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<title>NYAYO</title>
		<meta charset="utf-8" />
        
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/welcomemain.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header-wrapper">
				
				</div>

			<!-- Banner -->
				<div id="banner-wrapper">
					<div id="banner" class="box container">
						<div class="row">
							<div class="7u 12u(medium)">
								<h2>NYAYO TASK.</h2>
								<p>Implementation of Payment API ( MPESA ) with basic functions.</p>
								<p>Framework : Laravel with Auth</p>
								<p></p>
								<p>Username: 001</p>
								<p>Password: 1234</p>
							</div>

							<div class="5u 12u(medium)">
								<ul>

                                @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
        
                        <li><a href="{{ url('/home') }}" class="button big icon fa-home">Home</a></li>
                    @else
                    <li><a href="{{ route('login') }}" class="button big icon fa-lock">Login</a></li>
                    
                    @endif
                </div>
            @endif

				
									
								</ul>
							</div>
						</div>
					</div>
				</div>

			

			<!-- Main -->
				

			<!-- Footer -->
				<div id="footer-wrapper">
					<footer id="footer" class="container">
						
						<div class="row">
							<div class="12u">
								<div id="copyright">
									<ul class="menu">
										<li>Design: <a href="">Aryton</a></li>
									</ul>
								</div>
							</div>
						</div>
					</footer>
				</div>

			</div>

		<!-- Scripts -->

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
