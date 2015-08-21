@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Question</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('question') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Question</label>
							<div class="col-md-6">
								<textarea name="Question" id="Question" class="form-control" row="7">Content here..</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Lead Reponse</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lead_response" id="lead_response" value="" placeholder="Ex. Yes,Possibly">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Postcode Restriction</label>
							<div class="col-md-6">
								<select name="PostCodeRestriction" id="PostCodeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="PostCodeInclusion">PostCodeInclusion</option>
									<option value="PostCodeExclusion">PostCodeExclusion</option>
									<option value="Both">Both</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group"  id="DivPostCodeInclusion" style="display: none">
							<label class="col-md-4 control-label">Postcode Inclusion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="PostCodeInclusion" id="PostCodeInclusion" placeholder="Ex. CC,DH,CL">
							</div>
						</div>

						<div class="form-group" id="DivPostCodeExclusion" style="display: none">
							<label class="col-md-4 control-label">Postcode Exclusion</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="PostCodeExclusion" id="PostCodeExclusion" placeholder="Ex. CC,DH,CL">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Age Restriction</label>
							<div class="col-md-6">
								<select name="AgeRestriction" id="AgeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivAgeBracket" style="display: none">
							<label class="col-md-4 control-label">Age Bracket</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="AgeBracket" id="AgeBracket" placeholder="Ex. 30-50">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Own Home Restriction</label>
							<div class="col-md-6">
								<select name="OwnHomeRestriction" id="OwnHomeRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivOwnHomeOptions" style="display: none">
							<label class="col-md-4 control-label">Own Home Options</label>
							<div class="col-md-6">
								<!-- <select name="OwnHomeOptions" id="OwnHomeOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Own Home">Own Home</option>
									<option value="Renting">Renting</option>
									<option value="Living with Family/Friend">Living with Family/Friend</option>
									<option value="Not Answered">Not Answered</option>
								</select> -->
								<div class="checkbox">
 					 				<label><input type="checkbox" name="OwnHome" id="OwnHome" value="Own Home">Own Home</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="Renting" id="Renting" value="Renting">Renting</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="LivWithFamFrnd" id="LivWithFamFrnd" value="Living with Family/Friend">Living with Family/Friend</label>
								</div>
								<div class="checkbox">
 					 				<label><input type="checkbox" name="NotAns" id="NotAns" value="Not Answered">Not Answered</label>
								</div>
								
								<div class="text" style="padding-top: 4px"><input type="text" class="form-control" name="OwnHomeOptions" id="OwnHomeOptions"></div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Telephone Restriction</label>
							<div class="col-md-6">
								<select name="TelephoneRestriction" id="TelephoneRestriction" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group" id="DivTelephoneOptions" style="display: none">
							<label class="col-md-4 control-label">Telephone Options</label>
							<div class="col-md-6">
								<select name="TelephoneOptions" id="TelephoneOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Landline">Landline</option>
									<option value="Mobile">Mobile</option>
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Cost Per Lead</label>
							<div class="col-md-6">
								<div class="input-group">
			                      <span class="input-group-addon">£</span>
			                      	<input type="text" class="form-control" name="CostPerLead" id="CostPerLead">
			                      <span class="input-group-addon">.00</span>
                    			</div>
								
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Column Header</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ColumnHeader" id="ColumnHeader">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Delivery Assignment</label>
							<div class="col-md-6">
								<select name="DeliveryAssignment" id="DeliveryAssignment" class="form-control">
									<option value="">Choose One</option>
									<option value="MIS">MIS</option>
									<option value="CQ">CQ</option>
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Is Enabled</label>
							<div class="col-md-6">
								<select name="IsEnabled" id="IsEnabled" class="form-control">
									<option value="">Choose One</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">P.O #</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="po_num" id="po_num" value="">
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-4 control-label">Sort Order</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="sortorder" id="sortorder" value="">
							</div>
						</div> -->


							<div class="form-group">
								<label class="col-md-4 control-label">Number of Child Questions</label>
								<div class="col-md-4">
									<input type="text" class="form-control" name="numGenerate" id="numGenerate" value="{{ old('numGenerate') }}" placeholder=""> 
								</div>
							</div> 

							<div class="form-group">
								<div class="col-md-4 control-label"></div>
								<div class="col-md-4">
									<button type="button" class="btn btn-default" id="btnGenerate" name="btnGenerate">Go</button>
								</div>
							</div>

							

							<input type="hidden" class="form-control" name="NumberOfScripts" id="NumberOfScripts" value="{{ old('NumberOfScripts') }}" placeholder="" > 

							<table class="table" id="scripts"></table>
					

						<!-- <input type="text" name="restrictioncount" id="restrictioncount" /> -->

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
