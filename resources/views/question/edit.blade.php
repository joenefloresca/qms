@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
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

					{!! Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'PUT', 'class' => 'form-horizontal')) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Question</label>
							<div class="col-md-6">
								<textarea name="Question" id="Question" class="form-control" row="7">{!! $question->question !!}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Old Question</label>
							<div class="col-md-6">
								<textarea name="QuestionOld" id="QuestionOld" class="form-control" row="7">{!! $question->old_question !!}</textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Lead Reponse</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="lead_response" id="lead_response" value="{!! $question->parent_enable_response !!}" placeholder="Ex. Yes,Possibly">
							</div>
						</div>

						@if($question->is_child == 0)
						   <div class="form-group">
								<label class="col-md-4 control-label">Postcode Restriction</label>
								<div class="col-md-6">
									{!! Form::select('PostCodeRestriction', ['' => 'Choose One', 'PostCodeInclusion' => 'PostCodeInclusion', 'PostCodeExclusion' => 'PostCodeExclusion', 'Both' => 'Both', 'No' => 'No'], $question->postcoderestriction, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Postcode Inclusion</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="PostCodeInclusion" id="PostCodeInclusion" value="{!! $question->postcodeinclusion !!}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Postcode Exclusion</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="PostCodeExclusion" id="PostCodeExclusion" value="{!! $question->postcodeexclusion !!}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Age Restriction</label>
								<div class="col-md-6">
									{!! Form::select('AgeRestriction', ['' => 'Choose One', 'Yes' => 'Yes', 'No' => 'No'], $question->agerestriction, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Age Bracket</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="AgeBracket" id="AgeBracket" value="{!! $question->agebracket !!}">
								</div>
							</div>
						

							<div class="form-group">
								<label class="col-md-4 control-label">Own Home Restriction</label>
								<div class="col-md-6">
									{!! Form::select('OwnHomeRestriction', ['' => 'Choose One', 'Yes' => 'Yes', 'No' => 'No'], $question->ownhomerestriction, array('class' => 'form-control')) !!}
								</div>
							</div>
							

							<div class="form-group" id="DivOwnHomeOptions">
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
									
									<div class="text" style="padding-top: 4px"><input type="text" class="form-control" name="OwnHomeOptions" id="OwnHomeOptions" value="{{$question->ownhomeoptions}}"></div>
								</div>
							</div>


							<div class="form-group">
								<label class="col-md-4 control-label">Telephone Restriction</label>
								<div class="col-md-6">
									{!! Form::select('TelephoneRestriction', ['' => 'Choose One', 'Yes' => 'Yes', 'No' => 'No'], $question->telephonerestriction, array('class' => 'form-control')) !!}
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Telephone Options</label>
								<div class="col-md-6">
									{!! Form::select('TelephoneOptions', ['' => 'Choose One', 'Landline' => 'Landline', 'Mobile' => 'Mobile'], $question->telephoneoptions, array('class' => 'form-control')) !!}
								</div>
							</div>
                        @endif  
						

						<div class="form-group">
							<label class="col-md-4 control-label">Cost Per Lead</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="CostPerLead" id="CostPerLead" value="{!! $question->costperlead !!}">
							</div>
						</div>
						@if($question->is_child != 0)
							<div class="form-group">
								<label class="col-md-4 control-label">Column Header</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="ColumnHeader" id="ColumnHeader" value="{!! $question->columnheader !!}" readonly>
								</div>
							</div>
						@else 
							<div class="form-group">
								<label class="col-md-4 control-label">Column Header</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="ColumnHeader" id="ColumnHeader" value="{!! $question->columnheader !!}" readonly>
								</div>
							</div>
						@endif
						

						<div class="form-group">
							<label class="col-md-4 control-label">Delivery Assignment</label>
							<div class="col-md-6">
								{!! Form::select('DeliveryAssignment', ['' => 'Choose One', 'MIS' => 'MIS', 'CQ' => 'CQ'], $question->deliveryassignment, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Is Enabled</label>
							<div class="col-md-6">
								{!! Form::select('IsEnabled', ['' => 'Choose One', 'Yes' => 'Yes', 'No' => 'No'], $question->isenabled, array('class' => 'form-control')) !!}
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Status</label>
							<div class="col-md-6">
								{!! Form::select('status', ['' => 'Choose One', 'Re-Activate' => 'Re-Activate', 'New Question' => 'New Question', 'Updated Question' => 'Updated Question'], $question->status, array('class' => 'form-control')) !!}
							</div>
						</div>

						<!-- <div class="form-group">
							<label class="col-md-4 control-label">Sort Order</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="sortorder" id="sortorder" value="{!! $question->sortorder !!}">
							</div>
						</div> -->


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
