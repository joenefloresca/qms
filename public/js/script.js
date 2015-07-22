$('#Question').summernote();
$('#cbkTimeLocalTz').timepicker();
$('#cbkTimeCustomerTz').timepicker();
var records = [];
$(document).ready(function() {
/* Load the active questions to be used to check details and logic */
		$.ajax({
		url: "api/questions/getallactive", 
		type: 'GET',
		success: function(result){
			
			var myObj = $.parseJSON(result);
			console.log(myObj);
			$.each(myObj, function(key,value) {
				records.push({
	                agebracket: value.agebracket,
	                agerestriction: value.agerestriction,
	                child_count: value.child_count,
	                child_enable_response: value.child_enable_response,
	                child_sort_num: value.child_sort_num,
	                columnheader: value.columnheader,
	                costperlead: value.costperlead,
	                created_at: value.created_at,
	                deliveryassignment: value.deliveryassignment,
	                id: value.id,
	                is_child: value.is_child,
	                isenabled: value.isenabled,
	                ownhomeoptions: value.ownhomeoptions,
	                ownhomerestriction: value.ownhomerestriction,
	                parent_colheader: value.parent_colheader,
	                po_num: value.po_num,
	                postcodeexclusion: value.postcodeexclusion,
	                postcodeinclusion: value.postcodeinclusion,
	                postcoderestriction: value.postcoderestriction,
	                question: value.question,
	                sortorder: value.sortorder,
	                telephoneoptions: value.telephoneoptions,
	                telephonerestriction: value.telephonerestriction,
	                updated_at: value.updated_at,
				});
			});
			
		}});


});
$( document ).ready(function() {

	// var data = {labels: [], datasets: []};
	// var label = {};
	// var fillColor = {};
	// var strokeColor = {};
	// var highlightFill = {};
	// var highlightStroke = {};
	// var data = {};

	$.ajax({
		url: "api/crm/charityresponsesall", 
		success: function(result){
			var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		// data.labels.push(value.columnheader);
	    		
	    		// var label = "label";
	    		// data.datasets.push();


	    		// console.log(value.columnheader);
	    		// console.log(value.revenue);
	    		
			});
	    	console.log(data);
			
			var data = {
			    labels: ["January", "February", "March", "April", "May", "June", "July"],
			    datasets: [
			        {
			            label: "My First dataset",
			            fillColor: "rgba(220,220,220,0.5)",
			            strokeColor: "rgba(220,220,220,0.8)",
			            highlightFill: "rgba(220,220,220,0.75)",
			            highlightStroke: "rgba(220,220,220,1)",
			            data: [65, 59, 80, 81, 56, 55, 40]
			        },
			        {
			            label: "My Second dataset",
			            fillColor: "rgba(151,187,205,0.5)",
			            strokeColor: "rgba(151,187,205,0.8)",
			            highlightFill: "rgba(151,187,205,0.75)",
			            highlightStroke: "rgba(151,187,205,1)",
			            data: [28, 48, 40, 19, 86, 27, 90]
			        }
			    ]
			};

			
			
			var ctx = document.getElementById("canvas").getContext("2d");
			myBar = new Chart(ctx).Bar(data, {
				responsive : true
			});
		}	
	});

});

$('#fromDateAgentPer').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd",
});
$('#toDateAgentPer').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd",
});

$('#fromDateCharityRes').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd",
});
$('#toDateCharityRes').datepicker({
	autoclose: true,
	format: "yyyy-mm-dd",
});

$("#btnDateCharityRes").click(function() {
	if ($.fn.dataTable.isDataTable('#CharityResponses') ) 
	{	
    	table.destroy();
    	table = $('#CharityResponses').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	    $.ajax({
		url: "api/crm/charityresponses", 
		type: 'GET',
		data: {"from" : $("#fromDateCharityRes").val(), "to" :  $("#toDateCharityRes").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		
	    		table.row.add( [
		            value.question_id,	
		            value.columnheader,
		            value.ct_yes,
		            value.ct_no,
		            value.ct_maybe,
		            value.costperlead,
		            value.revenue,
	        	] ).draw();
	    		
			});
		}});

	}
    else 
    {
	    table = $('#CharityResponses').DataTable();
	    $.ajax({
		url: "api/crm/charityresponses", 
		type: 'GET',
		data: {"from" : $("#fromDateCharityRes").val(), "to" :  $("#toDateCharityRes").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		
	    		table.row.add( [
		            value.question_id,	
		            value.columnheader,
		            value.ct_yes,
		            value.ct_no,
		            value.ct_maybe,
		            value.costperlead,
		            value.revenue,
	        	] ).draw();
	    		
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	}
	
});

$("#btnDateAgentPer").click(function() {
	if ($.fn.dataTable.isDataTable('#AgentPerformance') ) 
	{
    	table.destroy();
    	table = $('#AgentPerformance').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	    $.ajax({
		url: "api/crm/agentperformance", 
		type: 'GET',
		data: {"from" : $("#fromDateAgentPer").val(), "to" :  $("#toDateAgentPer").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.totalapplication,
		            value.applicationperhour,
		            value.rph,
	        	] ).draw();
	    		
			});
		}});

	}
    else 
    {
	    table = $('#AgentPerformance').DataTable();
	    $.ajax({
		url: "api/crm/agentperformance", 
		type: 'GET',
		data: {"from" : $("#fromDateAgentPer").val(), "to" :  $("#toDateAgentPer").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.totalapplication,
		            value.applicationperhour,
		            value.rph,
	        	] ).draw();
	    		
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	}
	
});


function get_response(id)
{
	console.log(records);
	var currentheader = $(id).attr('id');
	var current_gross = parseFloat($("#CRMGross").val());
	var cost 	= $("#"+currentheader).attr('value');
	var response = $("#"+currentheader).val();
	var counter = 1;

    var result = $.grep(records, function(e){ return e.columnheader == currentheader; });
    console.log(result);
    console.log(currentheader);

    if (result.length == 1)
    {
    	console.log("Child count is "+result[0].child_count)
    	if(result[0].child_count > 0)
    	{
    		 console.log("Has child questions.");
    		 var childresponse = $.grep(records, function(e){ return e.columnheader == currentheader+"_1"; });
    		 if(childresponse.length == 1)
    		 {
	 			if($("#"+currentheader).val() == childresponse[0].child_enable_response)
				{
					$('#'+currentheader+"_1").prop("disabled", false);

					if(response == "Yes" || response == "Possibly")
					{
						current_gross = current_gross + parseFloat(cost);
						$("#CRMGross").val(current_gross.toFixed(2));
						$("#"+currentheader+"block").css("display","none");
					}
					else
					{
						$("#"+currentheader+"block").css("display","none");
					}
				}
				else
				{
					$('#'+currentheader+"_1").prop("disabled", true);

					if(response == "Yes" || response == "Possibly")
					{
						current_gross = current_gross + parseFloat(cost);
						$("#CRMGross").val(current_gross.toFixed(2));
						$("#"+currentheader+"block").css("display","none");
					}
					else
					{
						$("#"+currentheader+"block").css("display","none");
					}
				}
    		 }
    	}
    	else
    	{
    		var childsort = $.grep(records, function(e){ return e.columnheader == currentheader; });
    		if(childsort.length == 1)
    		{
    			var nextChildSort = parseInt(childsort[0].child_sort_num)+1;
    			var parent = childsort[0].parent_colheader;
    			var nextcolheader = parent+"_"+nextChildSort;

    			$.ajax({
					url: "api/questions/checkchild", 
					type: 'GET',
					data: {"parent":parent, "colheader" : nextcolheader},
					success: function(result){
					var myObjResult = $.parseJSON(result);
					if(myObjResult.count > 0)
					{
						if($("#"+currentheader).val() == myObjResult.response)
						{
							$('#'+nextcolheader).prop("disabled", false);

							if(response == "Yes" || response == "Possibly")
							{
								current_gross = current_gross + parseFloat(cost);
								$("#CRMGross").val(current_gross.toFixed(2));
								$("#"+currentheader+"block").css("display","none");
							}
							else
							{
								$("#"+currentheader+"block").css("display","none");
							}
						}
						else
						{
							$('#'+nextcolheader).prop("disabled", true);

							if(response == "Yes" || response == "Possibly")
							{
								current_gross = current_gross + parseFloat(cost);
								$("#CRMGross").val(current_gross.toFixed(2));
								$("#"+currentheader+"block").css("display","none");
							}
							else
							{
								$("#"+currentheader+"block").css("display","none");
							}
						}
					}
					else
					{
						if(response == "Yes" || response == "Possibly")
						{
							current_gross = current_gross + parseFloat(cost);
							$("#CRMGross").val(current_gross.toFixed(2));
							$("#"+currentheader+"block").css("display","none");
						}
						else
						{
							$("#"+currentheader+"block").css("display","none");
						}
					}
					
				}});

    		}
    	}
    }
//-----------------------------------------------------------------------------------------------------------------	
	// Check if has child questions
	// $.ajax({
	// 	url: "api/questions/childcount", 
	// 	type: 'GET',
	// 	data: {"colheader":currentheader},
	// 	success: function(result){
	// 		if(result > 0) 
	// 		{
	// 			/*
	// 			 Get the first child question and enable it
	// 			 if the enable response if met				
	// 			*/
	// 			//console.log("First child is "+currentheader+"_1");
	// 			$.ajax({
	// 				url: "api/questions/childresponse", 
	// 				type: 'GET',
	// 				data: {"childheader":currentheader+"_1"},
	// 				success: function(child_response){
	// 					//console.log("First child response is "+child_response);
						// if($("#"+currentheader).val() == child_response)
						// {
						// 	$('#'+currentheader+"_1").prop("disabled", false);

						// 	if(response == "Yes" || response == "Possibly")
						// 	{
						// 		current_gross = current_gross + parseFloat(cost);
						// 		$("#CRMGross").val(current_gross.toFixed(2));
						// 		$("#"+currentheader+"block").css("display","none");
						// 	}
						// 	else
						// 	{
						// 		$("#"+currentheader+"block").css("display","none");
						// 	}
						// }
						// else
						// {
						// 	$('#'+currentheader+"_1").prop("disabled", true);

						// 	if(response == "Yes" || response == "Possibly")
						// 	{
						// 		current_gross = current_gross + parseFloat(cost);
						// 		$("#CRMGross").val(current_gross.toFixed(2));
						// 		$("#"+currentheader+"block").css("display","none");
						// 	}
						// 	else
						// 	{
						// 		$("#"+currentheader+"block").css("display","none");
						// 	}
						// }
	// 				}
	// 			});			
	// 		}
	// 		else
	// 		{
	// 			// Handle the first child to the last
	// 			//console.log("Has no child");	 
	// 			//console.log(currentheader);
	// 			// Get current child sort number
	// 			$.ajax({
	// 				url: "api/questions/childsort", 
	// 				type: 'GET',
	// 				data: {"childheader":currentheader},
	// 				success: function(childsort){
	// 					var myObj = $.parseJSON(childsort);
	// 					var nextChildSort = parseInt(myObj.child_sort_num)+1;
	// 					var parent = myObj.parent_colheader;
	// 					var nextcolheader = parent+"_"+nextChildSort;

	// 					$.ajax({
	// 						url: "api/questions/checkchild", 
	// 						type: 'GET',
	// 						data: {"parent":parent, "colheader" : nextcolheader},
	// 						success: function(result){
	// 						var myObjResult = $.parseJSON(result);
	// 						if(myObjResult.count > 0)
	// 						{
	// 							if($("#"+currentheader).val() == myObjResult.response)
	// 							{
	// 								$('#'+nextcolheader).prop("disabled", false);

	// 								if(response == "Yes" || response == "Possibly")
	// 								{
	// 									current_gross = current_gross + parseFloat(cost);
	// 									$("#CRMGross").val(current_gross.toFixed(2));
	// 									$("#"+currentheader+"block").css("display","none");
	// 								}
	// 								else
	// 								{
	// 									$("#"+currentheader+"block").css("display","none");
	// 								}
	// 							}
	// 							else
	// 							{
	// 								$('#'+nextcolheader).prop("disabled", true);

	// 								if(response == "Yes" || response == "Possibly")
	// 								{
	// 									current_gross = current_gross + parseFloat(cost);
	// 									$("#CRMGross").val(current_gross.toFixed(2));
	// 									$("#"+currentheader+"block").css("display","none");
	// 								}
	// 								else
	// 								{
	// 									$("#"+currentheader+"block").css("display","none");
	// 								}
	// 							}
	// 						}
	// 						else
	// 						{
	// 							if(response == "Yes" || response == "Possibly")
	// 							{
	// 								current_gross = current_gross + parseFloat(cost);
	// 								$("#CRMGross").val(current_gross.toFixed(2));
	// 								$("#"+currentheader+"block").css("display","none");
	// 							}
	// 							else
	// 							{
	// 								$("#"+currentheader+"block").css("display","none");
	// 							}
	// 						}
							
	// 					}});

	// 				}
	// 			});	

	// 		}

	// 	}
	// });

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

	
    //console.log(data);
	$.each(data, function(key,value) {
		// Make an array variable where you will store the Restriction Name and Loop thru it
		var getRestrictions = [];
		var count = 0;
		var flag = 0; 

		if(value.is_child == 0) // Check if parent question
		{
			//console.log(value.columnheader+" is a parent question.");
			//console.log(value.agerestriction+" is agerestriction");

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

			if(getRestrictions.length == 0) // If has no restriction then enable the question
			{
				$('#'+value.columnheader).prop("disabled", false);
			}
			else
			{
				// Apply restriction rule
				$.each(getRestrictions, function(key2, value2)
				{
					if(value2 == "agebracket")
					{
						if(value.agebracket == age)
						{
							//console.log("Age is in.");
							//console.log("Flag is "+flag);
							//console.log("Count is "+count);
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
										//console.log("Postcode " + postcodes[i] + " is not allowed");
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
										//console.log("Postcode " + postcodes[i] + " is not allowed");
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

			}
			//console.log(getRestrictions);

			// if(value.child_count > 0)
			// {
   //             //console.log("This has child questions with "+value.child_count+" child questions");
			// }

		}
		else
		{
			//console.log(value.columnheader+" is a child question.");
			//console.log(value.columnheader+" value is "+value.costperlead);
			//console.log(value.columnheader+" response enable is "+value.child_enable_response);
			//console.log(value.columnheader+" parent is "+value.parent_colheader);
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
			$("#customer_id").val(myObj.id);

			alert("Record found for "+myObj.title+" "+myObj.firstname+" "+myObj.lastname);
		}
		else
		{
			alert("No result found.")
		}
		
	}});
	
});

$("#btnGenerate").click(function() {
	     var num = parseInt($("#numGenerate").val());
	     var html = '';
	     var columnheader = $("#ColumnHeader").val();

	     for(var i = 1; i <= num ; i++)
	     {
	     	html = '<tr><td>'+columnheader+'_'+i+'</td><td><textarea name="'+columnheader+'_'+i+'" id="'+columnheader+'_'+i+'"> Content here.. </textarea></td><td><input type="text" class="form-control" placeholder="Enter Cost" name="'+columnheader+'_'+i+'_cost'+'"></td><td><div><select class="form-control" name="'+columnheader+'_'+i+'_response'+'"><option value="">Response</option><option value="Yes">Yes</option><option value="Possibly">Possibly</option></select></td></tr>';
	     	$('#scripts').append(html);
	     }

	     for(var x = 1; x <= num ; x++)
	     {
	     	$('#'+columnheader+'_'+x).summernote();
	     	//console.log("in");
	     }
	     
	    $('#NumberOfScripts').val(num);
 		
});																		