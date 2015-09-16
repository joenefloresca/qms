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
                        <tfoot>
							<tr>
								<td colspan="8">&nbsp;</td>
							</tr>
						</tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
