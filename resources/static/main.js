$(document).ready(function(){
    $('.ui.dropdown') 
      .dropdown()
    ;

	$('.ui.dimmable')
	  .dimmer('show')
	;

    $('#addPlan').click(function() {
    	
    	$('#addPlanWindow').dimmer("show");
    });

	$('#editList').click(function() {
    	
    	$('#editListWindow').dimmer("show");
    }) 

	$('#CurrentProjectButton').click(function() {
    	var display = $('#CurrentProject').css('display');
    	if (display == "none") {
    		$('#TrackStatus').css("display","none");
    		$('#CurrentProject').css("display","");

    	}
    	
    }) 

    $('#TrackStatusButton').click(function() {
    	var display = $('#TrackStatus').css('display');
    	if (display == "none") {
    		$('#CurrentProject').css("display","none");
    		$('#TrackStatus').css("display","");

    	}
    }) 

});