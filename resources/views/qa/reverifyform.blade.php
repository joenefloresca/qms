@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Re-Verify Form</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('qa/postreverify/'.$crm->id) }}">
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
										{!! Form::select('disposition', ['' => 'Choose One', 'AnsweringMachine' => 'AnsweringMachine', 'Callback' => 'Callback', 'Deceased' => 'Deceased', 'DoNotCall' => 'DoNotCall', 'Foreign Language'=>'Foreign Language', 'Hibernate'=>'Hibernate', 'Manual Callback'=>'Manual Callback', 'NoAnswer'=>'NoAnswer', 'NoResponse'=>'NoResponse', 'NotInterested'=>'NotInterested', 'RaffleTicket'=>'RaffleTicket', 'Telcorecordedannouncement'=>'Telcorecordedannouncement', 'Appointmentset'=>'Appointmentset'], $crm->disposition, array('class' => 'form-control')) !!}
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

				        	</div> 
			        	</div>

			        	<div style="padding-bottom: 6px; padding-top: 6px">
			        		<button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#myModal">Show Responses</button>
			        	</div>
						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content modal-lg">
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
						</div>

						

						<div class="panel panel-info">
							<div class="panel-heading">Remarks</div>
							<div class="panel-body">
								<div class="form-horizontal">
									<div class="form-group">
										<label class="col-md-4 control-label">Comments</label>
										<div class="col-md-6">
											<textarea name="comments" id="comments" class="form-control" row="7">{{$crm->comments}}</textarea>
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Action</label>
										<div class="col-md-6">
											{!! Form::select('passwithchanges_status', ['' => 'Choose One', 'Changes/Updates to customer`s details' => 'Changes/Updates to customer`s details', 'Changes on how responses were tagged' => 'Changes on how responses were tagged', 'Call handling issues' => 'Call handling issues', 'Customer`s issue' => 'Customer`s issue', 'Bad Recording-Tech Issue' => 'Bad Recording-Tech Issue'], $crm->passwithchanges_status, array('class' => 'form-control')) !!}							
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject A</label>
										<div class="col-md-6">
											{!! Form::select('reject_a_status', ['' => 'Choose One', 'Weak Opt-In' => 'Weak Opt-In', 'Wrong Disposition' => 'Wrong Disposition'], $crm->reject_a_status, array('class' => 'form-control')) !!}
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject B</label>
										<div class="col-md-6">
											{!! Form::select('reject_b_status', ['' => 'Choose One', 'NOT INTERESTED(MULTIPLE OBJECTIONS)' => 'NOT INTERESTED(MULTIPLE OBJECTIONS)', 'WRONG REBUTTAL OR PROBING INTRO' => 'WRONG REBUTTAL OR PROBING INTRO', 'SRC-NON COMPLIANCE' => 'SRC-NON COMPLIANCE', 'BAD RECORDING' => 'BAD RECORDING', 'POOR CALL HANDLING / POSSIBLE COMPLAING' => 'POOR CALL HANDLING / POSSIBLE COMPLAING', 'DODGY CALLS/PRANK CUSTOMERS' => 'DODGY CALLS/PRANK CUSTOMERS'], $crm->reject_b_status, array('class' => 'form-control')) !!}
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label">Reject C</label>
										<div class="col-md-6">
											{!! Form::select('reject_c_status', ['' => 'Choose One', 'Screamer' => 'Screamer'], $crm->reject_c_status, array('class' => 'form-control')) !!}
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
