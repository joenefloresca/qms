<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Satellite CRM</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap-timepicker.css') }}" rel="stylesheet">
	<!-- <link href="{{ asset('bootflat/css/bootflat.css') }}" rel="stylesheet">
	<link href="{{ asset('bootflat/css/bootflat.css.map') }}" rel="stylesheet"> -->

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
	<link href="{{ asset('/css/summernote.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/jquery.datetimepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.tableTools.css') }}" rel="stylesheet">

</head>
<body>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Satellite CRM</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::check())
					    @if(Auth::user()->isAdmin == 1) <!-- Admin -->
					    	<li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
							
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> QA Tools <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('qa/verifylist') }}">Verify</a></li>
									<li><a href="{{ url('qa/reverifylist') }}">Re-Verify Forms</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-book"></i> Questions <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('question') }}">Question List</a></li>
									<li><a href="{{ url('question/create') }}">Add Question</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-file"></i> CRM <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<!-- <li><a href="{{ url('crm') }}">Column Header List</a></li> -->
									<li><a href="{{ url('crm/create') }}">CRM Form</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> Customers <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('customer') }}">Customer List</a></li>
									<li><a href="{{ url('customer/create') }}">Add Customer</a></li>
									<li><a href="{{ url('customer-upload') }}">Upload Customer</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="	glyphicon glyphicon-remove-sign"></i> Suppression & Mutuals <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('suppression') }}">Suppression List</a></li>
									<li><a href="{{ url('suppression/create') }}">Add Suppression</a></li>
									<li><a href="{{ url('suppression-upload') }}">Upload Suppression</a></li>

									<li><a href="{{ url('mutual') }}">Mutual Exlusion List</a></li>
									<li><a href="{{ url('mutual/create') }}">Add Mutual Exlusion</a></li>
								</ul>

							</li>
							
							<!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-time"></i> Login Hours <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
								</ul>
							</li> -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Reports <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('reports/agentperformance') }}">Agent Performance Gross</a></li>
									<li><a href="{{ url('reports/agentperformancenet') }}">Agent Performance Net</a></li>
									<li><a href="{{ url('reports/campaigngrossperformance') }}">Campaign Gross Performance</a></li>
									<li><a href="{{ url('reports/campaignnetperformance') }}">Campaign Net Performance</a></li>
									<li><a href="{{ url('reports/charityresponses') }}">Questionnaire Responses Gross</a></li>
									<li><a href="{{ url('reports/charityresponsesnet') }}">Questionnaire Responses Net</a></li>
									<li><a href="{{ url('reports/verifierreport') }}">Verifier Report</a></li>
									<li><a href="{{ url('reports/dailyverifierreport') }}">Daily Verification Report</a></li>
									<li><a href="{{ url('reports/qasummary') }}">Qa Summary Report</a></li>
									<li><a href="{{ url('reports/detailedsummary') }}">Detailed Summary</a></li>
									<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
								</ul>
							</li>
							<!-- <li class="dropdown">
								<ul class="nav navbar-nav">
						            <li class="dropdown">
						              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-star"></i> Themes <b class="caret"></b></a>
						              <ul class="dropdown-menu">
						                <li><a href="#" data-theme="default" class="theme-link">Default</a></li>
						                <li><a href="#" data-theme="amelia" class="theme-link">Amelia</a></li>
						                <li><a href="#" data-theme="cerulean" class="theme-link">Cerulean</a></li>
						                <li><a href="#" data-theme="cosmo" class="theme-link">Cosmo</a></li>
						                <li><a href="#" data-theme="cyborg" class="theme-link">Cyborg</a></li>
						                <li><a href="#" data-theme="flatly" class="theme-link">Flatly</a></li>
						                <li><a href="#" data-theme="journal" class="theme-link">Journal</a></li>
						                <li><a href="#" data-theme="readable" class="theme-link">Readable</a></li>
						                <li><a href="#" data-theme="simplex" class="theme-link">Simplex</a></li>
						                 <li><a href="#" data-theme="slate" class="theme-link">Slate</a></li>
						                  <li><a href="#" data-theme="spacelab" class="theme-link">Spacelab</a></li>
						                  <li><a href="#" data-theme="united" class="theme-link">United</a></li>
						              </ul>
						            </li>
						          </ul>
							</li> -->
						@endif	
						@if(Auth::user()->isAdmin == 0) <!-- Agent -->
						   	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-file"></i> CRM <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('crm/create') }}">CRM Form</a></li>
								</ul>
							</li>
					    @endif
					    @if(Auth::user()->isAdmin == 2) <!-- Supervisor -->
						   	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-file"></i> CRM <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('crm/create') }}">CRM Form</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Reports <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('reports/agentperformance') }}">Agent Performance</a></li>
									<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
								</ul>
							</li>
						@endif
						@if(Auth::user()->isAdmin == 3) <!-- QA -->
						   	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> QA Tools <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('qa/verifylist') }}">Verify</a></li>
									<li><a href="{{ url('qa/reverifylist') }}">Re-Verify Forms</a></li>
								</ul>
							</li>
						@endif	
						@if(Auth::user()->isAdmin == 4) <!-- Auditor -->
						   	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> QA Tools <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('qa/verifylist') }}">Verify</a></li>
									<li><a href="{{ url('qa/reverifylist') }}">Re-Verify Forms</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-file"></i> CRM <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<!-- <li><a href="{{ url('crm') }}">Column Header List</a></li> -->
									<li><a href="{{ url('crm/create') }}">CRM Form</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Reports <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('reports/agentperformance') }}">Agent Performance</a></li>
									<li><a href="{{ url('reports/campaigngrossperformance') }}">Campaign Gross Performance</a></li>
									<li><a href="{{ url('reports/campaignnetperformance') }}">Campaign Net Performance</a></li>
									<li><a href="{{ url('reports/charityresponses') }}">Charity Responses Gross</a></li>
									<li><a href="{{ url('reports/charityresponsesnet') }}">Charity Responses Net</a></li>
									<li><a href="{{ url('reports/verifierreport') }}">Verifier Report</a></li>
									<li><a href="{{ url('reports/qasummary') }}">Qa Summary Report</a></li>
									<li><a href="{{ url('reports/detailedsummary') }}">Detailed Summary</a></li>
									<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
								</ul>
							</li>
						@endif	
					@endif 

				</ul>

				<ul class="nav navbar-nav navbar-right">

					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user"></i>  {{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<!--<script src="{{ asset('bootflat/js/icheck.min.js') }}"></script>
	<script src="{{ asset('bootflat/js/jquery.fs.selecter.min.js') }}"></script>
	<script src="{{ asset('bootflat/js/jquery.fs.stepper.min.js') }}"></script>-->
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('js/dataTables.tableTools.js') }}"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="{{ asset('js/jquery.progressTimer.js') }}"></script>
	<script src="{{ asset('js/summernote.js') }}"></script>
	<script src="{{ asset('js/moment.js') }}"></script>
	<script src="{{ asset('js/jquery.rowsorter.js') }}"></script>
	<script src="{{ asset('js/bootstrap-timepicker.js') }}"></script>
	<script src="{{ asset('js/jquery.datetimepicker.js') }}"></script>
	<script src="{{ asset('js/Chart.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	<script type="text/javascript">
	var agent_id = <?php  if(isset(Auth::user()->id)) {echo Auth::user()->id; } else {echo '' ;} ?> ;
	</script>
	@yield('CrmCreate')
	@yield('agentperformance')
	@yield('agentperformancenet')
	@yield('campaigngrossperformance')
	@yield('campaignnetperformance')
	@yield('charityresponses')
	@yield('charityresponsesnet')
	@yield('loginhours')
	@yield('verifierreport')
	@yield('dailyverifierreport')
	@yield('qasummary')
	@yield('verifylist')
	@yield('verifyform')
	@yield('reverifyform')
	@yield('reverifylist')
	@yield('question')
	@yield('questioncreate')
	@yield('customer')
	@yield('detailedsummary')
	@yield('suppression')
	@yield('mutual')
</body>
</html>
