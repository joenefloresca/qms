@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Question</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="flash-message">
				        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
				          @if(Session::has('alert-' . $msg))
				          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
				          @endif
				        @endforeach
			        </div>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('question') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Question</label>
							<div class="col-md-6">
								<textarea name="Question" id="Question" class="form-control" row="7">Content here..</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Lead Reponse</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lead_response" id="lead_response" value="" placeholder="Ex. Yes,Possibly">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Postcode Restriction</label>
							<div class="col-md-6">
								<select name="PostCodeRestriction" id="PostCodeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="PostCodeInclusion">PostCodeInclusion</option>
									<option value="PostCodeExclusion">PostCodeExclusion</option>
									<option value="Both">Both</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group"  id="DivPostCodeInclusion" style="display: none">
							<label class="col-md-4 control-label">Postcode Inclusion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="PostCodeInclusion" id="PostCodeInclusion" placeholder="Ex. CC,DH,CL">
							</div>
						</div>

						<div class="form-group" id="DivPostCodeExclusion" style="display: none">
							<label class="col-md-4 control-label">Postcode Exclusion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="PostCodeExclusion" id="PostCodeExclusion" placeholder="Ex. CC,DH,CL">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Age Restriction</label>
							<div class="col-md-6">
								<select name="AgeRestriction" id="AgeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivAgeBracket" style="display: none">
							<label class="col-md-4 control-label">Age Bracket</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="AgeBracket" id="AgeBracket" placeholder="Ex. 30-50">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Own Home Restriction</label>
							<div class="col-md-6">
								<select name="OwnHomeRestriction" id="OwnHomeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivOwnHomeOptions" style="display: none">
							<label class="col-md-4 control-label">Own Home Options</label>
							<div class="col-md-6">
								<div class="checkbox">
 					 				<label><input type="checkbox" name="OwnHome" id="OwnHome" value="Own Home">Own Home</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Renting" id="Renting" value="Renting">Renting</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="LivWithFamFrnd" id="LivWithFamFrnd" value="Living with Family/Friend">Living with Family/Friend</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="NotAns" id="NotAns" value="Not Answered">Not Answered</label>
								</div>
								
								<div class="text" style="padding-top: 4px"><input type="text" class="form-control" name="OwnHomeOptions" id="OwnHomeOptions"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Telephone Restriction</label>
							<div class="col-md-6">
								<select name="TelephoneRestriction" id="TelephoneRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivTelephoneOptions" style="display: none">
							<label class="col-md-4 control-label">Telephone Options</label>
							<div class="col-md-6">
								<select name="TelephoneOptions" id="TelephoneOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Landline">Landline</option>
									<option value="Mobile">Mobile</option>
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Employment Restriction</label>
							<div class="col-md-6">
								<select name="WorkRestriction" id="WorkRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivWorkOptions" style="display: none">
							<label class="col-md-4 control-label">Employment Rules</label>
							<div class="col-md-6">
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Employed" id="Employed" value="Employed">Employed</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Self-Employed" id="Self-Employed" value="Self-Employed">Self-Employed</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Retired" id="Retired" value="Retired">Retired</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Company_Director" id="Company_Director" value="Company Director">Company Director</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Other_Work" id="Other_Work" value="Other">Other</label>
								</div>
								
								<div class="text" style="padding-top: 4px"><input type="text" class="form-control" name="WorkOptions" id="WorkOptions"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Marital Status Restriction</label>
							<div class="col-md-6">
								<select name="MaritalRestriction" id="MaritalRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivMaritalOptions" style="display: none">
							<label class="col-md-4 control-label">Marital Status Rules</label>
							<div class="col-md-6">
								<div class="checkbox">
 					 				<label><input type="checkbox" name="MarriedCoHabbiting" id="MarriedCoHabbiting" value="Married or Co-Habiting">Married or Co-Habiting</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="SingleNeverMarried" id="SingleNeverMarried" value="Single or Never Married">Single or Never Married</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Widowed" id="Widowed" value="Widowed">Widowed</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Divorced" id="Divorced" value="Divorced">Divorced</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Separated" id="Separated" value="Other">Separated</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Other_Marital" id="Other_Marital" value="Other">Others</label>
								</div>
								
								<div class="text" style="padding-top: 4px"><input type="text" class="form-control" name="MaritalOptions" id="MaritalOptions"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Cost Per Lead</label>
							<div class="col-md-6">
								<div class="input-group">
			                      <span class="input-group-addon">£</span>
			                      	<input type="text" class="form-control" name="CostPerLead" id="CostPerLead">
			                      <span class="input-group-addon">.00</span>
                    			</div>
								
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Column Header</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ColumnHeader" id="ColumnHeader">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Delivery Assignment</label>
							<div class="col-md-6">
								<select name="DeliveryAssignment" id="DeliveryAssignment" class="form-control">
									<option value="">Choose One</option>
									<option value="MIS">MIS</option>
									<option value="CQ">CQ</option>
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Is Enabled</label>
							<div class="col-md-6">
								<select name="IsEnabled" id="IsEnabled" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">P.O #</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="po_num" id="po_num" value="">
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-4 control-label">Sort Order</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="sortorder" id="sortorder" value="">
							</div>
						</div> -->


							<div class="form-group">
								<label class="col-md-4 control-label">Number of Child Questions</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="numGenerate" id="numGenerate" value="{{ old('numGenerate') }}" placeholder=""> 
								</div>
							</div> 

							<div class="form-group">
								<div class="col-md-4 control-label"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-default" id="btnGenerate" name="btnGenerate">Go</button>
								</div>
							</div>

							

							<input type="hidden" class="form-control" name="NumberOfScripts" id="NumberOfScripts" value="{{ old('NumberOfScripts') }}" placeholder="" > 

							<table class="table" id="scripts"></table>
					

						<!-- <input type="text" name="restrictioncount" id="restrictioncount" /> -->

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('questioncreate')
<script type="text/javascript">
$("#btnGenerate").click(function() {
     var num = parseInt($("#numGenerate").val());
     var html = '';
     var columnheader = $("#ColumnHeader").val();

     for(var i = 1; i <= num ; i++)
     {
     	html = '<tr><td>'+columnheader+'_'+i+'</td><td><textarea name="'+columnheader+'_'+i+'" id="'+columnheader+'_'+i+'"> Content here.. </textarea></td><td><input type="text" class="form-control" placeholder="Enter Cost" name="'+columnheader+'_'+i+'_cost'+'"></td><td><div><input type="text" class="form-control" name="'+columnheader+'_'+i+'_response'+'" placeholder="Response Activation" ><input type="text" class="form-control" name="'+columnheader+'_'+i+'_response_activate'+'" placeholder="Lead Response"></td></tr>';
     	$('#scripts').append(html);
     }

     for(var x = 1; x <= num ; x++)
     {
     	$('#'+columnheader+'_'+x).summernote();
     }
     
    $('#NumberOfScripts').val(num);
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


$("#OwnHome").click(function() {
	var value = $("#OwnHome").val();
	$('#OwnHomeOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
	});
});

$("#Renting").click(function() {
	var value = $("#Renting").val();
	$('#OwnHomeOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
	});
});

$("#LivWithFamFrnd").click(function() {
	var value = $("#LivWithFamFrnd").val();
	$('#OwnHomeOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
	});
});

$("#NotAns").click(function() {
	var value = $("#NotAns").val();
	$('#OwnHomeOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
	});
});


$("#WorkRestriction").change(function() {

	var choosen = $("#WorkRestriction").val();

	if(choosen == "Yes")
	{
		$("#DivWorkOptions").css("display","block");
	}
	else if(choosen == "No")
	{
		$("#DivWorkOptions").css("display","none");
	}
	else
	{
		$("#DivWorkOptions").css("display","none");
	}
	  	
});


$("#Employed").click(function() {
	var value = $("#Employed").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Self-Employed").click(function() {
	var value = $("#Self-Employed").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Retired").click(function() {
	var value = $("#Retired").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Retired").click(function() {
	var value = $("#Retired").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Company_Director").click(function() {
	var value = $("#Company_Director").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Other_Work").click(function() {
	var value = $("#Other_Work").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});				

$("#Separated").click(function() {
	var value = $("#Other_Work").val();
	$('#WorkOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#MaritalRestriction").change(function() {

	var choosen = $("#MaritalRestriction").val();

	if(choosen == "Yes")
	{
		$("#DivMaritalOptions").css("display","block");
	}
	else if(choosen == "No")
	{
		$("#DivMaritalOptions").css("display","none");
	}
	else
	{
		$("#DivMaritalOptions").css("display","none");
	}
	  	
});

$("#MarriedCoHabbiting").click(function() {
	var value = $("#MarriedCoHabbiting").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#SingleNeverMarried").click(function() {
	var value = $("#SingleNeverMarried").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Widowed").click(function() {
	var value = $("#Widowed").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Divorced").click(function() {
	var value = $("#Divorced").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Separated").click(function() {
	var value = $("#Separated").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});

$("#Other_Marital").click(function() {
	var value = $("#Other_Marital").val();
	$('#MaritalOptions').val(function(i,val) { 
     	return val + (!val ? '' : ',') + value;
    }); 	
});



</script>
@endsection

