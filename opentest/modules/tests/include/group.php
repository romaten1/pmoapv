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
	 if(isset($_REQUEST['next_action']))
          $next_action = $_REQUEST['next_action'];
	 else $next_action="";

     if(isset($_REQUEST['group_id']))
          $group_id = (int)$_REQUEST['group_id'];
     else $group_id="";

     if(isset($_REQUEST['group_name']))
          $group_name = $_REQUEST['group_name'];
     else $group_name="";
     
//   Переменные из формы ввода 
  if(isset($_REQUEST['user_name']))
          $user_name = $_REQUEST['user_name'];
     else $user_name="";
  if(isset($_REQUEST['user_name']))
          $user_login = $_REQUEST['user_login'];
     else $user_login="";
  if(isset($_REQUEST['user_name']))
          $user_password = $_REQUEST['user_password'];
     else $user_password=""; 
  if(isset($_REQUEST['user_password_confirm']))
          $user_password_confirm = $_REQUEST['user_password_confirm'];
     else $user_password_confirm="";  
  if(isset($_REQUEST['user_disable']))
          $user_disable = $_REQUEST['user_disable'];
     else $user_disable="";  
  if(isset($_REQUEST['user_cant_change_pass']))
          $user_cant_change_pass = $_REQUEST['user_cant_change_pass'];
     else $user_cant_change_pass="";  
   
     if(!isset($_REQUEST['page_num']))
          $page_num=0;
     else
          $page_num=(int)$_REQUEST['page_num']-1;

     if(!isset($_REQUEST['letter']))
          $letter="";
     else
		  $letter=$_REQUEST['letter'];

	 if(!isset($_REQUEST['keyword']))
		  $keyword="";
	 else
		  $keyword=$_REQUEST['keyword'];

	 if(isset($_REQUEST['return_up']))
		  $return_up = (int)$_REQUEST['return_up'];
	 else
		  $return_up= 0;
		  
	
     
    if(isset($_REQUEST['for_test_id']))
		$for_test_id = (int)$_REQUEST['for_test_id'];
    else
		$for_test_id="";
     
     
	 if ($for_test_id!="") {$tmp_obj="for_test_id";$tmp_obj_id=(int)$for_test_id;}

	 // Проверка полученных переменных
	 $return_up = intval($return_up);

     switch($action)
     {
          // ============= Блок реализующий вывод списка пользователей  =============
          case "view_group":
               // Вывод списка пользователей в указаной группе

               switch ($next_action)
                {
 					case "edit_permissions_u":
						$query="SELECT test_name FROM tests WHERE test_id=".$for_test_id;
						$res=sql_single_query($query);
                         themeleftbox(GROUP_CATEGORY_USER_SELECT_HEADER,"","",true);
                         echo "
                              <tr><td>  <br>
                              <b>".GROUP_USER_SELECT."</b>: <u><i>".$res['test_name']."</i></u><br><br>
                              ";
                    break;
               }
						
			   $row_num=get_count($group_id, 3, 0, $keyword, $letter);

               // Вывод алфавита
               show_abc('index.php?module=tests&page=group&action='.$action.'&next_action='.$next_action.'&group_id='.$group_id.'&letter=');

			   if ($row_num==0)
                    echo "<b>"._GROUP_NO_USERS."</b>";
			   else
			   {
					// выводим список пользователей в данной группе...
					if ($keyword!='')
					$query = "SELECT user_id,user_name,user_disable
							  FROM users
							  WHERE group_id='$group_id'
							  AND user_name
							  RLIKE '.*".$keyword.".*'
							  ORDER BY user_name ASC
							  LIMIT ".$page_num*$limit_page.",".$limit_page
							  ;
					else
					if ($letter=='')
						$query="SELECT user_id,user_name,user_disable
							   FROM users
							   WHERE group_id='$group_id'
							   ORDER BY user_name ASC
							   LIMIT ".$page_num*$limit_page.",".$limit_page;
                    else
						$query="SELECT user_id,user_name,user_disable
	                           FROM users
	                           WHERE group_id='$group_id'
	                           AND user_name
							   RLIKE '^".$letter.".*'
	                           ORDER BY user_name ASC
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
						//-------------------------
						echo "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						<tr><td nowrap>";
						//-------------------------
						if($row['user_disable']==1)
						{
						
						}
						if ($next_action=="edit_permissions_u")
						{
							 echo "<a href='index.php?module=".$module."&page=rights&action=edit_permissions_u&".$tmp_obj."=".$tmp_obj_id."&user_id=".$row['user_id']."'><img  align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>";
						}
						echo "</td><td>&nbsp; ".$row['user_name']."</td></tr></table>";
						//-------------------------
					}
	                echo "<tr><td colspan=".$limit_col."><br>";
					echo nav_bar($row_num,"index.php?module=groups&page=group&action=".$action."&group_id=".$group_id."&letter=".urlencode($letter)."&page_num=");
			   }
          break;
     }