(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
		
		// DOM ready, take it away
		
	});
	
})(jQuery, this);

jQuery(function($) {
    // init Masonry
    var $grid = $('.grid').masonry({
        // options
        //itemSelector: '.grid-item',
        //columnWidth: 400
        columnWidth: '.grid-sizer',
        itemSelector: '.grid-item',
        percentPosition: true
    });

    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });

});


(function ( $ ) {
    "use strict";
    /* Replace the ID `123456` with the ID of your grid */
    var my_grid_id = '.grid'; //alternatively use `.post-grid` for a less targetted approach
    
    var $my_grid = {};
    var $grid_items = {};
        
    $(document).on("sf:ajaxfinish", ".searchandfilter", function(){
        
        /*
        $my_grid = $(my_grid_id);
        $grid_items = $my_grid.find('.grid-item');


        
        if($grid_items.length>0){
            if($grid_items.hasClass("masonry")){
                $grid_items.removeClass("masonry");
                $grid_items.masonry('destroy');
            }
            $grid_items.removeAttr('style');
            $grid_items.masonry({isFitWidth: true});
        }
        */
       var $grid = $('.grid').masonry({
        // options
        //itemSelector: '.grid-item',
        //columnWidth: 350
        columnWidth: '.grid-sizer',
        itemSelector: '.grid-item',
        percentPosition: true
    });

    // layout Masonry after each image loads
    $grid.imagesLoaded().progress( function() {
        $grid.masonry('layout');
    });


    });     
}(jQuery));




jQuery(function($) {

$( document ).ready(function() {
    $('select').selectpicker();
    $('.selectpicker').selectpicker('refresh');
});

}(jQuery));