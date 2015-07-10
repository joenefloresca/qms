$('#Question').summernote();
$('#cbkTimeLocalTz').timepicker();
$('#cbkTimeCustomerTz').timepicker();

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
				// console.log(result);
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

var progress = $(".loading-progress").progressTimer({
	  timeLimit: 10,
	  onFinish: function () {
	  //alert('Data Loading Completed!');
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
				location.reload();
			}
			else
			{
				alert("Error enabling the question. Please contact Administrator");
				location.reload();
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
				location.reload();
			}
			else
			{
				alert("Error disabling the question. Please contact Administrator");
				location.reload();
			}
		}});		
	}
	
}

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

		$.each(getRestrictions, function(key2, value2){
			if(value2 == "agebracket")
			{
				if(value.agebracket == age)
				{
					flag++;
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
						// console.log(checkspace);
						if(checkspace == true)
						{
							// console.log("Has space satisfied");
							if ($.inArray(postcodes[i], postcodeinclusion) == -1)
							{
								// console.log("Postcode " + postcodes[i] + " is not allowed");
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
							
							if ($.inArray(postcodes[i], postcodeexclusion) == -1)
							{
								console.log("Postcode " + postcodes[i] + " is not allowed");
							}
							else
							{
								numMatches2++;
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

		// console.log(value.columnheader+" has "+ count + " number of restrictions.");
		// console.log(value.postcoderestriction);
		// console.log(getRestrictions);
	

		if(count == 0)
		{
			$('#'+value.columnheader).prop("disabled", false);
		}
		else
		{
			count = 0;
			getRestrictions = [];
		}

	});
});

$('#birthdate').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd",
	defaultViewDate: { year: 1960, month: 01, day: 01 }
});

$("#CRMPostcodeBtn").click(function() { 
	$("#CRMPostcode").val($("#CRMPostcodeNew").val());
});
$("#CrmAddr1Btn").click(function() { 
	$("#CrmAddr1").val($("#CrmAddr1New").val());
});
$("#CrmAddr2Btn").click(function() { 
	$("#CrmAddr2").val($("#CrmAddr2New").val());
});
$("#CrmAddr3Btn").click(function() { 
	$("#CrmAddr3").val($("#CrmAddr3New").val());
});
$("#CrmAddr4Btn").click(function() { 
	$("#CrmAddr4").val($("#CrmAddr4New").val());
});
$("#CrmTownBtn").click(function() { 
	$("#CrmTown").val($("#CrmTownNew").val());
});
$("#CrmCountryBtn").click(function() { 
	$("#CrmCountry").val($("#CrmCountryNew").val());
});
$("#CrmFirstNameBtn").click(function() { 
	$("#CrmFirstName").val($("#CrmFirstNameNew").val());
});
$("#CrmSurnameBtn").click(function() { 
	$("#CrmSurname").val($("#CrmSurnameNew").val());
});	

$("#searchCustomer").click(function() { 
	var customer_num = $("#customer_number").val();

	$.ajax({
	url: "api/customer/number", 
	type: 'GET',
	data: {'number':customer_num},
	success: function(result){
		var myObj = $.parseJSON(result);
		if(myObj != null)
		{
			$("#CRMPostcode").val(myObj.postcode);
			$("#CRMPostcodeNew").val(myObj.postcode);
			$("#CrmAddr1").val(myObj.addr1);
			$("#CrmAddr1New").val(myObj.addr1);
			$("#CrmAddr2").val(myObj.addr2);
			$("#CrmAddr2New").val(myObj.addr2);
			$("#CrmAddr3").val(myObj.addr3);
			$("#CrmAddr3New").val(myObj.addr3);
			$("#CrmAddr4").val(myObj.addr4);
			$("#CrmAddr4New").val(myObj.addr4);
			$("#CrmTown").val(myObj.town);
			$("#CrmTownNew").val(myObj.town);
			$("#CrmCountry").val(myObj.country);
			$("#CrmCountryNew").val(myObj.country);
			$("#CrmFirstName").val(myObj.firstname);
			$("#CrmFirstNameNew").val(myObj.firstname);
			$("#CrmSurname").val(myObj.lastname);
			$("#CrmSurnameNew").val(myObj.lastname);
			$("#Title").val(myObj.title);
			$("#Gender").val(myObj.gender);
			$("#CRMTelephoneOptions").val(myObj.phone_type);
			$("#CRMTelephoneNo").val(myObj.phone_num);
			$("#CrmAge").val(myObj.agebracket);
			$("#CRMWorkStatus").val(myObj.work_status);
			$("#CRMOwnHomeOptions").val(myObj.home_status);
			$("#CRMMaritalStatus").val(myObj.marital_status);

			alert("Record found for "+myObj.title+" "+myObj.firstname+" "+myObj.lastname);
		}
		else
		{
			alert("No result found.")
		}
		
	}});
	
});																		