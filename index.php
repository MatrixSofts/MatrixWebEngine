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
#		   File: index.php			  		 Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Main Routing File and Client FrontEnd
#
#		   GET Parameters : id,mid
#
#============================================================================*/

	// Glabal Vars
	
	$AppName=''; // Application Name /!\ NECESSARY /!\
	
	$SystemModulesPath='modules/system/'; // System Controllers
	$ModulesPath='modules/'.$AppName.'/'; // Application-Specific Controllers
	$SystemFunctions='includes/'; // MatrixWebEngine FrameWork
	$PicturesPath='imgs/'; // Graphic Ressources Path
	$LogosPath='imgs/logos'; // Logos Pictures Path
	$GraphicTheme='css/themes/'.$AppName.'/'; // Application Theme 
	$ModulesTheme='css/modules'; //Application Modules Themes
	$SystemViews='templates/generic/'; // System Views
	$AppViews='templates/'.$AppName.'/'; // Application Views
	$JsLibs='js/libs/'; // JavaScript Librairies 
	$AppJs='js/libs/'.$AppName.'/'; // Application Modules Javascript Controllers
	$UploadJail='files/upload_jail/'; // Upload Reception Jail

	if (isset($_SESSION['user_id']))
	{
		$user_id=$_SESSION['user_id'];
		$uid=intval($user_id); // User ID
	}
	$EID=''; // Error String Initialisation
	$ConvMap = array(0x80, 0xff, 0, 0xff); // Conversion Var for str>utf8
	$LID=0; // Log Target
	
	if ((!(isset($_SESSION['AppLoaded'])))||($_SESSION['AppLoaded']!=TRUE))
	{
		load_app_env($AppName) // DB App Vars Loading if not done
	}
	
	include_once $SystemFunctions.'functions.php'; 	// MatrixWebEngine FrameWork Including /!\ NECESSARY /!\
	if (file_exists($SystemFunctions.$AppName.'.php')) // Application Specific Model include if set
	{
		include_once $SystemFunctions.$AppName.'.php';
	}
	include_once $SystemFunctions.'system/time_stuff.php'; // Time Stuff
	mwe_session_start();// MatrixWebEngine Session Start
	
	// GET Parameters 
	$Action = intval(filter_input(INPUT_GET, 'id',  FILTER_SANITIZE_NUMBER_INT)); // Action ID
	$MID=filter_input(INPUT_GET, 'mid',  FILTER_SANITIZE_NUMBER_INT); // Menu ID
	
	// Layout Start
	include_once $SystemViews.'header.php'; // Header
	include_once $SystemFunctions.'system/ev_handler.php'; // Events Handler

	// Routing
	if (isset($MID)) // Menu Exceptions
	{ 
		load_env_controller($MID); // Load From DB
	}
	else
	{
		if (login_check() == true) // Authentification Management : If connected :
		{
			include_once $AppViews.'connected.php';
		}
		else // Default Routing
		{
			include_once $AppViews.'home.php';
		}
	}
	
	//Layout End
	include_once $SystemViews.'footer.php'; // Footer
?>