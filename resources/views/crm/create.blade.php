@extends('app')

@section('content')
<div class="container-fluid">
	<form class="form-horizontal" role="form" method="POST" action="{{ url('crm') }}">
	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="row">
		<div class="col-sm-3 sidebar">
	       <div class="panel panel-success">
	       	<div class="panel-heading">CRM</div>
	       		<div class="panel-body">
	       			<div class="form-horizontal">
	       				<div class="form-group">
	       					<div class="col-md-12">
							 <div class="input-group">
							 	  <input type="hidden" class="form-control" id="customer_id" name="customer_id">
							      <input type="text" class="form-control" id="customer_number" placeholder="Search customer number." value="09277878031">
							      <span class="input-group-btn">
							        <button class="btn btn-default" id="searchCustomer" type="button"><i class="glyphicon glyphicon-search"></i></button>
							      </span>
							 </div>   
    						</div>
						</div>

	       				<!-- <div class="form-group">
	       					<div class="col-md-8">
				       			<center> 
					       			<div style="margin: 15px 0px 0px; display: inline-block; text-align: center;"><div style="display: inline-block; padding: 2px 4px; margin: 0px 0px 5px; border: 1px solid rgb(204, 204, 204); text-align: center; background-color: rgb(255, 255, 255);"><a href="http://localtimes.info/difference" style="text-decoration: none; font-size: 13px; color: rgb(0, 0, 0);">World Clock</a></div><script type="text/javascript" src="http://localtimes.info/world_clock2.php?&cp1_Hex=000000&cp2_Hex=FFFFFF&cp3_Hex=000000&fwdt=88&ham=0&hbg=0&hfg=0&sid=0&mon=0&wek=0&wkf=0&sep=0&widget_number=11000"></script></div>
								</center> 
							</div>
						</div>
					 -->
						
						<!-- <div class="form-group">
							<ul class="list-group">
				              <li class="list-group-item"><input type='radio'  id='selfcallback' name="selfcallback"> Local TZ <input type="text" class="form-control timepicker" id="cbkTimeLocalTz" name="cbkTimeLocalTz" placeholder="Select CBK Time" data-default-time="false"></li>
            				</ul>
            				<ul class="list-group">
				              <li class="list-group-item"><input type='radio'  id='selfcallback' name="selfcallback"> Customer TZ <input type="text" class="form-control" id="cbkTimeCustomerTz" name="cbkTimeCustomerTz" placeholder="Select CBK Time" data-default-time="false"></li>
            				</ul>
            				<ul class="list-group">
				              <li class="list-group-item"><input type='radio'  id='selfcallback' name="selfcallback"> After 
				              		<div class="form-group">
				              			<div class="col-md-7">
						              		<select class="form-control">
						              			<option value="">Days</option>
						              		</select>
					              		</div>
				              		</div>
				              		<div class="form-group">
				              			<div class="col-md-7">
						              		<select class="form-control">
						              			<option value="">Hours</option>
						              		</select>
					              		</div>
				              		</div>
				              		<div class="form-group">
				              			<div class="col-md-7">
						              		<select class="form-control">
						              			<option value="">Minutes</option>
						              		</select>
					              		</div>
				              		</div>
				              </li>
            				</ul>

						</div> -->
						<div class="form-group">
							<label class="col-md-5 control-label text-success">Your Total Login Hours</label>
							<div class="col-md-6">
								<div class="input-group">
			                      	<input type="text" class="form-control" name="agentLoginHours" id="agentLoginHours"  readonly>
                    			</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-5 control-label text-success">Completed Surveys</label>
							<div class="col-md-6">
								<div class="input-group">
			                      	<input type="text" class="form-control" name="agentCompletedSurvey" id="agentCompletedSurvey"  readonly>
                    			</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-5 control-label text-success">Completed Survey Gross</label>
							<div class="col-md-6">
								<div class="input-group">
			                      	<input type="text" class="form-control" name="agentCompletedSurveyGross" id="agentCompletedSurveyGross"  readonly>
                    			</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-5 control-label text-success">Partital Surveys</label>
							<div class="col-md-6">
								<div class="input-group">
			                      	<input type="text" class="form-control" name="agentPartialSurvey" id="agentPartialSurvey"  readonly>
                    			</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-5 control-label text-success">Partital Survey Gross</label>
							<div class="col-md-6">
								<div class="input-group">
			                      	<input type="text" class="form-control" name="agentPartialSurveyGross" id="agentPartialSurveyGross"  readonly>
                    			</div>
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-5 control-label text-success">Your Total Gross Today</label>
							<div class="col-md-6">
								<div class="input-group">
									<span class="input-group-addon">£</span>
			                      	<input type="text" class="form-control" name="agentTodayGross" id="agentTodayGross"  readonly>
                    			</div>
							</div>
						</div> -->
						<div class="form-group" style="visibility: hidden">
							<label class="col-md-5 control-label text-success">Gross Revenue</label>
							<div class="col-md-6">
								<div class="input-group">
			                      <span class="input-group-addon">£</span>
			                      	<input type="text" class="form-control" name="CRMGross" id="CRMGross" value="0.00" readonly>
			                      <!-- <span class="input-group-addon">.00</span> -->
                    			</div>
							</div>
						</div>

					</div>
					

	       		</div>			
	       </div>   
	        
        </div>
			<div class="col-md-9">
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
				<div class="panel panel-success">
				<div class="panel-heading">CRM</div>
				<div class="panel-body">
					<p><strong>Introduction:</strong></p>
					<p>Hi, this is from <strong>MyCharitySurvey.com</strong>. We are calling on behalf of some of the UK’s largest charities, organizations and brands to conduct a brief marketing questionnaire to gauge your potential interest in their causes, products and services. This won’t take long. </p>

					<p><strong>Opt-in Statement:</strong></p>
					<p>MyCharitySurvey.com, our charity partners, the charities and organizations named in this questionnaire may wish to contact you by phone, SMS or e-mail, regarding your potential interest to support good causes and give you more information about their products and services. You can opt out anytime by visiting our website, www.mycharitysurvey.com. </p>

					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">Shall we proceed?… Yes/No</label>
							<div class="col-md-4">
								<!-- <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#continueModal">Yes</button> -->
								<!-- <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#shallwestart">Yes/No</button>	 -->
								<select name="CrmShallWeStart" id="CrmShallWeStart" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								 </select>
							</div>
						</div>
					</div>

					<div class="alert alert-danger alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		              <small><strong>Note:</strong>There MUST be a positive expression of interest to continue with the survey</small>
            		</div>
            		<div class="alert alert-info alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		              <small>Before we get started, I just need to let you know that this call is being recorded for training and quality control.</small>
            		</div>
            		<div class="alert alert-warning alert-dismissable">
		              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		              <small>If the customer does not want to tape/ record the conversation - “Not a problem, I will turn off the recording feature.</small>
            		</div>

            		<div class="form-horizontal">
						<div class="form-group">
							<label class="col-md-4 control-label">Are you a permanent resident of UK?</label>
							<div class="col-md-3">
								<select name="CrmIsUKPermanentResident" id="CrmIsUKPermanentResident" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								 </select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<!-- Modal -->
						<div id="continueModal" class="modal fade" role="dialog">
						  <div class="modal-dialog">
						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Verification</h4>
						      </div>
						      <div class="modal-body">
						        <div class="form-horizontal">
						        	<table class="table borderless"> 
								<tr>
									<td class="text-danger">Can I confirm that your post code is</td>
								</tr>
								<tr>
									<td><strong>Postcode</strong></td>
									<td><input type="" id="CRMPostcodeNew" name="CRMPostcodeNew" class="form-control" placeholder="Ex. CC,DH,CL"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CRMPostcodeBtn">-></button></center></td>
									<td><input type="" id="CRMPostcode" name="CRMPostcode" class="form-control" placeholder="Ex. CC,DH,CL"></td>
								</tr>
								<tr>
									<td colspan="2" class="text-danger">Can I confirm that your house number is ______ and it's at (street name?)</td>
								</tr>
								<tr>
									<td><strong>Addr1</strong></td>
									<td><input type="text" id="CrmAddr1New" name="CrmAddr1New" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmAddr1Btn">-></button></center></td>
									<td><input type="text" id="CrmAddr1" name="CrmAddr1" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Addr2</strong></td>
									<td><input type="text" id="CrmAddr2New" name="CrmAddr2New" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmAddr2Btn">-></button></center></td>
									<td><input type="text" id="CrmAddr2" name="CrmAddr2" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Addr3</strong></td>
									<td><input type="text" id="CrmAddr3New" name="CrmAddr3New" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmAddr3Btn">-></button></center></td>
									<td><input type="text" id="CrmAddr3" name="CrmAddr3" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Addr4</strong></td>
									<td><input type="text" id="CrmAddr4New" name="CrmAddr4New" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmAddr4Btn">-></button></center></td>
									<td><input type="text" id="CrmAddr4" name="CrmAddr4" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Town</strong></td>
									<td><input type="text" id="CrmTownNew" name="CrmTownNew" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmTownBtn">-></button></center></td>
									<td><input type="text" id="CrmTown" name="CrmTown" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Country</strong></td>
									<td><input type="text" id="CrmCountryNew" name="CrmCountryNew" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmCountryBtn">-></button></center></td>
									<td><input type="text" id="CrmCountry" name="CrmCountry" class="form-control"></td>
								</tr>
								<tr>
									<td class="text-danger">Can I confirm that your last name is And your first name is?</td>
								</tr>
								<tr>
									<td><strong>Title</strong></td>
									<td>
										<select name="Title" id="Title" class="form-control">
											<option value="">Choose One</option>
											<option value="Mr">Mr</option>
					  						<option value="Mrs">Mrs</option>
					  						<option value="Ms">Miss</option>
					  						<option value="Dr">Dr</option>
					  						<option value="Rev">Rev</option>
									 	</select>
									</td>
								</tr>
								<tr>
									<td><strong>Gender</strong></td>
									<td>
										<select name="Gender" id="Gender" class="form-control">
											<option value="">Choose One</option>
											<option value="Male">Male</option>
					  						<option value="Female">Female</option>
									 	</select>
									</td>
								</tr>
								<tr>
									<td><strong>First Name</strong></td>
									<td><input type="text" id="CrmFirstNameNew" name="CrmFirstNameNew" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmFirstNameBtn">-></button></center></td>
									<td><input type="text" id="CrmFirstName" name="CrmFirstName" class="form-control"></td>
								</tr>
								<tr>
									<td><strong>Surname</strong></td>
									<td><input type="text" id="CrmSurnameNew" name="CrmSurnameNew" class="form-control"></td>
									<td><center><button type="button" class="btn btn-primary btn-sm" id="CrmSurnameBtn">-></button></center></td>
									<td><input type="text" id="CrmSurname" name="CrmSurname" class="form-control"></td>
								</tr>

							</table>
						        </div>
						      </div>
						      <div class="modal-footer">
						        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
						        <button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
						      </div>
						    </div>
						  </div>
						</div>
						
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">CRM</div>
				<div class="panel-body">
						<table class="table borderless">
							<tr>
								<td class="bg-primary" colspan="3">Alternate</td>
							</tr>
						</table>

						<div class="form-group col-md-12">
							<center><label class="control-label pull-left">May I have your alternate phone number?</label></center>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Type</label>
							<div class="col-md-4">
								<select name="CRMTelephoneOptions" id="CRMTelephoneOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Landline">Landline</option>
									<option value="Mobile">Mobile</option>
								</select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone No.</label>
							<div class="col-md-4">
								<input type="text" class="form-control" name="CRMTelephoneNo" id="CRMTelephoneNo" placeholder="Phone No.">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Mr...To confirm that you are over the age of 18, please indicate into which age bracket do you fall?</label>
							<div class="col-md-4">
								<select name="CrmAge" id="CrmAge" class="form-control">
									<option value="">Choose One</option>
									<option value="18-29">18-29</option>
			  						<option value="30-39">30-39</option>
			  						<option value="40-49">40-49</option>
			  						<option value="50-59">50-59</option>
			  						<option value="60-64">60-64</option>
			  						<option value="65-75">65-75</option>
			  						<option value="75+">75+</option>
								 </select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<div class="form-group col-md-12">
							<div class="alert alert-warning alert-dismissable col-md-8">
				              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				              <small>If customer refuse to confirm the Age Bracket, Please Probe -- “Just a wild guess, would you be…... (suggest age bracket)</small>
	            			</div>
            			</div>
						

						<div class="form-group">
							<label class="col-md-4 control-label">Are you employed, self employed, retired or a company director?</label>
							<div class="col-md-4">
								<select name="CRMWorkStatus" id="CRMWorkStatus" class="form-control">
									<option value="">Choose One</option>
									<option value="Employed">Employed</option>
									<option value="Self-Employed">Self-Employed</option>
									<option value="Retired">Retired</option>
									<option value="Company Director">Company Director</option>
									<option value="Other">Other</option>
									<option value="Not answered">Not answered</option>
								</select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Currently, are you a homeowner, renting or living with family or friends?</label>
							<div class="col-md-4">
								<select name="CRMOwnHomeOptions" id="CRMOwnHomeOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Own Home">Own Home</option>
									<option value="Renting">Renting</option>
									<option value="Living with Family/Friend">Living with Family/Friend</option>
									<option value="Not Answered">Not Answered</option>
								</select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Would you be: Single or never Married, Married or Co-Habiting, Widowed, Divorced, or Separated?</label>
							<div class="col-md-4">
								<select name="CRMMaritalStatus" id="CRMMaritalStatus" class="form-control">
								  <option value="">Choose One</option>
								  <option value="Married or Co-Habiting">Married or Co-Habiting</option>
					              <option value="Single or Never Married">Single or Never Married</option>
					              <option value="Married or Co-Habiting">Married or Co-habiting</option>
					              <option value="Widowed">Widowed</option>
					              <option value="Divorced">Divorced</option>
					              <option value="Separated">Separated</option>
					              <option value="Others">Others</option>
								</select>
							</div>
							<div class="text-danger"><label class="control-label">* Required</label></div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" id="trigger" name="trigger" class="btn btn-info">
									Begin Survey
								</button>
							</div>
						</div>

						<table class="table table-bordered" id="CRMTable" style="display: none"> 
						 <thead>
						 	<tr>
                            	<th colspan="2" class="text-primary">Mr./Mrs. I am going to ask you a series of questions and you can answer me with yes, never, or yes,possibly, if you so wish</th>
                              
                            </tr>
                            <tr>
                            	<th> <center>Charity Questions<center></th>
                                <th> <center>Response<center></th>
                            </tr>
                           
                        </thead>                               
							<tbody>
                                @foreach($questions as $key => $value)
                                    <?php
                                    	if($value->is_child == 0 && $value->child_count == 0){
                                    		$class = "bg-success";
                                    	} else{
                                    		$class = "bg-warning";
                                    	}
                                    ?>
                                    <tr id="{{ $value->columnheader }}block" class="{{$class}}">
                                        <td>{!! $value->question !!}</td>
                                        <td>
                                        	<select class="form-control" name="{{ $value->columnheader }}" id="{{ $value->columnheader }}" value="{{ $value->costperlead }}" onchange="return get_response(this), enable_next(this);" disabled>
                                        		<option value=""></option>
	                                        	<?php
	                                        	
	                                        		if($value->is_child == 0)
	                                        		{	
	                                        			$options = explode(",",$value->parent_enable_response);
	                                        		}
	                                        		else
	                                        		{
	                                        			$options = explode(",",$value->child_lead_respponse);
	                                        		}
	                                        		

	                                        		foreach ($options as $key) {
	                                        			echo "<option value='$key'>".$key."</option>";
	                                        		}
	                                        	?>
	                                        	<option value="">N/A</option>
                                        	</select>
                                        	<!-- <input type="text" class="form-control" name="{{ $value->columnheader }}" id="{{ $value->columnheader }}" onblur="return get_response(this);" placeholder="Ex. Yes, No, Possibly" disabled> -->
                                        	<input type="hidden" class="form-control" name="hidden_val_{{ $value->columnheader }}" id="hidden_val_{{ $value->columnheader }}" value="{{ $value->costperlead }}">
                                        	<!-- <select class="form-control" name="{{ $value->columnheader }}" id="{{ $value->columnheader }}" value="{{ $value->costperlead }}" onchange="return get_response(this);" disabled>
                                        		<option value=""></option>
                                        		<option value="Yes">Yes</option>
                                        		<option value="No">No</option>
                                        		<option value="Possibly">Possibly</option>
                                        	</select> -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            	<tr>
                            		<th colspan="2" class="text-primary">Mr. , that’s the end of the questionnaire. Thank you so much for sharing your valuable time to participate. Let me share with you that we are not a charitable institution. We have been given authority by our charity partners, the charities and organizations named in this questionnaire, to gauge your interests in their causes, and to tell you about their products or services. By undertaking this marketing questionnaire, they may contact you in the future. To check our privacy policy, please visit our website, www.mycharitysurvey.com. Have a great day!
                            		</th>
                            	</tr>
                            </tfoot>
                        </table> 

						<div class="form-group" id="DispositionDiv" style="display: block">
							<label class="col-md-4 control-label"><small>Set Disposition</small></label>
							<div class="col-md-4">
								<select name="CrmDisposition" id="CrmDisposition" class="form-control">
									<option value="">Choose One</option>
									<option value="Completed Survey">Completed Survey</option> 
									<option value="Partial Survey">Partial Survey</option> 
									<!-- <option value="MCS Record">MCS Record</option>  -->
								 </select>
							</div>
						</div>

						<div class="form-group" style="display: none" id="CrmSubmitDiv">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div class="row"> -->	
		
	<!-- </div> -->	
	</form>
</div>
@endsection

@section('CrmCreate')
<script type="text/javascript">
checkAgentLoginHours();
	function checkAgentLoginHours(){
		$.ajax({
			url: "api/agent/loginhours",  
			type: 'GET',
			data: {'agent_id':agent_id},
			success: function(result){
				$("#agentLoginHours").val(result);
			},
			complete: function() {
	                setTimeout(checkAgentLoginHours,1000); //After completion of request, time to redo it after a second
	        }

		});
	}

	getCompletedSurvey();
	function getCompletedSurvey(){
		$.ajax({
			url: "api/agent/completedsurvey",  
			type: 'GET',
			data: {'agent_id':agent_id},
			success: function(result){
				$("#agentCompletedSurvey").val(result);
				var gross = parseInt(result) * 1.75;
				$("#agentCompletedSurveyGross").val(gross);

			},
			complete: function() {
	                setTimeout(getCompletedSurvey,1000); //After completion of request, time to redo it after a second
	        }

		});
	}

	getPartitalSurvey();
	function getPartitalSurvey(){
		$.ajax({
			url: "api/agent/partialsurvey",  
			type: 'GET',
			data: {'agent_id':agent_id},
			success: function(result){
				$("#agentPartialSurvey").val(result);
				var gross = parseInt(result) * 0.40;
				$("#agentPartialSurveyGross").val(gross);

			},
			complete: function() {
	                setTimeout(getPartitalSurvey,1000); //After completion of request, time to redo it after a second
	        }

		});
	}

	checkAgentDayGross();
	function checkAgentDayGross(){
		$.ajax({
			url: "api/agent/daygross",  
			type: 'GET',
			data: {'agent_id':agent_id},
			success: function(result){
				$("#agentTodayGross").val(result);
			},
			complete: function() {
	                setTimeout(checkAgentDayGross,1000); //After completion of request, time to redo it after a second
	        }

		});
	}
</script>
@endsection