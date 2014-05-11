$(function() {
	$( "#login" )
	  .click(function() 
	  {
		$( "#loggerd" ).dialog({
			height: 290,
			width: 380,
			buttons: {
				"Connexion": function() {
					formhash();
				},
				"Annuler": function() {
					$( this ).dialog( "close" );
				}
			}
	  });
	});
	$("#login_form input").keypress(function(event) {
		if (event.which == 13) {
			event.preventDefault();
			formhash();
		}
	});
});