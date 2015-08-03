@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Verifier Report</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="fromVerifierReport" id="fromVerifierReport" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="toVerifierReport" id="toVerifierReport" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">QA Name</label>
							<div class="col-md-6">
								{!! Form::select('qa_name', $qa_names, '',array('class' => 'form-control', 'id' => 'qa_name')) !!}
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" id="submitVerifierReport" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Verifier Report</div>
				<div class="panel-body">
                    <table id="VerifierReport" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>QA Name</th>
                                <th>Passed</th>
                                <th>Passed-Approved</th>
                                <th>Passed with Changes</th>
                                <th>Passed-Unverified</th>
                                <th>Pending</th>
                                <th>Reject A</th>
                                <th>Reject B</th>
                                <th>Reject C</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
							<tr>
								<td colspan="2">Total</td>
								<td id="totalPassed"></td>
								<td id="totalPassedApprove"></td>
								<td id="totalPassedChanges"></td>
								<td id="totalPassedUnverified"></td>
								<td id="totalPending"></td>
								<td id="totalRejectA"></td>
								<td id="totalRejectB"></td>
								<td id="totalRejectC"></td>
								<td id="totalTotal"></td>
							</tr>
						</tfoot>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
