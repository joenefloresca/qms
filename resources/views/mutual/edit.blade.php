@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">Edit Mutual Exclusive</div>
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

					{!! Form::model($mutual, array('route' => array('mutual.update', $mutual->id), 'method' => 'PUT', 'class' => 'form-horizontal')) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Column Header 1</label>
							<div class="col-md-6">
								{!! Form::select('question_id_1', $question_options, $mutual->question_id_1, array('class' => 'form-control', 'id' => 'question_id_1')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Column Header 2</label>
							<div class="col-md-6">
								{!! Form::select('question_id_2', $question_options, $mutual->question_id_2, array('class' => 'form-control', 'id' => 'question_id_2')) !!}
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
