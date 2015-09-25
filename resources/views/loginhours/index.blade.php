@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Login Hours</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromDatetimeAll" id="fromDatetimeAll">
							</div>
						</div>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toDatetimeAll" id="toDatetimeAll">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="button" class="btn btn-primary" id="sortLoginHours">
								Submit
							</button>
						</div>
					</div>
					
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">Login Hours</div>
				<div class="panel-body">
					
					<!-- <div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div> -->
                    <table id="LoginHourList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Login Time</th>
                                <th>Last Logout</th>
                                <th>Login Hours</th>
                                <th>Current Status</th>
                                
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
@section('loginhours')
<script type="text/javascript">
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
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
		data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
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
</script>
@endsection
