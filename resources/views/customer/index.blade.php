@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Customer List</div>
				<div class="panel-body">
					<!-- <div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div> -->
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                          @endif
                        @endforeach
                    </div>
                    <table id="CustomerList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="7"> <center>Customer Information<center></th>
                                <!-- <th colspan="2"> <center>Actions<center></th> -->
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Country</th>
                                <th>Postcode</th>
                            <!--     <th>Edit</th>
                                <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <!-- <tfoot>
							<tr>
                                <td colspan="9">&nbsp;</td>
								<td colspan="7">&nbsp;</td>
							</tr>
						</tfoot> -->
                    </table>
                  
                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('customer')
<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTable.ext.legacy.ajax = true;
        $('#CustomerList').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "api/customer/all",
            "paging" : true,
            "searching" : true,
            "ordering" :  true,
        } );

        var tt = new $.fn.dataTable.TableTools( $('#CustomerList').DataTable() );
        $( tt.fnContainer() ).insertBefore('div.dataTables_wrapper');
    });
</script>
@endsection

