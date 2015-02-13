<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");
	
	$limit_page=5;
	
	if(isset($_REQUEST['new_topic_name']))
		$new_topic_name = $_REQUEST['new_topic_name'];
	else $new_topic_name = "";
	
	if(isset($_REQUEST['question_text']))
		$question_text = $_REQUEST['question_text'];
	else $question_text="";
	
	if(isset($_REQUEST['question_type']))
		$question_type = intval($_REQUEST['question_type']);
	else $question_type=0;	
	
	if(isset($_REQUEST['question_difficulty']))
		$question_difficulty = intval($_REQUEST['question_difficulty']);
	else $question_difficulty = 0;
	
	if(isset($_REQUEST['show_later']))
		$show_later = intval($_REQUEST['show_later']);
	else $show_later=0;	
	
	if(!isset($_REQUEST['letter']))
		$letter="";
	else
		$letter=$_REQUEST['letter'];
	
	if(!isset($_REQUEST['keyword']))
		$keyword="";
	else
		$keyword=$_REQUEST['keyword'];
	 
	switch($action)
	{
		case "view_topic":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TOPIC_VIEW_HEADER,"","",true);
			echo "<tr><td>  <br>";
			
			if ($keyword!='')
				$null_message = _TOPIC_NO_KEYWORD;			
			elseif ($letter=='')
				$null_message = _TOPIC_NO_QUESTION;
			else
				$null_message = _TOPIC_NO_LETTER;
		
			$row_num=get_count($topic_id,2,false,$keyword,$letter);
			
			if(!($letter==''&&$row_num==0&&$keyword==''))
				show_abc ('index.php?module='.$module.'&page='.$page.'&action='.$action.'&topic_id='.$topic_id.'&letter=');
			
			if ($row_num==0)
				echo "<center><b>".$null_message."</b></center>";
			else
			{
				echo "<hr size=1 style='COLOR:#dddddd'>";
				
				if ($keyword!='')
					$query = "SELECT question_id,question_text,question_type,question_difficulty,question_disable,show_later
							  FROM questions
							  WHERE topic_id='$topic_id'
							  AND question_text RLIKE '.*".$keyword.".*'
							  ORDER BY question_id ASC
							  LIMIT ".$page_num*$limit_page.",".$limit_page;
				elseif ($letter=='')
					$query="SELECT question_id,question_text,question_type,question_difficulty,question_disable,show_later
							FROM questions
							WHERE topic_id='$topic_id'
							ORDER BY question_id ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				else
					$query="SELECT question_id,question_text,question_type,question_difficulty,question_disable,show_later
							FROM questions
							WHERE topic_id='$topic_id'
							 AND question_text
							RLIKE '^".$letter.".*'
							ORDER BY question_id ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				
				$result=sql_query($query);
					
				while ($fetched_question=mysql_fetch_assoc($result))
				{				
					if ($fetched_question['question_type']=='3')
					{
					$fetched_question['question_text']=preg_replace_callback("/\[_A([0-9]*)\]/U",'callback_question_text_2',$fetched_question['question_text']); 
					}
					echo $fetched_question['question_text']."<br><br>
						  <a href='index.php?module=".$module."&page=question&action=view_question&question_id=".$fetched_question['question_id']."'><img title='"._TOPIC_VIEW_QUESTION."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=question&action=view_edit_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&page_num=".($page_num+1)."&question_id=".$fetched_question['question_id']."'><img title='"._MENU_EDIT_QUESTION."' align='absmiddle' src='themes/".$current_theme."/images/edit.png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=question&action=switch&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&page_num=".($page_num+1)."&question_id=".$fetched_question['question_id']."'><img title='".$on_off['menu']['question'][$fetched_question['question_disable']]."' align='absmiddle' src='themes/".$current_theme."/images/".$on_off['action'][$fetched_question['question_disable']].".png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=question&action=view_delete_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&page_num=".($page_num+1)."&question_id=".$fetched_question['question_id']."'><img title='"._MENU_DELETE_QUESTION."' align='absmiddle' src='themes/".$current_theme."/images/delete.png'></a>&nbsp;
						  &nbsp;&nbsp;&nbsp;<b>"._TOPIC_QUEST_TYPE."</b>&nbsp;".($question_types[$fetched_question['question_type']-1])."&nbsp;&nbsp;<b>"._TOPIC_QUEST_DIFFICULTY."</b>&nbsp;".$fetched_question['question_difficulty']."&nbsp;&nbsp;<b>"._TOPIC_ANSWER_DELAY.":</b>&nbsp;".$fetched_question['show_later']."<br>
						  <hr size=1 style='COLOR:#dddddd'>";
				}				
				echo nav_bar($row_num,"index.php?module=".$module."&page=".$page."&action=".$action."&topic_id=".$topic_id."&letter=".urlencode($letter)."&page_num=");
			}
		break;
		
		case "view_export_form":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TOPIC_EXPORT_HEADER,"","",false);
			echo "<tr><td><br><b>"._TOPIC_EXPORT_TEXT."</b><br><br>
				 <form method=POST action='index.php?module=$module&page=".$page."&action=export_topic&topic_id=".$topic_id."'>
				 <input type=file name=xml_file><br><br>
				 <input type=submit value='"._EXPORT_BUTTON."'>
				 </form>";
		break;
		
		case "export_topic":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$topic."&action=view_topic&topic_id=".$topic_id."&status_code=1&status_num=topic_exported'>";		
		break;
		
		case "view_add_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			require_once("modules/".$module."/include/form_question.php");
		break;
		
		case "add_question":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			$question_text = remove_p($question_text);
		   
			if(!ini_get('magic_quotes_gpc'))				
				$question_text = addslashes($question_text);				
		
			$query = "SELECT COUNT(*)
					  FROM questions
					  WHERE topic_id=".$topic_id."
					   AND question_text='".$question_text."'";
		
		    $row = sql_single_query($query);
		
			if($row['COUNT(*)']!=0)
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&topic_id=".$topic_id."&status_code=0&status_num=question_exist'>";				
			else
			{
				$query = "INSERT INTO questions (topic_id,question_text,question_type,show_later, question_difficulty)
						  VALUES('$topic_id','$question_text','$question_type','$show_later' ,'$question_difficulty')";
				sql_query($query);
				
				$question_id = mysql_insert_id();
				
				add_referer($question_text, $question_id, 0);
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
				
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=1&status_num=question_added'>";
			}
		break;
		
		case "view_import_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TOPIC_IMPORT_HEADER,"","",false);
			echo "<tr><td><br>
				<b>"._TOPIC_IMPORT_TEXT."<br><br>
				<form method=POST action='index.php?module=$module&page=topic&action=import_question'>
				<input type=file name=xml_file><br><br>
				<input type=submit value='"._TOPIC_IMPORT_BUTTON."'>
				</form>";
		break;
		
		case "import_question":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
		break;
		
		case "move_topic":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
		break;
		
		case "switch":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			disable($topic_id,1,intval(!$topic_disabled));
			update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
			
			if($return_up==1)			
				$url = "index.php?module=".$module."&page=test&action=view_test&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$test_id."&page_num=".($page_num+1);			
			else
				$url = "index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id;
			
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$url."&status_code=1&status_num=".$on_off['status']['topic'][$topic_disabled]."'>";
		break;
		
		case "view_rename_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TOPIC_RENAME_HEADER,"","",true);	

			$topic_name = htmlspecialchars($topic_name);
			
			echo "<tr><td><br>
				<b>"._TOPIC_RENAME_TEXT."</b>:<br><br>
				<form method=POST action='index.php?module=".$module."&page=".$page."&action=rename&return_up=".$return_up."&topic_id=".$topic_id."&letter=".urlencode($letter)."&keyword=".$keyword."&page_num=".($page_num+1)."'>
				<input type=text name='new_topic_name' value=\"".$topic_name."\"><br><br>
				<input type=submit value='"._TOPIC_RENAME_BUTTON."'>
				</form>";
		break;
		
		case "rename":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			$stat_str="";
			
			if(!ini_get('magic_quotes_gpc'))
			{
				$new_topic_name = addslashes($new_topic_name);				
			}
			
			$query = "SELECT COUNT(*)
					 FROM topics
					 WHERE test_id=".$test_id."
					  AND topic_name='".$new_topic_name."'
					  AND topic_id<>".$topic_id;
			
			$row = sql_single_query($query);
			
			if ($row['COUNT(*)']!=0)
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&return_up=".$return_up."&action=view_rename_form&topic_id=".$topic_id."&status_code=0&status_num=topic_exist'>";				
			else
			{			
				$query = "UPDATE topics
						  SET topic_name='".$new_topic_name."'
						  WHERE topic_id='$topic_id'";
				sql_query($query);
				
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
				
				if($return_up==1)
					$url = "index.php?module=".$module."&page=test&action=view_test&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$test_id."&page_num=".($page_num+1);
				else
					$url = "index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id;
				
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$url."&status_code=1&status_num=topic_renamed'>";
			}
		break;
		
		case "view_delete_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TOPIC_DELETE_HEADER,"","",false);
			
			if($return_up==1)			
				$url = "index.php?module=".$module."&page=test&action=view_test&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$test_id."&page_num=".($page_num+1);
			else
				$url = "index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id;
			
			echo "<tr><td><br>
				 <b>"._TOPIC_DELETING_CONFIRM."</b><br><br>
				 <a href='index.php?module=".$module."&page=".$page."&action=delete&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$topic_id."'>"._YES."</a>&nbsp;&nbsp;
				 <a href='".$url."'>"._NO."</a>";
		break;
		
		case "delete":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			if(del_topic($topic_id))
			{
				$status_code = 1;
				$status_num = "topic_deleted";
				
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
			}
			else
			{
				$status_code = 0;
				$status_num = "topic_not_deleted";
			}
			
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test&action=view_test&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$test_id."&status_code=".$status_code."&status_num=".$status_num."'>";
		break;
		
		case "topic_print_ver":
			if(!is_allow(5,0,5,1)){
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			if(isset($_REQUEST['topic_id']))
				$topic_id = intval($_REQUEST['topic_id']);
			else
				$topic_id = 0;
			
			$topic = sql_single_query("SELECT topic_name
										FROM topics
										WHERE topic_id=".$topic_id);
			
			echo "<table border=".$config['debug_table']."><tr>
					<td colspan=2 nowrap>
						<b>"._MENU_TOPIC." :: ".$topic['topic_name']."</b></td>
					</tr>
					<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
				
			$result_questions= sql_query("SELECT * 
										 FROM questions
										 WHERE topic_id='$topic_id'");
					
			include("print_ver.php");		  
		break;
		
		
		case "copy_topic":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			
			@$dest_test_id=$_GET['test_id'];
			
			$res_source_test_category=sql_query("select * from test_categories,tests where 
											tests.test_category_id=test_categories.test_category_id and
											tests.test_id='$test_id' ");
			$f_source_test_category=mysql_fetch_array($res_source_test_category);
			$f_source_topic=mysql_fetch_array(sql_query("select * from topics where topic_id='$topic_id' "));
			
			$res_test_category=sql_query("select * from test_categories,tests where 
											tests.test_category_id=test_categories.test_category_id and
											tests.test_id='$dest_test_id' ");
			$f_test_category=mysql_fetch_array($res_test_category);
			
			
			if(!is_allow(12,$f_test_category['test_category_id'],$dest_test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_topic&topic_id=".$topic_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}

			themeleftbox(_TOPIC_COPY_HEADER,"","",true);
			
			include("copy_topic.php");
				

			$topic_name = htmlspecialchars($topic_name);
			
			
		break;
	}