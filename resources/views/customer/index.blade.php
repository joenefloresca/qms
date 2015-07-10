@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Customer List</div>
				<div class="panel-body">
					<div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div>
                    <table id="CustomerList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="7"> <center>Customer Information<center></th>
                                <th colspan="2"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Postcode</th>
                                <th>Country</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
							<tr>
								<td colspan="9">&nbsp;</td>
							</tr>
						</tfoot>
                    </table>
                  
                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
