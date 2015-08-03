@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fromQaSummary" id="fromQaSummary" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="toQaSummary" id="toQaSummary" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Agent Name</label>
							<div class="col-md-6">
								{!! Form::select('agent_nameQaSummary', $agent_name, '',array('class' => 'form-control', 'id' => 'agent_nameQaSummary')) !!}
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Disposition</label>
							<div class="col-md-6">
								<select name="dispositionQaSummary" id="dispositionQaSummary" class="form-control">
									<option value="Completed Survey">Completed Survey</option>
									<option value="MCS Record">MCS Record</option>
									<option value="Hibernate">Hibernate</option>
									<option value="All" selected="">All</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								<select class="form-control" name="verified_statusQaSummary" id="verified_statusQaSummary">
									<option value="All">All</option>
									<option value="On The Proccess">On The Proccess</option>
									<option value="Unverified">Unverified</option>
									<option value="Passed">Passed</option>
									<option value="Passed-Approved">Passed-Approved</option>
									<option value="Passed-With Changes">Passed-With Changes</option>
									<option value="Passed-Unverified">Passed-Unverified</option>
									<option value="Reject A">Reject A</option>
									<option value="Reject B">Reject B</option>
									<option value="Reject C">Reject C</option>
									<option value="Pending">Pending</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="submitQaSummary" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div id="showFullDetails" class="collapse out">
	        	<div class="panel panel-info">
					<div class="panel-heading">Question Responses</div>
					<div class="panel-body">
						<table id="SummaryReportResponses" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                        <thead>
	                            <tr>
	                                <th>Column Header</th>
	                                <th>Response</th>
	                            </tr>
	                        </thead>
	                        <tbody></tbody>
	                    </table>
					</div> 
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
                    <table id="SummaryReportA" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Disposition</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Summary Report</div>
				<div class="panel-body">
                    <table id="SummaryReportB" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Verified By</th>
                                <th>Verified Status</th>
                                <th>Pass with Changes</th>
                                <th>Comments</th>
                                <th>Gross</th>
                                <th>Title</th>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>Show All</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
				</div>
			</div>
		</div>
		
	</div>
</div>
@endsection
