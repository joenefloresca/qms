@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Form List</div>
				<div class="panel-body">
                    <table id="VerifyList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="7"> <center>Form Information<center></th>
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
$.ajax({
    url: "api/crm/all", 
    type: 'GET',
    success: function(result){
    var myObj = $.parseJSON(result);
        $.each(myObj, function(key,value) {
            var t = $('#VerifyList').DataTable();
            t.row.add( [
                value.crmid,    
                value.name,
                value.title+" "+value.firstname+" "+value.surname,
                value.disposition,
                value.gross,
                value.phone_num,
                value.created_at,
                "<a class='btn btn-small btn-info' href='<?php echo URL::to('qa').'/verify/';?>"+value.crmid+"'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
            ] ).draw();
            
        });
    }});
// $(document).ready(function() {
//     $.fn.dataTable.ext.legacy.ajax = true;
//     var table = $('#VerifyList').DataTable( {
//        "processing": true,
//        "serverSide": true,
//        "ajax": "api/crm/all",
//        "columnDefs": [
//             { 
//                 "targets": 8,
//                 "render": function(data, type, row, meta){ 
//                    return "<a class='btn btn-small btn-info' href='<?php echo URL::to('customer').'/';?>"+row[0]+"/edit'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>";  
//                 }
//             }            
//         ]        
//     });
    // var tt = new $.fn.dataTable.TableTools( $('#VerifyList').DataTable() );
    // $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
//});
</script>
@endsection
