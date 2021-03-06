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
//    var themesheet = $('<link href="'+themes['simplex']+'" rel="stylesheet" />');
//     themesheet.appendTo('head');
//     $('.theme-link').click(function(){
//        var themeurl = themes[$(this).attr('data-theme')]; 
//         themesheet.attr('href',themeurl);
//     });
// });

// $(function(){
//     function getCookie(c_name) {
//         if (document.cookie.length > 0) {
//             c_start = document.cookie.indexOf(c_name + "=");
//             if (c_start != -1) {
//                 c_start = c_start + c_name.length + 1;
//                 c_end = document.cookie.indexOf(";", c_start);
//                 if (c_end == -1) c_end = document.cookie.length;
//                 return unescape(document.cookie.substring(c_start, c_end));
//             }
//         }
//         return "default";
//     }

//     function setCookie(c_name, value) {
//         var exdate = new Date();
//         exdate.setDate(exdate.getDate() + 7);
//         document.cookie = c_name + "=" + escape(value) + ";path=/;expires=" + exdate.toUTCString();
//     }

//     var setTheme = getCookie('setTheme');

//     var themesheet = $('<link href="'+themes[getCookie('setTheme')]+'" rel="stylesheet" />');

//     themesheet.appendTo('head');

//     $('.theme-link').click(function(){
//         var themeurl = themes[$(this).attr('data-theme')]; 
//         setCookie('setTheme', $(this).attr('data-theme'));
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
$('#QuestionOld').summernote();
// $('#comments').summernote();
$('#cbkTimeLocalTz').timepicker();
$('#cbkTimeCustomerTz').timepicker();

/* Date picker for All */
jQuery('#fromDateAll, #toDateAll').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});


/* Datetime picker for All */
jQuery('#fromDatetimeAll, #toDatetimeAll').datetimepicker({
  format:'Y-m-d H:i:s',
});

jQuery('#birthdate').datetimepicker({
  format:'Y-m-d',
  timepicker:false,
});

jQuery('.time-input').datetimepicker({
  format:'Y-m-d H:i:s',
});


$("#btnYesterday").click(function() {
	var yesterday = moment().subtract(1, 'days').format("YYYY-MM-DD");
	var yesterday2 = moment().format("YYYY-MM-DD");
	$("#fromDateAll").val(yesterday);
	$("#toDateAll").val(yesterday2);
});

$("#btnToday").click(function() {
	var today = moment().format("YYYY-MM-DD");
	var today2 = moment().add(1, 'days').format("YYYY-MM-DD");
	$("#fromDateAll").val(today);
	$("#toDateAll").val(today2);
});

$("#btnLast7Days").click(function() {
	var last7days = moment().subtract(6, 'days').format("YYYY-MM-DD");
	var today = moment().add(1, 'days').format("YYYY-MM-DD");
	$("#fromDateAll").val(last7days);
	$("#toDateAll").val(today);
});

$("#btnLast30Days").click(function() {
	var last30days = moment().subtract(30, 'days').format("YYYY-MM-DD");
	var today = moment().add(1, 'days').format("YYYY-MM-DD");
	$("#fromDateAll").val(last30days);
	$("#toDateAll").val(today);
});