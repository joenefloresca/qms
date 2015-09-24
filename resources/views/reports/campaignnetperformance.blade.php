@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Campaign Net Performance</div>
				<div class="panel-body">
					<div class="col-md-12 form-horizontal" style="padding-bottom: 5px">
						<div class="form-group">
							<label class="col-md-4 control-label">From Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromCNP" id="fromCNP" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toCNP" id="toCNP" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary" id="btnCNP">
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
				<div class="panel-heading">Campaign Net Performance</div>
				<div class="panel-body">
					<table id="CampaignNetPerformance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Completed Surveys</th>
                                <th>Total Partital Surveys</th>
                                <th>Total Revenue</th>
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
