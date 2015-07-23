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
	<link href="{{ asset('/css/bootstrap-datepicker.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.tableTools.css') }}" rel="stylesheet">
	


	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
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
					    @if(Auth::user()->isAdmin == 1)
					    	<li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
							<!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-list"></i> Column Header <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('column') }}">Column Header List</a></li>
									<li><a href="{{ url('column/create') }}">Add/Delete Column Header</a></li>
								</ul>
							</li> -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-wrench"></i> QA Tools <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('qa/verifylist') }}">Verify</a></li>
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
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-time"></i> Login Hours <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-stats"></i> Reports <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ url('reports/agentperformance') }}">Agent Performance</a></li>
									<li><a href="{{ url('reports/charityresponses') }}">Charity Responses</a></li>
								</ul>
							</li>
						@else
						   	<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-file"></i> CRM <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<!-- <li><a href="{{ url('crm') }}">Column Header List</a></li> -->
									<li><a href="{{ url('crm/create') }}">CRM Form</a></li>
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
	<script src="{{ asset('js/jquery.rowsorter.js') }}"></script>
	<script src="{{ asset('js/bootstrap-timepicker.js') }}"></script>
	<script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('js/Chart.js') }}"></script>
	<script src="{{ asset('js/script.js') }}"></script>
	<script type="text/javascript">
	var data = <?php if(isset($questions)) {echo $questions; } else {echo '';} ?> 
	$.ajax({
	url: "api/question/all", 
	type: 'GET',
	success: function(result){
	var myObj = $.parseJSON(result);
    	$.each(myObj, function(key,value) {
    		var t = $('#QuestionList').DataTable();
    		if(value.isenabled == "Yes")
    		{
    			var label = "<span class='label label-success'>Enabled</span>";
    			
    		}
    		else if(value.isenabled == "No")
    		{
    			var label = "<span class='label label-danger'>Disabled</span>";
    		}

    		t.row.add( [
	            value.sortorder,	
	            value.columnheader,
	            value.costperlead,
	            // value.isenabled,
	            "<label class='toggle'><input type='checkbox' checked='' onclick='return changeEnable(this);' id='"+value.columnheader+"'><span class='handle'></span></label>"+label,
	            value.id,
	            "<a class='btn btn-small btn-info' href='<?php echo URL::to('question').'/';?>"+value.id+"/edit'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
	            "<form method='POST' action='<?php echo URL::to('question').'/';?>"+value.id+"' accept-charset='UTF-8' class='pull-left' >"+
	            "<input name='_method' type='hidden' value='DELETE'>"+
	            "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"+"</form>",
        	] ).draw();

        	if(value.isenabled == "Yes")
    		{
    			$("#"+value.columnheader).prop('checked', true);
    			
    		}
    		else if(value.isenabled == "No")
    		{
    			$("#"+value.columnheader).prop('checked', false);
    			
    		}
    		
		});
	}}).error(function(){
		  progress.progressTimer('error', {
		  errorText:'ERROR!',
		  onFinish:function(){
		    alert('There was an error processing your information!');
		  }
		});
	}).done(function(){
			progress.progressTimer('complete');
			$( "#progressbar" ).fadeOut( "slow" );
	});

	$.ajax({
	url: "api/customer/all", 
	type: 'GET',
	success: function(result){
	var myObj = $.parseJSON(result);
    	$.each(myObj, function(key,value) {
    		var t = $('#CustomerList').DataTable();
    		t.row.add( [
	            value.id,	
	            value.firstname,
	            value.lastname,
	            value.gender,
	            value.phone_num,
	            value.postcode,
	            value.country,
	            "<a class='btn btn-small btn-info' href='<?php echo URL::to('customer').'/';?>"+value.id+"/edit'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
	            "<form method='POST' action='<?php echo URL::to('customer').'/';?>"+value.id+"' accept-charset='UTF-8' class='pull-left' >"+
	            "<input name='_method' type='hidden' value='DELETE'>"+
	            "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"+"</form>",
        	] ).draw();

        	if(value.isenabled == "Yes")
    		{
    			$("#"+value.columnheader).prop('checked', true);
    			
    		}
    		else if(value.isenabled == "No")
    		{
    			$("#"+value.columnheader).prop('checked', false);
    			
    		}
    		
		});
	}}).error(function(){
		  progress.progressTimer('error', {
		  errorText:'ERROR!',
		  onFinish:function(){
		    alert('There was an error processing your information!');
		  }
		});
	}).done(function(){
			progress.progressTimer('complete');
			$( "#progressbar" ).fadeOut( "slow" );
	});

	$.ajax({
	url: "api/crm/all", 
	type: 'GET',
	success: function(result){
	var myObj = $.parseJSON(result);
    	$.each(myObj, function(key,value) {
    		var t = $('#VerifyList').DataTable();
    		t.row.add( [
	            value.crmid,	
	            value.name,
	            value.title+" "+value.firstname+" "+value.surname,
	            value.disposition,
	            value.gross,
	            value.created_at,
	            "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+value.crmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
        	] ).draw();
    		
		});
	}}).error(function(){
		  progress.progressTimer('error', {
		  errorText:'ERROR!',
		  onFinish:function(){
		    alert('There was an error processing your information!');
		  }
		});
	}).done(function(){
			progress.progressTimer('complete');
			$( "#progressbar" ).fadeOut( "slow" );
	});
	</script>

</body>
</html>
