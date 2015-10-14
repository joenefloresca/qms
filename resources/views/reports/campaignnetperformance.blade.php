@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Campaign Net Performance</div>
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
								<button type="button" class="btn btn-info" id="btnYesterday">
									Yesterday
								</button>
								<button type="button" class="btn btn-info" id="btnToday">
									Today
								</button>
								<button type="button" class="btn btn-info" id="btnLast7Days">
									Last 7 days
								</button>
								<button type="button" class="btn btn-info" id="btnLast30Days">
									Last 30 days
								</button>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary" id="btnCNP">
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
				<div class="panel-heading">Campaign Net Performance</div>
				<div class="panel-body">
					<table id="CampaignNetPerformance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Completed Surveys</th>
                                <th>Total Partital Surveys</th>
                                <th>Total Revenue</th>
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
@section('campaignnetperformance')
<script type="text/javascript">
$("#btnCNP").click(function() {
	if($.fn.dataTable.isDataTable('#CampaignNetPerformance')) 
	{
    	table.destroy();
    	table = $('#CampaignNetPerformance').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	    $.ajax({
		url: "api/crm/apiCampaignNetPerformance", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val()},
		success: function(result){
			console.log(result);
		var myObj = $.parseJSON(result);
	    	var myObj = $.parseJSON(result);
			$.each(myObj, function(key,value) {
	    		table.row.add( [
		            value.start_date,	
		            value.end_date,
		            value.completedsurvey,
		            value.partialsurvey,
		            value.revenue,
	        	] ).draw();
			});
		}});
	}
    else 
    {
	    table = $('#CampaignNetPerformance').DataTable();
	    $.ajax({
		url: "api/crm/apiCampaignNetPerformance", 
		type: 'GET',
		data: {"from" : $("#fromDateAll").val(), "to" :  $("#toDateAll").val()},
		success: function(result){
			console.log(result);
		var myObj = $.parseJSON(result);
	    	var myObj = $.parseJSON(result);
			$.each(myObj, function(key,value) {
	    		table.row.add( [
		            value.start_date,	
		            value.end_date,
		            value.completedsurvey,
		            value.partialsurvey,
		            value.revenue,
	        	] ).draw();
			});
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	}
	
});
</script>
@endsection
