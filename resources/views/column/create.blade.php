@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Question | <font class="o">Column header will be added to <strong>customer</strong> and <strong>customer_history</strong> tables.</font></div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('column') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Column Header</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="ColumnHeader" id="ColumnHeader" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Method</label>
							<div class="col-md-6">
								<select name="Method" id="Method" class="form-control" required>
									<option value="">Choose One</option>
									<option value="ADD">ADD</option>
									<option value="DROP">DROP</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Choose Databases</label>
							<div class="col-md-6">
								<div class="checkbox">
								  <label><input type="checkbox" value="UKSurvey1_General" name="UKSurvey1_General">UKSurvey1_General</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="UKSurvey1_MCS" name="UKSurvey1_MCS">UKSurvey1_MCS</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="UKSurvey2_General" name="UKSurvey2_General">UKSurvey2_General</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="UKSurvey2_MCS" name="UKSurvey2_MCS">UKSurvey2_MCS</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="MCSSurvey_Main" name="MCSSurvey_Main">MCSSurvey_Main</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="HSG_Survey" name="HSG_Survey">HSG_Survey</label>
								</div>
								<div class="checkbox">
								  <label><input type="checkbox" value="pgsql" name="pgsql">pgsql (Database: qms) <small class="text-danger">Test Database only. DO NOT DELETE</small> </label>
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
