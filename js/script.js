// some scripts

// jquery ready start
$(document).ready(function() {
	// jQuery code



    
    /* ///////////////////////////////////////

    THESE FOLLOWING SCRIPTS ONLY FOR BASIC USAGE, 
    For sliders, interactions and other

    */ ///////////////////////////////////////
    

	//////////////////////// Prevent closing from click inside dropdown
    $(document).on('click', '.dropdown-menu', function (e) {
      e.stopPropagation();
    });


    

	//////////////////////// Bootstrap tooltip
	if($('[data-toggle="tooltip"]').length>0) {  // check if element exists
		$('[data-toggle="tooltip"]').tooltip()
	} // end if




  

sizeTheOverlays();
}); 
// jquery end

var sizeTheOverlays = function() {
  $(".overlay").resize().each(function() {
  var h = $(this).parent().height();
  var w = $(this).parent().width();
  $(this).css("height", h);
  $(this).css("width", w);
  });
}