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
#		   Fichier: client-config.php		Version: 1.0
#
#          Author: Jerome 'PsYkhAzE aka The_Architekt' KASPER
#
#          Licence: GPL V3
#
#		   Description : Fonctions et Définitions BDD Client
#
#		   Paramètres GET: /
#
#============================================================================*/

//////////////////////////////////////
// 0.1 Paramètres Connexion Client : Utilisateur MySQL avec Droits INSERT,SELECT,UPDATE sur la base $AppName
//////////////////////////////////////

define("HOST", "localhost"); 
define("USER", "root");  
define("PASSWORD", ""); 
define("DATABASE", "");
define("CAN_REGISTER", "any"); 
define("DEFAULT_ROLE", "member"); 

?>