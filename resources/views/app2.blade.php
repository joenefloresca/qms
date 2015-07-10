<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Web Tool</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
	<!-- <link href="{{ asset('bootflat/css/bootflat.css') }}" rel="stylesheet">
	<link href="{{ asset('bootflat/css/bootflat.css.map') }}" rel="stylesheet"> -->

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
	<link href="{{ asset('/css/summernote.css') }}" rel="stylesheet">

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
				<a class="navbar-brand" href="#">Web Tool</a>
			</div>


			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if (Auth::check())
						<li><a href="{{ url('/') }}"><i class="glyphicon glyphicon-home"></i> Home</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-list"></i> Column Header <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('column') }}">Column Header List</a></li>
								<li><a href="{{ url('column/create') }}">Add/Delete Column Header</a></li>
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
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-time"></i> Login Hours <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('loginhours') }}">View Login Hours</a></li>
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
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="{{ asset('js/jquery.progressTimer.js') }}"></script>
	<script src="{{ asset('js/summernote.js') }}"></script>
	<script src="{{ asset('js/jquery.rowsorter.js') }}"></script>
	<script type="text/javascript">

	
	function get_response(id)
	{
		var current_gross = parseFloat($("#CRMGross").val());
		var val 	= $(id).attr('id');
		var cost 	= $("#"+val).attr('value');
		var response = $("#"+val).val();


		if(response == "Yes" || response == "Possibly")
		{
			current_gross = current_gross + parseFloat(cost);
			$("#CRMGross").val(current_gross.toFixed(2));
			$("#"+val+"block").css("display","none");
		}
	}


	$("#PostCodeRestriction").change(function() {

		var choosen = $("#PostCodeRestriction").val();

		if(choosen == "PostCodeInclusion")
		{
			$("#DivPostCodeInclusion").css("display","block");
			$("#DivPostCodeExclusion").css("display","none");
		}
		else if(choosen == "PostCodeExclusion")
		{
			$("#DivPostCodeExclusion").css("display","block");
			$("#DivPostCodeInclusion").css("display","none");
		}
		else if(choosen == "Both")
		{
			$("#DivPostCodeInclusion").css("display","block");
			$("#DivPostCodeExclusion").css("display","block");
		}
		else
		{
			$("#DivPostCodeInclusion").css("display","none");
			$("#DivPostCodeExclusion").css("display","none");
		}
	  	
	});

	$("#AgeRestriction").change(function() {

		var choosen = $("#AgeRestriction").val();

		if(choosen == "Yes")
		{
			$("#DivAgeBracket").css("display","block");
		}
		else if(choosen == "No")
		{
			$("#DivAgeBracket").css("display","none");
		}
		else
		{
			$("#DivAgeBracket").css("display","none");
		}
	  	
	});

	$("#OwnHomeRestriction").change(function() {

		var choosen = $("#OwnHomeRestriction").val();

		if(choosen == "Yes")
		{
			$("#DivOwnHomeOptions").css("display","block");
		}
		else if(choosen == "No")
		{
			$("#DivOwnHomeOptions").css("display","none");
		}
		else
		{
			$("#DivOwnHomeOptions").css("display","none");
		}
	  	
	});

	$("#CrmShallWeStart").change(function() {

		var choosen = $("#CrmShallWeStart").val();

		if(choosen == "Yes")
		{
			$("#shallwestart").css("display","block");
		}
		else if(choosen == "No")
		{
			$("#shallwestart").css("display","none");
		}
		else
		{
			$("#shallwestart").css("display","none");
		}
	  	
	});

	$("#OwnHomeRestriction").change(function() {

		var choosen = $("#OwnHomeRestriction").val();

		if(choosen == "Yes")
		{
			$("#DivOwnHomeOptions").css("display","block");
		}
		else if(choosen == "No")
		{
			$("#DivOwnHomeOptions").css("display","none");
		}
		else
		{
			$("#DivOwnHomeOptions").css("display","none");
		}
	  	
	});

		function changeEnable(id)
		{
			var val 	= $(id).attr('id');
			var ischeck = $("#"+val).is(":checked");
			if(ischeck == true)
			{
				$.ajax({
				url: "api/question/changeenable", 
				type: 'GET',
				data: {'id':val, 'isenabled': 'Yes'},
				success: function(result){
	
					if(result > 0)
					{
						alert("Question "+val+ " has been enabled.");
					}
					else
					{
						alert("Error enabling the question. Please contact Administrator");
					}
				}});
			}
			else
			{
				$.ajax({
				url: "api/question/changeenable", 
				type: 'GET',
				data: {'id':val, 'isenabled': 'No'},
				success: function(result){
	
					if(result > 0)
					{
						alert("Question "+val+ " has been disabled.");
					}
					else
					{
						alert("Error disabling the question. Please contact Administrator");
					}
				}});		
			}
			
			
		}

	</script>
	<script type="text/javascript">
	var data = <?php if(isset($questions)) {echo $questions; } ?> ;

	$("#trigger").click(function() {
		var age = $("#CrmAge").val();
		var CRMPostcode = $("#CRMPostcode").val();
		var CRMTelephoneOptions = $("#CRMTelephoneOptions").val();
		var CRMOwnHomeOptions = $("#CRMOwnHomeOptions").val();
		var count = 0;
		var flag = 0; 
		var getRestrictions = [];

  		$.each(data, function(key,value) {

  		// Make an array variable where you will store the Restriction Name and Loop thru it
  			
  			if(value.postcoderestriction == "PostCodeInclusion" || value.postcoderestriction == "PostCodeExclusion" || value.postcoderestriction == "Both")
  			{
  				if(value.postcoderestriction == "Both")
  				{
  					count += 2;
  					getRestrictions.push("postcodeinclusion");
  					getRestrictions.push("postcodeexclusion");
  				}
  				if(value.postcoderestriction == "PostCodeInclusion")
  				{
  					count++;
  					getRestrictions.push("postcodeinclusion");
  				}
  				if(value.postcoderestriction == "PostCodeExclusion")
  				{
  					count++;
  					getRestrictions.push("postcodeexclusion");
  				}
  			}
  			if(value.agerestriction == "Yes")
  			{
  				count++;
  				getRestrictions.push("agebracket");
  			}
  			if(value.ownhomerestriction == "Yes")
  			{
  				count++;
  				getRestrictions.push("ownhomeoptions");
  			}
  			if(value.telephonerestriction == "Yes")
  			{
  				count++;
  				getRestrictions.push("telephoneoptions");
  			}

  			console.log("It has "+ count + " number of restrictions.");

  			if(count == 0)
  			{
  				$('#'+value.columnheader).prop("disabled", false);
  			}

  			$.each(getRestrictions, function(key2, value2){

  				if(value2 == "agebracket")
  				{
  					if(value.agebracket == age)
  					{
  						flag++;
  						console.log("Entered on age");
  						if(flag == count)
  						{
  							$('#'+value.columnheader).prop("disabled", false);
  						}
  					}
  				}
  				if(value2 == "telephoneoptions")
  				{
  					if(value.telephoneoptions == CRMTelephoneOptions)
  					{
  						flag++;
  						console.log("Entered on telephone");
  						if(flag == count)
  						{
  							$('#'+value.columnheader).prop("disabled", false);
  						}
  					}
  				}
  				if(value2 == "ownhomeoptions")
  				{
  					if(value.ownhomeoptions == CRMOwnHomeOptions)
  					{
  						flag++;
  						console.log("Entered on Own Home");
  						if(flag == count)
  						{
  							$('#'+value.columnheader).prop("disabled", false);
  						}
  					}
  				}
  				if(getRestrictions.length == 0)
				{
					$('#'+value.columnheader).prop("disabled", false);
				}
  				if(value2 == "postcodeinclusion")
  				{

  					var postcodeinclusion = value.postcodeinclusion.split(',');
  					var postcodes = CRMPostcode.split('/');
  					var numMatches = 0;

  					for (var i = 0; i < postcodes.length; i++) 
  					{
  						for(var x = 0; x < postcodeinclusion.length; x++)
  						{
  							var checkspace = (postcodeinclusion[x].indexOf(' ') >= 0);
  							console.log(checkspace);
  							if(checkspace == true)
  							{
  								console.log("Has space satisfied");
  								if ($.inArray(postcodes[i], postcodeinclusion) == -1)
  								{
  									console.log("Postcode " + postcodes[i] + " is not allowed");
  								}
  								else
  								{
  									numMatches++;
  								}
  							}
  							else
  							{
  								var checkspacePostcodeIn = (postcodes[i].indexOf(' ') >= 0);

  								if(checkspacePostcodeIn == true)
  								{
  									var newpostcodein = postcodes[i].split(' ');
  									if(newpostcodein[0] == postcodeinclusion[x])
  									{
										numMatches++;
  									}
  								}
  							}
  						}
  						
    				}
    		
  				    console.log("Number of matches is "+ numMatches);
  				    if(numMatches > 0)
  				    {
  				    	$('#'+value.columnheader).prop("disabled", false);
  				    }
  					
  				}

  				if(value2 = "postcodeexclusion")
  				{
  					var postcodeexclusion = value.postcodeexclusion.split(',');
  					var postcodes = CRMPostcode.split('/');
  					var numMatches2 = 0;

  					for (var i = 0; i < postcodes.length; i++) 
  					{

  						for(var x = 0; x < postcodeexclusion.length; x++)
  						{
  							var checkspace = (postcodeexclusion[x].indexOf(' ') >= 0);
  							if(checkspace == true)
  							{
  								console.log("Has space satisfied");
  								console.log(checkspace);
  								console.log(postcodeexclusion[x]);

  								if ($.inArray(postcodes[i], postcodeexclusion) == -1)
  								{
  									console.log("Postcode " + postcodes[i] + " is not allowed");
  								}
  								else
  								{
  									numMatches2++;
  									console.log(numMatches2);
  								}
  								
  							}
  							else
  							{
  								var checkspacePostcodeIn = (postcodes[i].indexOf(' ') >= 0);

  								if(checkspacePostcodeIn == true)
  								{
  									var newpostcodein = postcodes[i].split(' ');
  									if(newpostcodein[0] == postcodeexclusion[x])
  									{
										numMatches2++;
  									}
  								}
  							}
  						}
  						
    				}

    				if(numMatches2 > 0)
  				    {
  				    	$('#'+value.columnheader).prop("disabled", true);
  				    }
  					
  				}
  				
  			});
			
			
		});
	});
	

</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Choose a Campaign</h4>
      </div>
      <div class="modal-body">
        <div class="form-horizontal">
        	<div class="form-group">
				<label class="col-md-5 control-label">Campaigns</label>
				<div class="col-md-6">
					<select class="form-control">
						<option value="">Choose One</option>
						<option value="Sample">Sample</option>
						<option value="Sample 2">Sample 2</option>
						<option value="Sample 3">Sample 3</option>
					</select>
				</div>
			</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>
