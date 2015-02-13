<?

function import_test($xml_file,$test_category_id,$insert_to_db=0)
 {
 global $dom,$config;
 if (@$dom=domxml_open_mem($xml_file))
     {
     echo "<br>XML is well-formed OK<br>";
     $root = $dom->document_element();
         $ctx_n1=xpath_new_context($root);
         $xpo_n1=xpath_eval($ctx_n1,"test",$root);
         $node=$xpo_n1->nodeset;
         $root=$node[0];
      

     if ($root->tagname()=="test" )
         {
         // OK parsing content

         $test_node=$root;
         $test_disabled=$test_node->get_attribute('disabled');

         $ctx_n1=xpath_new_context($root);
         $xpo_n1=xpath_eval($ctx_n1,"test_name",$root);
         $node=$xpo_n1->nodeset;
         $test_name=$node[0]->get_content();

         $xpo_n1=xpath_eval($ctx_n1,"test_description",$root);
         $node=$xpo_n1->nodeset;
         $test_test_description=$node[0]->get_content();

         $xpo_n1=xpath_eval($ctx_n1,"date_created",$root);
         $node=$xpo_n1->nodeset;
         $test_date_created=$node[0]->get_content();

         $xpo_n1=xpath_eval($ctx_n1,"generator",$root);
         $node=$xpo_n1->nodeset;
         $test_date_generator=$node[0]->get_content();

         echo "
         XML type: ".$root->tagname()." <br>
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
			 // check if test_name exists
			 $valid_test_name=check_test_name($test_category_id,$test_name);
			 //$valid_test_name=$test_name;
			 
			 
             sql_query("insert into tests
                        (test_category_id,test_name,test_disable)
                        values
                        ('$test_category_id','".addslashes($valid_test_name)."','$test_disabled')
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

                if ($insert_to_db)
                    {
                    $dirpath="./media/test_".$ins_test_id."/";
					
                    mkdir($dirpath, 0777);
                    @File_Archive::extract(
                        $src = File_Archive::read($GLOBALS['tmpfname']."/files"),
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

                    @mkdir($user_dir, 0777);
                    @mkdir($dirpath, 0777);
                    @File_Archive::extract(
                        $src = File_Archive::read($GLOBALS['tmpfname']."/files"),
                        $dest = "$dirpath"
                        );
					$prefix=$config['additional_path']."/modules/tests/include".$dirpath1;
                    }



         $xpo_n1=xpath_eval($ctx_n1,"content/topic",$root);

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
     $topic_disabled=$topic_node->get_attribute('disabled');

     $ctx_n1=xpath_new_context($topic_node);
     $xpo_n1=xpath_eval($ctx_n1,"topic_name",$topic_node);
     $node=$xpo_n1->nodeset;
     $topic_name=$node[0]->get_content();

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
                    (test_id,topic_name,topic_disable)
                    values
                    ('$ins_test_id','".addslashes($topic_name)."','$topic_disabled')
                    ");
         $ins_topic_id=mysql_insert_id();
         }
     else
         {
         $ins_topic_id="";
         }
     //--


     $xpo_n1=xpath_eval($ctx_n1,"content/question",$topic_node);

         $nodes=$xpo_n1->nodeset;

         if (count($nodes)>=1 )
          {
          foreach ($nodes as $node)
            {
            get_questions_node($node,$test_category_id,$insert_to_db,$ins_test_id,$ins_topic_id,$prefix);
            }
          }

     }



//-------------------------------

function  get_questions_node($question_node,$test_category_id,$insert_to_db,$ins_test_id,$ins_topic_id,$prefix='')
     {

     @$question_disabled=$question_node->get_attribute('disabled');
     @$question_type=$question_node->get_attribute('question_type');
     @$answers_delay=$question_node->get_attribute('answers_delay');
     @$question_difficulty=$question_node->get_attribute('question_difficulty');

     $ctx_n1=xpath_new_context($question_node);
     $xpo_n1=xpath_eval($ctx_n1,"question_text",$question_node);


     $node=$xpo_n1->nodeset;

     $question_text=parse_xml_to_text($node[0],$prefix);

     //$question_text=$node[0]->get_content();
     $GLOBALS['stat_total_questions']++;
     
     echo "
            <tr>
             <td class='im_header3'>Question text:</td>
             <td>$question_text</td>
             <td class='im_header3'>Question typet:</td>
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
                    (topic_id,question_text,question_type,question_disable,show_later,question_difficulty)
                    values
                    ('$ins_topic_id','".addslashes($question_text)."','$question_type',
                    '$question_disabled','$answers_delay','$question_difficulty')
                    ");
         $ins_question_id=mysql_insert_id();
         }
     else
         {
         $ins_question_id="";
         }
     //--

     $xpo_n1=xpath_eval($ctx_n1,"content/answer",$question_node);

         $nodes=$xpo_n1->nodeset;

         if (count($nodes)>=1 )
          {
          foreach ($nodes as $node)
            {
            get_answers_node($node,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix,$question_type);
            }
          }


     }








function  get_answers_node($answer_node,$test_category_id,$insert_to_db,$ins_test_id,$ins_question_id,$prefix='',$question_type)
     {

     @$answer_disabled=$answer_node->get_attribute('disabled');
     @$answer_true=$answer_node->get_attribute('true');
     @$answer_true_percent=$answer_node->get_attribute('true_percent');
     @$answer_sample=urldecode($answer_node->get_attribute('sample'));
     @$use_regexp=$answer_node->get_attribute('use_regexp');
     @$sample_id=$answer_node->get_attribute('sample_id');
     
	 $serialized_regexp="";
     $ctx_n1=xpath_new_context($answer_node);
     $xpo_n1=xpath_eval($ctx_n1,"answer_text",$answer_node);
     
     $xpo_n2=xpath_eval($ctx_n1,"serialized_regexp",$answer_node);
     $serialized_regexp_node=$xpo_n2->nodeset;
	 $serialized_regexp=$serialized_regexp_node[0]->get_content();
     
	
     $node=$xpo_n1->nodeset;

     $answer_text=parse_xml_to_text($node[0],$prefix);

     //$question_text=$node[0]->get_content();
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
                    ( question_id,answer_text ,answer_sample,answer_true ,true_percent, use_regexp, serialized_regexp )
                    values
                    ('$ins_question_id','".addslashes($answer_text)."','".addslashes($answer_sample)."',
                    '$answer_true','$answer_true_percent' , '".$use_regexp."', '".addslashes($serialized_regexp)."' ) 
                    ");
         $ins_answer_id=mysql_insert_id();
         
        if ($sample_id!="" and $question_type=='3')
		 	{
		 		
		 	$quest_text=mysql_fetch_array(mysql_query("select * from questions where question_id='$ins_question_id' "));
		 	//echo "-----<textarea cols=100 rows=30>".$question_type."111";print_r($quest_text['question_text']);echo "</textarea>";
		 	$new_quest_text=preg_replace("/\\[_A(\d*\])/","[_A".$ins_answer_id."]",$quest_text['question_text']);
		 	//echo "<textarea cols=100 rows=30>".$new_quest_text."</textarea>+++";
		 	$update_question=mysql_query("update questions set question_text='".addslashes($new_quest_text)."' where question_id='$ins_question_id' ");
		 	//echo "update questions set question_text='".addslashes($new_quest_text)."' where question_id='$ins_question_id' ";
		 	}
	 
         
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