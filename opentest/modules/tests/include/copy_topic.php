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



ini_set("magic_quotes_gpc","on");
ini_set("magic_quotes_runtime","off");
ini_set("magic_quotes_sybase","off");

mb_internal_encoding($GLOBALS['default_internal_encoding']);

/*
echo "
<p>
Source topic: $topic_id  <br>
Destination test : $dest_test_id  <br>
</p>
";
*/

// copying topc
$res_topic=sql_query("select * from topics where topic_id='$topic_id' ");
while ($f_topic=mysql_fetch_array($res_topic))
	{
	$res_ins=sql_query("insert into topics  (  	 topic_id ,topic_name , test_id , topic_disable)
				values ('','$f_topic[topic_name]','$dest_test_id','$f_topic[topic_disable]')  ");
	$dest_topic_id=mysql_insert_id();
	// copying questions
	$res_questions=sql_query("select * from questions where topic_id='$f_topic[topic_id]' ");
	while ($f_question=mysql_fetch_array($res_questions))
		{
		$new_question_text=process_htmltext($f_question['question_text']);
		$res_ins=sql_query("insert into questions  
					(question_id,topic_id,question_text,question_type,question_disable,show_later,question_difficulty)
				values 
				('','$dest_topic_id','$new_question_text 7777777','$f_question[question_type]','$f_question[question_disable]',
				'$f_question[show_later]','$f_question[question_difficulty]'		)  ");
		$dest_question_id=mysql_insert_id();
		$res_answers=sql_query("select * from answers where question_id='$f_question[question_id]' ");
		while ($f_answer=mysql_fetch_array($res_answers))
				{
				$new_answer_text=process_htmltext($f_answer['answer_text']);
				sql_query("insert into answers  
							(answer_id,question_id,answer_text,answer_sample,answer_true,true_percent,use_regexp,serialized_regexp)
						values 
						('','$dest_question_id','$new_answer_text','$f_answer[answer_sample]','$f_answer[answer_true]',
						'$f_answer[true_percent]','$f_answer[use_regexp]','$f_answer[serialized_regexp]'		)  ");
				
				}
		
		}
					
	}

	

echo "
Topic  $f_source_test_category[test_category_name] -> $f_source_test_category[test_name] -> $f_source_topic[topic_name]
 has been copied to $f_test_category[test_category_name] -> <a href='index.php?module=tests&page=test&action=view_test&test_id=$f_test_category[test_id]'>$f_test_category[test_name]</a>
";	
	



function process_htmltext($html_text)
     {
     //$html_text_return=htmlspecialchars($html_text);
     $html_text_return=replace_objects($html_text);


     return $html_text_return;
     }


function replace_objects($string) {
    $string=preg_replace_callback("/<\s*((embed)|(img)).*>/Ui",'callback_flush_image',$string);
    return $string;
}
 
function callback_flush_image($data)
    {
    global $_REQUEST;
    $src=preg_match("/src=\"(.*)\"/Ui",$data[0],$matches);
    $file_url=$matches[1];
    $file_url=str_replace($GLOBALS['config']['additional_path'],"",$file_url);
    $dest_media_path=$GLOBALS['config']['opentest_root_path']."/media/test_".$GLOBALS['dest_test_id'];
    echo $dest_media_path;
    if (!is_dir($dest_media_path))
    	mkdir($dest_media_path);	
    
    $tmpfname = tempnam($dest_media_path, "cop");
    
    
    copy($GLOBALS['config']['opentest_root_path'].$file_url,$tmpfname);
    
    $new_file_url=$GLOBALS['config']['media_path_prefix']."".$GLOBALS['dest_test_id']."/".basename($tmpfname);
    if (@$_REQUEST['test_category_id'])
    	@copy($GLOBALS['config']['opentets_root_path'].$file_uri.$_REQUEST['test_category_id'],$new_file_url.basename($_REQUEST['test_category_id']));
    //print_r($file_url);
    
    $return=preg_replace("/src=\"(.*)\"/Ui","src=\"$new_file_url\"",$data[0]);
    //print_r( $return);
    return $return;

    }
