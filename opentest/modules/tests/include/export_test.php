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

@$export_format=$_REQUEST['export_format'];         
@$test_id=$_REQUEST['test_id'];                  
@$donot_export_disabled=$_REQUEST['donot_export_disabled'];         

ini_set ("memory_limit","96M");
ini_set ("max_execution_time","160000");
ignore_user_abort();
require_once('export_xml_functions.php');




ini_set("magic_quotes_gpc","on");
ini_set("magic_quotes_runtime","off");
ini_set("magic_quotes_sybase","off");

mb_internal_encoding($GLOBALS['default_internal_encoding']);


if (version_compare(PHP_VERSION,'5','>='))
 require_once('domxml-php4-to-php5.php'); //Load the PHP5 converter
if (version_compare(PHP_VERSION,'5','>=')&&extension_loaded('xsl'))
 require_once('xslt-php4-to-php5.php');

ini_set ("include_path","./modules/PEAR");

//	$GLOBALS['default_internal_encoding']=mb_internal_encoding();


switch($export_format)
  {
  case "opentest2":
      {

	$res=export_test($test_id, $donot_export_disabled);
	$res=preg_replace("/<\/test>(\s|\n)*/","</test>",$res);
	 
	
	 require_once "File/Archive.php";
	
	// $r1="html_entity_decode($res)";
	 $r1=array();
	 $r1[]=File_Archive::readMemory(html_entity_decode($res), "opentest_manifest.xml");
	 $r1[]=File_Archive::read("./media/test_".$test_id, "files");
	File_Archive::extract(
	    //The content of archive.tar appears in the root folder (default argument)
	    $r1,
	
	
	    //And is written to ...
	    File_Archive::toArchive(       // ... a zip archive
	        "archive.zip",             // called archive.zip
	        File_Archive::toVariable($GLOBALS['download']),   // that will be sent to the standard output
	    "Zip"
	    )
	);
	
	ini_set ("include_path","./");
	
	//----uncomment
	    $GLOBALS['filename']='opentest_test.zip';
	    
     }
  case "qti":
      {
      break;
      }
  default:
     {
     echo "<tr><td>  <br>
             <b>"._CATEGORY_EXPORT_TEXT."</b>:<br><br>
             <form method=POST enctype='multipart/form-data' >
             <b>"._CATEGORY_IMPORT_FORMATS."</b>:<br>

             <input type='radio' name='export_format' value='opentest2' checked> OpenTEST 2.0 Zip Package <br>
             <input type='radio' name='export_format' value='qti' disabled> IMS QTI v.2 <br>
             <br><b>"._CATEGORY_IMPORT_OPTIONS."</b>:<br>
             <input type='checkbox' name='donot_export_disabled' value='1'>"._CATEGORY_EXPORT_OPTION1." <br>
             <br><br>

             <input type=submit value='"._EXPORT_BUTTON."'>
             </form>
            ";
      break;
     }
  }
		
ini_set ("include_path","./");