-------------------------------------------------------------------------------
--                           ``--:-` 
--                          `-/+ooo+:.
--                         .:+sssssss+-         MatrixWebEngine  V:1.0 
--                        .:+sooossssso:
--                       `-++:--:/osssso.
--                      `.:/:-oysysossss+`        `````````
--                      `-::.yy` `ohosss+- ``..---:::::::::-.
--                      .-..od`    hhssso/----------::::///::`
--  ``...------......```.-..ms-:+shhs+ooo/--:://++/---::////:`
--.-::::::::-----------....-+shdhyyyssddy+:yhs/---os--:////:.
--.::::::/:::---/++oooo-|yhhhhhyyyyyyshm|y+|hhh. `yo-:///::.
-- `-:::/++//:::hh+:-/N:|h|yhdhyyyyyyy|N|y+|hhsooso:////:-`
--   `.-://+++///oyyoyo.|y|sh|shhhh|hs|N|h/|ys-----///:-.
--      `.-://++++///---|y|oy|sh|hh|o+|m|y/|so...-:-:-.-..`
--          `.-:/:////-.|s|+s|os|hh|++|s|+-|//:/:::-::------..`
--            ``..-:-.--+y|od|ys|o+|oo|m|:-`:/:::/oo/os+--------.`
--          ``.----`:yd:-+|/+|ss|y+|.:|:|oh:---:shyoooys--:::-::---`
--         `.--:--.oh.do./++s|+/|.`|..:ydmh+-+////////////////:::---.
--        `-::::---N/`yy..../so/+/++/.:///+/::::///////+++++//:::---.
--      ..://:::---+ssys.-:-.//+o++//--/os+:``````....---------..``  
--     .-:///:::///:////:+o/-:////+shossss/: 
--    .-::////////////////o+:.:shyyNyosssso-     
--    .-::///////////////-::-..+ysyoosssss+.
--    `.-::////////::-..``.:/:..--:ossssss/      Rel Date: 11/05/2014
--       ``.....```       .-:/+o+ossssssso-
--                        `.-:+ssssssssso:
--                         `.-/sssssssso/`
--                          `.-:+sssss+/`
--                            `-://///-`
--                             ``.--.` 
--
-------------------------------------------------------------------------------
--     File : MatrixEngineStruct.sql
--     Author : Jerome 'PsYkhAzE aka The_Architekt' KASPER
--     Licence: GPL V3
--     Description : DB Structure for MatrixWebEngine
-------------------------------------------------------------------------------

-- Tables Système

CREATE TABLE `sys.text_articles` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Title_Lib` int(32) unsigned NOT NULL COMMENT 'I18n Title Label Ref',
  `ID_Lang` int(32) unsigned NOT NULL COMMENT 'I18n lang Ref',
  `ID_Menu` int(32) unsigned NOT NULL COMMENT 'Routing Reference ',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Link',
  `ID_Owner` int(32) unsigned NOT NULL COMMENT 'Writer ID Ref',
  `ID_Icon` int(32) unsigned DEFAULT NULL COMMENT 'Graphic Resource Link',
  `Val` varchar(8196) COLLATE utf16_bin NOT NULL COMMENT 'Text Value',
  `Article_Type` enum('News','Forum','Menu','Announce') COLLATE utf16_bin NOT NULL COMMENT 'Logical Type',
  `Publication_Moment` varchar(20) NOT NULL COMMENT 'Publication Date',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Text Labels Table';

CREATE TABLE `sys.css_styles`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `FileName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Name',
  `PathName` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Path',
  `ModuleRef` int(32) unsigned DEFAULT NULL COMMENT 'PHP Ref',
  `Name` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Name',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='CSS Styles Table';

CREATE TABLE `sys.sitemap_elements` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Title_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Title Label Number',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Description Label Number',
  `ID_Parent` int(32) unsigned DEFAULT NULL COMMENT 'Self Linked Ref for Organisation',
  `ID_Menu` int(32) unsigned DEFAULT NULL COMMENT 'Routing Reference ',
  `ID_Icon` int(32) unsigned DEFAULT NULL COMMENT 'Lien Ressource Graphique',
  `ID_Background` int(32) unsigned DEFAULT NULL COMMENT 'Lien Ressource Graphique Fond',
  `ModuleRef` int(32) unsigned DEFAULT NULL COMMENT 'PHP Module Ref',
  `CssStyleRef` int(32) unsigned DEFAULT NULL COMMENT 'CSS Style Ref',
  `JSRef` int(32) unsigned DEFAULT NULL COMMENT 'JS Ref',
  `Element_Type` enum('Homepage','Connected','Register','Settings','Auth','Newpass','Banner','Menu','Account') COLLATE utf16_bin DEFAULT NULL COMMENT 'Context Type',
  `Name` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Name',
  `Link` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Associated Link',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='SiteMap Elements Table Table';

CREATE TABLE `sys.global_application_settings`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `AppName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Application Name',
  `T_Val` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Text Value',
  `N_Val` float(32,2) DEFAULT NULL COMMENT 'Current Numeric Value',
  `A_Val` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Splitted String Array',
  `Param_Group` int(32) unsigned DEFAULT NULL COMMENT 'Regroup Key',
  `Name` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Name',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Global Applications Settings Table';

CREATE TABLE `sys.imgs`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Title_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Title Label Number',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Description Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `FileName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Name',
  `PathName` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Path',
  `Author` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Picture Author',
  `PicType` enum('icon','pic') COLLATE utf16_bin DEFAULT NULL COMMENT 'Picture File Type',
  `Extension_Type` enum('png','jpg','jpeg','svg','gif') COLLATE utf16_bin DEFAULT NULL COMMENT 'File Extension Type',
  `CssStyleref` int(32) unsigned DEFAULT NULL COMMENT 'CSS Style Ref',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Pictures Table';

CREATE TABLE `sys.js_libs`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `FileName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Name',
  `PathName` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Path',
  `LibName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Library Name',
  `WebSite` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Library Website URL',
  `DocLink` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Library Documentation URL',
  `CssStyleref` int(32) unsigned DEFAULT NULL COMMENT 'CSS Style Ref',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Javascript Modules Table';

CREATE TABLE `sys.param_files`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `FileName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Name',
  `PathName` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Path',
  `Extension_Type` enum('json','csv','ui') COLLATE utf16_bin DEFAULT NULL COMMENT 'File Extension Type',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Parameters Files Table';

CREATE TABLE `sys.php_modules`(
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `FileName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Name',
  `PathName` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'File Path',
  `AppName` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Application Name',
  `CssStyleref` int(32) unsigned DEFAULT NULL COMMENT 'CSS Style Ref',
  `Param_Group` int(32) unsigned DEFAULT NULL COMMENT 'Associated Parameters Group',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='PHP Modules Table';

-- Tables Gestion Events

CREATE TABLE `ev.actions` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Action` int(32) unsigned NOT NULL COMMENT 'Target ID',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `ID_PreState` int(32) unsigned DEFAULT NULL COMMENT 'State Before this One',
  `ID_Img` int(32) unsigned DEFAULT NULL COMMENT 'Graphic Resource Ref',
  `TargetType` enum('Player','Game Element','Env','PlayerSpec','EnvSpec') COLLATE utf16_bin NOT NULL COMMENT 'Target Type',
  `Action` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Action Content',
  `TriggerType` enum('script','click','watchdog','autoupdate','success_type') COLLATE utf16_bin DEFAULT NULL COMMENT 'Trigger Type',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Actions Table';

CREATE TABLE `ev.errors` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Error int(32) unsigned NOT NULL COMMENT 'Target ID',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `ID_PreState` int(32) unsigned DEFAULT NULL COMMENT 'State Before this One',
  `ID_PreError` int(32) unsigned DEFAULT NULL COMMENT 'Action before the State',
  `ID_Img` int(32) unsigned DEFAULT NULL COMMENT 'Graphic Resource Ref',
  `TargetType` enum('Player','Game Element','Env','PlayerSpec','EnvSpec') COLLATE utf16_bin NOT NULL COMMENT 'Target Type',
  `Error` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Action Content',
  `TriggerType` enum('script','click','watchdog','autoupdate','success_type') COLLATE utf16_bin DEFAULT NULL COMMENT 'Trigger Type',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Errors Table';

CREATE TABLE `ev.events` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_PreState` int(32) unsigned DEFAULT NULL COMMENT 'State Before this One',
  `ID_PreAction` int(32) unsigned DEFAULT NULL COMMENT 'Action before the State',
  `ID_Img` int(32) unsigned DEFAULT NULL COMMENT 'Graphic Resource Ref',
  `Cycled` tinyint(1) DEFAULT NULL COMMENT 'Cycled',
  `Cycle_s` int(32) unsigned DEFAULT NULL COMMENT 'Cycle Duration if Cycled',
  `Variation` int(10) unsigned DEFAULT NULL COMMENT 'Variant Key',
  `Regroup` int(10) unsigned DEFAULT NULL COMMENT 'Variants Regroup Key',
  `Trigger_type` enum('script','click','watchdog','autoupdate') COLLATE utf16_bin DEFAULT NULL,
  `Name` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Name',
  `State_Trigger` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Triggered Script',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Events Table';

CREATE TABLE `ev.states` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_PreState` int(32) unsigned DEFAULT NULL COMMENT 'State Before this One',
  `ID_PreAction` int(32) unsigned DEFAULT NULL COMMENT 'Action before the State',
  `ID_Img` int(32) unsigned DEFAULT NULL COMMENT 'Graphic Resource Ref',
  `Cycled` tinyint(1) DEFAULT NULL COMMENT 'Cycled',
  `Cycle_s` int(32) unsigned DEFAULT NULL COMMENT 'Cycle Duration if Cycled',
  `Variation` int(10) unsigned DEFAULT NULL COMMENT 'Variant Key',
  `Regroup` int(10) unsigned DEFAULT NULL COMMENT 'Variants Regroup Key',
  `Trigger_type` enum('script','click','watchdog','autoupdate') COLLATE utf16_bin DEFAULT NULL,
  `Name` varchar(254) COLLATE utf16_bin NOT NULL COMMENT 'Name',
  `State_Trigger` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Triggered Script',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='States Table';

-- Tables dédiées au Multilingue

CREATE TABLE `i18n.helpers` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Lang` int(2) unsigned NOT NULL COMMENT 'Référence Langue',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Helper_Group` int(32) unsigned NOT NULL COMMENT 'Regroup Key',
  `ID_Parent_Env` int(32) unsigned DEFAULT NULL COMMENT 'Parent Environment Link',
  `T_Val` varchar(4096) COLLATE utf16_bin NOT NULL COMMENT 'Text Value',
  `Publication_Moment` varchar(20) NOT NULL COMMENT 'Publication Stamp',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Helpers Table';

CREATE TABLE `i18n.lang` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `Country` varchar(3) COLLATE utf16_bin NOT NULL COMMENT '(ShortName)',
  `ID_Img` int(32) unsigned DEFAULT NULL COMMENT 'Flag Picture Name',
  `Currency` varchar(3) COLLATE utf16_bin NOT NULL COMMENT 'Money Type',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Languages Table';

CREATE TABLE `i18n.translation_text` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Lang` int(2) unsigned NOT NULL COMMENT 'Language Reference',
  `ID_I18n_Regroup` int(32) unsigned NOT NULL COMMENT 'Concept Regroup Key',
  `T_Val` varchar(4096) COLLATE utf16_bin NOT NULL COMMENT 'Text Value',
  `Last_Update` varchar(20) NOT NULL COMMENT 'Last Update Date',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='I18n Labels Table';

-- Tables Utilisateurs

CREATE TABLE `ud.user_data` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_User_Profile` int(32) unsigned NOT NULL COMMENT 'User Profile Ref',
  `KPass` varchar(128) COLLATE utf16_bin NOT NULL COMMENT 'Crypted Pass',
  `Last_Connexion` varchar(20) DEFAULT NULL COMMENT 'Last Connexion Stamp',
  `Inscription_Date` varchar(20) NOT NULL COMMENT 'Inscription Stamp',
  `salt` varchar(128) COLLATE utf16_bin NOT NULL COMMENT 'Chopping Salt',
  `token` varchar(128) COLLATE utf16_bin NOT NULL COMMENT 'Security Token',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Users Data Table';

CREATE TABLE `ud.user_profile` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `Email` char(128) COLLATE utf16_bin NOT NULL COMMENT 'User Email',
  `ID_Lang` int(2) unsigned NOT NULL COMMENT 'I18n Language Ref',
  `Active` tinyint(1) NOT NULL COMMENT 'Locking Flag',
  `User_type` enum('client','admin','partner') COLLATE utf16_bin DEFAULT NULL COMMENT 'User Type',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Users Profiles Table';

-- Tables Plugins Système

CREATE TABLE `plugin.forum_threads` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_Lang` int(32) unsigned DEFAULT NULL COMMENT 'I18n Thread Language',
  `ID_Parent` int(32) unsigned DEFAULT NULL COMMENT 'Self Linked Reference',
  `ID_Owner` int(32) unsigned DEFAULT NULL COMMENT 'Owner',
  `ID_Icon` int(32) unsigned DEFAULT NULL COMMENT 'Icon Graphic Ressource Associated',
  `Thread_nb` int(32) unsigned NOT NULL COMMENT 'Childs number',
  `Answers` int(32) unsigned DEFAULT NULL COMMENT 'Answers number',
  `Publication_Moment` varchar(20) NOT NULL COMMENT 'Publication Stamp',
  `Name` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Thread Neme',
  `Validated` tinyint(1) NOT NULL COMMENT 'Publication State',
  `More` varchar(2096) COLLATE utf16_bin NOT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Forum Threads Tree';

CREATE TABLE `plugin.comments` (
  `ID` int(32) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Lib` int(32) unsigned NOT NULL COMMENT 'I18n Label Number',
  `ID_Lang` int(32) unsigned DEFAULT NULL COMMENT 'Reference linguistique thread',
  `ID_Owner` int(32) unsigned DEFAULT NULL COMMENT 'Owner',
  `Publication_Moment` varchar(20) NOT NULL COMMENT 'Publication Date',
  `Text` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Shout Text',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Shoutbox Messages Table';

-- Tables dédiées au Log

CREATE TABLE `logger.user_actions_log` (
  `ID` int(64) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_User_Profile` int(32) unsigned NOT NULL COMMENT 'User Reference',
  `ID_Action` int(32) unsigned NOT NULL COMMENT 'Action Reference ',
  `ID_Target` int(32) unsigned DEFAULT NULL COMMENT 'Target Reference',
  `Target_Type`  varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Target Type',
  `Moment` varchar(20) NOT NULL COMMENT 'Action Stamp',
  `HostOSNavIP` varchar(1024) COLLATE utf16_bin NOT NULL COMMENT 'SysVals',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Users Actions Log Table';

CREATE TABLE `logger.user_errors_log` (
  `ID` int(64) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `ID_Description_Lib` int(32) unsigned DEFAULT NULL COMMENT 'I18n Label Number',
  `ID_User_Profile` int(32) unsigned NOT NULL COMMENT 'User Reference',
  `ID_Error` int(32) unsigned NOT NULL COMMENT 'Error Reference',
  `Target_ID` int(32) DEFAULT NULL COMMENT 'Target Reference',
  `Target_Type` varchar(1024) COLLATE utf16_bin DEFAULT NULL COMMENT 'Target Type',
  `Moment` varchar(20) NOT NULL COMMENT 'Error Stamp',
  `HostOSNavIP` varchar(1024) COLLATE utf16_bin NOT NULL COMMENT 'SysVals',
  `More` varchar(254) COLLATE utf16_bin DEFAULT NULL COMMENT 'Additionnal Informations',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_bin COMMENT='Users Errors Log Table';
