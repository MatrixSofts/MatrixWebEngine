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
#		   File: 2-i18n_functions.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Internationalisation Functions
#
#		   GET Parameters : /
#
#============================================================================*/


/////////////////////////////////////
// 2.1 I18n Function : Load Translated Labels Table in a Specific Language
/////////////////////////////////////

function load_i18n_labels_table($lang)
{
	$LabelsList=mapped_db_query( 's' , 'i18n' , 'translation_text' , array(0=>'T_Val') , , array(0=>'ID_lang') , array(0=>$lang) , $_SESSION['mysqli'] );
	$i=1;
	$_SESSION['labels']=array();
	foreach ($LabelsList)
	{
		$_SESSION['labels'][$i] = $LabelsList;
		$i++;
	}
}

/////////////////////////////////////
// 2.2 I18n Function : Load Label in a Specific Language
/////////////////////////////////////

function get_translated_label( $lang, $id_label )
{
	$text = mapped_db_query( 's' , 'i18n' , 'translation_text' , array(0=>'Val') , , array(0=>'ID_I18n_Regroup','ID_Lang') , array(0=>$id_label,$lang) , $_SESSION['mysqli'] );
	return $text[0];
}

/////////////////////////////////////
// 2.3 I18n Function : Returns User Language
/////////////////////////////////////

function get_lang_from_user($uid)
{
	$lang = mapped_db_query( 's' , 'pd' , 'player_profile' , array(0=>'ID_Lang') , , array(0=>'ID') , array(0=>$uid) , $_SESSION['mysqli'] );
	return $lang[0];
}

/////////////////////////////////////
// 2.4 I18n Function : Returns User Language
/////////////////////////////////////

function get_lang_name_from_player($lid)
{
	$lang = mapped_db_query( 's' , 'i18n' , 'lang' , array(0=>'Country') , , array(0=>'ID') , array(0=>$lid) , $_SESSION['mysqli'] );
	return $lang[0];
}

/////////////////////////////////////
// 2.5 I18n Function : Returns Translated Error Message
/////////////////////////////////////

function get_translated_error_msg($error_id)
{
	$emsg = mapped_db_query( 's' , 'ev' , 'errors' , array(0=>'Name') , , array(0=>'ID_Error') , array(0=>$error_id) , $_SESSION['mysqli'] );
	return $emsg[0];
}

/////////////////////////////////////
// 2.6 I18n Function : Returns Translated Validation Message
/////////////////////////////////////

function get_translated_validation_msg($val_id)
{
	$vmsg = mapped_db_query( 's' , 'ev' , 'validations' , array(0=>'Name') , , array(0=>'ID_Val') , array(0=>$val_id) , $_SESSION['mysqli'] );
	return $vmsg[0];
}

/////////////////////////////////////
// 2.7 I18n Function : Returns Translated State Name
/////////////////////////////////////

function get_translated_state_name_from_str($state,$lang)
{
 // TODO
}

?>