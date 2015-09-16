@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Charity Responses</div>
				<div class="panel-body">
					<div class="col-md-12 form-horizontal" style="padding-bottom: 5px">
						<div class="form-group">
							<label class="col-md-4 control-label">From Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromDateCharityRes" id="fromDateCharityRes" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toDateCharityRes" id="toDateCharityRes" required>
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
				<div class="panel-heading">Charity Responses</div>
				<div class="panel-body">
					<table id="CharityResponses" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                                <th colspan="2">Total YES Count</th>
                                <th colspan="2">Total NO Count</th>
                                <th>Total POSSIBLY Count</th>
                                <th colspan="2">Total Revenue </th>
						    </tr>
						     <tr>
                                <td colspan="2" id="CharityRepTotalYes"></td>
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
