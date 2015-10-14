@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Verifier Report</div>
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
							<label class="col-md-4 control-label">QA Name</label>
							<div class="col-md-6">
								{!! Form::select('qa_name', $qa_names, '',array('class' => 'form-control', 'id' => 'qa_name')) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="submitVerifierReport" class="btn btn-primary">
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
				<div class="panel-heading">Verifier Report</div>
				<div class="panel-body">
                    <table id="VerifierReport" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>QA Name</th>
                                <!-- <th>Passed</th> -->
                                <th>Passed-Approved</th>
                                <th>Passed with Changes</th>
                                <th>Passed-Unverified</th>
                                <th>Pending</th>
                                <th>Reject A</th>
                                <th>Reject B</th>
                                <th>Reject C</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
							<tr>
								<td colspan="2">Total</td>
								<!-- <td id="totalPassed"></td> -->
								<td id="totalPassedApprove"></td>
								<td id="totalPassedChanges"></td>
								<td id="totalPassedUnverified"></td>
								<td id="totalPending"></td>
								<td id="totalRejectA"></td>
								<td id="totalRejectB"></td>
								<td id="totalRejectC"></td>
								<td id="totalTotal"></td>
							</tr>
						</tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('verifierreport')
<script type="text/javascript">
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val(), "qa_name" : $("#qa_name").val()},
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
		            //value.passed,
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val(), "qa_name" : $("#qa_name").val()},
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
		           // value.passed,
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
</script>
@endsection