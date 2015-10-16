@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-success">
                <div class="panel-heading">Form List</div>
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
                                <button type="button" class="btn btn-primary" id="btnDateVerifyList">
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
				<div class="panel-heading">Form List</div>
				<div class="panel-body">
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                          @endif
                        @endforeach
                    </div>
                   <!--  <div id="loader" style="position: fixed; left: 50%; top: 50%; display: none;">
                            <img src="{{ asset('/js/loader.gif') }}"></img>
                    </div> -->

                    <table id="VerifyList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="8"> <center>Form Information<center></th>
                                <th colspan="1"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Agent</th>
                                <th>Customer</th>
                                <th>Disposition</th>
                                <th>Gross</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Verify</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <!-- <tfoot>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
						</tfoot> -->
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('verifylist')
<script type="text/javascript">
// $.ajax({
//     url: "api/crm/all", 
//     type: 'GET',
//     success: function(result){
//     var myObj = $.parseJSON(result);
//         $.each(myObj, function(key,value) {
//             var t = $('#VerifyList').DataTable();
//             t.row.add( [
//                 value.crmid,    
//                 value.name,
//                 value.title+" "+value.firstname+" "+value.surname,
//                 value.disposition,
//                 value.gross,
//                 value.phone_num,
//                 value.created_at,
//                 "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+value.crmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
//             ] ).draw();
            
//         });
//     }});
// $(document).ready(function() {
//     $.fn.dataTable.ext.legacy.ajax = true;
//     var table = $('#VerifyList').DataTable( {
//        "processing": true,
//        "serverSide": true,
//        "ajax": "api/crm/all",
//        "columnDefs": [
//             { 
//                 "targets": 7,
//                 "render": function(data, type, row, meta){ 
//                    return "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+row[0]+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>";  
//                 }
//             }            
//         ]        
//     });
//     var tt = new $.fn.dataTable.TableTools( $('#VerifyList').DataTable() );
//     $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
// });
jQuery(function ($){
        $(document).ajaxStop(function(){
            $("#ajax_loader").hide();
         });
         $(document).ajaxStart(function(){
             $("#ajax_loader").show();
         });    
    });  


$("#btnDateVerifyList").click(function() {
     // $( "#loader" ).show();
     alert("Data will now load. Please wait.")
        var status = 'Unverfied';
    if($.fn.dataTable.isDataTable('#VerifyList')) 
    {
        table.destroy();
        table = $('#VerifyList').DataTable(
                {
                    "lengthMenu": [ [10, 25, 50, 500, -1], [10, 25, 50, 500, "All"] ]
                }
        );
        table.clear().draw();
        var tt = new $.fn.dataTable.TableTools( table );
        $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');

        $.ajax({
        url: "api/crm/all2", 
        type: 'GET',
        data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
        success: function(result){
        var myObj = $.parseJSON(result);
            $.each(myObj, function(key,value) {
                if(value.isverified == 1) {status = 'On the process'}

                table.row.add( [
                    value.crmid, 
                    value.name,
                    value.customer,
                    value.disposition,
                    value.gross,
                    value.phone_num,
                    value.created_at,
                   // status,
                   'Dont mind me',
                    "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+value.crmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>"
                ] ).draw();
            });
            // $( "#loader" ).hide();
            alert("Data loading complete.");
        }});
    }
    else 
    {
         $( "#loader" ).show();
        table = $('#VerifyList').DataTable({
            "lengthMenu": [ [10, 25, 50, 500, -1], [10, 25, 50, 500, "All"] ]
        });
        $.ajax({
        url: "api/crm/all2", 
        type: 'GET',
        data: {"from" : $("#fromDatetimeAll").val(), "to" :  $("#toDatetimeAll").val()},
        success: function(result){
        var myObj = $.parseJSON(result);
            $.each(myObj, function(key,value) {
                if(value.isverified == 1) {status = 'On the process'}

                table.row.add( [
                    value.crmid, 
                    value.name,
                    value.customer,
                    value.disposition,
                    value.gross,
                    value.phone_num,
                    value.created_at,
                   // status,
                   'Dont mind me',
                    "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+value.crmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>"
                ] ).draw();
            });
            // $( "#loader" ).hide();
            alert("Data loading complete.");
        }});

        var tt = new $.fn.dataTable.TableTools( table );
        $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
    }   

});
</script>
@endsection
