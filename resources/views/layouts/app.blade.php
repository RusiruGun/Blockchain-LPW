<!DOCTYPE html>
<html lang="en">
<head>
<title>LANKA PLYWOOD OMS</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<link rel="stylesheet" href="css/popup.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="css/footable.bootstrap.min.css">
<link rel="stylesheet" href="css/media.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/black-tie/jquery-ui.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="js/footable.min.js"></script>
<style type="text/css">
.footable-filtering {
	display:none;
}
.hidden-print {
    display: none !important;
  }
</style>
</head>
<body class="container-fluid" style="padding-top: 70px;">
	<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
	
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
		</button>
	
      <a class="navbar-brand">
	  <img src="https://lankaplywood.lk/wp-content/uploads/2018/05/Lanka-Plywood-Logo.png" style="height:20px;">
	  </a>
    </div>
	
	<div class="collapse navbar-collapse" id="myNavbar">
	
		<!--menu-->
		<ul class="nav navbar-nav text-uppercase">
			<li><a href="NewOrder"> <span class="glyphicon glyphicon-file"></span> MAKE ORDER</a></li>
			<li><a href="Order"> <span class="glyphicon glyphicon-shopping-cart"></span> ORDERS</a></li>
			<li><a href="Cur"> <span class="glyphicon glyphicon-transfer"></span> CURRENT ORDERS</a></li> 
			<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-list"></span> Report</a>
				<ul class="dropdown-menu">
					
						<li><a class="dropdown-item" href="ReportCity"> <span class="glyphicon glyphicon-stats"></span> By City</a></li>
						<li><a class="dropdown-item" href="ReportCuslist"> <span class="glyphicon glyphicon-user"></span> By Customer</a></li>
						<li><a class="dropdown-item" href="ReportState"> <span class="glyphicon glyphicon-time"></span> By date</a></li>
			   </ul>
		  </li>
		</ul>
		
		<ul class="nav navbar-nav navbar-right">

			{{-- Log Section --}}

			<ul class="nav navbar-nav navbar-right">
					@guest
					<li><a href="login"> <span class="glyphicon glyphicon-on"></span> Login</a></li>     
						@else
						<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-cog"></span> SYSTEM <span class="caret"></span></a>
							<ul class="dropdown-menu">
							<li><a href="help.php"> <span class="glyphicon glyphicon-question-sign"></span> HELP</a></li>
									<li><a class="dropdown-item" href="{{ route('logout') }}"
											onclick="event.preventDefault();
														document.getElementById('logout-form').submit();">
											{{ __('Logout') }}
										</a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
									</li>
								
							</ul>
					  </li>
						@endguest
			</ul>

			{{-- end Log Section --}}

		</ul>
	<!--menu end-->
	
	</div>
	
	
  </div>
</nav>	
@yield('content')
</body>
</html>