// var themes = {
//     "default": "//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css",
//     "amelia" : "//bootswatch.com/amelia/bootstrap.min.css",
//     "cerulean" : "//bootswatch.com/cerulean/bootstrap.min.css",
//     "cosmo" : "//bootswatch.com/cosmo/bootstrap.min.css",
//     "cyborg" : "//bootswatch.com/cyborg/bootstrap.min.css",
//     "flatly" : "//bootswatch.com/flatly/bootstrap.min.css",
//     "journal" : "//bootswatch.com/journal/bootstrap.min.css",
//     "readable" : "//bootswatch.com/readable/bootstrap.min.css",
//     "simplex" : "//bootswatch.com/simplex/bootstrap.min.css",
//     "slate" : "//bootswatch.com/slate/bootstrap.min.css",
//     "spacelab" : "//bootswatch.com/spacelab/bootstrap.min.css",
//     "united" : "//bootswatch.com/united/bootstrap.min.css"
// }

// $(function(){
//    var themesheet = $('<link href="'+themes['cosmo']+'" rel="stylesheet" />');
//     themesheet.appendTo('head');
//     $('.theme-link').click(function(){
//        var themeurl = themes[$(this).attr('data-theme')]; 
//         themesheet.attr('href',themeurl);
//     });
// });


$('#Question').summernote();
$('#comments').summernote();
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
	                parent_enable_response: value.parent_enable_response,
	                child_lead_respponse: value.child_lead_respponse,
				});
			});
			
		}});
});


jQuery('#fromDateAgentPer').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#toDateAgentPer').datetimepicker({
  format:'Y-m-d H:i:s',
});


jQuery('#fromDateCharityRes').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#toDateCharityRes').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#fromQaSummary').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#toQaSummary').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#loginHoursFrom').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#loginHoursTo').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#fromVerifierReport').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#toVerifierReport').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#birthdate').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});


$("#sortLoginHours").click(function() {
	if($.fn.dataTable.isDataTable('#LoginHourList')) 
	{	
		table.destroy();
		table = $('#LoginHourList').DataTable();
		table.clear().draw();
		var tt = new $.fn.dataTable.TableTools( table );
		$( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
		$.ajax({
		url: "api/loginhours/filter", 
		type: 'GET',
		data: {"from" : $("#loginHoursFrom").val(), "to" :  $("#loginHoursTo").val()},
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
	    		table.row.add( [
		            value.id,	
		            value.name,	
		            value.created_at,	
		            value.lastlogout,
		             value.loginhours,
		            status,	
	        	] ).draw();
			});
		}});
	}
    else 
    {
	   table = $('#LoginHourList').DataTable();
	   $.ajax({
		url: "api/loginhours/filter", 
		type: 'GET',
		data: {"from" : $("#loginHoursFrom").val(), "to" :  $("#loginHoursTo").val()},
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
			    		table.row.add( [
				            value.id,	
				            value.name,	
				            value.created_at,	
				            value.lastlogout,
				             value.loginhours,
				            status,	
			        	] ).draw();
					});
		}});

	    var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	}
	
});


$("#btnDateCharityRes").click(function() {
	var totalyes = 0;
	var totalno = 0;
	var totalpossibly = 0;
	var totalrev = 0;

	if($.fn.dataTable.isDataTable('#CharityResponses')) 
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
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseFloat(value.revenue); 

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
			$("#CharityRepTotalYes").html(totalyes);
			$("#CharityRepTotalNo").html(totalno);
			$("#CharityRepTotalPossib").html(totalpossibly);
			$("#CharityRepTotalRev").html(totalrev.toFixed(2));
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
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseInt(value.revenue); 

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
			$("#CharityRepTotalYes").html(totalyes);
			$("#CharityRepTotalNo").html(totalno);
			$("#CharityRepTotalPossib").html(totalpossibly);
			$("#CharityRepTotalRev").html(totalrev.toFixed(2));
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	}
	
});

$("#btnDateAgentPer").click(function() {
	var sph = 0;
	if($.fn.dataTable.isDataTable('#AgentPerformance')) 
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
	    		sph = Math.round((parseInt(value.completedsurvey) + parseInt(value.partial_survey)) / parseFloat(value.totalloginhours));
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.completedsurvey,
		            value.partial_survey,
		            value.applicationperhour,
		            value.rph,
		            sph.toFixed(2),
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
	    		sph = Math.round((parseInt(value.completedsurvey) + parseInt(value.partial_survey)) / parseFloat(value.totalloginhours));
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.completedsurvey,
		            value.partial_survey,
		            value.applicationperhour,
		            value.rph,
		            sph.toFixed(2),
	        	] ).draw();
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	
});

$("#submitVerifierReport").click(function() {
	if($.fn.dataTable.isDataTable('#VerifierReport')) 
	{
    	table.destroy();
    	table = $('#VerifierReport').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
    	$.ajax({
		url: "api/crm/verifierreport", 
		type: 'GET',
		data: {"from" : $("#fromVerifierReport").val(), "to" :  $("#toVerifierReport").val(), "qa_name" : $("#qa_name").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
		var allTotal = 0;
		var ctr = 1;
		var totalPassed = 0;
		var totalPassedApprove = 0;
		var totalPassedChanges = 0;
		var totalPassedUnverified = 0;
		var totalPending = 0;
		var totalRejectA = 0;
		var totalRejectB = 0;
		var totalRejectC = 0;
		var totalTotal = 0;
	    	$.each(myObj, function(key,value) {
	    		totalPassed += parseInt(value.passed);
	    		totalPassedApprove += parseInt(value.passed_approved);
	    		totalPassedChanges += parseInt(value.passed_changes);
	    		totalPassedUnverified += parseInt(value.passed_unverified);
	    		totalPending += parseInt(value.pending);
	    		totalRejectA += parseInt(value.reject_a);
	    		totalRejectB += parseInt(value.reject_b);
	    		totalRejectC += parseInt(value.reject_c);
	    		allTotal = parseInt(value.passed) + parseInt(value.passed_approved) + parseInt(value.passed_changes) + parseInt(value.passed_unverified) + parseInt(value.pending) + parseInt(value.reject_a) + parseInt(value.reject_b) + parseInt(value.reject_c);
	    		totalTotal += parseInt(allTotal);
	    		table.row.add( [
	    			ctr,
		            value.verified_by,	
		            value.passed,
		            value.passed_approved,
		            value.passed_changes,
		            value.passed_unverified,
		            value.pending,
		            value.reject_a,
		            value.reject_b,
		            value.reject_c,
		            allTotal
	        	] ).draw();
	        	ctr++;
			});
			$('#totalPassed').html(totalPassed);
			$('#totalPassedApprove').html(totalPassedApprove);
			$('#totalPassedChanges').html(totalPassedChanges);
			$('#totalPassedUnverified').html(totalPassedUnverified);
			$('#totalPending').html(totalPending);
			$('#totalRejectA').html(totalRejectA);
			$('#totalRejectB').html(totalRejectB);
			$('#totalRejectC').html(totalRejectC);
			$('#totalTotal').html(totalTotal);
		}});
	}
	else
	{
		table = $('#VerifierReport').DataTable();
		$.ajax({
		url: "api/crm/verifierreport", 
		type: 'GET',
		data: {"from" : $("#fromVerifierReport").val(), "to" :  $("#toVerifierReport").val(), "qa_name" : $("#qa_name").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
		var allTotal = 0;
		var ctr = 1;
		var totalPassed = 0;
		var totalPassedApprove = 0;
		var totalPassedChanges = 0;
		var totalPassedUnverified = 0;
		var totalPending = 0;
		var totalRejectA = 0;
		var totalRejectB = 0;
		var totalRejectC = 0;
		var totalTotal = 0;
	    	$.each(myObj, function(key,value) {
	    		totalPassed += parseInt(value.passed);
	    		totalPassedApprove += parseInt(value.passed_approved);
	    		totalPassedChanges += parseInt(value.passed_changes);
	    		totalPassedUnverified += parseInt(value.passed_unverified);
	    		totalPending += parseInt(value.pending);
	    		totalRejectA += parseInt(value.reject_a);
	    		totalRejectB += parseInt(value.reject_b);
	    		totalRejectC += parseInt(value.reject_c);
	    		allTotal = parseInt(value.passed) + parseInt(value.passed_approved) + parseInt(value.passed_changes) + parseInt(value.passed_unverified) + parseInt(value.pending) + parseInt(value.reject_a) + parseInt(value.reject_b) + parseInt(value.reject_c);
	    		totalTotal += parseInt(allTotal);
	    		table.row.add( [
	    			ctr,
		            value.verified_by,	
		            value.passed,
		            value.passed_approved,
		            value.passed_changes,
		            value.passed_unverified,
		            value.pending,
		            value.reject_a,
		            value.reject_b,
		            value.reject_c,
		            allTotal
	        	] ).draw();
	        	ctr++;
			});
			$('#totalPassed').html(totalPassed);
			$('#totalPassedApprove').html(totalPassedApprove);
			$('#totalPassedChanges').html(totalPassedChanges);
			$('#totalPassedUnverified').html(totalPassedUnverified);
			$('#totalPending').html(totalPending);
			$('#totalRejectA').html(totalRejectA);
			$('#totalRejectB').html(totalRejectB);
			$('#totalRejectC').html(totalRejectC);
			$('#totalTotal').html(totalTotal);
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	    
});

$("#submitQaSummary").click(function() {
	if($.fn.dataTable.isDataTable('#SummaryReportA')) 
	{
		table.destroy();
    	table = $('#SummaryReportA').DataTable();
    	table2.destroy();
    	table2 = $('#SummaryReportB').DataTable();
    	table.clear().draw();
    	table2.clear().draw();
    	// var tt = new $.fn.dataTable.TableTools( table );
    	// var tt2 = new $.fn.dataTable.TableTools( table2 );
    	$.ajax({
		url: "api/crm/qasummary", 
		type: 'GET',
		data: {"from" : $("#fromQaSummary").val(), "to" :  $("#toQaSummary").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
		success: function(result){
			var myObj = $.parseJSON(result);
			$.each(myObj, function(key,value) { 
				table.row.add( [
		            value.disposition,	
		            value.verified_status,
		            value.totalcount
	    		] ).draw();
			});

			$.ajax({
			url: "api/crm/qasummary2", 
			type: 'GET',
			data: {"from" : $("#fromQaSummary").val(), "to" :  $("#toQaSummary").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
			success: function(result2){
				var myObj2 = $.parseJSON(result2);
				$.each(myObj2, function(key,value2) { 
					table2.row.add( [
					  value2.verified_by,
			          value2.verified_status,
			          value2.passwithchanges_status,
			          value2.comments,
			          value2.gross,
			          value2.title,
			          value2.firstname,
			          value2.surname,
			          '<button type="button" class="btn btn-info" data-toggle="collapse" id="showBtnFullDetails" data-target="#showFullDetails" value="'+value2.id+'">Show Responses</button>'
		    		] ).draw();
				});	
			}});

		}});
	}
	else
	{
		table = $('#SummaryReportA').DataTable();
		table2 = $('#SummaryReportB').DataTable();
		$.ajax({
			url: "api/crm/qasummary", 
			type: 'GET',
			data: {"from" : $("#fromQaSummary").val(), "to" :  $("#toQaSummary").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
			success: function(result){
			var myObj = $.parseJSON(result);
			$.each(myObj, function(key,value) { 
				table.row.add( [
		            value.disposition,	
		            value.verified_status,
		            value.totalcount
	    		] ).draw();
			});

			$.ajax({
			url: "api/crm/qasummary2", 
			type: 'GET',
			data: {"from" : $("#fromQaSummary").val(), "to" :  $("#toQaSummary").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
			success: function(result2){
				var myObj2 = $.parseJSON(result2);
				$.each(myObj2, function(key,value2) { 
					table2.row.add( [
			          value2.verified_by,
			          value2.verified_status,
			          value2.passwithchanges_status,
			          value2.comments,
			          value2.gross,
			          value2.title,
			          value2.firstname,
			          value2.surname,
			          '<button type="button" class="btn btn-info" data-toggle="collapse" id="showBtnFullDetails" data-target="#showFullDetails" value="'+value2.id+'">Show Responses</button>'
		    		] ).draw();
				});	
			}});


		}});

		// var tt = new $.fn.dataTable.TableTools( table );
	 //    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	 //    var tt2 = new $.fn.dataTable.TableTools( table2 );
	 //    $( tt2.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
});


$(document).on("click", "#showBtnFullDetails", function() {
	var id = $("#showBtnFullDetails").val();
	table = $('#SummaryReportResponses').DataTable();
	$.ajax({
	url: "api/crm/getqaresponses/"+id, 
	type: 'GET',
	success: function(result){
		var myObj = $.parseJSON(result);
		$.each(myObj, function(key,value) { 
			table.row.add( [
		        value.columnheader,	
		        value.response
			] ).draw();
		});	
	}});

});

function get_response(id)
{
	var lastIndex = records.length - 1;
	// console.log(lastIndex);
	// console.log(records);
	var currentheader = $(id).attr('id');
	var current_gross = parseFloat($("#CRMGross").val());
	var cost 	 = $("#hidden_val_"+currentheader).attr('value');
	var response = $("#"+currentheader).val();
	var counter  = 1;
	var parent_response_enable = records[0].parent_enable_response.split(',');
	//console.log(parent_response_enable);

    var result = $.grep(records, function(e){ return e.columnheader == currentheader; });


    if (result.length == 1)
    {
    	console.log("Child count is "+result[0].child_count)
    	if(result[0].child_count > 0)
    	{
    		 console.log("Has child questions.");
    		 var childresponse = $.grep(records, function(e){ return e.columnheader == currentheader+"_1"; });
    		 var child_response_enable = childresponse[0].child_enable_response.split(',');
    		
    		 if(childresponse.length == 1)
    		 {
	 			if($.inArray($("#"+currentheader).val(), child_response_enable) >= 0)
				{
					
					$('#'+currentheader+"_1").prop("disabled", false);

					if($.inArray(response, parent_response_enable) >= 0)
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

					if($.inArray(response, parent_response_enable) >= 0)
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
    		console.log("No child questions.");
    		var childsort = $.grep(records, function(e){ return e.columnheader == currentheader; });
    		
    		console.log(childsort[0].is_child);
    		if(childsort[0].is_child == 0) // Check if the current question is a parent question with no child
    		{
    			var parent_lead_response = childsort[0].parent_enable_response.split(",");
   
    			if($.inArray(response, parent_lead_response) >= 0)
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
    			if(childsort.length == 1)
	    		{
	    			var nextChildSort = parseInt(childsort[0].child_sort_num)+1;
	    			console.log("##");
	    			console.log(nextChildSort);
	    			var parent = childsort[0].parent_colheader;
	    			var nextcolheader2 = parent+"_"+nextChildSort;
	    			var nextcolheader = parent+"_"+childsort[0].child_sort_num;

	    			console.log(parent);
	    			console.log(nextcolheader);
	    			console.log(records);
	    			console.log(childsort[0].child_sort_num);
	    			console.log("^");

	    			var checkchild = $.grep(records, function(e){ return e.parent_colheader == parent && e.columnheader == nextcolheader; });
	    			var child_lead_respponse = checkchild[0].child_lead_respponse.split(',');
	    			console.log(checkchild);
	    			console.log(child_lead_respponse);

	    		
	    			
	    			if(checkchild.length == 1)
	    		    {
			    		
			    		if($.inArray($("#"+currentheader).val(), child_lead_respponse) >= 0)
						{
							$('#'+nextcolheader2).prop("disabled", false);

							if($.inArray(response, child_lead_respponse) >= 0)
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
							$('#'+nextcolheader2).prop("disabled", true);

							if($.inArray(response, parent_response_enable) >= 0)
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
			    		if($.inArray(response, child_lead_respponse) >= 0)
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
    	
    		
    	}
    }

    //console.log(lastItem);
    // if($("#"+lastItem).val() != "")
    // {
    // 	//$("#DispositionDiv").css("display","block");
    // 	$('#CrmDisposition').append($('<option>', {value: 'Completed Survey', text:'Completed Survey'}));
    // 	console.log("last last last");
    // }


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
		$('#CRMGross').val(0.20);

	}
	else
	{
		var current_gross = $('#CRMGross').val();
		var newgross = current_gross - 0.20;
		$('#CRMGross').val(newgross);
	}
	  	
});

$("#CrmIsUKPermanentResident").change(function() {

	var choosen = $("#CrmIsUKPermanentResident").val();

	if(choosen == "Yes")
	{
		$('#continueModal').modal('toggle');
	}
	else
	{
		$('#continueModal').modal('hide');
	}
	  	
});

$("#CrmDisposition").change(function() {

	var choosen = $("#CrmDisposition").val();

	if(choosen != "")
	{
		$("#CrmSubmitDiv").css("display","block");
	}
	else
	{
		$("#CrmSubmitDiv").css("display","none");
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



function changeEnable(id)
{
	var val 	= $(id).attr('id');
	var ischeck = $("#"+val).is(":checked");

	alert(ischeck);
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

// $.ajax({
// 	url: "api/loginhours/all",
// 	type: 'GET',
// 	success: function(result){
// 	var myObj = $.parseJSON(result);
//     	$.each(myObj, function(key,value) {
    		
//     		if(value.status == 1)
//     		{
//     			var status = "Logged-In";
//     		}
//     		else
//     		{
//     			var status = "Logged-Out";
//     		}
//     		var t = $('#LoginHourList').DataTable();

//     		t.row.add( [
// 	            value.name,
// 	            value.date,
// 	            status,
// 	            value.loginhours,
//         	] ).draw();
    		
// 		});
// 	}}).error(function(){
// 		  progress.progressTimer('error', {
// 		  errorText:'ERROR!',
// 		  onFinish:function(){
// 		    alert('There was an error processing your information!');
// 		  }
// 		});
// 	}).done(function(){
// 			progress.progressTimer('complete');
// 			$( "#progressbar" ).fadeOut( "slow" );
// 	});


var lastItem = "";
var enabled_questions = [];
var check_questions = [];
$("#trigger").click(function() {
var isPermanentResident = $('#CrmIsUKPermanentResident').val();	
var phoneType = $('#CRMTelephoneOptions').val();	
var ageBracket = $('#CrmAge').val();	
var workStatus = $('#CRMWorkStatus').val();	
var homeStatus = $('#CRMOwnHomeOptions').val();	
var civilStatus = $('#CRMMaritalStatus').val();

if(phoneType == "" || ageBracket == "" || workStatus == "" || homeStatus == "" || civilStatus == "")
{
	alert("Please select answer on the required fields.");
}
else
{
	$("#CRMTable").css("display","block");		
var age = $("#CrmAge").val();
var CRMPostcode = $("#CRMPostcode").val();
var CRMTelephoneOptions = $("#CRMTelephoneOptions").val();
var CRMOwnHomeOptions = $("#CRMOwnHomeOptions").val();

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
				//console.log(getRestrictions);
				// Apply restriction rule
				$.each(getRestrictions, function(key2, value2)
				{
					//console.log("Loop on "+ value2);
					if(value2 == "agebracket")
					{
						var QuesAge = value.agebracket.split('-');
						var minQuesAge = QuesAge[0];
						var maxQuesAge = QuesAge[1];

						var CustomerAge = age.split('-');
						var minCusAge = CustomerAge[0];
						var maxCusAge = CustomerAge[1];

						
						if(parseInt(minCusAge) >= parseInt(minQuesAge) && parseInt(maxCusAge) <= parseInt(maxQuesAge))
						{
							flag++;
							console.log("age is satisfied, flag value is "+flag+ ", while count is "+count);
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
						var ownHomeRestrictions = value.ownhomeoptions.split(',');
						var find = $.inArray(CRMOwnHomeOptions, ownHomeRestrictions);

						if(find >= 0)
						{
							
							flag++;
							console.log("own home, flag value is "+flag+ ", while count is "+count);
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
					    else
					    {	
							$('#'+value.columnheader).prop("disabled", true);

					    }
					}
					if(value2 == "postcodeexclusion")
					{
						//console.log("it goes into exclusion");
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
					    else
					    {
					    	flag++;
							if(flag == count)
							{
								
								$('#'+value.columnheader).prop("disabled", false);
							}
					    }
					}

				});

			}
		}
		
	});

	/* Remove restricted questions on the table */
	$.each(data, function(key,value) {
		var colheader = value.columnheader;
		var child_count = value.child_count;
		var is_child = value.is_child;
		var isDisabled = $("#"+colheader).is(':disabled');
		if (isDisabled && child_count > 0) 
		{
			if(child_count > 0 && is_child == 0)
			{
				// console.log("Has child questions");
				// console.log("Parent question.");
				// console.log(child_count);
				$('table#CRMTable tr#'+colheader+"block").remove();
				//console.log(colheader+" is removed. Tier 1a.");
				for(var g = 1; g <= child_count; g++)
				{
					$('table#CRMTable tr#'+colheader+"_"+g+"block").remove();
					console.log(colheader+"_"+g+" is in the child loop.");
					arr = data.filter(function(e) { return e.columnheader !== colheader+"_"+g });
					check_questions.push(colheader+"_"+g);
					//console.log(arr);
				}
			}
			else
			{
				$('table#CRMTable tr#'+colheader+"block").remove();
				//console.log(colheader+" is removed. Tier 2.");
			}
	    }
	    else if(isDisabled && is_child == 0)
	    {
	    	$('table#CRMTable tr#'+colheader+"block").remove();
	    	//console.log(colheader+" is removed. Tier 3.");
	    }
	    else
	    {
	    	var checkRemove = $.grep(check_questions, function(e){ return e == colheader; });
	    	if(checkRemove != colheader)
	    	{
	    		enabled_questions.push(colheader);
	    	}
	    	//lastItem = colheader;
	    } 
	});

	console.log("Last item is "+lastItem)
	console.log(enabled_questions)
	var len = enabled_questions.length;
	$.each(enabled_questions, function(key,value) {
		if(key > 0)
		{
			console.log(value);
			$('#'+value).prop("disabled", true);
		}

		if (key == len - 1) {
              lastItem = value;
              console.log("Last item is "+lastItem);
          }
		
	});
}	


});

function enable_next(id)
{
	var currentheader = $(id).attr('id');
	var response = $("#"+currentheader).val();
	var current_index = $.inArray( currentheader, enabled_questions );
	var next_index = parseInt(current_index) + 1;

	console.log("Enabling "+enabled_questions[next_index]);
	console.log(enabled_questions)

	$('#'+enabled_questions[next_index]).prop("disabled", false);

}

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
			//console.log("Record found for "+myObj.title+" "+myObj.firstname+" "+myObj.lastname);
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
     	html = '<tr><td>'+columnheader+'_'+i+'</td><td><textarea name="'+columnheader+'_'+i+'" id="'+columnheader+'_'+i+'"> Content here.. </textarea></td><td><input type="text" class="form-control" placeholder="Enter Cost" name="'+columnheader+'_'+i+'_cost'+'"></td><td><div><input type="text" class="form-control" name="'+columnheader+'_'+i+'_response'+'" placeholder="Response Activation" ><input type="text" class="form-control" name="'+columnheader+'_'+i+'_response_activate'+'" placeholder="Lead Response"></td></tr>';
     	$('#scripts').append(html);
     }

     for(var x = 1; x <= num ; x++)
     {
     	$('#'+columnheader+'_'+x).summernote();
     }
     
    $('#NumberOfScripts').val(num);
});	

$("#verified_status").change(function() {
	if($("#verified_status").val() == "Passed-With Changes")
	{
		$('#passwithchanges_status').prop("disabled", false); 
	}
	else
	{
		$('#passwithchanges_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject A")
	{
		$('#reject_a_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_a_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject B")
	{
		$('#reject_b_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_b_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject C")
	{
		$('#reject_c_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_c_status').prop("disabled", true); 
	}

});

$("#re_verified_status").change(function() {
	var re_ver_status = $("#re_verified_status").val();

	if(re_ver_status == "On The Proccess" || re_ver_status == "Unverified" || re_ver_status == "Passed" || re_ver_status == "Passed-Approved" || re_ver_status == "Passed-Unverified" || re_ver_status == "Pending")
	{
		$("#reject_a_status").val("");
		$("#reject_b_status").val("");
		$("#reject_c_status").val("");
		$("#passwithchanges_status").val("");
	}


	$("#verified_status").val(re_ver_status);
	if(re_ver_status == "Passed-With Changes")
	{
		$('#re_passwithchanges_status').prop("disabled", false); 
		$("#re_reject_a_status").val(0);
		$("#re_reject_b_status").val(0);
		$("#re_reject_c_status").val(0);
		$("#reject_a_status").val("");
		$("#reject_b_status").val("");
		$("#reject_c_status").val("");

	}
	else
	{
		$('#re_passwithchanges_status').prop("disabled", true); 
	}


	if(re_ver_status == "Reject A")
	{
		$('#re_reject_a_status').prop("disabled", false); 

		$("#re_reject_b_status").val(0);
		$("#re_reject_c_status").val(0);
		$("#re_passwithchanges_status").val(0);
		$("#passwithchanges_status").val("");
		$("#reject_b_status").val("");
		$("#reject_c_status").val("");
	}
	else
	{
		$('#re_reject_a_status').prop("disabled", true); 
	}

	if(re_ver_status == "Reject B")
	{
		$('#re_reject_b_status').prop("disabled", false); 
		$("#re_reject_a_status").val(0);
		$("#re_reject_c_status").val(0);
		$("#re_passwithchanges_status").val(0);
		$("#passwithchanges_status").val("");
		$("#reject_a_status").val("");
		$("#reject_c_status").val("");
	}
	else
	{
		$('#re_reject_b_status').prop("disabled", true); 
	}

	if(re_ver_status == "Reject C")
	{
		$('#re_reject_c_status').prop("disabled", false); 
		$("#re_reject_a_status").val(0);
		$("#re_reject_b_status").val(0);
		$("#re_passwithchanges_status").val(0);
		$("#passwithchanges_status").val("");
		$("#reject_a_status").val("");
		$("#reject_b_status").val("");
	}
	else
	{
		$('#re_reject_c_status').prop("disabled", true); 
	}
});

$("#re_passwithchanges_status").change(function() { $("#passwithchanges_status").val($("#re_passwithchanges_status").val()); });
$("#re_reject_a_status").change(function() { $("#reject_a_status").val($("#re_reject_a_status").val()); });
$("#re_reject_b_status").change(function() { $("#reject_b_status").val($("#re_reject_b_status").val()); });
$("#re_reject_c_status").change(function() { $("#reject_c_status").val($("#re_reject_c_status").val()); });

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


// $("#checkUpdateRevenue").change(function() {
	// var updated_response = $("#checkUpdateRevenue").val();
	// var colheader = $('#checkUpdateRevenue').attr('name');
	// $('#new_gross').val("Joene"); 
	// console.log(colheader);

	// $.ajax({
	// url: "qa/api/crm/getquestion", 
	// type: 'GET',
	// data: {'colheader':colheader},
	// success: function(result){
	// 	//var myObj = $.parseJSON(result);
	// 	console.log(result);
		
	// }});
// });

function verifyUpdateResponseGross(val)
{
	// var updated_response = val.value;
	// var colheader = val.name
	// var before_gross = $('#new_gross').val(); 

	// $.ajax({
	// url: "qa/api/crm/getquestion", 
	// type: 'GET',
	// data: {'colheader':colheader},
	// success: function(result){

	// 	$("#"+colheader).on("focus",function(){  
 //     		$(this).data('previous',$(this).val());
	// 	});

	// 	var previous = $("#"+colheader).data('previous');


	// 	console.log(previous);
	// 	console.log(updated_response);

	// 	var costperlead = result;
	// 	if(updated_response != "")
	// 	{
	// 		var new_gross_amount = parseFloat(before_gross) + parseFloat(costperlead);
	// 		$('#new_gross').val(new_gross_amount);
	// 	}
	// 	else
	// 	{
	// 		var new_gross_amount = parseFloat(before_gross) - parseFloat(costperlead);
	// 		$('#new_gross').val(new_gross_amount);
	// 	}
	// 	console.log(costperlead);
	// }});
}

$(document).ready(function(){
    var previous;
     $(".myselectbox").on("focus click",function () {
        previous = this.value; // Old vaue 

    }).change(function(e) {

    	var before_gross = $('#new_gross').val(); 
    	var value =  this.value; // New Value
    	var colheader = e.target.id;
    	var new_prev = previous;
      	

		$.ajax({
		url: "qa/api/crm/getquestion", 
		type: 'GET',
		data: {'colheader':colheader},
		success: function(result){
			var costperlead = result;
			if(new_prev == "" && value != "")
			{
				var new_gross_amount = parseFloat(before_gross) + parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			else if(new_prev =! "" && value == "")
			{	
				var new_gross_amount = parseFloat(before_gross) - parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			
		}});
    });

});

$(document).ready(function(){
    var previous;
     $(".myselectbox2").on("focus click",function () {
        previous = this.value; // Old vaue 

    }).change(function(e) {

    	var before_gross = $('#new_gross').val(); 
    	var value =  this.value; // New Value
    	var colheader = e.target.id;
    	var new_prev = previous;
      	
		$.ajax({
		url: "qa/api/crm/getquestion", 
		type: 'GET',
		data: {'colheader':colheader},
		success: function(result){
			var costperlead = result;
			if(new_prev == "" && value != "")
			{
				var new_gross_amount = parseFloat(before_gross) + parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			else if(new_prev =! "" && value == "")
			{	
				var new_gross_amount = parseFloat(before_gross) - parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			
		}});
    });

});
