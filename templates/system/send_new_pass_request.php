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
#		   Fichier: send_new_pass_request.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Password Update interface link Mail Sender
#
#		   Paramètres GET: /
#
#============================================================================*/
	
	include_once '../../includes/functions.php'; 
	mwe_session_start();

	$to = $_POST['mail'];
	$uid=get_player_id_from_mail($to);
	$token=get_player_token($uid);

	$link="index.php?menuid=4&id=".$uid."&token=".$token;
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: psykhaze@hotmail.fr' . "\r\n" .
	'Reply-To: psykhaze@hotmail.fr' . "\r\n" .
	'X-Mailer: PHP/' . phpversion(); 
	$subject = 'Password Reinit';
	$message = '<div style="min-width:70%;margin:40px;border-radius:1em;font-family:Helvetica;font-size:1.5em;color:#fff;" align="left">';
	$message = '<H1 style="font-family:Helvetica;font-size:1.5em;color:#006e2e;">Account Reactivation</H1>';
	$message.= 'Please click the following link :<br><br>';
	$message.= '<p><a href="'.$link.'">Change Password</a></p></div>';
	
	mail($to, $subject, $message, $headers);
	//TODO Update token
	
	header('Location: ../index.php?val=8');
?>
