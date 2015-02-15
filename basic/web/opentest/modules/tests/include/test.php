<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");	
	
	if(isset($_REQUEST['topic_name']))
		$topic_name = $_REQUEST['topic_name'];
	else $topic_name = "";
	
	if(isset($_REQUEST['new_test_name']))
		$new_test_name = $_REQUEST['new_test_name'];
	else $new_test_name = "";
	
	if(!isset($_REQUEST['letter']))
		$letter="";
	else
		$letter=$_REQUEST['letter'];
	
	if(!isset($_REQUEST['keyword']))
		$keyword="";
	else
		$keyword=$_REQUEST['keyword'];
	
	if(!isset($_REQUEST['return_up']))
		$return_up="";
	else
		$return_up = intval($_REQUEST['return_up']);
	
	switch($action)
	{
		case "view_test":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
			       	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			add_recent(0,$test_category_id,$test_id,$GLOBALS['auth_result']['user']['user_id']);
			themeleftbox(_TEST_VIEW_HEADER,"","",true);
			echo "<tr><td>  <br>";
			if ($keyword!='')
				$null_message = _TEST_NO_KEYWORD;			
			elseif ($letter=='')
				$null_message = _TEST_NO_TOPIC;
			else
				$null_message = _TEST_NO_LETTER;
			
			$row_num=get_count($test_id,9,false,$keyword,$letter);
			
			if(!($letter==''&&$row_num==0&&$keyword==''))
				show_abc('index.php?module='.$module.'&page='.$page.'&action='.$action.'&test_id='.$test_id.'&letter=');
			
			if ($row_num==0)
				echo "<center><b>".$null_message."</b></center>";
			else
			{
				if ($keyword!='')
					$query = "SELECT topic_id,topic_name,topic_disable
							  FROM topics
							  WHERE test_id='".$test_id."'
							  AND topic_name RLIKE '.*".$keyword.".*'
							  ORDER BY topic_name ASC
							  LIMIT ".$page_num*$limit_page.",".$limit_page;
				elseif ($letter=='')
					$query="SELECT topic_id,topic_name,topic_disable
							FROM topics
							WHERE test_id='".$test_id."'
							ORDER BY topic_name ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				else
				
					$query="SELECT topic_id,topic_name,topic_disable
							FROM topics
							WHERE test_id='".$test_id."'
							AND topic_name RLIKE '^".$letter.".*'
							ORDER BY topic_name ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
			
				$result=sql_query($query);
			
				CloseTable();
				$n=0;
			
				$col_width=100/$limit_col;
			
				echo '<table border="0"style="width:100%"><tr><td width='.$col_width.'%>';
			
				while ($row=mysql_fetch_assoc($result))
				{
					if ($n==$limit_row)
					{
						echo"<td width=".$col_width."%>";
						$n=0;					
					}
					$n++;				
					
					echo "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						  <tr><td nowrap> 
						  <a href='index.php?module=".$module."&page=topic&action=view_topic&topic_id=".$row['topic_id']."'><img title='"._TEST_VIEW_TOPIC."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=topic&action=view_rename_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$row['topic_id']."&page_num=".($page_num+1)."'><img title='"._MENU_RENAME_TOPIC."' align='absmiddle' src='themes/".$current_theme."/images/rename.png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=topic&action=switch&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$row['topic_id']."&page_num=".($page_num+1)."'><img title='".$on_off['menu']['topic'][$row['topic_disable']]."' align='absmiddle' src='themes/".$current_theme."/images/".$on_off['action'][$row['topic_disable']].".png'></a>&nbsp;
						  <a href='index.php?module=".$module."&page=topic&action=view_delete_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$row['topic_id']."&page_num=".($page_num+1)."'><img title='"._MENU_DELETE_TOPIC."' align='absmiddle' src='themes/".$current_theme."/images/delete.png'></a>&nbsp;
						  </td><td>
						  ".$row['topic_name']."
						  </td></tr></table><br>";
				}
				echo "<tr><td colspan=".$limit_col."><br>";
				echo nav_bar($row_num,"index.php?module=".$module."&page=".$page."&action=".$action."&test_id=".$test_id."&letter=".urlencode($letter)."&page_num=");
			}			
		break;
		
		case "view_export_form":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_CATEGORY_EXPORT_HEADER,"","",false);
			include('export_test.php');
		break;		
		
		case "add_topic_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TEST_CREATE_HEADER,"","",true);
			echo "<tr><td><br>
				  <b>"._TEST_CREATE_TOPIC_NAME."</b>:<br><br>
				  <form method=POST action='index.php?module=$module&page=".$page."&action=add_topic&test_id=".$test_id."'>
				   <input type=text name=topic_name><br><br>
				   <input type=submit value='"._TEST_CREATE_BUTTON."'>
				  </form>";
		break;
		
		case "add_topic":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			if(!ini_get('magic_quotes_gpc'))
			{
				$topic_name = addslashes($topic_name);				
			}
			
			$query = "SELECT COUNT(*)
					  FROM topics
					  WHERE test_id=".$test_id."
					   AND topic_name='".$topic_name."'";
			
			$row = sql_single_query($query);
			if ($row['COUNT(*)']!=0)
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=add_topic_form&test_id=".$test_id."&status_code=0&status_num=topic_exist'>";
			else
			{
				$query = "INSERT INTO topics (test_id,topic_name)
						  VALUES('$test_id','$topic_name')";
				
				sql_query($query);
				$topic_id = mysql_insert_id();
				
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=topic&action=view_topic&topic_id=".$topic_id."&status_code=1&status_num=topic_added'>";
			}
		break;
		
		case "view_import_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TEST_IMPORT_HEADER,"","",false);
			echo "<tr><td><br>
				<b>"._TEST_IMPORT_TEXT."<br><br>
				<form method=POST action='index.php?module=$module&page=".$page."&action=import_topic'>
				 <input type=file name=xml_file><br><br>
				 <input type=submit value='"._TEST_IMPORT_BUTTON."'>
				</form>";
		break;
		
		case "import_topic":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
		break;
		
		case "view_rename_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TEST_RENAME_HEADER,"","",true);

			$test_name = htmlspecialchars($test_name);
			
			echo "<tr><td><br>
				<b>"._TEST_RENAME_TEXT."</b>:<br><br>
				<form method=POST action='index.php?module=".$module."&page=".$page."&action=rename&return_up=".$return_up."&test_id=".$test_id."&letter=".urlencode($letter)."&keyword=".$keyword."&page_num=".($page_num+1)."'>
				<input type=text name=new_test_name value=\"".$test_name."\"><br><br>
				<input type=submit value='"._TEST_RENAME_BUTTON."'>
				</form>";
		break;
		
		case "rename":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			if(!ini_get('magic_quotes_gpc'))
			{
				$new_test_name = addslashes($new_test_name);				
			}
			
		$query = "SELECT COUNT(*)
					 FROM tests
					 WHERE test_category_id='".$test_category_id."'
					  AND test_name='".$new_test_name."'
					  AND test_id<>'".$test_id."'";
			
			$row = sql_single_query($query);
			if ($row['COUNT(*)']!=0)
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_rename_form&return_up=".$return_up."&test_id=".$test_id."&status_code=0&status_num=test_exist'>";
			else
			{
				$query = "UPDATE tests
						  SET test_name='".$new_test_name."'
						  WHERE test_id='$test_id'";
				
				sql_query($query);
				
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
				
				if($return_up==1)
					$url = "index.php?module=".$module."&page=category&action=view_category&letter=".urlencode($letter)."&keyword=".$keyword."&test_category_id=".$test_category_id."&page_num=".($page_num+1);
				else
					$url = "index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id;
				
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$url."&status_code=1&status_num=test_renamed'>";
			}
		break;
		
		case "switch":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			disable($test_id,0,intval(!$test_disabled));
			
			update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
			
			if($return_up==1)
				$url = "index.php?module=".$module."&page=category&action=view_category&letter=".urlencode($letter)."&keyword=".$keyword."&test_category_id=".$test_category_id."&page_num=".($page_num+1);
			else
				$url = "index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id;
			
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".$url."&status_code=1&status_num=".$on_off['status']['test'][$test_disabled]."'>";			
		break;
		
		case "view_delete_form":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_TEST_DELETE_HEADER,"","",false);
			
			if($return_up==1)
			{
			   $url = "index.php?module=".$module."&page=category&action=view_category&letter=".urlencode($letter)."&keyword=".$keyword."&test_category_id=".$test_category_id."&page_num=".($page_num+1);
			}
			else
			   $url = "index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id;
			
			echo "<tr><td>  <br>
				 <b>"._TEST_DELETING_CONFIRM."</b><br><br>
				 <a href='index.php?module=".$module."&page=".$page."&action=delete&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$test_id."'>"._YES."</a>&nbsp;&nbsp;
				 <a href='".$url."'>"._NO."</a>";
		break;
		
		case "delete":
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
		   if(del_test($test_id))
		   {
				$status_code = 1;
				$status_num = "test_deleted";
		   }
		   else
		   {
				$status_code = 0;
				$status_num = "test_not_deleted";
		   }
		
		   echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&letter=".urlencode($letter)."&keyword=".$keyword."&test_category_id=".$test_category_id."&status_code=".$status_code."&status_num=".$status_num."'>";
		break;		
		
		case "test_preview":
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
		break;
		
		case "test_print_ver":
        	//проверка прав на модуль Администрирование
		    /*
			if(!is_allow(5,0,5,1))
			{
		    	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?status_code=0&status_num=op_not_permitted'>";
		       	exit;
		    };
			*/
				if(!is_allow(12,$test_category_id,$test_id,1))
				{
					echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
					exit;
				}
				if( $test_category_id != 13 and !is_allow(5,0,5,1) )
				{
					echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
					exit;
				}

			$test_res = sql_single_query("SELECT test_name
										  FROM tests
										  WHERE test_id='".$test_id."'");
			echo "<table border=".$config['debug_table']."><tr>
					<td colspan=2 nowrap><b>"._MENU_TEST." ::: ".$test_res['test_name']."</b></td>
				</tr>
				<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
			
			$topic_res = sql_query("SELECT topic_name, topic_id
									FROM topics
									WHERE test_id='".$test_id."'");			
		
			while ($fetched_topics=mysql_fetch_assoc($topic_res))
			{					
				echo "<table border=".$config['debug_table']."><tr>
					<td colspan=2 nowrap>
						<b>"._MENU_TOPIC." :: ".$fetched_topics['topic_name']."</b></td>
					</tr>
					<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
				
				$result_questions= sql_query("SELECT * 
											  FROM questions
											  WHERE topic_id='".$fetched_topics['topic_id']."'");
					
				include("print_ver.php");
				echo "</td></tr></table>";
			}
			echo "</td></tr></table>";
		break;
	}
?>