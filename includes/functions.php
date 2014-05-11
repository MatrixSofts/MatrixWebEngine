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
#		   File: functions.php			   Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : MatrixWebEngine FrameWork Meta Include File 
#
#		   GET Parameters : /
#
#============================================================================*/

include_once 'db/client-config.php'; // DB Connexion

//////////////////////////////////////
// DB Function : make a simple mapped SQL request
//////////////////////////////////////

function mapped_db_query( $RequestType='s' , $DbEnv , $Table , $Fields=array() , $Values=array() , $ConditionFields=array() , $ConditionVals=array() ,$mysqli=null )
{
	$TableName=$DbEnv.'.'.$Table;
	$Condition='';
	$i=0;
	foreach ($ConditionFields)
	{
		if (isset($ConditionVals[$i])&&($ConditionVals[$i]!=''))
		{
			$Condition.=$ConditionFields.'=\''.$ConditionVals[$i].'\' AND';
			$i++;
		}
	}
	if (isset($Condition)&&($Condition!=''))
	{
		$Condition=mb_substr($Condition, 0, -3);
	}
	switch ($RequestType)
	{
		case 'S': // SELECT
		case 's':
			$SelectFields='';
			$nb_results=count($Fields);
			foreach ($Fields)
			{
				$SelectFields.='`'.$Fields.'`,';
			}
			if (isset($SelectFields)&&($SelectFields!=''))
			{
				$SelectFields=mb_substr($SelectFields, 0, -1);
			}
			if (isset($Condition)&&($Condition!=''))
			{
				$rqst='SELECT '.$SelectFields.' FROM `'.$TableName.'` WHERE '.$Condition ;
			}
			else
			{
				$rqst='SELECT '.$SelectFields.' FROM `'.$TableName.'`';
			}
			$stmt = $mysqli->prepare($rqst);
			$results=array(0=>0,0,0,0,0,0);
			switch ($nb_results)
			{
				case 1:
					$stmt->bind_result($results[0]);
					break
				case 2:
					$stmt->bind_result($results[0],$results[1]);
					break
				case 3:
					$stmt->bind_result($results[0],$results[1],$results[2]);
					break
				case 4:
					$stmt->bind_result($results[0],$results[1],$results[2],$results[3]);
					break
				case 5:
					$stmt->bind_result($results[0],$results[1],$results[2],$results[3],$results[4]);
					break
				case 6:
					$stmt->bind_result($results[0],$results[1],$results[2],$results[3],$results[4],$results[5]);
					break
			}
			$stmt->execute();       
			$res=$results;
			$stmt->store_result();
			$stmt->close();
			return $res;
		case 'I': // INSERT
		case 'i':
			$Pattern='';
			foreach ($Fields)
			{
				$Pattern.='`'.$Fields.'`,';
			}
			$Pattern=mb_substr($SelectFields, 0, -1);
			$InsertVals='';
			foreach ($Values)
			{
				$InsertVals.='\''.$Values.'\',';
			}
			if (isset($InsertVals)&&($InsertVals!=''))
			{
				$InsertVals=mb_substr($SelectFields, 0, -1);
			}
			if (isset($Condition)&&($Condition!=''))
			{
				$rqst='INSERT INTO `'.$TableName.'` ('.$Pattern.')  VALUES ('.$InsertVals.') WHERE '.$Condition ;
			}
			else
			{
				$rqst='INSERT INTO `'.$TableName.'` ('.$Pattern.')  VALUES ('.$InsertVals.')';
			}
			if ($stmt = $mysqli->prepare($rqst))
			{
				$stmt->execute();       
				$stmt->store_result();
				$stmt->close();
				return true;
			}
			else
			{
				$stmt->close();
				return false;
			}
			break;
		case 'U': // UPDATE
		case 'u':
			$UpdateFields='';
			$j=0;
			foreach ($Fields)
			{
				if (isset($Values[$j])&&($Values[$j]!=''))
				{
					$UpdateFields.='`'.$Fields.'`=\''.$Values[$j].'\' ,';
					$j++;
				}
			}
			if (isset($UpdateFields)&&($UpdateFields!=''))
			{
				$UpdateFields=mb_substr($UpdateFields, 0, -1);
			}
			if (isset($Condition)&&($Condition!=''))
			{
				$rqst='UPDATE `'.$TableName.'` SET '.$UpdateFields.'` WHERE '.$Condition ;
			}
			else
			{
				$rqst='UPDATE `'.$TableName.'` SET '.$UpdateFields;
			}
			$stmt = $mysqli->prepare($rqst);
			if ($stmt = $mysqli->prepare($rqst))
			{
				$stmt->execute();       
				$stmt->store_result();
				$stmt->close();
				return true;
			}
			else
			{
				$stmt->close();
				return false;
			}
			break;
	}
}

// Framework MatrixWebEngine
include_once 'system/1-system_functions.php';
include_once 'system/2-i18n_functions.php';
include_once 'system/3-ui_functions.php';
include_once 'system/4-log_functions.php';

