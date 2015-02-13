<?
function import_test($xml_file,$test_category_id,$insert_to_db=0,$ms_dir_name)
 {
 global $config;
	$GLOBALS['total_warnings']=0;
	$GLOBALS['total_errors']=0;
 
 $xml_file=str_replace("&","&amp;",$xml_file);
 if (@$dom=domxml_open_mem($xml_file))
     {
     $GLOBALS['dom']=$dom;
     echo "<br>XML is well-formed OK<br>";
     
     $root = $dom->document_element();

        $ctx_n1=xpath_new_context($root);
         $xpo_n1=xpath_eval($ctx_n1,"tr[1]/td[1]",$root);
         $xpo_n2=xpath_eval($ctx_n1,"tr[1]/td[2]/p",$root);
         $xpo_n3=xpath_eval($ctx_n1,"tr[1]/td[3]",$root);
         $node1=$xpo_n1->nodeset;
         $node2=$xpo_n2->nodeset;
         $node3=$xpo_n3->nodeset;
         $td1=$dom->dump_node($node1[0]);
         $td1_text=$td2_text=$td3_text="";
         if ($node1) $td1_text=trim($node1[0]->get_content());
         $td1_text=mb_convert_case($td1_text,MB_CASE_LOWER,"UTF-8");
         
         if ($node2) $td2_text=trim($node2[0]->get_content());
         $td2=$dom->dump_node($node2[0]);
         
			         
         if ($node3) $td3_text=trim($node3[0]->get_content());
         $td3_text=$td3_text;
         
         $root=$node1[0];

      $xml = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><opentest_xml type=\"test_xml\" format_version=\"2.0\" ></opentest_xml>";
       

     if ($td1_text=="test" or $td1_text=="тест")
         {
         // OK parsing content
			echo " OK parsing content";
			
		
         $test_node=$root;
         $test_disabled="0";
		 $test_test_description="";
         
         foreach ($node2 as $node2_p) 
	         {
	         echo "<br>";
	         echo $node2_p->get_content();
	         
	         if(preg_match("/Краткое\s+описание:(.)*/",$node2_p->get_content(),$matches))
	         	{
	         	@$test_test_description=$matches['1'];
	         	}
	         
	         }
         
         
         $test_name=$td3_text;
         
         $test_date_created="Unknown";
         $test_date_generator="MS Word";

         echo "<br>
         XML type: ".$td1_text." <br>
         Date created: $test_date_created <br>
         Generator: $test_date_generator <br>
          <br>
         Content <br>

         <style>
         .im_header1 {color:#5864A7}
         .im_header2 {color:#5864A7;padding-left:20px;}
         .im_header3 {color:#5864A7;padding-left:30px;}
         .im_header4 {color:#5864A7;padding-left:40px;}
         </style>

               <table>
                <tr>
                 <td class='im_header1'>Test name:</td>
                 <td>$test_name</td>
                 <td class='im_header1'>Disabled:</td>
                 <td >$test_disabled</td>
                 <td class='im_header1'>Description:</td>
                 <td >$test_test_description</td>
                </tr>

            ";




         //-- save to db
         if ($insert_to_db)
             {
			 $valid_test_name=check_test_name($test_category_id,$test_name);
             sql_query("insert into tests
                        (test_id,test_category_id,test_name,test_disable)
                        values
                        ('','$test_category_id','".addslashes($valid_test_name)."','$test_disabled')
                        ");
             $ins_test_id=mysql_insert_id();


             $query="INSERT into permissions (object_code,object_id,user_id,permission_owner)
              VALUES ('12','".$ins_test_id."','".$GLOBALS['auth_result']['user']['user_id']."','1') ";
              sql_query($query);

			$query="INSERT into test_info (test_id,user_id,update_time)
              VALUES ('".$ins_test_id."','".$GLOBALS['auth_result']['user']['user_id']."','".time()."') ";
              sql_query($query);


             }
         else
             {
             $ins_test_id="";
             }
         //--
         $ms_dir_name=(substr($ms_dir_name, 0, -1)); 
         
                if ($insert_to_db)
                    {
                    $dirpath="./media/test_".$ins_test_id."/";

                    @mkdir($dirpath, 0777);
                    @File_Archive::extract(
                        $src = File_Archive::read($GLOBALS['tmpfname']."/".$ms_dir_name),
                        $dest = "$dirpath"
                        );

                    $prefix=$config['additional_path']."/media/test_".$ins_test_id."/";;
                    }
                else
                    {
					$rnd=rand(0,100000000000000);
					$dirpath1="/tmp/".$GLOBALS['auth_result']['user']['user_id']."/archive_".$rnd."/";
                    $dirpath=dirname(__FILE__).$dirpath1;

                    $user_dir=dirname(__FILE__)."/tmp/".$GLOBALS['auth_result']['user']['user_id'];

		    @mkdir($user_dir, 0777);
                    include("dirtool/class_dirtool.php");
                    @$dir = new dirtool($user_dir);
                    @$dir->delete();

			//echo "--".$user_dir;
                    @mkdir($user_dir, 0777);
                    @mkdir($dirpath, 0777);
                    @File_Archive::extract(
                        $src = File_Archive::read($GLOBALS['tmpfname']."/$ms_dir_name"),
                        $dest = "$dirpath"
                        );
					$prefix=$config['additional_path']."/modules/tests/include".$dirpath1;
                    }
         
         $xpo_n1=xpath_eval($ctx_n1,"//tr[td[1]//node()[contains(text(),'Тема') or contains(text(),'Topic')]]",$root);
         $nodes=$xpo_n1->nodeset;

         if (count($nodes)>=1 )
          {
          foreach ($nodes as $node)
            {
            get_topics_node($node,$test_category_id,$insert_to_db,$ins_test_id,$prefix);
            }
          }
         echo "
               </table>
              ";

         }
     else
         {
         echo "<p style='color:red;'><b>ERROR:</b> Not-valid package (\"".$root->tagname()."\"), need \"test\"</p>";
         }

     }
 else
     {
     echo "<p style='color:red;'><b>ERROR:</b> XML is not well-formed</p>";

     }



 }



function get_topics_node($topic_node,$test_category_id,$insert_to_db=0,$ins_test_id="",$prefix='')
     {
     $topic_disabled="0";

     $ctx_n1=xpath_new_context($topic_node);
     $xpo_n1=xpath_eval($ctx_n1,"td[2]",$topic_node);
     $node=$xpo_n1->nodeset;
     $topic_name="";
     if ($node) $topic_name=$node[0]->get_content();
	
     $GLOBALS['stat_total_topics']++;
     
     echo "
            <tr>
             <td class='im_header2'>Topic name:</td>
             <td>$topic_name</td>
             <td class='im_header2'>Disabled:</td>
             <td >$topic_disabled</td>

            </tr>

        ";
	



     //-- save to db
     if ($insert_to_db)
         {
         sql_query("insert into topics
                    (topic_id,test_id,topic_name,topic_disable)
                    values
                    ('','$ins_test_id','".addslashes($topic_name)."','$topic_disabled')
                    ");
         $ins_topic_id=mysql_insert_id();
         }
     else
         {
         $ins_topic_id="";
         }
     $xpo_n1_next_tr=xpath_eval($ctx_n1,"following-sibling::tr",$topic_node);
     
     $nodes=$xpo_n1_next_tr->nodeset;
     foreach ($nodes as $node)
            {
            $ctx_q=xpath_new_context($node);
            $xpo_n_question=xpath_eval($ctx_q,"td[1]",$node);
            $question_node=$xpo_n_question->nodeset;
     		if ($question_node) $question_flag=trim($question_node[0]->get_content());
            
         	$question_flag=mb_convert_case($question_flag,MB_CASE_LOWER,"UTF-8");
            
            if ($question_flag=='вопрос' or $question_flag=='question')
            	{
            	
            	get_questions_node($node,$test_category_id,$insert_to_db,$ins_test_id,$ins_topic_id,$prefix);
            	}
            else if ($question_flag=='тема' or $question_flag=='topic') 
            	{
            	break;
            	}
            
            }
  

     }

function  get_questions_node($question_node,$test_category_id,$insert_to_db,$ins_test_id,$ins_topic_id,$prefix='')
     {
	 $ctx_q=xpath_new_context($question_node);
	 $xpo_n_question_text=xpath_eval($ctx_q,"td[3]",$question_node);
	 $question_node_text=$xpo_n_question_text->nodeset;
 	 //$question_node_text_content=$GLOBALS['dom']->dump_node($question_node_text[0]);
 	 $question_node_text_content=dump_child_nodes($question_node_text[0]);
 	 
 	 
 	 
 	 
	 $xpo_n2=xpath_eval($ctx_q,"td[2]/p",$question_node);    
	 $node2=$xpo_n2->nodeset; 
	 
	 
	 $question_type="1"; //DEFAULT
	 $answers_delay=''; //DEFAULT
	 $question_difficulty=1;
	 
	 foreach ($node2 as $node2_p) 
	         {
	         $node2_p_content=strip_tags ($node2_p->get_content() );
	         //echo $node2_p_content;
	         if(preg_match("/Тип\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
         	@$question_type=trim($matches['1']);
	         	}
	         if(preg_match("/Type\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
	         	@$question_type=trim($matches['1']);
	         	}
	         if(preg_match("/Сложность\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
	         	@$question_difficulty=trim($matches['1']);
	         	}
	         if(preg_match("/Вес\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
	         	@$question_difficulty=trim($matches['1']);
	         	}
	         if(preg_match("/Difficulty\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
	         	@$question_difficulty=trim($matches['1']);
	         	}
	          if(preg_match("/Weight\s*:\n*(.)*/",$node2_p_content,$matches))
	         	{
	         	@$question_difficulty=trim($matches['1']);
	         	}
	         	
	         if(preg_match("/Время\s*отображения\s*вариантов\s*ответов:(.*)/",str_replace("\n","",$node2_p_content),$matches))
	         	{
	         	@$answers_delay=trim($matches['1']);
	         	}
	         if(preg_match("/Delay\s*of\s*showing\s*answers:(.*)/",str_replace("\n","",$node2_p_content),$matches))
	         	{
	         	@$answers_delay=trim($matches['1']);
	         	}
	         	
	         }
	 
     	
     	
     @$question_disabled="0";
	 $question_text=$question_node_text_content;
	 $question_text=parse_path($question_text,$GLOBALS['ms_dir_name'],$prefix);
	 $question_text=str_replace("&amp;","&",$question_text);
     $GLOBALS['stat_total_questions']++;
     
     echo "
            <tr>
             <td class='im_header3'>Question text:</td>
             <td>$question_text</td>
             <td class='im_header3'>Question type:</td>
             <td>$question_type</td>
             <td class='im_header2'>Disabled:</td>
             <td >$question_disabled</td>
             <td class='im_header2'>Answers delay:</td>
             <td >$answers_delay</td>
             <td class='im_header2'>Difficulty:</td>
             <td >$question_difficulty</td>


            </tr>

        ";
    
	 	
     
     
     
	 	
     //-- save to db
     if ($insert_to_db)
         {
         sql_query("insert into questions
                    (question_id,topic_id,question_text,question_type,question_disable,show_later,question_difficulty)
                    values
                    ('','$ins_topic_id','".addslashes($question_text)."','$question_type',
                    '$question_disabled','$answers_delay','$question_difficulty')
                    ");
         $ins_question_id=mysql_insert_id();
         }
     else
         {
         $ins_question_id="";
         }
     //--
	
     if ($question_type=='3' and $ins_question_id!="")
	 	{
	 	$question_text=parse_question_text_type3($question_text,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix,$question_type);
	 	sql_query("update  questions set
                    question_text='".addslashes($question_text)."'
                    where 
                    question_id='$ins_question_id'
                    
                    ");
	 	
	 	}
     
     
     
     
     $xpo_n1_next_tr=xpath_eval($ctx_q,"following-sibling::tr",$question_node);
     
     $nodes=$xpo_n1_next_tr->nodeset;
     $GLOBALS['answer_true_percent_all_plus']=0;
     $GLOBALS['answer_true_percent_all_minus']=0;
     foreach ($nodes as $node)
            {
            $ctx_a=xpath_new_context($node);
            $xpo_n_answer=xpath_eval($ctx_a,"td[1]",$node);
            $answer_node=$xpo_n_answer->nodeset;
     		$answer_flag=trim($answer_node[0]->get_content());
            
         	$answer_flag=mb_convert_case($answer_flag,MB_CASE_LOWER,"UTF-8");
            if ($answer_flag=='ответ' or $answer_flag=='answer')
            	{
            	get_answers_node($node,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix,$question_type);
            	}
            else 
            	{
            	break;
            	}
            
            
            }
     		// Veryfication
     		if ($GLOBALS['answer_true_percent_all_plus']!=100 and $GLOBALS['answer_true_percent_all_plus']!=0)
            	{
            	echo " <tr>
			             <td class='im_header3' style='color:red;'>Warning:</td>
			             <td  style='color:red;'>Total positive percent should be 100 or 0 </td>
			             
			            </tr>	
            		 ";
            	$GLOBALS['total_warnings']++;
            	sql_query("update  questions set
                    question_disable='1'
                    where 
                    question_id='$ins_question_id'
                    ");
            	
            	
            	}
     		// Veryfication
     		if ($GLOBALS['answer_true_percent_all_minus']<-100)
            	{
            	echo " <tr>
			             <td class='im_header3' style='color:red;'>Warning:</td>
			             <td  style='color:red;'>Total negative percent should be no less then -100</td>
			             
			            </tr>	
            		 ";
            	$GLOBALS['total_warnings']++;
            	sql_query("update  questions set
                    question_disable='1'
                    where 
                    question_id='$ins_question_id'
                    ");
            	}
    }

function  get_answers_node($answer_node,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix='',$question_type)
     {

	 $ctx_a=xpath_new_context($answer_node);
	 $xpo_n_answer_text=xpath_eval($ctx_a,"td[3]",$answer_node);
	 $answer_node_text=$xpo_n_answer_text->nodeset;

 	 $answer_node_text_content=dump_child_nodes($answer_node_text[0]);
 	 
	 $xpo_n2=xpath_eval($ctx_a,"td[2]/p",$answer_node);    
	 $node2=$xpo_n2->nodeset; 
	  
	 $answer_true="0";//DEFAULT     	
 	 $answer_true_percent='';//DEFAULT     	
 	 $answer_sample='';//DEFAULT     	
 	 
 	 
 	 if ($question_type==4)
	 	{
	 	$xpo_n_answer_sample=xpath_eval($ctx_a,"td[4]",$answer_node);
	    $sample_node_text=$xpo_n_answer_sample->nodeset;
	    $answer_sample=$sample_node_text[0]->get_content();
	    $answer_sample=str_replace("\n"," ",$answer_sample);
	 	}
 	  
	 foreach ($node2 as $node2_p) 
	         {
	         if(preg_match("/Правильный\s*:(.*)/i",str_replace("\n","",$node2_p->get_content()),$matches))
	         	{
	         	@$answer_true=trim($matches['1']);
	         	}
	         if(preg_match("/Процент\s*правильности\s*:(\d*)/i",str_replace("\n","",$node2_p->get_content()),$matches))
	         	{
	         	@$answer_true_percent=trim($matches['1']);
	         	if ($answer_true_percent>=0)
	         		{
	         		$GLOBALS['answer_true_percent_all_plus']=$GLOBALS['answer_true_percent_all_plus']+$answer_true_percent;
	         		}
	         	else 
	         		{
	         		$GLOBALS['answer_true_percent_all_minus']+=$answer_true_percent;
	         		}
	         	
	         	}
	         if(preg_match("/Correct\s*:(.*)/i",str_replace("\n","",$node2_p->get_content()),$matches))
	         	{
	         	@$answer_true=trim($matches['1']);
	         	}
	         if(preg_match("/Correct\s*percent\s*:(\d*)/i",str_replace("\n","",$node2_p->get_content()),$matches))
	         	{
	         	@$answer_true_percent=trim($matches['1']);
	         	}
	         
	        
	         }
	 
    
     	
     @$answer_disabled="0"; 

     $answer_text=$answer_node_text_content;
     $answer_text=str_replace("&amp;","&",$answer_text);
     
     $answer_text=parse_path($answer_text,$GLOBALS['ms_dir_name'],$prefix);
     
     $GLOBALS['stat_total_answers']++;
     echo "
            <tr>
             <td class='im_header4'>Answer text:</td>
             <td>$answer_text</td>
             <td class='im_header3'>Answer true:</td>
             <td>$answer_true</td>
             <td class='im_header2'>True percent:</td>
             <td >$answer_true_percent</td>
             <td class='im_header2'>Sample:</td>
             <td >$answer_sample</td>
            </tr>

        ";
     //-- save to db
     
     if ($insert_to_db)
         {
         sql_query("insert into answers
                    (answer_id, question_id,answer_text ,answer_sample,answer_true ,true_percent )
                    values
                    ('','$ins_question_id','".addslashes($answer_text)."','".addslashes($answer_sample)."',
                    '$answer_true','$answer_true_percent')
                    ");
         $ins_answer_id=mysql_insert_id();
         }
     else
         {
         $ins_answer_id="";
         }
     //--



     }

function parse_xml_to_text($node,$prefix='')
 {

 $xslt_str = join("",file("./modules/".$GLOBALS['module']."/include/xmls/xml_to_html.xslt"));
 if ($prefix)
     {
	 $xslt_str=str_replace("<xsl:value-of select=\"@href\"/>",$prefix."<xsl:value-of select=\"@href\"/>",$xslt_str);
     }


 $question_subnodes=$node->child_nodes();

 $res_text="";

 if (count($question_subnodes)>=1)
     {
     foreach ($question_subnodes as $node1)
      {
      switch ($node1->type)
          {
          case 3:
               {
               $res_text.=$node1->get_content();
               break;
               }
          case 1:
               {

               $xmldoc = domxml_open_mem( $GLOBALS['dom']->dump_node($node1) );

                $xsldoc = domxml_xslt_stylesheet($xslt_str);
                $result =  $xsldoc->process($xmldoc);
                $res=$xsldoc->result_dump_mem($result);

               $res_text.=$res;
			   $res_text=str_replace("<?xml version=\"1.0\" encoding=\"UTF-8\"?>","",$res_text);
               break;
               }
          }

      }
     }
$res_text=str_replace("src_temp=\"","src=\"",$res_text);
$res_text=str_replace("&amp;","&",$res_text);


 return ($res_text);
 }
 
 
 
 
 
 
 
 
 
 
 
 
 
 
function show_dir($dir, $pos=2){ 
    global $totalsize; 
    $handle = @opendir($dir); 
    while ($file = @readdir ($handle)){ 
        if (eregi("^\.{1,2}$",$file)) 
            continue; 
        if(is_dir($dir.$file)){ 
        show_dir($dir."$file/", $pos+1); 
    }else{ 
        $size=filesize($dir.$file); 
            $totalsize=$totalsize+$size; 
        } 
    } 
    @closedir($handle); 
    return($totalsize); 
}



function check_test_name($test_category,$test_name,$iteration=0)
	{

	if ($iteration!=0)
		{
		$test_name_end=$test_name."_".$iteration;
		}
	else
		{
		$test_name_end=$test_name;
		}
	$f_test=mysql_fetch_row(mysql_query("select count(*) from tests
		where 
		tests.test_category_id='$test_category' and
		tests.test_name='$test_name_end'
		"));
    if ($f_test[0]>=1)
        {
        //echo "present";
        $iteration++;
        $test_name_end=check_test_name($test_category,$test_name,$iteration);
        return $test_name_end;
        }
    else
        {
        return $test_name_end;
        }

    }

    
    
function parse_question_text_type3($question_text,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix='',$question_type)
	{
	$question_text=str_replace("\n","",$question_text);
	$res_text=preg_replace("/\[_(.*)_\]/Ue","answer3_callback('\\1',\$ins_question_id,\$insert_to_db)", $question_text);
	return $res_text;
	}    

function answer3_callback($data,$ins_question_id,$insert_to_db)
	{
	
	$answer_true="1";//DEFAULT     	
 	$answer_true_percent='';//DEFAULT     	
 	$answer_sample=$data;//DEFAULT  
	@$answer_disabled="0"; 
	
	$answer_text=$data;
     
     $GLOBALS['stat_total_answers']++;
     echo "
            <tr>
             <td class='im_header4'>Answer text:</td>
             <td>$answer_text</td>
             <td class='im_header3'>Answer true:</td>
             <td>$answer_true</td>
             <td class='im_header2'>True percent:</td>
             <td >$answer_true_percent</td>
             <td class='im_header2'>Sample:</td>
             <td >$answer_sample</td>
            </tr>

        ";
     //-- save to db
     
     if (preg_match("/^~/",$answer_sample) )
     	{
     	$use_regexp="2";
     	
     	}
     else 
     	{
     	$use_regexp="0";
     	}
     
     if ($insert_to_db)
     	{
         
         sql_query("insert into answers
                    (answer_id, question_id,answer_text ,answer_sample,answer_true ,true_percent, use_regexp )
                    values
                    ('','$ins_question_id','".addslashes($answer_text)."','".addslashes($answer_sample)."',
                    '$answer_true','$answer_true_percent' , '$use_regexp' )
                    ");
         
         $ins_answer_id=mysql_insert_id();
         
         }
     else
         {
         $ins_answer_id="";
         }
     //--
	
	
	
	return("[_A$ins_answer_id]");
	}

	
	
function dump_child_nodes($node){
   $output='';
   $owner_document = $node->owner_document();
   $children = $node->child_nodes();
   $total_children = count($children);
   for ($i = 0; $i < $total_children; $i++){
       $cur_child_node = $children[$i];
       $output .= $owner_document->dump_node($cur_child_node);
   }
   return $output;
}	


function parse_path($text,$ms_dir_name,$prefix)
	{
	$text=preg_replace("/src=\"(.)*\.files\//U","src=\"".$prefix,$text);
	return $text;
	}