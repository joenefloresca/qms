@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Agent Performance</div>
				<div class="panel-body">
					<div class="col-md-12 form-horizontal" style="padding-bottom: 5px">
						<div class="form-group">
							<label class="col-md-4 control-label">From Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="fromDateAgentPer" id="fromDateAgentPer" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To Date</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="toDateAgentPer" id="toDateAgentPer" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" class="btn btn-primary" id="btnDateAgentPer">
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
				<div class="panel-heading">Agent Performance</div>
				<div class="panel-body">
					<table id="AgentPerformance" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            
                            <tr>
                                <th>Agent Name</th>
                                <th>Total Login Hours</th>
                                <th>Total Completed Surveys</th>
                                <th>Total Partital Surveys</th>
                                <th>APH</th>
                                <th>RPH</th>
                                <th>SPH</th>
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
