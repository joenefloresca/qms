@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-success">
				<div class="panel-heading">Question List</div>
				<div class="panel-body">
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
@section('question')
<script type="text/javascript">
$.ajax({
    url: "api/question/all", 
    type: 'GET',
    success: function(result){
    var myObj = $.parseJSON(result);
        $.each(myObj, function(key,value) {
            var t = $('#QuestionList').DataTable();
            if(value.isenabled == "Yes")
            {
                var label = "<span class='label label-success'>Enabled</span>";
                
            }
            else if(value.isenabled == "No")
            {
                var label = "<span class='label label-danger'>Disabled</span>";
            }


            t.row.add( [
                value.sortorder,    
                value.columnheader,
                value.costperlead,
                 value.isenabled,
                // "<label class='toggle'><input type='checkbox' checked='' onclick='return changeEnable(this);' id='"+value.columnheader+"'><span class='handle'></span></label>"+label,
                value.id,
                "<a class='btn btn-small btn-info' href='<?php echo URL::to('question').'/';?>"+value.id+"/edit'><span class='glyphicon glyphicon glyphicon-edit' aria-hidden='true'></span></a>",
                "<form method='POST' action='<?php echo URL::to('question').'/';?>"+value.id+"' accept-charset='UTF-8' class='pull-left' >"+
                "<input name='_method' type='hidden' value='DELETE'>"+
                "<button type='submit' class='btn btn-warning'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button>"+"</form>",
            ] ).draw();

      //    if(value.isenabled == "Yes")
            // {
            //  $("#"+value.columnheader).prop('checked', true);
            //  console.log(value.columnheader);
            // }
            // else if(value.isenabled == "No")
            // {
            //  //$("#"+value.columnheader).prop('checked', false);
            //  $("#"+value.columnheader).removeAttr('checked');

            //  console.log(value.columnheader+ " should be unchecked.");
            // }

        });
    }});


var sortSequence = [];
var sortSequenceId = [];
$("#QuestionList").rowSorter({
    onDrop: function(tbody, row, index, oldIndex) {
        $(tbody).parent().find("tfoot > tr > td").html((oldIndex + 1) + ". row moved to " + (index + 1));
    }
});

$("#saveSort").click(function() {
    sortSequence = [];
        $('#QuestionList tbody tr td:nth-child(1)').each( function(){
       //add item to array
       sortSequence.push( $(this).text() );       
    });
    $('#QuestionList tbody tr td:nth-child(5)').each( function(){
       
       sortSequenceId.push( $(this).text() );       
    });

    var cnt = 1;

        $.each(sortSequence, function(key,value) { 
            $.ajax({
            url: "api/sort/questions", 
            type: 'GET',
            data: {"value":value, "cnt" : cnt, "id" : sortSequenceId[key]},
            success: function(result){
                // console.log(result);
            }});
            cnt++;
        });

        location.reload();
            
});

function changeEnable(id)
{
    var val     = $(id).attr('id');
    var ischeck = $("#"+val).is(":checked");

    alert(ischeck);
    if(ischeck == true)
    {
        $.ajax({
        url: "api/question/changeenable", 
        type: 'GET',
        data: {'id':val, 'isenabled': 'Yes'},
        success: function(result){

            if(result > 0)
            {
                alert("Question "+val+ " has been enabled.");
                location.reload();
            }
            else
            {
                alert("Error enabling the question. Please contact Administrator");
                location.reload();
            }
        }});
    }
    else
    {
        $.ajax({
        url: "api/question/changeenable", 
        type: 'GET',
        data: {'id':val, 'isenabled': 'No'},
        success: function(result){

            if(result > 0)
            {
                alert("Question "+val+ " has been disabled.");
                location.reload();
            }
            else
            {
                alert("Error disabling the question. Please contact Administrator");
                location.reload();
            }
        }});        
    }
    
}    
</script>
@endsection

