$(function() {
	$( "#slots" ).accordion();
	$( "#valquizzbtn" ).button();
	$( "#displayitemsbutton" ).button();
	$( "#roomactions>p" ).button();
	$( "#brewmarket>p" ).button();
	$( "#friendsinteractions>span" ).button();
	$( "#placement>span" ).button();
	$( "#sells>span>p" ).button();
	$( "#overview>div>div").button();
	$( "#displayitems>div>p>span" ).button();
	$( "#upstock" ).button();
	$( "#validlab" ).button();
	$( "#back2shophome" ).button();
	$( "#friendsinteractions>p" ).button();
	
	$( "#loggerd" ).css("display", "none");
	$( "#logger" ).css("display", "none");
	$( "#registerer" ).css("display", "none");
	$( "#register" ).css("display", "none");
	$( "#giftlist" ).css("display", "none");
	$( "#equiper" ).css("display", "none");
	$( "#account" ).css("display", "none");
	$( "#validate" ).css("display", "none");
	$( "#validateUpStock" ).css("display", "none");
	$( "#validateUpBrewery" ).css("display", "none");
	$( "#plantation" ).css("display", "none");
	$( "#diversion" ).css("display", "none");
	
	$( "#errors" ).dialog({
		height: 260,
		width: 440,
		buttons: {
			"OK": function() {
				 $( this ).dialog( "close" );
			}
		}
	});
	$( "#validate" ).dialog({
		height: 280,
		width: 440,
		buttons: {
			"OK": function() {
				 $( this ).dialog( "close" );
			}
		}
	});
});