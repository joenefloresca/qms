@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Verify Form</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<div class="flash-message">
				        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
				          @if(Session::has('alert-' . $msg))
				          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
				          @endif
				        @endforeach
			        </div>
                    
					<form class="form-horizontal" role="form" method="POST" action="{{ url('qa/postverify/'.$crm->id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="agent_id" id="agent_id" value="{{ $crm->agent_id }}">
						<input type="hidden" name="customer_id" id="customer_id" value="{{ $crm->customer_id }}">
						<input type="hidden" class="form-control" name="orig_crm_id" id="orig_crm_id" value="{{$crm->id}}">

						<div class="panel panel-info"> 
				        	<div class="panel-heading">Client Information</div>
				        	<div class="panel-body"> 

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Gross</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="gross" id="gross" value="{{$crm->gross}}" readonly>
									</div>
								</div> 

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Disposition</label>
									<div class="col-md-6">
										{!! Form::select('disposition', ['' => 'Choose One', 'Completed Survey' => 'Completed Survey', 'Partial Survey' => 'Partial Survey'], $crm->disposition, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Gender</label>
									<div class="col-md-6">
										{!! Form::select('gender', ['' => 'Choose One', 'Male' => 'Male', 'Female' => 'Female'], $crm->gender, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Title</label>
									<div class="col-md-6">
										{!! Form::select('title', ['' => 'Choose One', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms', 'Dr' => 'Dr', 'Rev'=>'Rev'], $crm->title, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">First Name</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="firstname" id="firstname" value="{{$crm->firstname}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Surname</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="lastname" id="lastname" value="{{$crm->surname}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Addr1</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="addr1" id="addr1" value="{{$crm->addr1}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Addr2</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="addr2" id="addr2" value="{{$crm->addr2}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Addr3</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="addr3" id="addr3" value="{{$crm->addr3}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Addr4</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="addr4" id="addr4" value="{{$crm->addr4}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Town</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="town" id="town" value="{{$crm->town}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Country</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="country" id="country" value="{{$crm->country}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Postcode</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="postcode" id="postcode" value="{{$crm->postcode}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Phone Number</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="phone_num" id="phone_num" value="{{$crm->phone_num}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Phone Type</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="phonetype" id="phonetype" value="{{$crm->phonetype}}">
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Age Bracket</label>
									<div class="col-md-4">
										{!! Form::select('age_bracket', ['' => 'Choose One', '18-29' => '18-29', '30-39' => '30-39', '40-49' => '40-49', '50-59' => '50-59', '60-64'=>'60-64', '65-75'=>'65-75', '75+' => '75+'], $crm->age_bracket, array('class' => 'form-control')) !!}
									</div>
								</div>
								

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Work Status</label>
									<div class="col-md-4">
										{!! Form::select('work_status', ['' => 'Choose One', 'Employed' => 'Employed', 'Self-Employed' => 'Self-Employed', 'Retired' => 'Retired', 'Company Director' => 'Company Director', 'Other' => 'Other', 'Not answered' => 'Not answered'], $crm->work_status, array('class' => 'form-control')) !!}
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Home Status</label>
									<div class="col-md-4">
										{!! Form::select('home_status', ['' => 'Choose One', 'Own Home' => 'Own Home', 'Renting' => 'Renting', 'Living with Family/Friend' => 'Living with Family/Friend', 'Not Answered' => 'Not Answered'], $crm->home_status, array('class' => 'form-control')) !!}						
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Marital Status</label>
									<div class="col-md-4">
										{!! Form::select('marital_status', ['' => 'Choose One', 'Married or Co-Habiting' => 'Married or Co-Habiting', 'Single or Never Married' => 'Single or Never Married', 'Married or Co-habiting' => 'Married or Co-habiting', 'Widowed' => 'Widowed', 'Divorced' => 'Divorced', 'Separated' => 'Separated', 'Others' => 'Others'], $crm->marital_status, array('class' => 'form-control')) !!}		
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Is UK Permanent Resident?</label>
									<div class="col-md-4">
										{!! Form::select('ispermanentresident', ['' => 'Choose One', 'Yes' => 'Yes', 'No' => 'No'], $crm->ispermanentresident, array('class' => 'form-control')) !!}		
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Agent</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="phonetype" id="phonetype" value="{{$agent_name}}" readonly>
									</div>
								</div>

								<div class="form-group col-md-6">
									<label class="col-md-4 control-label">Revenue</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="new_gross" id="new_gross" value="{{$crm->gross}}" readonly>
									</div>
								</div> 

				        	</div> 
			        	</div>

			        	<!-- <div style="padding-bottom: 6px; padding-top: 6px">
			        		<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">Show Responses</button>
			        	</div> -->
						<!-- Modal -->
						<!-- <div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog"> -->

						    <!-- Modal content-->
						    <!-- <div class="modal-content modal-lg">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Question Responses</h4>
						      </div>
						      <div class="modal-body">
						        	<div class="panel panel-info">
										<div class="panel-heading">Question Responses</div>
										<div class="panel-body">
											<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="QaResponsesList">
												<thead>
						                            <tr>
						                                <th>Response ID</th>
						                                <th>Column Header</th>
						                                <th>Question</th>
						                                <th>Response</th>
						                            </tr>
					                        	</thead>
					                        	<tbody>
													@foreach ($responses as $response)
													<tr>
														<td>{{ $response->id }}</td>
														<td>{{ $response->columnheader }}</td>
														<td>{{ $response->question }}</td>
														<td>
															<select class="form-control" name="{{$response->columnheader}}">
																<option value="{{$response->response}}" selected>{{$response->response}}</option>
																<option value="Yes">Yes</option>
																<option value="No">No</option>
																<option value="Possibly">Possibly</option>
															</select>
														</td>
													</tr>
													@endforeach
												</tbody>
										   </table>
										</div> 
									</div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>

						  </div>
						</div> -->

						<div style="padding-bottom: 8px">
							<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#showReponse">Show Responses</button>
						</div> 
						<div id="showReponse" class="collapse out">
				        	<div class="panel panel-info">
								<div class="panel-heading">Question Responses</div>
								<div class="panel-body">
									<table class="table table-striped table-bordered" cellspacing="0" width="100%" id="QaResponsesList">
										<thead>
				                            <tr>
				                                <th>Response ID</th>
				                                <th>Column Header</th>
				                                <th>Question</th>
				                                <th>Response</th>
				                            </tr>
			                        	</thead>
			                        	<tbody>
											@foreach ($responses as $response)
											<tr>
												<td>{{ $response->id }}</td>
												<td>{{ $response->columnheader }}</td>
												<td>{{ $response->question }}</td>
												<td>
													<!-- <input type="text" class="form-control" name="{{$response->columnheader}}" value="{{$response->response}}"> -->
													<select class="form-control myselectbox" name="{{$response->columnheader}}" id="{{$response->columnheader}}">
														<option value="{{$response->response}}" selected>{{$response->response}}</option>
														<?php  
															if($response->child_lead_respponse == "" || $response->child_lead_respponse == NULL)
															{
																$options = explode(",",$response->parent_enable_response);
																foreach ($options as $key) {
	                                        						echo "<option value='$key'>".$key."</option>";
	                                        					}
															}
															else
															{
																$options = explode(",",$response->child_lead_respponse);
																foreach ($options as $key) {
	                                        						echo "<option value='$key'>".$key."</option>";
	                                        					}
															}
														?>
														<option value="">N/A</option>
														<option value="No">No</option>
													</select>
												</td>
											</tr>
											@endforeach
										</tbody>
								   </table>
								</div> 
							</div>
						</div>  

						

						<div class="panel panel-info">
							<div class="panel-heading">Remarks</div>
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 control-label">Comments</label>
										<div class="col-md-6">
											<textarea name="comments" id="comments" class="form-control" row="7">Comment here..</textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Action</label>
										<div class="col-md-6">
											<select class="form-control" name="verified_status" id="verified_status">
												<option value="">Choose One</option>
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
										<label class="col-md-4 control-label">Passed w/ Changes</label>
										<div class="col-md-6">
											<select class="form-control" name="passwithchanges_status" id="passwithchanges_status" disabled>
												<option value="">Choose One</option>
												<option value="Changes/Updates to customer`s details">Changes/Updates to customer`s details</option>
												<option value="Changes on how responses were tagged">Changes on how responses were tagged</option>
												<option value="Call handling issues">Call handling issues</option>
												<option value="Customer`s issue">Customer`s issue</option>
												<option value="Bad Recording-Tech Issue">Bad Recording-Tech Issue</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject A</label>
										<div class="col-md-6">
											<select class="form-control" name="reject_a_status" id="reject_a_status" disabled>
												<option value="">Choose One</option>
												<option value="Weak Opt-In">Weak Opt-In</option>
												<option value="Wrong Disposition">Wrong Disposition</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject B</label>
										<div class="col-md-6">
											<select class="form-control" name="reject_b_status" id="reject_b_status" disabled>
												<option value="">Choose One</option>
												<option value="NOT INTERESTED(MULTIPLE OBJECTIONS)">NOT INTERESTED(MULTIPLE OBJECTIONS)</option>
												<option value="WRONG REBUTTAL OR PROBING INTRO">WRONG REBUTTAL OR PROBING INTRO</option>
												<option value="SRC-NON COMPLIANCE">SRC-NON COMPLIANCE</option>
												<option value="BAD RECORDING">BAD RECORDING</option>
												<option value="POOR CALL HANDLING / POSSIBLE COMPLAING">POOR CALL HANDLING / POSSIBLE COMPLAIN</option>
												<option value="DODGY CALLS/PRANK CUSTOMERS">DODGY CALLS/PRANK CUSTOMERS</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject C</label>
										<div class="col-md-6">
											<select class="form-control" name="reject_c_status" id="reject_c_status" disabled>
												<option value="">Choose One</option>
												<option value="Screamer">Screamer</option>
											</select>
										</div>
									</div>
								</div>
							</div> 
						</div>  
						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('verifyform')
<script type="text/javascript">
$(document).ready(function(){
    var previous;
     $(".myselectbox").on("focus click",function () {
        previous = this.value; // Old vaue 

    }).change(function(e) {

    	var before_gross = $('#new_gross').val(); 
    	var value =  this.value; // New Value
    	var colheader = e.target.id;
    	var new_prev = previous;
      	

		$.ajax({
		url: "qa/api/crm/getquestion", 
		type: 'GET',
		data: {'colheader':colheader},
		success: function(result){
			var costperlead = result;
			if(new_prev == "" && value != "")
			{
				var new_gross_amount = parseFloat(before_gross) + parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			else if(new_prev =! "" && value == "")
			{	
				var new_gross_amount = parseFloat(before_gross) - parseFloat(costperlead);
				$('#new_gross').val(new_gross_amount);
			}
			
		}});
    });

});

$("#verified_status").change(function() {
	if($("#verified_status").val() == "Passed-With Changes")
	{
		$('#passwithchanges_status').prop("disabled", false); 
	}
	else
	{
		$('#passwithchanges_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject A")
	{
		$('#reject_a_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_a_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject B")
	{
		$('#reject_b_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_b_status').prop("disabled", true); 
	}

	if($("#verified_status").val() == "Reject C")
	{
		$('#reject_c_status').prop("disabled", false); 
	}
	else
	{
		$('#reject_c_status').prop("disabled", true); 
	}

});
</script>
@endsection