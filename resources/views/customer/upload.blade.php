@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Customer Upload</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('customer-upload') }}" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Upload Excel</label>
							<div class="col-md-6">
								<div class="input-group">
									<input type="file" class="form-control" name="file" id="file">
									<span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span>
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

						<div class="form-group">
							<div class="col-md-8">
								<div class="alert alert-warning alert-dismissable">
					              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					              <h4>Warning!</h4>
					              <p>To upload records, you must follow the format to avoid conflicts/problems. Template can be downloaded on the button below.</p>
					              <p>You can delete the first record on the first row of the template.</p>
					              <p><a class="btn btn-warning" href="{{URL::to('')}}/import/Customer Upload.xlsx">Download Template</a></p>
		            			</div>
	            		    </div>

					    </div>

					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
