@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Customer List</div>
				<div class="panel-body">
					<!-- <div class="loading-progress" id="progressbar" style="padding-left: 2px; padding-right: 2px; padding-top: 2px"></div> -->
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                          @if(Session::has('alert-' . $msg))
                          <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                          @endif
                        @endforeach
                    </div>
                    <table id="CustomerList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            	<th colspan="7"> <center>Customer Information<center></th>
                                <!-- <th colspan="2"> <center>Actions<center></th> -->
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Postcode</th>
                                <th>Country</th>
                            <!--     <th>Edit</th>
                                <th>Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <!-- <tfoot>
							<tr>
                                <td colspan="9">&nbsp;</td>
								<td colspan="7">&nbsp;</td>
							</tr>
						</tfoot> -->
                    </table>
                  
                    
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('customer')
<script type="text/javascript">
// $.ajax({
    // url: "api/customer/all", 
    // type: 'GET',
    // success: function(result){
    // var myObj = $.parseJSON(result);
 //     $.each(myObj, function(key,value) {
 //         var t = $('#CustomerList').DataTable(
    //          {
    //              "processing": true,
    //              "scrollY" : 400
    //          }
 //         );
 //         t.row.add( [
    //             value.id,    
    //             value.firstname,
    //             value.lastname,
    //             value.gender,
    //             value.phone_num,
    //             value.postcode,
    //             value.country,
    //             // "<a class='btn btn-small btn-info' href='<?php echo URL::to('customer').'/';?>"+value.id+"/edit'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
    //             // "<form method='POST' action='<?php echo URL::to('customer').'/';?>"+value.id+"' accept-charset='UTF-8' class='pull-left' >"+
    //             // "<input name='_method' type='hidden' value='DELETE'>"+
    //             // "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"+"</form>",
 //         ] ).draw();
            
    //  });
    // }});

    $(document).ready(function() {
        $('#CustomerList').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": "api/customer/all",
            //"paging" : true,
            //"scrollY" : 400,
           // "searching" : true,
            //"ordering" :  true,
            //"pagingType" : "full_numbers" 
        } );
    });
</script>
@endsection

