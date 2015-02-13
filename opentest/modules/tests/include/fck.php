<?php
	/************************************************************************/
	/* OpenTEST System: The System Of Computer Testing Knowleges            */
	/* ============================================                         */
	/*                                                                      */
	/* Copyright (c) 2002-2005 by OpenTEST Team                             */
	/* http://opentest.com.ua                                               */
	/* e-mail: opentest@opentest.com.ua                                     */
	/*                                                                      */
	/************************************************************************/
	/* 11/01/2005 08:00:00                                                                                    */
	/************************************************************************/
	if (INDEXPHP!=1)
		die ("You can't access this file directly...");
	
	function ConfigFCK(&$oFCK,$test_id,$value,$question_id=0)
	{
		global $config,$currentlang;
		
		$oFCK->BasePath	   = $config['fckeditor_path'] ;		
		$oFCK->Value       = $value;
		$oFCK->Width       = $config['fckeditor_width'];
		$oFCK->Height      = $config['fckeditor_height'];
		
		$oFCK->Config['DefaultLanguage'] = $currentlang;
		
		$oFCK->Config['ImageBrowserURL'] = $oFCK->BasePath."editor/filemanager/browser/default/browser.html?Type=&Connector=connectors/php/connector.php&ServerPath=".$config['media_path_prefix'].$test_id."/";
		$oFCK->Config['ImageOType'] 	  = $config['img_ot_type'];
		
		$oFCK->Config['FlashBrowserURL'] = $oFCK->BasePath."editor/filemanager/browser/default/browser.html?Type=&Connector=connectors/php/connector.php&ServerPath=".$config['media_path_prefix'].$test_id."/";
		$oFCK->Config['FlashClassID']    = $config['flash_classid'];
		$oFCK->Config['FlashPlugin']     = $config['plugin_page'].'flash_install.exe';
		$oFCK->Config['FlashType']       = $config['flash_type'];
		$oFCK->Config['FlashOType'] 	  = $config['flash_ot_type'];
		
		$oFCK->Config['VideoBrowserURL'] = $oFCK->BasePath."editor/filemanager/browser/default/browser.html?Type=&Connector=connectors/php/connector.php&ServerPath=".$config['media_path_prefix'].$test_id."/";
		$oFCK->Config['VideoClassID']    = $config['video_classid'];
		$oFCK->Config['VideoPlugin']     = $config['plugin_page'].'mplayer_install.exe';
		$oFCK->Config['VideoType']       = $config['video_type'];
		$oFCK->Config['VideoID']         = $config['video_id'];
		$oFCK->Config['VideoOType'] 	  = $config['video_ot_type'];
		
		$oFCK->Config['AudioBrowserURL'] = $oFCK->BasePath."editor/filemanager/browser/default/browser.html?Type=&Connector=connectors/php/connector.php&ServerPath=".$config['media_path_prefix'].$test_id."/";
		$oFCK->Config['AudioClassID']    = $config['audio_classid'];
		$oFCK->Config['AudioPlugin']     = $config['plugin_page'].'mplayer_install.exe';
		$oFCK->Config['AudioType']       = $config['audio_type'];
		$oFCK->Config['AudioID']         = $config['audio_id'];
		$oFCK->Config['AudioOType'] 	  = $config['audio_ot_type'];
		
		if (!empty($question_id)) {
			$oFCK->Config['QuestionID']		=	$question_id;	
			$oFCK->ToolbarSet  = "_".$config['fckeditor_toolbarset'];
		} else {
			$oFCK->ToolbarSet  = $config['fckeditor_toolbarset'];
		}
	}
	
	function remove_p($text)
	{
		return preg_replace("/^( *)((&nbsp;)*)( *)(<p>)(.+)(<\/p>)/iU","\$1\$2\$4\$6",$text);
	}
	
	require_once substr($config['fckeditor_path'],strlen($config['additional_path'])+1)."fckeditor.php";