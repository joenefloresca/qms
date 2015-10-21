@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Detailed Summary</div>
				<div class="panel-body">
					<div class="col-md-12 form-horizontal" style="padding-bottom: 5px">
						<div class="form-group">
							<label class="col-md-4 control-label">From Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromDateAll" id="fromDateAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toDateAll" id="toDateAll" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary" id="btnDateDetailedSummary">
									Submit
								</button>
							</div>

						</div>

					</div>
                     

				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success"> 
				<div class="panel-heading">Detailed Summary</div>
				<div class="panel-body">
					<table id="DetailedSummary" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            
                            <tr>
                                <th>Calldatetime</th>
                                <th>Phone</th>
                                <th>Agent</th>
                                <th>Gross Disposition</th>
                                <th>Net Disposition</th>
                                <th>Verified Status</th>
                                <th>Passed-Changes Status</th>
                                <th>Reject A Status</th>
                                <th>Reject B Status</th>
                                <th>Reject C Status</th>
                                <th>Verified By</th>
                                <th>Verified Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
				</div> 
			</div> 
		</div>
	</div>
</div>
@endsection
@section('agentperformance')
<script type="text/javascript">
$("#btnDateDetailedSummary").click(function() {
	var sph = 0;
	var revperhour = 0;
	if($.fn.dataTable.isDataTable('#DetailedSummary')) 
	{
    	table.destroy();
    	table = $('#DetailedSummary').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	    $.ajax({
		url: "api/crm/detailedsummary", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
       
	    		table.row.add( [
		            value.calldatetime,	
		            value.phone_num,	
		            value.agent,	
		            value.gross_disposition,	
		            value.net_disposition,	
		            value.verified_status,	
		            value.passwithchanges_status,	
		            value.reject_a_status,	
		            value.reject_b_status,	
		            value.reject_c_status,	
		            value.verified_by,	
		            value.verified_date,	
		            value.comments
		           
	        	] ).draw();
			});
		}});

	}
    else 
    {
	    table = $('#DetailedSummary').DataTable();
	    $.ajax({
		url: "api/crm/detailedsummary", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		table.row.add( [
		            value.calldatetime,	
		            value.phone_num,	
		            value.agent,	
		            value.gross_disposition,	
		            value.net_disposition,	
		            value.verified_status,	
		            value.passwithchanges_status,	
		            value.reject_a_status,	
		            value.reject_b_status,	
		            value.reject_c_status,	
		            value.verified_by,	
		            value.verified_date,	
		            value.comments
		           
	        	] ).draw();
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	
});
</script>
@endsection