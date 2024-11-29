jQuery(document).ready(function( $ ) {

  $( '.button-primary' ).mouseenter(function() {
    var aadress = $( '#submitted_address' ).val();
    $( '#submitted_post_title' ).val( aadress );
    //console.log( aadress );
  });

  $( '#pac-input' ).mouseenter(function() {
    $("#instruction").fadeIn(3000);
  });
});
