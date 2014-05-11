$(function() {
	$( "#validnewpass" )
	  .click(function()
	  {
		  vformhash(); 
	  }
	);
	$( "#asknewpass" )
	  .click(function()
	  {
		$( "#newpassrequest" ).submit();
	  }
	);
});