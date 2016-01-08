@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Suppression List</div>
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
                            	<th colspan="4"> <center>Suppression Information<center></th>
                                <th colspan="1"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Phone</th>
                                <th>Column Header</th>
                                <th>Date Added</th>
                                <th>Edit</th>
                            <!--     <th>Edit</th>
                                <th>Delete</th> -->
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
@section('suppression')
<script type="text/javascript">
    $(document).ready(function() {
        $('#SuppressionList').DataTable({
            processing: true,
            serverSide: true,
            ajax: 'api/suppression/all',
            columns: [
                {data: 'id', name: 'id'},
                {data: 'phone', name: 'phone'},
                {data: 'column_header', name: 'column_header'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]
        });
    });
</script>
@endsection

