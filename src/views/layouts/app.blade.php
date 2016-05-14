<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Knock @yield('title')</title>
		<link href="{{asset('/css/font-awesome.min.css')}}" rel='stylesheet' type='text/css'>
		<link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
		<link href="{{asset('/css/jquery.dataTables.min.css')}}" rel="stylesheet">
		<link href="{{asset('/css/knock.css')}}" rel='stylesheet' type='text/css'>
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
		<link href="{{asset(Config::get('knock.knockfavicon'))}}" rel="shortcut icon"/>
      	
	</head>
	<body id="app-layout">
		<nav class="navbar navbar-default navbar-static-top">
			<div class="container">
				<div class="navbar-header">

					<!-- Collapsed Hamburger -->
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					@if(Auth::check())
					<!-- Branding Image -->
					<a class="navbar-brand" href="{{asset(Config::get('knock.apphomepage'))}}">
						<img src="{{asset(Config::get('knock.knocklogo'))}}" height="30px" alt="Home" />
					</a>
					@endif
					
					
				</div>

				<div class="collapse navbar-collapse" id="app-navbar-collapse">
					<!-- Left Side Of Navbar -->
					@if(Auth::check())
					<ul class="breadcrumb">
						@yield('breadcrumb')
					</ul>
					@endif

					<!-- Right Side Of Navbar -->
					<ul class="nav navbar-nav navbar-right">
						@if (!Auth::check())
						<li><a href="{{ asset('/login') }}"><i class="fa fa-btn fa-sign-in"></i>Sign in</a></li>
						@else
						
						@if(Auth::user())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-btn fa-gears"></i>Knock Settings</a>
							<ul class="dropdown-menu" role="menu">
								@if(Knock::hasRole('knock', 'permission-administrator'))
								<li><a href="{{ url('/knock/tags') }}"><i class="knock-tag-color fa fa-btn fa-tags"></i>Tags</a></li>
								@endif
								
								@if(Knock::hasRole('knock', 'user-administrator'))
								<li><a href="{{ asset('/users') }}"><i class="knock-user-color fa fa-btn fa-users"></i>Users</a></li>
								@endif
							</ul>
						</li>
						@endif
						
						<li class="dropdown">
							<a title="{{Auth::user()->email }}" href="#" class="dropdown-toggle wierd_one"  data-placement="top" data-toggle="dropdown" role="button" aria-expanded="false">
								<i class="fa fa-user"></i> <span class="caret"></span>
							</a>

							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ asset('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
							</ul>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">  
					@include('knock::errors.list')
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row" align="center">
				<div class="col-md-4 col-md-offset-4" align="center">
					@if(Session::has('flash_message'))
					<div class="alert alert-success" align="center">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true" align="center"></button>
						{{Session::get('flash_message')}}
					</div>
					@endif
				</div>
			</div>
		</div>

		<br>

		@include('knock::partials.jquery-js')	
		@include('knock::partials.bootstrap-js')	
		@include('knock::partials.datatables-js')	
		@include('knock::partials.knock-misc-js')


		@yield('content')
    
	</body>
</html>
