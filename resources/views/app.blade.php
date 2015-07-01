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
	<nav class="navbar navbar-inverse">
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

				</ul>

				<ul class="nav navbar-nav navbar-right">

					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
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
	<!--<script src="{{ asset('js/timer.jquery.js') }}"></script>-->
	<script type="text/javascript">
	// $('#timer').timer();
	$('#Question').summernote();
	

	var sortSequence = [];
	var sortSequenceId = [];
	$("#QuestionList").rowSorter({
		onDrop: function(tbody, row, index, oldIndex) {
			$(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
		}
	});

	$("#saveSort").click(function() {
		sortSequence = [];
  		$('#QuestionList tbody tr td:nth-child(1)').each( function(){
		   //add item to array
		   sortSequence.push( $(this).text() );       
		});
		$('#QuestionList tbody tr td:nth-child(5)').each( function(){
		   
		   sortSequenceId.push( $(this).text() );       
		});

		var cnt = 1;

  		$.each(sortSequence, function(key,value) { 
  			$.ajax({
				url: "api/sort/questions", 
				type: 'GET',
				data: {"value":value, "cnt" : cnt, "id" : sortSequenceId[key]},
				success: function(result){
					console.log(result);
				}});
				cnt++;
  		});

  		location.reload();
  			
	});

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

	$("#TelephoneRestriction").change(function() {

		var choosen = $("#TelephoneRestriction").val();

		if(choosen == "Yes")
		{
			$("#DivTelephoneOptions").css("display","block");
		}
		else if(choosen == "No")
		{
			$("#DivTelephoneOptions").css("display","none");
		}
		else
		{
			$("#DivTelephoneOptions").css("display","none");
		}
	  	
	});

	var progress = $(".loading-progress").progressTimer({
			  timeLimit: 10,
			  onFinish: function () {
			  //alert('Data Loading Completed!');
			}
		});

	$.ajax({
		url: "api/question/all", 
		type: 'GET',
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		var t = $('#QuestionList').DataTable();

	    		t.row.add( [
		            value.sortorder,	
		            value.columnheader,
		            value.costperlead,
		            // value.isenabled,
		            "<label class='toggle'><input type='checkbox' checked='' id='"+value.columnheader+"'><span class='handle'></span></label>",
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
		url: "api/column/all", 
		type: 'GET',
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		var t = $('#columnList').DataTable();

	    		t.row.add( [
		            value.id,
		            value.column_header,
		            value.database,
		            value.method,
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

		$.ajax({
		url: "api/loginhours/all",
		type: 'GET',
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		
	    		if(value.status == 1)
	    		{
	    			var status = "Logged-In";
	    		}
	    		else
	    		{
	    			var status = "Logged-Out";
	    		}
	    		var t = $('#LoginHourList').DataTable();

	    		t.row.add( [
		            value.name,
		            value.date,
		            status,
		            value.loginhours,
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
</body>
</html>
