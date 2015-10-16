@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Verified Form List</div>
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
                                <button type="button" class="btn btn-primary" id="btnDateReVerifyList">
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
				<div class="panel-heading">Verified Form List</div>
				<div class="panel-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                          @endif
                        @endforeach
                    </div>
                    <table id="ReVerifyList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="9"> <center>Form Information<center></th>
                                <th colspan="1"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Agent</th>
                                <th>Customer</th>
                                <th>Disposition</th>
                                <th>Gross</th>
                                <th>Phone</th>
                                <th>Verified Status</th>
                                <th>Date Verfied</th>
                                <th>Verified By</th>
                                <th>Re-Verify</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
							<tr>
								<td colspan="10">&nbsp;</td>
							</tr>
						</tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('reverifylist')
<script type="text/javascript">
// $.ajax({
//     url: "api/crm/reverify", 
//     type: 'GET',
//     success: function(result){
//     var myObj = $.parseJSON(result);
//     console.log(myObj);
        // $.each(myObj, function(key,value) {
        //     var t = $('#ReVerifyList').DataTable();
        //     t.row.add( [
        //         value.verfiedcrmid, 
        //         value.agentname,
        //         value.title+" "+value.firstname+" "+value.surname,
        //         value.disposition,
        //         value.gross,
        //         value.phone_num,
        //         value.verified_status,
        //         value.created_at,
        //         value.verified_by,
        //         "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/reverify/';?>"+value.verfiedcrmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
        //     ] ).draw();
            
        // });
//     }});

$("#btnDateReVerifyList").click(function() {
    
     alert("Data will now load. Please wait.");

    if($.fn.dataTable.isDataTable('#ReVerifyList')) 
    {
        table.destroy();
        table = $('#ReVerifyList').DataTable({
            "lengthMenu": [ [10, 25, 50, 500, -1], [10, 25, 50, 500, "All"] ]
        });
        table.clear().draw();
        var tt = new $.fn.dataTable.TableTools( table );
        $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

        $.ajax({
        url: "api/crm/reverify2", 
        type: 'GET',
        data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
        success: function(result){
        var myObj = $.parseJSON(result);
            $.each(myObj, function(key,value) {
                var t = $('#ReVerifyList').DataTable();
                t.row.add( [
                    value.verfiedcrmid, 
                    value.agentname,
                    value.title+" "+value.firstname+" "+value.surname,
                    value.disposition,
                    value.gross,
                    value.phone_num,
                    value.verified_status,
                    value.created_at,
                    value.verified_by,
                    "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/reverify/';?>"+value.verfiedcrmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
                ] ).draw();
                
            });
            alert("Data loading complete.");
        }});
    }
    else 
    {
        table = $('#ReVerifyList').DataTable({
            "lengthMenu": [ [10, 25, 50, 500, -1], [10, 25, 50, 500, "All"] ]
        });
        $.ajax({
        url: "api/crm/reverify2", 
        type: 'GET',
        data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
        success: function(result){
        var myObj = $.parseJSON(result);
            $.each(myObj, function(key,value) {
                var t = $('#ReVerifyList').DataTable();
                t.row.add( [
                    value.verfiedcrmid, 
                    value.agentname,
                    value.title+" "+value.firstname+" "+value.surname,
                    value.disposition,
                    value.gross,
                    value.phone_num,
                    value.verified_status,
                    value.created_at,
                    value.verified_by,
                    "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/reverify/';?>"+value.verfiedcrmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
                ] ).draw();
                
            });
            alert("Data loading complete.");
        }});

        var tt = new $.fn.dataTable.TableTools( table );
        $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
    }   

});
</script>
@endsection

