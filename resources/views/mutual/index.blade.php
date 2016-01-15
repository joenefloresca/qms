@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Mutual Exclusive List</div>
				<div class="panel-body">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                          @endif
                        @endforeach
                    </div>
                    <table id="SuppressionList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="3"> <center>Mutual Exclusive Information<center></th>
                                <th colspan="1"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Column Header 1</th>
                                <th>Column Header 2</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('mutual')
<script type="text/javascript">
    $(document).ready(function() {
        $('#SuppressionList').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'api/mutual/all',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'q1', name: 'q1'},
                {data: 'q2', name: 'q2'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection

