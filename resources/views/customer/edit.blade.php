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

					{!! Form::model($customer, array('route' => array('customer.update', $customer->id), 'method' => 'PUT', 'class' => 'form-horizontal')) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Title</label>
							<div class="col-md-6">
								{!! Form::select('title', ['' => 'Choose One', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms', 'Dr' => 'Dr', 'Rev'=>'Rev'], $customer->title, array('class' => 'form-control')) !!}
							</div>
						</div>

						

						<div class="form-group">
							<label class="col-md-4 control-label">First Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="firstname" id="firstname" value="{{$customer->firstname}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Surname</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lastname" id="lastname" value="{{$customer->lastname}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Gender</label>
							<div class="col-md-6">
								{!! Form::select('gender', ['' => 'Choose One', 'Male' => 'Male', 'Female' => 'Female'], $customer->gender, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Birth date</label>
							<div class="col-md-6">
								<div class="input-group date">
									<input type="text" class="form-control" name="birthdate" id="birthdate" value="{{$customer->birthdate}}">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Age Bracket</label>
							<div class="col-md-4">
								{!! Form::select('age_bracket', ['' => 'Choose One', '18-29' => '18-29', '30-39' => '30-39', '40-49' => '40-49', '50-59' => '50-59', '60-64'=>'60-64', '65-75'=>'65-75', '75+' => '75+'], $customer->agebracket, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 1</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr1" id="addr1" value="{{$customer->addr1}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 2</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr2" id="addr2" value="{{$customer->addr2}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 3</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr3" id="addr3" value="{{$customer->addr3}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Address 4</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="addr4" id="addr4" value="{{$customer->addr4}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Town</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="town" id="town" value="{{$customer->town}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Country</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="country" id="country" value="{{$customer->country}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Postcode</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="postcode" id="postcode" value="{{$customer->postcode}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Number</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="phone_num" id="phone_num" value="{{$customer->phone_num}}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Type</label>
							<div class="col-md-4">
								{!! Form::select('phone_type', ['' => 'Choose One', 'Landline' => 'Landline', 'Mobile' => 'Mobile'], $customer->phone_type, array('class' => 'form-control')) !!}
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Work Status</label>
							<div class="col-md-4">
								{!! Form::select('work_status', ['' => 'Choose One', 'Employed' => 'Employed', 'Self-Employed' => 'Self-Employed', 'Retired' => 'Retired', 'Company Director' => 'Company Director', 'Other' => 'Other', 'Not answered' => 'Not answered'], $customer->work_status, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Home Status</label>
							<div class="col-md-4">
								{!! Form::select('home_status', ['' => 'Choose One', 'Own Home' => 'Own Home', 'Renting' => 'Renting', 'Living with Family/Friend' => 'Living with Family/Friend', 'Not Answered' => 'Not Answered'], $customer->home_status, array('class' => 'form-control')) !!}						
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Marital Status</label>
							<div class="col-md-4">
								{!! Form::select('marital_status', ['' => 'Choose One', 'Married or Co-Habiting' => 'Married or Co-Habiting', 'Single or Never Married' => 'Single or Never Married', 'Married or Co-habiting' => 'Married or Co-habiting', 'Widowed' => 'Widowed', 'Divorced' => 'Divorced', 'Separated' => 'Separated', 'Others' => 'Others'], $customer->marital_status, array('class' => 'form-control')) !!}		
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
