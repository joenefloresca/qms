// var themes = {
//     "default": "//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css",
//     "amelia" : "//bootswatch.com/amelia/bootstrap.min.css",
//     "cerulean" : "//bootswatch.com/cerulean/bootstrap.min.css",
//     "cosmo" : "//bootswatch.com/cosmo/bootstrap.min.css",
//     "cyborg" : "//bootswatch.com/cyborg/bootstrap.min.css",
//     "flatly" : "//bootswatch.com/flatly/bootstrap.min.css",
//     "journal" : "//bootswatch.com/journal/bootstrap.min.css",
//     "readable" : "//bootswatch.com/readable/bootstrap.min.css",
//     "simplex" : "//bootswatch.com/simplex/bootstrap.min.css",
//     "slate" : "//bootswatch.com/slate/bootstrap.min.css",
//     "spacelab" : "//bootswatch.com/spacelab/bootstrap.min.css",
//     "united" : "//bootswatch.com/united/bootstrap.min.css"
// }

// $(function(){
//    var themesheet = $('<link href="'+themes['cosmo']+'" rel="stylesheet" />');
//     themesheet.appendTo('head');
//     $('.theme-link').click(function(){
//        var themeurl = themes[$(this).attr('data-theme')]; 
//         themesheet.attr('href',themeurl);
//     });
// });

var progress = $(".loading-progress").progressTimer({
	  timeLimit: 10,
	  onFinish: function () {
	  //alert('Data Loading Completed!');
	}
});

$('#Question').summernote();
$('#comments').summernote();
$('#cbkTimeLocalTz').timepicker();
$('#cbkTimeCustomerTz').timepicker();

/* Date picker for All */
jQuery('#fromDateAll').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});

jQuery('#toDateAll').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});

/* Datetime picker for All */
jQuery('#fromDatetimeAll').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#toDatetimeAll').datetimepicker({
  format:'Y-m-d H:i:s',
});


jQuery('#birthdate').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});

// $.ajax({
// 	url: "api/column/all", 
// 	type: 'GET',
// 	success: function(result){
// 	var myObj = $.parseJSON(result);
//     	$.each(myObj, function(key,value) {
//     		var t = $('#columnList').DataTable();

//     		t.row.add( [
// 	            value.id,
// 	            value.column_header,
// 	            value.database,
// 	            value.method,
//         	] ).draw();
    		
// 		});
// 	}}).error(function(){
// 		  progress.progressTimer('error', {
// 		  errorText:'ERROR!',
// 		  onFinish:function(){
// 		    alert('There was an error processing your information!');
// 		  }
// 		});
// 	}).done(function(){
// 			progress.progressTimer('complete');
// 			$( "#progressbar" ).fadeOut( "slow" );
// 	});