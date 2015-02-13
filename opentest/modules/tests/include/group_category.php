<?php
 if (INDEXPHP!=1)
		 die ("You can't access this file directly...");

	 // получаем, определяем и проверяем входяшие данные
     if(!isset($_REQUEST['next_action']))
          $next_action="";
     else
          $next_action=$_REQUEST['next_action'];


     if(!isset($_REQUEST['group_category_id']))
          $group_category_id="";
     else
          $group_category_id=$_REQUEST['group_category_id'];


     if(!isset($_REQUEST['group_id']))
          $group_id="";
     else
          $group_id=$_REQUEST['group_id'];



     if(!isset($_REQUEST['page_num']))
          $page_num=0;
     else
          $page_num=$_REQUEST['page_num']-1;

     if(!isset($_REQUEST['letter']))
          $letter="";
     else
          $letter=$_REQUEST['letter'];

	 if(!isset($_REQUEST['keyword']))
		  $keyword="";
	 else
		  $keyword=$_REQUEST['keyword'];

     if(isset($_REQUEST['for_test_id']))
     $for_test_id = $_REQUEST['for_test_id'];
     else $for_test_id="";

     
		if ($for_test_id!="") {$tmp_obj="for_test_id";$tmp_obj_id=$for_test_id;}
					
 

     switch($action)
     {
          // ============= Блок реализующий "Открыть существующую категорию"  =============
		  case "view_category":
				switch ($next_action)
                {
 					 case "edit_permissions_g":
					 
						 $query="SELECT test_name FROM tests WHERE test_id=".$for_test_id;
						 $res=sql_single_query($query);
                         themeleftbox(GROUP_CATEGORY_GR_SELECT_HEADER,"","",true);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_CATEGORY_CAT_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
					
					case "edit_permissions_u":
					$query="SELECT test_name FROM tests WHERE test_id=".$for_test_id;
						 $res=sql_single_query($query);
                         themeleftbox(GROUP_CATEGORY_GR_SELECT_HEADER,"","",true);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_CATEGORY_GROUP_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
                
               }
               if ($keyword!='')
				   $query = "SELECT COUNT(*)
                              FROM groups
							  WHERE group_category_id=".$group_category_id."
                              AND group_name
							  RLIKE '.*".$keyword.".*'
                              ";
               else
                   if ($letter=='')
    					$query = "SELECT COUNT(*)
    	                          FROM groups
    							  WHERE group_category_id=".$group_category_id;
    			   else
    					$query = "SELECT COUNT(*)
    	                          FROM groups
    							  WHERE group_category_id=".$group_category_id."
    	                          AND group_name
								  RLIKE '^".$letter.".*'
    	                          ";
			   $row = sql_single_query($query);
			   $row_num=$row['COUNT(*)'];

               // Вывод алфавита
               show_abc('index.php?module=tests&page=group_category&action='.$action.'&next_action='.$next_action.'&group_category_id='.$group_category_id.'&letter=');

               if ($row_num==0)
					echo "<b>"._GROUPS_CATEGORY_NO_GROUP."</b>";
               else
               {
                    CloseTable();
			       // выводим список групп в данной категории...
                    if ($keyword!='')
						$query="SELECT group_id,group_name,group_disable
                                   FROM groups
								   WHERE group_category_id='$group_category_id'
                                   AND group_name
								   RLIKE '.*".$keyword.".*'
                                   ORDER BY group_name ASC
                                   LIMIT ".$page_num*$limit_page.",".$limit_page;
                    else
                        if ($letter=='')
							$query="SELECT group_id,group_name,group_disable
    	                           FROM groups
    	                           WHERE group_category_id='$group_category_id'
                                   ORDER BY group_name ASC
    							   LIMIT ".$page_num*$limit_page.",".$limit_page;
                        else
							$query="SELECT group_id,group_name,group_disable
    	                           FROM groups
    	                           WHERE group_category_id='$group_category_id'
    	                           AND group_name
    	                           RLIKE '^".$letter.".*'
    	                           ORDER BY group_name ASC
    							   LIMIT ".$page_num*$limit_page.",".$limit_page;
					$result=sql_query($query);

                    $n=0;

                    $col_width=100/$limit_col;
                    //OpenTable2();
					echo '<table border="0"style="width:100%"><tr><td width='.$col_width.'%>';
	               	while ($row=mysql_fetch_assoc($result))
	               	{
                        if ($n==$limit_row)
	                        {
	                             echo"<td width=".$col_width."%>";
                                 $n=0;

							}
						$n++;
                        if($row['group_disable']==1)
                        {
                             $on_off_str = _MENU_ON_TEST;
                             $on_off = "on";
                             $img = "on.png";
                        }
                        else
                        {
                             $on_off_str = _MENU_OFF_TEST;
                             $on_off = "off";
                             $img = "off.png";
                        }
						//-------------------------
						echo "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						<tr><td nowrap>";
						//-------------------------
						if ($next_action=="edit_permissions_g")
						{
							 echo "<a href='index.php?module=".$module."&page=rights&action=edit_permissions_g&".$tmp_obj."=".$tmp_obj_id."&group_id=".$row['group_id']."'><img  align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>";
						}
						elseif ($next_action=="edit_permissions_u")
						{
							 echo "<a href='index.php?module=".$module."&page=group&action=view_group&next_action=".$next_action."&".$tmp_obj."=".$tmp_obj_id."&group_id=".$row['group_id']."'><img  align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>";
						}
						//-------------------------
						echo "</td><td>&nbsp; ".$row['group_name']."</td></tr></table>";
						//-------------------------
	               	}
                    echo "<tr><td colspan=".$limit_col."><br>";
					echo nav_bar($row_num,"index.php?module=tests&page=group_category&action=".$action."&group_category_id=".$group_category_id."&letter=".urlencode($letter)."&page_num=");

               }
          break;



          // ============= Блок общий для всех задач файла group_category.php  =============
          case "select_group_category":
          default :
               // в зависимости от $next_action выводим разный заголовок и $page= странице, где лежит соответсвующий скрипт переноса
               // выводим список категорий           
                              
               switch ($next_action)
               {
                    case "edit_permissions":
                         themeleftbox(GROUP_CATEGORY_CAT_SELECT_HEADER,"","",true);
						 $query="SELECT test_name FROM tests WHERE test_id='".$for_test_id."'";
						 $res=sql_single_query($query);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_CATEGORY_CAT_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
					
					 case "edit_permissions_g":
					 
						 $query="SELECT test_name FROM tests WHERE test_id='".$for_test_id."'";
						 $res=sql_single_query($query);
                         themeleftbox(GROUP_CATEGORY_CAT_SELECT_HEADER,"","",true);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_CATEGORY_GROUP_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
					
					case "edit_permissions_u":
					$query="SELECT test_name FROM tests WHERE test_id='".$for_test_id."'";
						 $res=sql_single_query($query);
                         themeleftbox(GROUP_CATEGORY_CAT_SELECT_HEADER,"","",true);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_CATEGORY_USER_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
                }
               if ($keyword!='')
				   $query = "SELECT COUNT(*)
                              FROM group_categories
                              WHERE group_category_name
							  RLIKE '.*".$keyword.".*'
                              ";
               else
    			   if ($letter=='')
    					$query = "SELECT COUNT(*) FROM group_categories";
                   else
    					$query = "SELECT COUNT(*)
    							  FROM group_categories
    							  WHERE group_category_name
    							  RLIKE '^".$letter.".*'
    							 ";
			   $row = sql_single_query($query);
			   $row_num=$row['COUNT(*)'];

			   // Вывод алфавита
			   show_abc('index.php?module=tests&page=group_category&action='.$action.'&next_action='.$next_action.'&letter=');

               if ($row_num==0) echo _GROUPS_CATEGORY_NO_CATEGORY;
					else
					{  if($keyword!='')
                            $query = "SELECT *
                                     FROM group_categories
                                     WHERE group_category_name
                                     RLIKE '.*".$keyword.".*'
                                     ORDER BY group_category_name ASC
                                     LIMIT ".$page_num*$limit_page.",".$limit_page;

                       else
                           if ($letter=='')
    							$query = "SELECT *
                                     	 FROM group_categories
    	                                 ORDER BY group_category_name ASC
    									 LIMIT ".$page_num*$limit_page.",".$limit_page;
                                else
        							$query = "SELECT *
        	                                 FROM group_categories
        	                                 WHERE group_category_name
        									 RLIKE '^".$letter.".*'
        	                                 ORDER BY group_category_name ASC
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
				switch ($next_action)
                {
               
                    case "edit_permissions":
                         echo "<a href='index.php?module=tests&page=rights&action=".$next_action."&group_category_id=".$row['group_category_id']."&".$tmp_obj."=".$tmp_obj_id."'><img title='"._GROUPS_CATEGORY_VIEW."' align='middle' src='themes/".$current_theme."/images/view.png'></a>&nbsp; ".$row['group_category_name']."<br>";
                    break;
					case "edit_permissions_g":
					case "edit_permissions_u":
                         echo "<a href='index.php?module=tests&page=group_category&action=view_category&next_action=".$next_action."&group_category_id=".$row['group_category_id']."&".$tmp_obj."=".$tmp_obj_id."'><img title='"._GROUPS_CATEGORY_VIEW."' align='middle' src='themes/".$current_theme."/images/view.png'></a>&nbsp; ".$row['group_category_name']."<br>";
                    break;
               }
								
	                    }
					   echo "<tr><td colspan=".$limit_col."><br>";
					   echo nav_bar($row_num,"index.php?module=tests&page=group_category&next_action=".$next_action."&letter=".urlencode($letter)."&page_num=")."</center>";

                    }
		  break;
     }