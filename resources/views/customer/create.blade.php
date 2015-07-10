@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Customer</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('customer') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								<select name="title" id="title" class="form-control">
									<option value="">Choose One</option>
									<option value="Mr">Mr</option>
			  						<option value="Mrs">Mrs</option>
			  						<option value="Ms">Miss</option>
			  						<option value="Dr">Dr</option>
			  						<option value="Rev">Rev</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" id="firstname">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Surname</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" id="lastname">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Gender</label>
							<div class="col-md-6">
								<select name="gender" id="gender" class="form-control">
									<option value="">Choose One</option>
									<option value="Male">Male</option>
					  				<option value="Female">Female</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Birth date</label>
							<div class="col-md-6">
								<div class="input-group date">
									<input type="text" class="form-control" name="birthdate" id="birthdate">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Age Bracket</label>
							<div class="col-md-4">
								<select name="age_bracket" id="age_bracket" class="form-control">
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
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 1</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr1" id="addr1">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 2</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr2" id="addr2">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 3</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr3" id="addr3">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 4</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr4" id="addr4">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Town</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="town" id="town">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" id="country ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Postcode</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="postcode" id="postcode">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_num" id="phone_num ">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Type</label>
							<div class="col-md-4">
								<select name="phone_type" id="phone_type" class="form-control">
									<option value="">Choose One</option>
									<option value="Landline">Landline</option>
									<option value="Mobile">Mobile</option>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Work Status</label>
							<div class="col-md-4">
								<select name="work_status" id="work_status" class="form-control">
									<option value="">Choose One</option>
									<option value="Employed">Employed</option>
									<option value="Self-Employed">Self-Employed</option>
									<option value="Retired">Retired</option>
									<option value="Company Director">Company Director</option>
									<option value="Other">Other</option>
									<option value="Not answered">Not answered</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Home Status</label>
							<div class="col-md-4">
								<select name="home_status" id="home_status" class="form-control">
									<option value="">Choose One</option>
									<option value="Own Home">Own Home</option>
									<option value="Renting">Renting</option>
									<option value="Living with Family/Friend">Living with Family/Friend</option>
									<option value="Not Answered">Not Answered</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Marital Status</label>
							<div class="col-md-4">
								<select name="marital_status" id="marital_status" class="form-control">
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
