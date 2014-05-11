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
#		   Fichier: process_login.php			   Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Script de Connexion joueur
#
#		   GET Parameters : /
#
#============================================================================*/

	include_once '../includes/functions.php';
	mwe_session_start();
	include_once '../includes/time_stuff.php';
	
	if (isset($_POST['emaill'], $_POST['p'])) 
	{    
		$email = $_POST['emaill'];    
		$password = $_POST['p'];  
    	if (login($email, $password) == true) 
		{
			log_player_action($_SESSION['user_id'],gmdate("Y-m-d H:i:s", $now),0,0);
			update_player_last_connexion($_SESSION['user_id'], gmdate("Y-m-d H:i:s", $now));
			$urlto='Location: ../index.php';
		} 
		else 
		{   
			$urlto='Location: ../index.php?errid=7';    
		} 
	} 
	header($urlto); 
?>