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
#    `.-::////////::-..``.:/:..--:ossssss/      Rel Date: 11/05/2014
#       ``.....```       .-:/+o+ossssssso-
#                        `.-:+ssssssssso:
#                         `.-/sssssssso/`
#                          `.-:+sssss+/`
#                            `-://///-`
#                             ``.--.` 
#
#==============================================================================
#
#		   File: 4-log_functions.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Log Functions
#
#		   GET Parameters : /
#
#============================================================================*/

/////////////////////////////////////
// 6.1 Log Function : Returns Client System Infos
/////////////////////////////////////

function get_client_sys_data()
{
	//IP
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	  $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
	  $ip  = $_SERVER['HTTP_CLIENT_IP'];
	}
	else {
	  $ip = $_SERVER['REMOTE_ADDR'];
	}
	//Machine(OS)
	$host = gethostbyaddr($ip);
	//Navigateur
	$navigateur = $_SERVER['HTTP_USER_AGENT'];
	$SysData=$ip."_".$host."_".$navigateur;
	return $SysData;
}

/////////////////////////////////////
// 6.2 Log Function : Records an Action Log
/////////////////////////////////////

function log_player_action($uid, $date, $action2log, $target)
{
	//Bind et insertion
	if ( mapped_db_query( 'i' , 'logger' , 'player_actions_log' , array(0=>'ID_Player_Profile', 'ID_Character', 'Moment', 'ID_Action', 'Target_ID', 'HostOSNavIP') , array(0=>$uid, $uid, $date, $action2log, $target, get_client_sys_data()) ,  ,  , $_SESSION['mysqli'] ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

/////////////////////////////////////
// 6.3 Log Function : Records an Error Log
/////////////////////////////////////

function log_player_error($uid, $date, $error2log, $target)
{
	//Bind et insertion
	if ( mapped_db_query( 'i' , 'logger' , 'player_errors_log' , array(0=>'ID_Player_Profile', 'ID_Character', 'Moment', 'ID_Action', 'Target_ID', 'HostOSNavIP') , array(0=>$uid, $uid, $date, $error2log, $target, get_client_sys_data()) ,  ,  , $_SESSION['mysqli'] ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}



?>