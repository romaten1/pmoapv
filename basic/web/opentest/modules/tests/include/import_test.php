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


@$import_format=$_REQUEST['import_format'];
@$save_to_db=$_REQUEST['save_to_db'];
@$show_log=$_REQUEST['show_log'];
  
 ini_set ("memory_limit","96M");
 ini_set ("max_execution_time","160000");
 ignore_user_abort();

mb_internal_encoding($GLOBALS['default_internal_encoding']);
if (version_compare(PHP_VERSION,'5','>='))
 require_once('domxml-php4-to-php5.php'); //Load the PHP5 converter
 
 

switch($import_format)
  {

case "opentest2_msword_html":
  	{
  		
  		
	$test_category_id=$_REQUEST['test_category_id'];


      if($file_post=fopen($_FILES['file']['tmp_name'],"rb"))
          {
            $file_post_str=fread($file_post,filesize($_FILES['file']['tmp_name']));

            ini_set ("include_path","./modules/PEAR");
			
            if (@$f_zip=zip_open($_FILES['file']['tmp_name']) and !is_int($f_zip))
                {

                $zip_size=0;
                $ms_dir_name='';
                while ($zip_entry = zip_read($f_zip))
                   {
                   $zip_size+=zip_entry_filesize($zip_entry);
                   if ($ms_dir_name=='' and preg_match("/.*\.files/",zip_entry_name($zip_entry))) 
                   	{$ms_dir_name=zip_entry_name($zip_entry);}
                   }
                $GLOBALS['ms_dir_name']=$ms_dir_name;
                echo "
                <tr><td>  <br>


                <br>
                <div style='background-color:#F7F8FB;padding:3px;'>
                Total unpacked size: $zip_size bytes  <br>
                Processing:  OpenTEST2 MSWord Package ...
                </div>
                ";

                require_once "File/Archive.php";

				ob_start();	
				
               $tmpfname1 = tempnam(dirname(__FILE__)."/tmp/", "ndn");
                $tmpfname=$tmpfname1.".zip";
                copy($_FILES['file']['tmp_name'],$tmpfname);

                File_Archive::extract(
                    $src =File_Archive::read($tmpfname."/*.htm"),
                    File_Archive::toVariable($xml_file),
                    "zip"
                    );
		    $tmpfname_xml = tempnam(dirname(__FILE__)."/tmp", "xml");
		    $f_xml=fopen($tmpfname_xml,"w+");
		    fwrite($f_xml,$xml_file);
		    fclose($f_xml);
		unlink($tmpfname_xml);
		
			
			$stat_total_topics=0;
			$stat_total_questions=0;
			$stat_total_answers=0;
			$total_warnings=0;
			require("HTMLtoXHTML.php");
			$doc=iconv("windows-1251","utf-8",$xml_file);
			$handler=new HTMLtoXHTMLHandler();
			$parser=new XML_HTMLSax3();
			$parser->set_object($handler);
		
		// Set the handlers
			$parser->set_element_handler('openHandler','closeHandler');
			$parser->set_data_handler('dataHandler');
			$parser->set_escape_handler('escapeHandler');
			
			// Parse the document
			$parser->parse($doc);
			$full_html=$handler->getXHTML();

			$table_xml=eregi("<table(.*)<\/table\>",$full_html,$matches_table);
			if ($table_xml)
				{
				$xml_file="<?xml version=\"1.0\" encoding=\"utf-8\" ?>
".$matches_table[0];
				include('import_html_functions_2.php');
				
				import_test($xml_file,$test_category_id,$save_to_db,$ms_dir_name);	
				}
			else 	
				{
				echo "<p>Table wasn't found in the document</p>";
				}
			
			$res_log=ob_get_contents();
			ob_end_clean();
			
			if ($show_log)
				{
				echo $res_log;
                }
				
			echo "<div style='color:blue;background-color:#F7F8FB;padding:3px;'><br>
			Total Topics: <b>$stat_total_topics</b> <br>
			Total Questions: <b>$stat_total_questions</b> <br>
			Total Answers: <b>$stat_total_answers</b> <br>
			Total Warnings: <b>".$GLOBALS['total_warnings']."</b> <br>&nbsp;
			</div>";
                unlink($tmpfname1);
                unlink($tmpfname);


                }
            else
                {
                echo "Error in Zip archive";
                }
            ini_set ("include_path","./");
          }
      else
          {
                echo "Error. File wasn't uploaded";
          }
  	
  	break;
  	}
    	
  	
  	
  	
  case "opentest2":
      {
      
      $test_category_id=$_REQUEST['test_category_id'];


      if($file_post=fopen($_FILES['file']['tmp_name'],"rb"))
          {
            $file_post_str=fread($file_post,filesize($_FILES['file']['tmp_name']));

            ini_set ("include_path","./modules/PEAR");
           
            if (@$f_zip=zip_open($_FILES['file']['tmp_name']) and !is_int($f_zip))
                {

                $zip_size=0;
                while ($zip_entry = zip_read($f_zip))
                   {
                   $zip_size+=zip_entry_filesize($zip_entry);
                   }
                echo "
                <tr><td>  <br>


                <br>
                <div style='background-color:#F7F8FB;padding:3px;'>
                Total unpacked size: $zip_size bytes  <br>
                Processing:  opentest_manifest.xml ...
                ";

                require_once "File/Archive.php";


                include('import_xml_functions.php');

                $tmpfname1 = tempnam(dirname(__FILE__)."/tmp/", "ndn");
                $tmpfname=$tmpfname1.".zip";
                copy($_FILES['file']['tmp_name'],$tmpfname);

                @File_Archive::extract(
                    $src =File_Archive::read($tmpfname."/opentest_manifest.xml"),
                    File_Archive::toVariable($xml_file),
                    "zip"
                    );
                    
                    $xml_file=trim($xml_file);
		    $tmpfname_xml = tempnam(dirname(__FILE__)."/tmp", "xml");
		    $f_xml=fopen($tmpfname_xml,"w+");
		    fwrite($f_xml,$xml_file);
		    fclose($f_xml);
		echo "<br>Veryfying XML: ";
		include 'XML/DTD/XmlValidator.php';
		$validator = new XML_DTD_XmlValidator;

		$test_xml_file=$tmpfname_xml;
		$dtd_file=dirname(__FILE__)."/xmls/opentest_manifest.dtd";

		$res=@$validator->isValid($dtd_file, $test_xml_file);
		unlink($tmpfname_xml);
		if($res)
			{
			echo "<span style='color:green;'>XML ValidM</span>
				</div>";
			$stat_total_topics=0;
			$stat_total_questions=0;
			$stat_total_answers=0;
			
			ob_start();	
			import_test($xml_file,$test_category_id,$save_to_db);
			$res_log=ob_get_contents();
			ob_end_clean();
			
			if ($show_log)
				{echo $res_log;}
				
			echo "<div style='color:blue;background-color:#F7F8FB;padding:3px;'><br>
			Total Topics: <b>$stat_total_topics</b> <br>
			Total Questions: <b>$stat_total_questions</b> <br>
			Total Answers: <b>$stat_total_answers</b> <br>&nbsp;
			
			</div>";
			}
		else
			{echo "<span style='color:red;'>XML Invalid</span>";
			echo "<p style='background-color:#FFF9F9;padding:10px;margin:10px;color:red;'>
			<b>Found errors in XML:</b><br><br>
			
			
			
			";
			$errors=$validator->getMessage();
			echo nl2br(htmlentities($errors));
			echo "</p>";
			echo "XML File: <textarea style='width:100%;height=200'>$xml_file</textarea>";
			
			}
		
		

	     
                unlink($tmpfname1);
                unlink($tmpfname);


                }
            else
                {
                echo "Error in Zip archive";
                }
            ini_set ("include_path","./");
          }
      else
          {
                echo "Error. File wasn't uploaded";
          }


      break;
      }



  case "opentest1":
      {
		echo "<tr><td>             ";

      if($file_post=fopen($_FILES['file']['tmp_name'],"rb"))
          {
            include("opentest1_xml_scripts/import_xml_functions.php");
            
	ob_start();	
	import_xml($_FILES['file']['tmp_name'],"test",$save_to_db);
	$res_log=ob_get_contents();
	ob_end_clean();
	
	if ($show_log)
		{echo $res_log;}            
            
            


          }
      else
          {
                echo "Error. File wasn't uploaded";
          }


      break;
      }

  case "opentest1_msword_html":
  	{
  		
	$test_category_id=$_REQUEST['test_category_id'];
	print_r($_FILES['file']);
	
	
	
      if($file_post=fopen($_FILES['file']['tmp_name'],"rb"))
          {
          	if (move_uploaded_file($_FILES['file']['tmp_name'], "./modules/tests/include/tmp/".$_REQUEST['test_id']))
					{
	
					}
            $file_post_str=fread($file_post,filesize($_FILES['file']['tmp_name']));

            ini_set ("include_path","./modules/PEAR");

            if (@$f_zip=zip_open($_FILES['file']['tmp_name']))
                {

                $zip_size=0;
                while ($zip_entry = zip_read($f_zip))
                   {
                   $zip_size+=zip_entry_filesize($zip_entry);
                   }
                echo "
                <tr><td>  <br>


                <br>
                <div style='background-color:#F7F8FB;padding:3px;'>
                Total unpacked size: $zip_size bytes  <br>
                Processing:  opentest_manifest.xml ...
                ";

                require_once "File/Archive.php";

                $tmpfname1 = tempnam(dirname(__FILE__)."/tmp/", "ndn");
                $tmpfname=$tmpfname1.".zip";
                copy($_FILES['file']['tmp_name'],$tmpfname);

                File_Archive::extract(
                    $src =File_Archive::read($tmpfname."/*.htm"),
                    File_Archive::toVariable($xml_file),
                    "zip"
                    );
		    $tmpfname_xml = tempnam(dirname(__FILE__)."/tmp", "xml");
		    $f_xml=fopen($tmpfname_xml,"w+");
		    fwrite($f_xml,$xml_file);
		    fclose($f_xml);
		unlink($tmpfname_xml);
		
			
			$stat_total_topics=0;
			$stat_total_questions=0;
			$stat_total_answers=0;
			
			ob_start();	
			
			require("HTMLtoXHTML.php");
			
			
			$res_log=ob_get_contents();
			ob_end_clean();
			
			if ($show_log)
				{echo $res_log;}
				
			echo "<div style='color:blue;background-color:#F7F8FB;padding:3px;'><br>
			Total Topics: <b>$stat_total_topics</b> <br>
			Total Questions: <b>$stat_total_questions</b> <br>
			Total Answers: <b>$stat_total_answers</b> <br>&nbsp;
			
			</div>";
                unlink($tmpfname1);
                unlink($tmpfname);


                }
            else
                {
                echo "Error in Zip archive";
                }
            ini_set ("include_path","./");
          }
      else
          {
                echo "Error. File wasn't uploaded";
          }
 	
  	break;
  	}
  	
  default:
      {
       echo "<tr><td>  <br>
             <b>"._CATEGORY_IMPORT_TEXT."</b>:<br><br>
             <form method=POST enctype='multipart/form-data' >
             <input type=file name='file'>
               (Max upload size:  ".ini_get('upload_max_filesize').")
             <br><br>
             <b>"._CATEGORY_IMPORT_FORMATS."</b>:<br>

             <input type='radio' name='import_format' value='opentest2_msword_html' checked >  OpenTEST2 MSWord Zip Package <br>
             <input type='radio' name='import_format' value='opentest2' > OpenTEST2 XML Zip Package <br>
             <input type='radio' name='import_format' value='opentest1' > OpenTEST1 XML <br>

             <br><b>"._CATEGORY_IMPORT_OPTIONS."</b>:<br>

             <input type='radio' name='save_to_db' value='1' checked > "._CATEGORY_IMPORT_OPTION2." <br>
             <input type='radio' name='save_to_db' value='0'> "._CATEGORY_IMPORT_OPTION1." <br><br>
             
             <input type='checkbox' name='show_log' checked value='1' > "._CATEGORY_IMPORT_OPTION3." <br><br>

             <input type=submit value='"._CATEGORY_IMPORT_BUTTON."'>
             </form>
            ";
      break;
      }
  }