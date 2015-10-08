@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Agent Performance</div>
				<div class="panel-body">
					<div class="col-md-12 form-horizontal" style="padding-bottom: 5px">
						<div class="form-group">
							<label class="col-md-4 control-label">From Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromDatetimeAll" id="fromDatetimeAll" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toDatetimeAll" id="toDatetimeAll" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary" id="btnDateAgentPer">
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
				<div class="panel-heading">Agent Performance</div>
				<div class="panel-body">
					<table id="AgentPerformance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            
                            <tr>
                                <th>Agent Name</th>
                                <th>Total Login Hours</th>
                                <th>Total Completed Surveys</th>
                                <th>Total Partial Surveys</th>
                                <th>APH</th>
                                <th>Total Rev</th>
                                <th>SPH</th>
                                <th>RPH</th>
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
$("#btnDateAgentPer").click(function() {
	var sph = 0;
	var revperhour = 0;
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
                revperhour = parseFloat(value.rph) / parseFloat(value.totalloginhours);
	    		sph = Math.round((parseInt(value.completedsurvey) + parseInt(value.partial_survey)) / parseFloat(value.totalloginhours));
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.completedsurvey,
		            value.partial_survey,
		            value.applicationperhour,
		            value.rph,
		            sph.toFixed(2),
		            revperhour.toFixed(2),
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		revperhour = parseFloat(value.rph) / parseFloat(value.totalloginhours);
	    		sph = Math.round((parseInt(value.completedsurvey) + parseInt(value.partial_survey)) / parseFloat(value.totalloginhours));
	    		table.row.add( [
		            value.name,	
		            value.totalloginhours,
		            value.completedsurvey,
		            value.partial_survey,
		            value.applicationperhour,
		            value.rph,
		            sph.toFixed(2),
		            revperhour.toFixed(2),
	        	] ).draw();
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	
});
</script>
@endsection