@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Daily Verifier Report</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fromDateAll" id="fromDateAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="toDateAll" id="toDateAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Disposition</label>
							<div class="col-md-6">
								<select class="form-control" name="disposition" id="disposition">
									<option value="All">All</option>
									<option value="Completed Survey">Completed Survey</option>
									<option value="Partial Survey">Partial Survey</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="submitDailyVerifierReport" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Daily Verifier Report</div>
				<div class="panel-body">
                    <table id="DailyVerifierReport" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Passed-Approved</th>
                                <th>Passed-Changes</th>
                                <th>Passed-Unverified</th>
                                <th>Pending</th>
                                <th>Reject A</th>
                                <th>Reject B</th>
                                <th>Reject C</th>
                                <th>Unverified</th>
                                <th>On the process</th>
                                
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
							<tr>
								<td colspan="2">Total</td>
								<td id="totalPassedApprove"></td>
								<td id="totalPassedChanges"></td>
								<td id="totalPassedUnverified"></td>
								<td id="totalPending"></td>
								<td id="totalRejectA"></td>
								<td id="totalRejectB"></td>
								<td id="totalRejectC"></td>
								<td id="totalUnverified"></td>
								<td id="totalOnProcess"></td>
							</tr>
						</tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('dailyverifierreport')
<script type="text/javascript">
$("#submitDailyVerifierReport").click(function() {
	if($.fn.dataTable.isDataTable('#DailyVerifierReport')) 
	{
    	table.destroy();
    	table = $('#DailyVerifierReport').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
    	$.ajax({
		url: "api/crm/dailyverifierreport", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val(), "disposition" : $("#disposition").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
		var totalPassedApprove = 0;
		var totalPassedChanges = 0;
		var totalPassedUnverified = 0;
		var totalPending = 0;
		var totalRejectA = 0;
		var totalRejectB = 0;
		var totalRejectC = 0;
		var totalUnverified = 0;
		var totalOnProcess = 0;
	    	$.each(myObj, function(key,value) {
	    		totalPassedApprove += parseInt(value.passed_approved);
	    		totalPassedChanges += parseInt(value.passed_changes);
	    		totalPassedUnverified += parseInt(value.passed_unverified);
	    		totalPending += parseInt(value.pending);
	    		totalRejectA += parseInt(value.reject_a);
	    		totalRejectB += parseInt(value.reject_b);
	    		totalRejectC += parseInt(value.reject_c);
	    		totalUnverified += parseInt(value.unverified);
	    		totalOnProcess += parseInt(value.on_the_process);
	    		table.row.add( [
		            value.start_date,	
		            value.end_date,
		            value.passed_approved,
		            value.passed_changes,
		            value.passed_unverified,
		            value.pending,
		            value.reject_a,
		            value.reject_b,
		            value.reject_c,
		            value.unverified,
		            value.on_the_process
	        	] ).draw();
			});
			$('#totalPassedApprove').html(totalPassedApprove);
			$('#totalPassedChanges').html(totalPassedChanges);
			$('#totalPassedUnverified').html(totalPassedUnverified);
			$('#totalPending').html(totalPending);
			$('#totalRejectA').html(totalRejectA);
			$('#totalRejectB').html(totalRejectB);
			$('#totalRejectC').html(totalRejectC);
			$('#totalUnverified').html(totalUnverified);
			$('#totalOnProcess').html(totalOnProcess);
		}});
	}
	else
	{
		table = $('#DailyVerifierReport').DataTable();
		$.ajax({
		url: "api/crm/dailyverifierreport", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val(), "disposition" : $("#disposition").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
		var totalPassedApprove = 0;
		var totalPassedChanges = 0;
		var totalPassedUnverified = 0;
		var totalPending = 0;
		var totalRejectA = 0;
		var totalRejectB = 0;
		var totalRejectC = 0;
		var totalUnverified = 0;
		var totalOnProcess = 0;
	    	$.each(myObj, function(key,value) {
	    		totalPassedApprove += parseInt(value.passed_approved);
	    		totalPassedChanges += parseInt(value.passed_changes);
	    		totalPassedUnverified += parseInt(value.passed_unverified);
	    		totalPending += parseInt(value.pending);
	    		totalRejectA += parseInt(value.reject_a);
	    		totalRejectB += parseInt(value.reject_b);
	    		totalRejectC += parseInt(value.reject_c);
	    		totalUnverified += parseInt(value.unverified);
	    		totalOnProcess += parseInt(value.on_the_process);
	    		table.row.add( [
		            value.start_date,	
		            value.end_date,
		            value.passed_approved,
		            value.passed_changes,
		            value.passed_unverified,
		            value.pending,
		            value.reject_a,
		            value.reject_b,
		            value.reject_c,
		            value.unverified,
		            value.on_the_process
	        	] ).draw();
			});
			$('#totalPassedApprove').html(totalPassedApprove);
			$('#totalPassedChanges').html(totalPassedChanges);
			$('#totalPassedUnverified').html(totalPassedUnverified);
			$('#totalPending').html(totalPending);
			$('#totalRejectA').html(totalRejectA);
			$('#totalRejectB').html(totalRejectB);
			$('#totalRejectC').html(totalRejectC);
			$('#totalUnverified').html(totalUnverified);
			$('#totalOnProcess').html(totalOnProcess);
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	    
});
</script>
@endsection