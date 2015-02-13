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
	
	// получаем, определяем и проверяем входяшие данные
	if(!isset($_REQUEST['next_action']))
		$next_action="";
	else
		$next_action=$_REQUEST['next_action'];
	
	if(!isset($_REQUEST['test_name']))
		$test_name="";
	else
		$test_name=$_REQUEST['test_name'];
	
	if(!isset($_REQUEST['letter']))
		$letter="";
	else
		$letter=$_REQUEST['letter'];
	
	if(!isset($_REQUEST['keyword']))
		$keyword="";
	else
		$keyword=$_REQUEST['keyword'];
	
	$from_dest="";
		
	switch($action)
	{
		// ============= Блок реализующий "Создать новый тест"  =============
		case "view_create_form":
            // проверка прав на создание
            if(!is_allow(11,0,$test_category_id,0,0,0,1))
            {
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&next_action=".$action."&status_code=0&status_num=op_not_permitted'>";
                exit;
            }
			// Форма создания нового теста
			themeleftbox(_CATEGORY_CREATE_HEADER,"","",true);
			echo "<tr><td>  <br>
				 <b>"._CATEGORY_CREATE_NAME."</b>:<br><br>
				 <form method=POST action='index.php?module=".$module."&page=".$page."&action=create_test&test_category_id=".$test_category_id."'>
				 <input type=text name=test_name><br><br>
				 <input type=submit value='"._CATEGORY_CREATE_BUTTON."'>
				 </form>";
		break;
		
		case "create_test":
            // проверка прав на запись
             if(!is_allow(11,0,$test_category_id,0,0,0,1))
            {
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&next_action=".$action."&status_code=0&status_num=op_not_permitted'>";
                exit;
            }
			//экранирование спецсимволов в имени теста
			if(!ini_get('magic_quotes_gpc'))
			{
				$test_name = addslashes($test_name);				
			}
		
			// проверка имени теста на уникальность в пределах категории
			$query = "SELECT COUNT(*)
					  FROM tests
					  WHERE test_category_id=".$test_category_id."
					   AND test_name='".$test_name."'";
			
			$row = sql_single_query($query);
			
			if ($row['COUNT(*)']!=0)
			{
				//редирект на форму создания теста
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_create_form&test_category_id=".$test_category_id."&status_code=0&status_num=test_exist'>";
			}
			else
			{
				// Скрипт создания нового теста
				$query = "INSERT INTO tests (test_category_id,test_name)
						 VALUES('$test_category_id','$test_name')
						 ";
				sql_query($query);
				// получаем id созданного теста
				$test_id = mysql_insert_id();
				
			   $query = "INSERT INTO permissions (object_code, object_id,group_category_id,group_id,user_id,
				permission_read,permission_write,permission_owner)
				VALUES('12','$test_id','0',
				'0',
				'".$GLOBALS['auth_result']['user']['user_id']."','1','1','1')";
                     sql_query($query);
                     
				update_info($test_id,$GLOBALS['auth_result']['user']['user_id']);
				
				//редирект на вывод списка тем в созданном тесте
				// занести в статус сообщение о том, что тест с заданным именем был успешно создан
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test&action=view_test&test_id=".$test_id."&status_code=1&status_num=test_created'>";
			}
		break;
		
		// ============= Блок реализующий "Импортировать тест из XML"  =============
		case "view_import_form":
        	// проверка прав на запись
            if(!is_allow(11,0,$test_category_id,0,0,0,1))
            {
                echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&next_action=".$action."&status_code=0&status_num=op_not_permitted'>";
                exit;
            }
			themeleftbox(_CATEGORY_IMPORT_HEADER,"","",false);
			// Форма импорта нового теста
			require_once("./modules/$module/include/import_test.php");
		break;	
		
		case "copy_topic_select_test":
			$action='view_category';
			$from_dest="index.php?module=tests&page=topic&action=copy_topic&topic_id=".$_GET['topic_id'];
		
		// ============= Блок реализующий "Открыть существующий тест"  =============
		case "view_category":
                        
			themeleftbox(_CATEGORY_VIEW_HEADER,"","",true);
			echo "<tr><td> <br>";
			
			if ($keyword!='')
				$null_message = _CATEGORY_NO_T_KEYWORD;
			elseif ($letter=='')
				$null_message = _CATEGORY_NO_TEST;
			else
				$null_message = _CATEGORY_NO_T_LETTER;
			
			$row_num=get_count($test_category_id,5,false,$keyword,$letter);
			
			// Вывод алфавита
			if(!($letter==''&&$row_num==0&&$keyword==''))
				show_abc('index.php?module='.$module.'&page='.$page.'&action='.$action.'&test_category_id='.$test_category_id.'&letter=');
			
			if ($row_num==0)
				echo "<center><b>".$null_message."</b><center>";
			else
			{
				CloseTable();
				
				// выводим список тестов в данной категории...
				if ($keyword!='')
					$query="SELECT DISTINCT t.test_id,t.test_name,t.test_disable
							FROM tests t, permissions p
							WHERE t.test_category_id='$test_category_id'
							 AND test_name RLIKE '.*".$keyword.".*'
							 AND ((p.object_code=11 AND p.object_id='".$test_category_id."') OR (p.object_code=12 AND p.object_id=t.test_id ))
							 AND (p.user_id=".$GLOBALS['auth_result']['user']['user_id']."
							 		OR p.group_id=".$GLOBALS['auth_result']['user']['group_id']."
							 		OR p.group_category_id=".$GLOBALS['auth_result']['group']['group_category_id'].")
							 AND (p.permission_read=1 OR p.permission_write=1 OR p.permission_owner=1)
							ORDER BY t.test_name ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				elseif ($letter=='')
					$query="SELECT  DISTINCT t.test_id,t.test_name,t.test_disable
							FROM tests t, permissions p
							WHERE t.test_category_id='$test_category_id'
							 AND ((p.object_code=11 AND p.object_id='".$test_category_id."') OR (p.object_code=12 AND p.object_id=t.test_id ))
							 AND (p.user_id=".$GLOBALS['auth_result']['user']['user_id']."
							 		OR p.group_id=".$GLOBALS['auth_result']['user']['group_id']."
							 		OR p.group_category_id=".$GLOBALS['auth_result']['group']['group_category_id'].")
							 AND (p.permission_read=1 OR p.permission_write=1 OR p.permission_owner=1)
							ORDER BY t.test_name ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				else
					$query="SELECT DISTINCT  t.test_id,t.test_name,t.test_disable
							FROM tests t, permissions p
							WHERE t.test_category_id='$test_category_id'
							 AND t.test_name  RLIKE '^".$letter.".*'
							 AND ((p.object_code=11 AND p.object_id='".$test_category_id."') OR (p.object_code=12 AND p.object_id=t.test_id ))
							 AND (p.user_id=".$GLOBALS['auth_result']['user']['user_id']."
							 		OR p.group_id=".$GLOBALS['auth_result']['user']['group_id']."
							 		OR p.group_category_id=".$GLOBALS['auth_result']['group']['group_category_id'].")
							 AND (p.permission_read=1 OR p.permission_write=1 OR p.permission_owner=1)
							ORDER BY t.test_name ASC
							LIMIT ".$page_num*$limit_page.",".$limit_page;
				$result=sql_query($query);
				
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
						  <tr><td nowrap>";
					if ($from_dest!="")
							echo "<a href='$from_dest&test_id=".$row['test_id']."'><img title='"._CATEGORY_VIEW_TOPIC."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>&nbsp;";
					else
							echo "<a href='index.php?module=".$module."&page=test&action=view_test&test_id=".$row['test_id']."'><img title='"._CATEGORY_VIEW_TOPIC."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>&nbsp;";
								
					echo "
							<a href='index.php?module=".$module."&page=test&action=view_rename_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$row['test_id']."&page_num=".($page_num+1)."'><img title='"._MENU_RENAME_TEST."' align='absmiddle' src='themes/".$current_theme."/images/rename.png'></a>&nbsp;
							<a href='index.php?module=".$module."&page=test&action=switch&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$row['test_id']."&page_num=".($page_num+1)."'><img title='".$on_off['menu']['test'][$row['test_disable']]."' align='absmiddle' src='themes/".$current_theme."/images/".$on_off['action'][$row['test_disable']].".png'></a>&nbsp;
							<a href='index.php?module=".$module."&page=test&action=view_delete_form&return_up=1&letter=".urlencode($letter)."&keyword=".$keyword."&test_id=".$row['test_id']."&page_num=".($page_num+1)."'><img title='"._MENU_DELETE_TEST."' align='absmiddle' src='themes/".$current_theme."/images/delete.png'></a>&nbsp;
						  </td>
						  <td>
							".$row['test_name']."
						  </td></tr></table><br>";
				}
				echo "<tr><td colspan=".$limit_col."><br>";
				echo nav_bar($row_num,"index.php?module=".$module."&page=".$page."&action=".$action."&test_category_id=".$test_category_id."&letter=".urlencode($letter)."&page_num=");
			}
		break;
		
		// ============= Блок реализующий "Перемесить тест в другую категорию"  =============
		case "move_copy_test":
			//скрипт переноса/копирования теста в выбранную категорию
			//редирект на вывод списка тем в перенесенном тесте
			//пример: include_once("modules/$module/include/test.php?action=view_test&test_id=1");
		break;
		
		case "move_copy_topic":
			// редирект на вывод списка тестов в выбранной категории
			// пример: include_once("modules/$module/include/category.php?action=view_category&next_action=$action&category_id=1");
		break;
		
		// ============= Блок общий для всех задач файла category.php  =============
		case "select_category":
		default :
			$pass_vars="";
			// в зависимости от $next_action выводим разный заголовок и $page= странице, где лежит соответсвующий скрипт переноса
			// выводим список категорий
			switch ($next_action)
			{
				case "view_create_form":
					themeleftbox(_CATEGORY_CREATE_HEADER,"","",true);
					echo "<tr><td><br>
						  <center><b>"._CATEGORY_CREATE_TEXT."</b></center><br><br>";
				break;
			
				case "view_import_form":
					themeleftbox(_CATEGORY_IMPORT_HEADER,"","",true);
					echo "<tr><td><br>
						  <center><b>"._CATEGORY_IMPORT_CHOOSE_CATEGORY."</b></center><br><br>";
				break;
			
				case "view_category":
					themeleftbox(_CATEGORY_CHOOSE_HEADER,"","",true);
					echo "<tr><td><br>
						  <center><b>"._CATEGORY_CHOOSE_CATEGORY."</b></center><br><br>";
				break;
				case "copy_topic_select_test":
					themeleftbox(_CATEGORY_CHOOSE_HEADER,"","",true);
					$pass_vars="&topic_id=".$_GET['topic_id'];
					echo "<tr><td><br>
						  <center><b>"._CATEGORY_CHOOSE_CATEGORY."</b></center><br><br>";
				break;
				default:
					themeleftbox(_CATEGORY_CHOOSE_HEADER_DEF,"","",true);			
					echo "<tr><td><br>
						  <center><b>"._CATEGORY_CHOOSE_CATEGORY_DEF."</b></center><br><br>";
					$next_action="view_category";
				break;
			}
			
			if ($keyword!='')
				$null_message = _CATEGORY_NO_C_KEYWORD;
			elseif ($letter=='')
				$null_message = _CATEGORY_NO_CATEGORY;
			else
				$null_message = _CATEGORY_NO_C_LETTER;
			
			$row_num=get_count(0,4,false,$keyword,$letter);
			
			// Вывод алфавита
			if(!($letter==''&&$row_num==0&&$keyword==''))
				show_abc('index.php?module='.$module.'&page='.$page.'&next_action='.$next_action.'&letter=');
			
			if ($row_num==0) 
				echo "<center><b>".$null_message."</b></center>";
			else
			{  
				if($keyword!='')
					$query = "SELECT *
							  FROM test_categories
							  WHERE test_category_name RLIKE '.*".$keyword.".*'
							  ORDER BY test_category_name ASC
							  LIMIT ".$page_num*$limit_page.",".$limit_page;
			
				elseif ($letter=='')
					$query = "SELECT *
							  FROM test_categories
							  ORDER BY test_category_name ASC
							  LIMIT ".$page_num*$limit_page.",".$limit_page;
				else
					$query = "SELECT *
							  FROM test_categories
							  WHERE test_category_name RLIKE '^".$letter.".*'
							  ORDER BY test_category_name ASC
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
						<a href='index.php?module=".$module."&page=".$page."&action=".$next_action."&test_category_id=".$row['test_category_id']."$pass_vars'><img title='"._CATEGORY_VIEW_TEST."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>
						</td><td>
						&nbsp; ".$row['test_category_name']."
						</td></tr></table>
						<br>";
				}
			   echo "<tr><td colspan=".$limit_col."><br>";
			   echo nav_bar($row_num,"index.php?module=".$module."&page=".$page."&next_action=".$next_action."&letter=".urlencode($letter)."&page_num=")."</center>";			
			}
		break;
	}