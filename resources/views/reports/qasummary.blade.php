@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fromDatetimeAll" id="fromDatetimeAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="toDatetimeAll" id="toDatetimeAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Agent Name</label>
							<div class="col-md-6">
								{!! Form::select('agent_nameQaSummary', $agent_name, '',array('class' => 'form-control', 'id' => 'agent_nameQaSummary')) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Disposition</label>
							<div class="col-md-6">
								<select name="dispositionQaSummary" id="dispositionQaSummary" class="form-control">
									<option value="Completed Survey">Completed Survey</option>
									<option value="MCS Record">MCS Record</option>
									<option value="Hibernate">Hibernate</option>
									<option value="All" selected="">All</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control" name="verified_statusQaSummary" id="verified_statusQaSummary">
									<option value="All">All</option>
									<option value="On The Proccess">On The Proccess</option>
									<option value="Unverified">Unverified</option>
									<option value="Passed">Passed</option>
									<option value="Passed-Approved">Passed-Approved</option>
									<option value="Passed-With Changes">Passed-With Changes</option>
									<option value="Passed-Unverified">Passed-Unverified</option>
									<option value="Reject A">Reject A</option>
									<option value="Reject B">Reject B</option>
									<option value="Reject C">Reject C</option>
									<option value="Pending">Pending</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="submitQaSummary" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div id="showFullDetails" class="collapse out">
	        	<div class="panel panel-info">
					<div class="panel-heading">Question Responses</div>
					<div class="panel-body">
						<table id="SummaryReportResponses" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>Column Header</th>
	                                <th>Response</th>
	                            </tr>
	                        </thead>
	                        <tbody></tbody>
	                    </table>
					</div> 
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
                    <table id="SummaryReportA" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Disposition</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
                    <table id="SummaryReportB" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Verified By</th>
                                <th>Verified Status</th>
                                <th>Pass with Changes</th>
                                <th>Comments</th>
                                <th>Gross</th>
                                <th>Title</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Show All</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
@section('qasummary')
<script type="text/javascript">
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
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
			data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val(), "agent" :  $("#agent_nameQaSummary").val(), "disposition" :  $("#dispositionQaSummary").val(), "verifiedstatus" :  $("#verified_statusQaSummary").val()},
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
</script>
@endsection
