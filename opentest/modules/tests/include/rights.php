<?php
	
if (INDEXPHP!=1) die ("You can't access this file directly...");

if(isset($_REQUEST['next_action'])) $next_action = $_REQUEST['next_action'];
else $next_action="";

if(isset($_REQUEST['group_category_id'])) $group_category_id = (int)$_REQUEST['group_category_id'];
else $group_category_id="";
     
if(isset($_REQUEST['group_id'])) $group_id = (int)$_REQUEST['group_id'];
else $group_id="";
     
if(isset($_REQUEST['user_id'])) $user_id = (int)$_REQUEST['user_id'];
else $user_id="";

if(isset($_REQUEST['for_test_id'])) $for_test_id = (int)$_REQUEST['for_test_id'];
else $for_test_id="";



	if ($for_test_id!="") {$tmp_obj="for_test_id";$tmp_obj_id=$for_test_id;}

    if(isset($_REQUEST['perm_read']))
          $perm_read = $_REQUEST['perm_read'];
     else $perm_read="";
      if(isset($_REQUEST['perm_write']))
          $perm_write = $_REQUEST['perm_write'];
     else $perm_write="";
      if(isset($_REQUEST['perm_owner']))
          $perm_owner = $_REQUEST['perm_owner'];
     else $perm_owner="";
         
     if(isset($_REQUEST['hid']))
     $hid = $_REQUEST['hid'];
     else $hid="";


	 if(!isset($_REQUEST['letter']))
		  $letter="";
	 else
		  $letter=$_REQUEST['letter'];

	 if(!isset($_REQUEST['keyword']))
		  $keyword="";
	 else
		  $keyword=$_REQUEST['keyword'];

	 if(isset($_REQUEST['return_up']))
		  $return_up = $_REQUEST['return_up'];
	 else $return_up= 0;
	 
	 if ($group_category_id!="") {$tmp_to_obj="group_category_id";$tmp_to_obj_id=$group_category_id;}
				else if ($group_id!="") {$tmp_to_obj="group_id";$tmp_to_obj_id=$group_id;}
					else if ($user_id!="") {$tmp_to_obj="user_id";$tmp_to_obj_id=$user_id;} 

if(!is_allow(12,0,$for_test_id,0,0,1)){
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=".htmlspecialchars($_SERVER['HTTP_REFERER'])."&status_code=0&status_num=op_not_permitted'>";
	exit;
}
switch($action) {
	case "do_category_permissions":
		if ($tmp_obj=="for_test_id") $tmp_obj_code=12;
              
              
               if (($hid=="true") && ($perm_read=="") && ($perm_write=="") && ($perm_owner=="")) 
					echo "new record, empty - NOT recorded";
               	elseif ($hid=="true") 
               		{
               			//echo "new record - not empty-recorded";
               			 $query = "INSERT INTO permissions (object_code, object_id,group_category_id,group_id,user_id,permission_read,permission_write,permission_owner)   
       VALUES('$tmp_obj_code','$tmp_obj_id','$group_category_id','$group_id','$user_id','$perm_read','$perm_write','$perm_owner')";
                     sql_query($query);
                	}
                	elseif (($hid!="true") && ($perm_read=="") && ($perm_write=="") && ($perm_owner=="")) 
                	{
                		///echo "old record. Empty - deleted";
                		 $query = "DELETE FROM permissions WHERE permission_id='".$hid."'";
  						 sql_query($query); 
                	}
                	else {
					//echo "old record. not empty - updated";
                       $query = "UPDATE permissions SET  group_id='$group_id',user_id='$user_id',permission_read='$perm_read',
					   permission_write='$perm_write',permission_owner='$perm_owner' 
					   WHERE object_code='$tmp_obj_code' AND object_id='$tmp_obj_id' AND $tmp_to_obj='$tmp_to_obj_id'";
  				 sql_query($query); }
               
echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=rights&".$tmp_obj."=".$tmp_obj_id."'>";
               
      break;
      case "edit_permissions_g":
	  case "edit_permissions_u":
      case "edit_permissions":
               themeleftbox(RIGHTS_CH_RIGHTS_HEADER,"","",true);
			   echo "<tr><td>";
                    
                   $query = "SELECT *
                         FROM permissions
						 WHERE object_code='12' AND object_id='".$tmp_obj_id."' AND $tmp_to_obj='$tmp_to_obj_id'";
               $result = sql_query($query);  
              $row=mysql_fetch_assoc($result);
                               
               
              $r_check="";
              $o_check="";
              $w_check="";
                	$new="true";
                	if ($row['permission_read']=="1")  {$r_check="checked";$new=$row['permission_id'];} 
                	if ($row['permission_write']=="1") {$w_check="checked";$new=$row['permission_id'];}
                	if ($row['permission_owner']=="1") {$o_check="checked";$new=$row['permission_id'];}
                	
          	
             
                $str="<form method=POST action='index.php?module=".$module."&page=rights&action=do_category_permissions&".$tmp_obj."=".$tmp_obj_id."&".$tmp_to_obj."=".$tmp_to_obj_id."'>


                     <input type=checkbox name=perm_read value=1 $r_check>".RIGHTS_READ."<br>
                     <input type=checkbox name=perm_write value=1 $w_check>".RIGHTS_WRITE."<br>
                    <input type=checkbox name=perm_owner value=1 $o_check>".RIGHTS_OWNER."<br>
                    <input type=hidden name=hid value=$new>";

                    $str.="<input type=submit value='"._USER_APPLY_BUTTON."'></form>";
                echo $str;

          break;
                    
          default:
		  
          themeleftbox(RIGHTS_RIGHTS_HEADER,"","",true);
		  
		  $query="SELECT test_name FROM tests WHERE test_id=".$for_test_id;
						$res=sql_single_query($query);
		  echo "<tr><td> <br>";
	
		  echo RIGHTS_LIST."</b>: <u><i>".$res['test_name']."</i></u><br><br>";
               
			if ($tmp_obj=="for_test_id") $tmp_obj_code=12;
               
					
		    $query = "SELECT *
                         FROM permissions
                         WHERE object_code='".$tmp_obj_code."' AND group_category_id!=0 AND object_id='$tmp_obj_id'";
               $result = sql_query($query);
               
               echo "<b><br>".RIGHTS_CAT."</b> &nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?module=$module&page=group_category&next_action=edit_permissions&".$tmp_obj."=".$tmp_obj_id."'>".RIGHTS_ADD."</a><br>";
                while ($row=mysql_fetch_assoc($result))
                {
                	$query = "SELECT group_category_name FROM group_categories WHERE group_category_id=".$row['group_category_id'];
                	$row1=sql_single_query($query);

                	$str="";
                	if ($row['permission_read']=="1")  $str.="R"; else $str.="_"; 
                	if ($row['permission_write']=="1") $str.="W"; else $str.="_";
                	if ($row['permission_owner']=="1") $str.="O"; else $str.="_";

                	echo $row1['group_category_name'].' - '.$str.' <a href="index.php?module=tests&page=rights&action=edit_permissions&group_category_id='.$row['group_category_id'].'&'.$tmp_obj.'='.$tmp_obj_id.'">'.RIGHTS_CHANGE.'</a><br>';


                }
                $query = "SELECT *
                         FROM permissions
                         WHERE object_code='".$tmp_obj_code."' AND group_id!=0 AND object_id='$tmp_obj_id'";
               $result = sql_query($query);
               
               echo "<b><br>".RIGHTS_GR."</b> &nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?module=$module&page=group_category&next_action=edit_permissions_g&".$tmp_obj."=".$tmp_obj_id."'>".RIGHTS_ADD."</a><br>";
                while ($row=mysql_fetch_assoc($result))
                {
                	$query = "SELECT group_name FROM groups WHERE group_id=".$row['group_id'];
                	$row1=sql_single_query($query);
                	
                	$str="";
                	if ($row['permission_read']=="1")  $str.="R"; else $str.=" _"; 
                	if ($row['permission_write']=="1") $str.="W"; else $str.=" _";
                	if ($row['permission_owner']=="1") $str.="O"; else $str.=" _";
                	
                	echo $row1['group_name'].RIGHTS_RIGHTS.$str.' <a href="index.php?module=tests&page=rights&action=edit_permissions&next_action=edit_permissions_g&group_id='.$row['group_id'].'&'.$tmp_obj.'='.$tmp_obj_id.'">'.RIGHTS_CHANGE.'</a><br>';
               }
                $query = "SELECT *
                         FROM permissions
                         WHERE object_code='".$tmp_obj_code."' AND user_id!=0 AND object_id='$tmp_obj_id'";
               $result = sql_query($query);
               
               echo "<b><br>".RIGHTS_USER."</b> &nbsp;&nbsp;&nbsp;&nbsp;<a href='index.php?module=$module&page=group_category&next_action=edit_permissions_u&".$tmp_obj."=".$tmp_obj_id."'>".RIGHTS_ADD."</a><br>";
                while ($row=mysql_fetch_assoc($result))
                {
                	$query = "SELECT user_name FROM users WHERE user_id=".$row['user_id'];
                	$row1=sql_single_query($query);
                	
                	$str="";
                	if ($row['permission_read']=="1")  $str.="R"; else $str.=" _"; 
                	if ($row['permission_write']=="1") $str.="W"; else $str.=" _";
                	if ($row['permission_owner']=="1") $str.="O"; else $str.=" _";
                	
                	echo $row1['user_name'].RIGHTS_RIGHTS.$str.' <a href="index.php?module=tests&page=rights&action=edit_permissions&next_action=edit_permissions_u&user_id='.$row['user_id'].'&'.$tmp_obj.'='.$tmp_obj_id.'">'.RIGHTS_CHANGE.'</a><br>';
               }
         break;
}