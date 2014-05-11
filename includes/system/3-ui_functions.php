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
#		   File: 3-ui_functions.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Fonctions Interface/Routing
#
#		   GET Parameters : /
#
#============================================================================*/

/////////////////////////////////////
// 5.1 UI Function : Creates a JQueryUI Dialog
/////////////////////////////////////

function make_dialog( $HTMLText , $Width=666 , $Height=421 , $Img_Ref=null , $Type=1 , $CssRef='' , $StartVisible=true)
{
	//TODO
}

/////////////////////////////////////
// 5.2 UI Function : Turn a mark into a JQueryUI Button
/////////////////////////////////////

function make_btn( $TargetID , $Action=null , $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.3 UI Function : Creates a JQueryUI Slider
/////////////////////////////////////

function make_slider( $Caption , $Name,  $Val=0, $MinVal=0 , $MaxVal=100 , $step=1 , $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.4 UI Function : Creates a JQueryUI Sortable
/////////////////////////////////////

function make_sortable( $Caption , $Name,  $Items=array() , $Values=array() , $CssRef='')
{
	//TODO
}


/////////////////////////////////////
// 5.4 UI Function : Creates a <form> header
/////////////////////////////////////

function make_post_form_head( $Name, $Action , $Width , $Height , $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.5 UI Function : Creates a <select> list
/////////////////////////////////////

function make_select( $Name, $Options=array() , $Values=array() , $Selected='', $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.6 UI Function : Creates a <input> text-typed
/////////////////////////////////////

function make_text_input( $Name, $Width=150 , $Selected=false, $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.7 UI Function : Creates a <input> date-typed
/////////////////////////////////////

function make_date_input( $Name, $Date , $Width=150, $CssRef='')
{
	//TODO
}

/////////////////////////////////////
// 5.8 UI Function : Creates a hidden <input> submit-typed
/////////////////////////////////////

function make_hidden_submit( $Name, $Value=null )
{
	//TODO
}

/////////////////////////////////////
// 5.9 UI Function : Closes a <form> mark
/////////////////////////////////////

function make_post_form_close()
{
	make_hidden_submit('submit');
	echo '</form>';
}

/////////////////////////////////////
// 5.10 UI Function : List Environment Child's
/////////////////////////////////////

function list_env_from($ParentID)
{
	$ChildsList = mapped_db_query( 's' , 'sys' , 'environments' , array(0=>'Link','Name') , , array(0=>'ID_Parent') , array(0=>$ParentID) , $_SESSION['mysqli'] );
	foreach ($ChildsList)
	{
		echo "<p><a href=\"".$ChildsList[0]."\">".$ChildsList[1]."</a></p>";
	}
}

/////////////////////////////////////
// 5.11 UI Function : Creates a countdown timer
/////////////////////////////////////

function make_decreasing_timer_hms($seconds,$timer_nb)
{
	echo '<script type="text/javascript">';
	echo '$(function () {';
	echo '	var upto= new Date(); ';
	echo '	upto.setSeconds(upto.getSeconds() + '.$seconds.');'; 
	echo '$(\'#count'.$timer_nb.'\').countdown({until: upto, onExpiry: reloadpage'.$timer_nb.', format: \'HMS\'}); ';
	echo '	function reloadpage'.$timer_nb.'() { window.location.reload(); } ';
	echo '});</script>';
	echo '<span id="count'.$timer_nb.'" style="float:left;width:220px;font-family:helvetica;font-size:0.8em;color:#000;border-radius:0.5em;"></span>';
}

/////////////////////////////////////
// 5.12 UI Function : Creates a Compact countdown timer
/////////////////////////////////////

function make_decreasing_compact_timer_hms($seconds,$timer_nb)
{
	echo '<script type="text/javascript">';
	echo '$(function () {';
	echo '	var upto= new Date(); ';
	echo '	upto.setSeconds(upto.getSeconds() + '.$seconds.');'; 
	echo '$(\'#count'.$timer_nb.'\').countdown({until: upto, onExpiry: reloadpage'.$timer_nb.', compact: true, format: \'HMS\', description: \'\'}); ';
	echo '	function reloadpage'.$timer_nb.'() { window.location.reload(); } ';
	echo '});</script>';
	echo '<div id="count'.$timer_nb.'" style="float:left;width:80px;font-family:helvetica;font-size:0.4em;color:#000;border-radius:0.5em;"></div>';

}

/////////////////////////////////////
// 5.13 UI Function : Creates an Increasing timer
/////////////////////////////////////

function make_increasing_timer_ms()
{
	echo '<script type="text/javascript">';
	echo '$(function () {';
	echo '	var now= new Date(); ';
	echo '	now.setSeconds(now.getSeconds());'; 
	echo '$(\'#countlab\').countdown({ since: now, compact: true, format: \'MS\', description: \'Temps écoulé\'}); ';
	echo '});</script>';
	echo '<span id="countlab" style="float:left;width:130px;height:60px;font-family:helvetica;font-size:0.8em;color:#000;border-radius:0.5em;"></span>';
}

/////////////////////////////////////
// 5.14 UI Function : Makes the Page Reload
/////////////////////////////////////

function make_reload()
{
	echo '<script type="text/javascript">';
	echo '$(function () {';
	echo '	function reloadpage() { window.location.reload(); }';
	echo '  reloadpage();  ';
	echo '});</script>';
}

/////////////////////////////////////
// 5.15 UI Function : Creates a styled Title Bar
/////////////////////////////////////

function make_title_bar($EnvID,$ImgRef)
{
 // TODO
}

/////////////////////////////////////
// 5.16 UI Function : Creates a styled Menu Bar
/////////////////////////////////////

function make_menu_bar($EnvID)
{
 // TODO
}

?>