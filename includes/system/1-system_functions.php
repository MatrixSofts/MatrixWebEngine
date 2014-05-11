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
#		   Fichier: 1-system_functions.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Core Functions
#
#		   GET Parameters : /
#
#============================================================================*/

/////////////////////////////////////
// 1.1 System function : log User
/////////////////////////////////////

function login($email, $password) 
{   
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$PlayerInfos = mapped_db_query( 's' , 'ud', 'user_profile', array(0=>'ID','Username','ID_Lang') , , array(0=>'Email'), array(0=>$password), $mysqli );
	$PlayerSecurityInfos = mapped_db_query( 's' , 'ud', 'user_profile', array(0=>'KPass','salt') , , array(0=>'ID_Player_Profile'), array(0=>$PlayerInfos[0]) , $mysqli );
	$db_password = hash('sha512', $PlayerSecurityInfos[0] . $PlayerSecurityInfos[1]);
	if ($db_password == $spassword) 
	{                                    
		$user_browser = $_SERVER['HTTP_USER_AGENT'];                                   
		$user_id = preg_replace("/[^0-9]+/", "", $PlayerInfos[0]);                    
		$_SESSION['user_id'] = $PlayerInfos[0];                                    
		$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $PlayerInfos[1]);                    
		$_SESSION['username'] = $PlayerInfos[1];    
		$_SESSION['lang'] = $PlayerInfos[2]; 
		$_SESSION['login_string'] = hash('sha512', $password . $user_browser);
		return true;                
	} 
}

/////////////////////////////////////
// 1.2 System function : Checks if User logged
/////////////////////////////////////

function login_check() 
{    
	if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) 
	{ 
		$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
        $uid = $_SESSION['user_id'];        
		$login_string = $_SESSION['login_string'];        
		$username = $_SESSION['username'];       
		$user_browser = $_SERVER['HTTP_USER_AGENT']; 
		if (count(mapped_db_query( 's' , 'ud' , 'user_profile' , array(0=>'Username') ,  , array(0=>'ID') , array(0=>$uid), $_SESSION['mysqli'] ))>0) 
		{ 
			return true ;
		}
		else
		{
			return false;
		}
	}
	else
	{
		return false;
	}
				
} 

/////////////////////////////////////
// 1.3 System Function : Starts a secure Session
/////////////////////////////////////

function mwe_session_start() 
{    
	$session_name = 'mwe_session_id';     
	$secure = false;       
	$httponly = true;    
	$cookieParams = session_get_cookie_params();    
	session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"],$secure,$httponly);
	session_name($session_name);
	session_start();                
	session_regenerate_id(); 
	$_SESSION['mysqli'] = new mysqli(HOST, USER, PASSWORD, DATABASE);
} 

/////////////////////////////////////
// 1.4 System Function : URL cleaning
/////////////////////////////////////

function esc_url($url) 
{ 
    if ('' == $url) 
	{        
		return $url;    
	} 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url); 
    $strip = array('%0d', '%0a', '%0D', '%0A');    $url = (string) $url; 
    $count = 1;    
	while ($count) 
	{       
		$url = str_replace($strip, '', $url, $count);    
	} 
    $url = str_replace(';//', '://', $url); 
    $url = htmlentities($url); 
    $url = str_replace('&amp;', '&#038;', $url);    
	$url = str_replace("'", '&#039;', $url); 
    if ($url[0] !== '/') 
	{             
		return '';    
	} 
	else 
	{        
		return $url;    
	} 
}

/////////////////////////////////////
// 1.5 System Function : return a user ID from Email
/////////////////////////////////////

function get_player_id_from_mail($mail)
{
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$uid = mapped_db_query( 's' , 'ud' , 'user_profile' , array(0=>'ID') ,  , array(0=>'Email') , array(0=>$mail), $mysqli );
	return $uid[0];
}
/////////////////////////////////////
// 1.6 System Function : Return a User Security Token
/////////////////////////////////////

function get_player_token($uid)
{
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$dbtoken = mapped_db_query( 's' , 'ud' , 'user_data' , array(0=>'token') ,  , array(0=>'ID_Player_Profile') , array(0=>$uid), $mysqli );
	return $dbtoken[0];
}

/////////////////////////////////////
// 1.7 System Function : Renew a User Security Token
/////////////////////////////////////

function renew_player_token($uid)
{
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$NewToken=hash('sha512', $uid.'M4tr1X23');
	if ( mapped_db_query( 'u' , 'ud' , 'user_data' , array(0=>'token') , array(0=>$NewToken) , array(0=>'ID_Player_Profile') , array(0=>$uid), $mysqli ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

/////////////////////////////////////
// 1.8 System Function : Updates User Password
/////////////////////////////////////

function update_kpass( $kpass , $uid )
{
	$mysqli= new mysqli(HOST, USER, PASSWORD, DATABASE);
	$salt = mapped_db_query( 's' , 'ud' , 'user_data' , array(0=>'salt') , , array(0=>'ID_Player_Profile') , array(0=>$uid) , $mysqli );
	$ipassword = hash('sha512', $kpass.$salt);
	if ( mapped_db_query( 'u' , 'ud' , 'user_data' , array(0=>'KPass') , array(0=>$ipassword) , array(0=>'ID_Player_Profile') , array(0=>$uid) , $mysqli ) )
	{
		return true;
	}
	else
	{
		return false;
	}
}

/////////////////////////////////////
// 1.9 System Function : Load App Global Vars
/////////////////////////////////////

function load_app_env($AppName)
{
	$Settings = mapped_db_query( 's' , 'sys' , 'global_app_settings' , array(0=>'Name','T_Val','N_Val','A_Val') , , array(0=>'AppName') , array(0=>$AppName) , $_SESSION['mysqli'] );
	$_SESSION['params']=array();
	foreach($Settings as $k=>$v)
	{
		switch($k)
		{
			case 'Name':
				$name=$v;
				$_SESSION['params'][$name]=array();
				break;
			case 'T_val':
				$_SESSION['params'][$name][0]=$v;
				break;
			case 'N_val':
				$_SESSION['params'][$name][1]=$v;
				break;
			case 'A_val':
				$_SESSION['params'][$name][0]=explode('-',$v);
				break;
		}
	}
	$_SESSION['AppLoaded']=TRUE;
}

/////////////////////////////////////
// 1.10 System Function : Load a Specific Controller
/////////////////////////////////////

function load_env_controller($ParentEnv)
{
	$ControllerName = mapped_db_query( 's' , 'sys' , 'php_modules' , array(0=>'PathName','FileName') , , array(0=>'ID_Parent_Env') , array(0=>$ParentEnv) , $_SESSION['mysqli'] );
    if (file_exists($ControllerName[0].$ControllerName[1]))
	{
		include_once($ControllerName[0].$ControllerName[1]);
	}
}

/////////////////////////////////////
// 1.11 System Function : Load JS Libs for a Specific Controller
/////////////////////////////////////

function load_env_js($ParentEnv)
{
	$JsFilesPathList = mapped_db_query( 's' , 'sys' , 'js_libs' , array(0=>'PathName','FileName') , , array(0=>'ID_Parent_Env') , array(0=>$ParentEnv) , $_SESSION['mysqli'] );
	foreach($JsFilesPathList)
	{
		if (file_exists($JsFilesPathList[0].$JsFilesPathList[1]))
		{
			echo 'script type="text/JavaScript" src="'.$JsFilesPathList[0].$JsFilesPathList[1].'"></script>\n';
		}
	}
}

/////////////////////////////////////
// 1.12 System Function : Load generic JS Libs
/////////////////////////////////////

function load_generic_js()
{
	$JsFilesGenericPathList = mapped_db_query( 's' , 'sys' , 'js_libs' , array(0=>'PathName','FileName') , , array(0=>'More') , array(0=>'generic') , $_SESSION['mysqli'] );
	foreach($JsFilesGenericPathList)
	{
		if (file_exists($JsFilesGenericPathList[0].$JsFilesGenericPathList[1])
		{
			echo 'script type="text/JavaScript" src="'.$JsFilesGenericPathList[0].$JsFilesGenericPathList[1].'"></script>\n';
		}
	}
}

/////////////////////////////////////
// 1.13 System Function : Load generic CSS Styles
/////////////////////////////////////

function load_generic_style()
{
	$CssFilesGenericPathList = mapped_db_query( 's' , 'sys' , 'css_styles' , array(0=>'PathName','FileName') , , array(0=>'More') , array(0=>'generic') , $_SESSION['mysqli'] );
	foreach($CssFilesGenericPathList)
	{
		if (file_exists($CssFilesGenericPathList[0].$CssFilesGenericPathList[1]))
		{
			echo '<link rel="stylesheet" href="'.$CssFilesGenericPathList[0].$CssFilesGenericPathList[1].'" type="text/css" />\n';
		}
	}
}

/////////////////////////////////////
// 1.14 System Function : Load generic JavaScript Modules CSS Styles
/////////////////////////////////////

function load_generic_js_style()
{
	$CssFilesPathList = mapped_db_query( 's' , 'sys' , 'css_styles' , array(0=>'PathName','FileName') , , array(0=>'More') , array(0=>'js') , $_SESSION['mysqli'] );
	foreach($CssFilesPathList)
	{
		if (file_exists($CssFilesPathList[0].$CssFilesPathList[1]))
		{
			echo '<link rel="stylesheet" href="'.$CssFilesPathList[0].$CssFilesPathList[1].'" type="text/css" />';
		}
	}
}

/////////////////////////////////////
// 1.15 Fonction System Function : Load Modules Specific CSS Styles
/////////////////////////////////////

function load_module_style($EnvID);
{
	$CssFilePath = mapped_db_query( 's' , 'sys' , 'css_styles' , array(0=>'PathName','FileName') , , array(0=>'ModuleRef') , array(0=>$EnvID) , $_SESSION['mysqli'] );
	if (file_exists($CssFilePath[0].$CssFilePath[1])
	{
		echo '<link rel="stylesheet" href="'.$CssFilePath[0].$CssFilePath[1].'" type="text/css" />';
	}
}


?>