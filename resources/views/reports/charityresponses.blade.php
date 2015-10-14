@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Charity Responses Gross</div>
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
								<button type="button" class="btn btn-primary" id="btnDateCharityRes">
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
				<div class="panel-heading">Charity Responses Gross</div>
				<div class="panel-body">
					<table id="CharityResponses" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>Column Header</th>
                                <th>YES Count</th>
                                <th>NO Count</th>
                                <th>POSSIBLY Count</th>
                                <th>Total Leads</th>
                                <th>Cost Per Lead</th>
                                <th>Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
						    <tr>
						    	<th></th>
                                <th colspan="1">Total YES Count</th>
                                <th>Total NO Count</th>
                                <th>Total POSSIBLY Count</th>
                                <th>Total Leads Count</th>
                                <th colspan="2">Total Revenue </th>
						    </tr>
						     <tr>
						     	<th></th>
                                <td colspan="1" id="CharityRepTotalYes"></td>
                                <td id="CharityRepTotalNo"></td>
                                <td id="CharityRepTotalPossib"></td>
                                <td id="CharityRepTotalLeads"></td>
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
@section('charityresponses')
<script type="text/javascript">
$("#btnDateCharityRes").click(function() {
	var totalyes = 0;
	var totalno = 0;
	var totalpossibly = 0;
	var totalrev = 0;
	var totalleads = 0;
	var grandtotal_leads = 0;

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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseFloat(value.revenue); 
	    		totalleads = parseInt(value.ct_yes) + parseInt(value.ct_maybe); 
	    		grandtotal_leads += totalleads;

	    		table.row.add( [
		           // value.question_id,	
		            value.columnheader,
		            value.ct_yes,
		            value.ct_no,
		            value.ct_maybe,
		            totalleads,
		            value.costperlead,
		            value.revenue,
	        	] ).draw();
			});
			$("#CharityRepTotalYes").html(totalyes);
			$("#CharityRepTotalNo").html(totalno);
			$("#CharityRepTotalPossib").html(totalpossibly);
			$("#CharityRepTotalLeads").html(grandtotal_leads);
			$("#CharityRepTotalRev").html(totalrev.toFixed(2));
		}});

	}
    else 
    {
	    table = $('#CharityResponses').DataTable();
	    $.ajax({
		url: "api/crm/charityresponses", 
		type: 'GET',
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
		success: function(result){
		var myObj = $.parseJSON(result);
	    	$.each(myObj, function(key,value) {
	    		totalyes += parseInt(value.ct_yes); 
	    		totalno += parseInt(value.ct_no); 
	    		totalpossibly += parseInt(value.ct_maybe); 
	    		totalrev += parseInt(value.revenue); 
	    		totalleads = parseInt(value.ct_yes) + parseInt(value.ct_maybe); 
	    		grandtotal_leads += totalleads;

	    		table.row.add( [
		           // value.question_id,	
		            value.columnheader,
		            value.ct_yes,
		            value.ct_no,
		            value.ct_maybe,
		            totalleads,
		            value.costperlead,
		            value.revenue,
	        	] ).draw();
			});
			$("#CharityRepTotalYes").html(totalyes);
			$("#CharityRepTotalNo").html(totalno);
			$("#CharityRepTotalPossib").html(totalpossibly);
			$("#CharityRepTotalLeads").html(grandtotal_leads);
			$("#CharityRepTotalRev").html(totalrev.toFixed(2));
		}});

		var tt = new $.fn.dataTable.TableTools( table );
	    $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

	}
	
});
</script>
@endsection