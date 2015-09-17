@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Login Hours</div>
				<div class="panel-body">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">From</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="loginHoursFrom" id="loginHoursFrom">
							</div>
						</div>
					</div>
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">To</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="loginHoursTo" id="loginHoursTo">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="button" class="btn btn-primary" id="sortLoginHours">
								Submit
							</button>
						</div>
					</div>
					
				</div>
			</div>
			<div class="panel panel-success">
				<div class="panel-heading">Login Hours</div>
				<div class="panel-body">
					
					<!-- <div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div> -->
                    <table id="LoginHourList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Login Time</th>
                                <th>Last Logout</th>
                                <th>Login Hours</th>
                                <th>Current Status</th>
                                
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
