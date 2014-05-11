<?php
/*=============================================================================
#
#                           ``--:-` 
#                          `-/+ooo+:.
#                         .:+sssssss+-         MatrixWebEngine  V:1.0 
#                        .:+sooossssso:
#                       `-++:--:/osssso.
#                      `.:/:-oysysossss+`        `````````
#                      `-::.yy` `ohosss+- ``..---:::::::::-.
#                      .-..od`    hhssso/----------::::///::`
#  ``...------......```.-..ms-:+shhs+ooo/--:://++/---::////:`
#.-::::::::-----------....-+shdhyyyssddy+:yhs/---os--:////:.
#.::::::/:::---/++oooo-|yhhhhhyyyyyyshm|y+|hhh. `yo-:///::.
# `-:::/++//:::hh+:-/N:|h|yhdhyyyyyyy|N|y+|hhsooso:////:-`
#   `.-://+++///oyyoyo.|y|sh|shhhh|hs|N|h/|ys-----///:-.
#      `.-://++++///---|y|oy|sh|hh|o+|m|y/|so...-:-:-.-..`
#          `.-:/:////-.|s|+s|os|hh|++|s|+-|//:/:::-::------..`
#            ``..-:-.--+y|od|ys|o+|oo|m|:-`:/:::/oo/os+--------.`
#          ``.----`:yd:-+|/+|ss|y+|.:|:|oh:---:shyoooys--:::-::---`
#         `.--:--.oh.do./++s|+/|.`|..:ydmh+-+////////////////:::---.
#        `-::::---N/`yy..../so/+/++/.:///+/::::///////+++++//:::---.
#      ..://:::---+ssys.-:-.//+o++//--/os+:``````....---------..``  
#     .-:///:::///:////:+o/-:////+shossss/: 
#    .-::////////////////o+:.:shyyNyosssso-     
#    .-::///////////////-::-..+ysyoosssss+.
#    `.-::////////::-..``.:/:..--:ossssss/      Rel Date: 24/04/2014
#       ``.....```       .-:/+o+ossssssso-
#                        `.-:+ssssssssso:
#                         `.-/sssssssso/`
#                          `.-:+sssss+/`
#                            `-://///-`
#                             ``.--.` 
#
#==============================================================================
#
#		   File: error_handler.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Gestionnaire de messages d'erreur
#
#		   GET Parameters : eid, val
#
#============================================================================*/

// Error Handler vars
$error=intval(filter_input(INPUT_GET, 'eid',  FILTER_SANITIZE_NUMBER_INT));
$maxerrors=$maxerrors+1; // $maxerrors Errors States in DB

if ((isset($error))&&($error>0)&&($error<$maxerrors)) 
{      
	$errors = explode("-", $_GET['errid']);
	$errorstring="";
	for ($i = 0; $i < $maxerrors; $i++) 
	{
		if(isset($errors[$i]))
		{
			$errorstring .= '<p>'.get_error_msg($errors[$i]).'</p>';
		}
	}
	$erreur=$errors[0];
	$target=$uid;
	$date=date("Y-m-d-H-i-s");
	log_player_error($uid, $date, $erreur , $target);
	echo "<div id=\"errors\" title=\"Erreur !\">  ".$errorstring."</div>";
}

//Val Handler 
$val=intval(filter_input(INPUT_GET, 'val',  FILTER_SANITIZE_NUMBER_INT));
if ((isset($val))&&($val>0)&&($val<$X+1)) 
{ 
 // TODO
}
?>