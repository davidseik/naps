$(document).ready(function(){
	// $("#login_form_button").on("click",function(){
	// 	//console.log("SUPER CLICKED");
	// 	console.log($("#login_form").serialize());
	// });

$( "#login_form").on( "submit", function( event ) {
  event.preventDefault();
  console.log( $( this ).serialize() );
});
});