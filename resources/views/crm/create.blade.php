@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-primary">
				<div class="panel-heading">CRM</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('crm') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Age</label>
							<div class="col-md-6">
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
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Postcode</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="CRMPostcode" id="CRMPostcode" placeholder="Ex. CC,DH,CL">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Telephone Options</label>
							<div class="col-md-6">
								<select name="CRMTelephoneOptions" id="CRMTelephoneOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Landline">Landline</option>
									<option value="Mobile">Mobile</option>
								
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Own Home Options</label>
							<div class="col-md-6">
								<select name="CRMOwnHomeOptions" id="CRMOwnHomeOptions" class="form-control">
									<option value="">Choose One</option>
									<option value="Own Home">Own Home</option>
									<option value="Renting">Renting</option>
									<option value="Living with Family/Friend">Living with Family/Friend</option>
									<option value="Not Answered">Not Answered</option>
								</select>
							</div>
						</div>

						<table class="table table-striped table-bordered" id="CRMTable"> 
						 <thead>
                            <tr>
                            	<th> <center>Survey Question<center></th>
                                <th> <center>Response<center></th>
                            </tr>
                           
                        </thead>                               
							<tbody>
                                @foreach($questions as $key => $value)
                                    <tr>
                                        <td>{!! $value->question !!}</td>
                                        <td>
                                        	<select class="form-control" name="{{ $value->columnheader }}" id="{{ $value->columnheader }}" disabled>
                                        		<option value="">---</option>
                                        		<option value="Yes">Yes</option>
                                        		<option value="No">No</option>
                                        		<option value="Possibly">Possibly</option>
                                        	</select>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table> 

                        <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="button" id="trigger" name="trigger" class="btn btn-danger">
									Trigger Rules
								</button>
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
