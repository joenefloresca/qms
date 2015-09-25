@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Charity Responses Net</div>
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
								<button type="button" class="btn btn-primary" id="btnDateCharityResNet">
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
				<div class="panel-heading">Charity Responses Net</div>
				<div class="panel-body">
					<table id="CharityResponsesNet" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Column Header</th>
                                <th>YES Count</th>
                                <th>NO Count</th>
                                <th>POSSIBLY Count</th>
                                <th>Cost Per Lead</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
						    <tr>
                                <th colspan="1">Total YES Count</th>
                                <th colspan="2">Total NO Count</th>
                                <th>Total POSSIBLY Count</th>
                                <th colspan="2">Total Revenue </th>
						    </tr>
						     <tr>
                                <td colspan="1" id="CharityRepTotalYes"></td>
                                <td colspan="2" id="CharityRepTotalNo"></td>
                                <td id="CharityRepTotalPossib"></td>
                                <td colspan="2" id="CharityRepTotalRev"></td>
						    </tr>
						</tfoot>
                    </table>
				</div> 
			</div> 
		</div>
	</div>
</div>
@endsection
@section('charityresponsesnet')
<script type="text/javascript">
$("#btnDateCharityResNet").click(function() {
	var totalyes = 0;
	var totalno = 0;
	var totalpossibly = 0;
	var totalrev = 0;

	if($.fn.dataTable.isDataTable('#CharityResponsesNet')) 
	{	
    	table.destroy();
    	table = $('#CharityResponsesNet').DataTable();
    	table.clear().draw();
    	var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
	    $.ajax({
		url: "api/crm/charityresponsesnet", 
		type: 'GET',
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseFloat(value.revenue); 

	    		table.row.add( [
		           // value.question_id,	
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
	    table = $('#CharityResponsesNet').DataTable();
	    $.ajax({
		url: "api/crm/charityresponsesnet", 
		type: 'GET',
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseInt(value.revenue); 

	    		table.row.add( [
		           // value.question_id,	
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
</script>
@endsection
