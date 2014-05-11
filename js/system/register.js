$(function() {
	$( "#subscribe" )
	  .click(function()
	  {
		$( "#registerer" ).dialog({
			height: 510,
			width: 435,
			 buttons: {
				"Valider": function() {
					regformhash();  		
				},
				"Annuler": function() {
					 $( this ).dialog( "close" );
				}
			 }
		});
		
	});
	$( "#avatar-list" ).change(function() 
	  {
		var avatar=$("#avatar-list option:selected").attr("path")+'avatar.png';
		$( "#preavatar" ).attr('src', avatar );
	});
});