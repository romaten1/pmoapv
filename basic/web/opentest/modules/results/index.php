<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

@$donot_show_headers=$_REQUEST['donot_show_headers'];
$header_content = "";
$page_content = "";
$footer_content = "";

$page = test_page(@$_REQUEST['page']);

if(isset($_REQUEST['action'])) $action = $_REQUEST['action'];
	else $action="";

$teacher_id = $GLOBALS['auth_result']['user']['user_id'];

ini_set("session.save_path",$config['opentest_root_path']."/tmp");
	
get_lang($module);

if(!strpos($action,"print_ver")&&$action!="print_ver") {
	session_start();
	ob_start();	
	
	include_once("include/header.php");
	OpenTable();		
	$header_content=ob_get_contents();
   	ob_end_clean();
	ob_start();

	include_once("modules/$module/include/$page.php");
	$page_content=ob_get_contents();
	ob_end_clean();
	ob_start();
	CloseTable();

	include_once("include/footer.php");
	$footer_content=ob_get_contents();
	ob_end_clean();		
} else {		
	include("themes/$current_theme/theme.php");;
	echo   "﻿<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\">
		<html>
		<head>
		<title>"._HEADER2."</title>";
	include_once("include/meta.php");
	if (file_exists("themes/$current_theme/images/favicon.ico"))
		echo '<link REL="shortcut icon" HREF="themes/'.$current_theme.'/images/favicon.ico" TYPE="image/x-icon">';
	echo '<LINK REL="StyleSheet" HREF="themes/'.$current_theme.'/style/style.css" TYPE="text/css">
		</head><body>';
	OpenTable2();		

	include_once("modules/$module/include/$page.php");
	CloseTable2();

	echo '</body></html>';
}
	
if ($donot_show_headers and @$GLOBALS['download']!="") {
	echo $GLOBALS['download'];
} elseif ($donot_show_headers) {
	echo $page_content;	
} else {
	echo $header_content;
	echo $page_content;
	echo $footer_content;
}