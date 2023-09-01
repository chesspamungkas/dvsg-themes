// var $myGroup = jQuery('#categories-div');
// console.log($myGroup);
// $myGroup.on('show','.collapse', function() {
//     $myGroup.find('.collapse.in').collapse('hide');
// });

jQuery('#categories-div button, #categories-div-m button').click( function(e) {
    jQuery('.collapse').collapse('hide');
});

jQuery( ".desktop-view button" ).click( function(e) {
    e.stopPropagation();
        jQuery( '.col-8.subcat.collapse' ).not( jQuery(this).data("target") ).collapse('hide');
        jQuery( jQuery(this).data("target") ).collapse('show');
    // }, function() {
    //     jQuery( jQuery(this).data("target") ).collapse('hide');
    }
);

jQuery(document).click( function(e) { 
    e.stopPropagation();
    jQuery( '.col-8.subcat.collapse' ).collapse('hide');
});