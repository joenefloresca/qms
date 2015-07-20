@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-success">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					
					<div class="col-md-12">
						<div style="">
							Responses Per Charity
							<canvas id="canvas" height="450" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
