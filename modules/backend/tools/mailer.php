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
#          File: mailer.php
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Script Exemple d'envoi de mail
#
#============================================================================*/

	include_once '../includes/functions.php'; 
	mwe_session_start();
	include_once '../includes/time_stuff.php';
	
	$user_id=$_SESSION['user_id'];
	$uid=intval($user_id); // identifiant joueur
	$error_msg="";
	
	$to = 'psykhaze@hotmail.fr'; 
	$player=1744;
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$list_stmt = $mysqli->prepare("SELECT `token` FROM `player_data` WHERE `ID_User_Profile` = ?"); 
	$list_stmt->bind_param('i',$player);
	$list_stmt->bind_result($bddtoken);
	$list_stmt->execute();
	$list_stmt->fetch();
	$token=$bddtoken;
	$list_stmt->store_result();
	$list_stmt->close();

	$link="index.php?menuid=4&id=".$uid."&token=".$token;
	$subject = 'Test Subject';

	$message = '<div style="min-width:70%;margin:40px;border-radius:1em;font-family:Helvetica;font-size:1.5em;color:#fff;" align="left">';
	$message = '<H1 style="font-family:Helvetica;font-size:1.5em;color:#006e2e;">This is a Test</H1></div>';
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: psykhaze@hotmail.fr' . "\r\n" .
	'Reply-To: psykhaze@hotmail.fr' . "\r\n" .
	'X-Mailer: PHP/' . phpversion(); 
	
	mail($to, $subject, $message, $headers);
?>