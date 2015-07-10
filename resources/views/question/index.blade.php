@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Question List</div>
				<div class="panel-body">
					<div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div>
                    <table id="QuestionList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="5"> <center>Question Information<center></th>
                                <th colspan="2"> <center>Actions<center></th>
                            </tr>
                            <tr>
                                <th>Sort Order</th>
                                <th>Column Header</th>
                                <th>Cost Per Lead</th>
                                <th>Is Enabled?</th>
                                <th>ID</th>
                                <th>Edit/View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <tfoot>
							<tr>
								<td colspan="7">&nbsp;</td>
							</tr>
						</tfoot>
                    </table>
                    <div class="col-md-2">
                    	<button type="button" id="saveSort" name="saveSort" class="btn btn-primary btn-block">Save Sorting</button>
                	</div> 
                    <div class="col-md-8">
	                    <div class="alert alert-warning alert-dismissable">
			              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			              <strong>Note: </strong> You can change the sorting of the data by dragging each item and clicking the Save Sorting button. Sorting also applies to CRM Form
	            		</div>
	            		
            		</div>
                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
