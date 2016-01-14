@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Suppression Upload</div>
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

					<form class="form-horizontal" role="form" method="POST" action="{{ url('suppression-upload') }}" enctype="multipart/form-data">
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
							<label class="col-md-4 control-label">Column Header</label>
							<div class="col-md-6">
								<div class="input-group">
									{!! Form::select('question_options', $question_options, '', array('class' => 'form-control', 'id' => 'question_options')) !!}
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
					              <h4>Note:</h4>
					              <p>Records with up to 30,000 records might take up to 4 minutes to upload.</p>
					              <p>Delete other sheets in your excel file or upload will fail.</p>
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
