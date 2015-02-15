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
    /* 11/01/2005 08:00:00                                                  */
    /************************************************************************/
    if (INDEXPHP!=1)
        die ("You can't access this file directly...");
        
    require_once("modules/".$module."/include/test_info.php");

	$search_html_tags="'<[\/\!]*?[^<>]*?>'si";

	global $action, $current_theme, $test_category_id, $test_id, $test_name, $test_disabled,
		   $topic_id, $topic_name, $topic_disabled, $question_id, $question_text,$question_disabled, 
		   $answer_id, $answer_text, $on_off, $page, $question_type, $answer_sample, $page_num,$return_up;

	if(isset($_REQUEST['test_category_id']))
		$test_category_id = intval($_REQUEST['test_category_id']);
    else
		$test_category_id = 0;
		
	if(isset($_REQUEST['next_action']))
          $next_action = $_REQUEST['next_action'];
     else $next_action="";

    if(isset($_REQUEST['test_id']))
        $test_id = intval($_REQUEST['test_id']);
	else
        $test_id = "";	

	if(isset($_REQUEST['topic_id']))
		$topic_id = intval($_REQUEST['topic_id']);
    else
		$topic_id = "";

    if(isset($_REQUEST['question_id']))
		$question_id = intval($_REQUEST['question_id']);
    else
        $question_id = "";	

	if(isset($_REQUEST['answer_id']))
		$answer_id = intval($_REQUEST['answer_id']);
	else
		$answer_id = "";
	
	  if(isset($_REQUEST['for_test_id']))
        $for_test_id = intval($_REQUEST['for_test_id']);
	else
        $for_test_id = "";	
		
		 if(isset($_REQUEST['group_category_id']))
		   $group_category_id = intval($_REQUEST['group_category_id']);
     else
		   $group_category_id = "";

     if(isset($_REQUEST['group_id']))
           $group_id = intval($_REQUEST['group_id']);
	 else
           $group_id = "";

	 if(isset($_REQUEST['user_id']))
		   $user_id = intval($_REQUEST['user_id']);
     else
		   $user_id = "";

	if(isset($_REQUEST['return_up']))
		$return_up = $_REQUEST['return_up'];
	else
		$return_up= 0;

	if(!isset($_REQUEST['page_num']))
		$page_num=0;
	else
		$page_num=intval($_REQUEST['page_num']-1);

	if($page_num<0)
		$page_num=0;

    $content = "<div style='padding-left:0px;line-height:18px;'>
    
                <a href='index.php'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r8_c18.gif' align=absmiddle> "._MENU_BASIC_MENU."</a><br>
                <a href='index.php?module=".$module."'>
	<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c4.gif' align=absmiddle> "._MENU_RESULTS_ROOT."</a><br>
                
                </div>";
    
     
    
    
    themeleftbox(_MENU_COMMON_TASKS, "$content","",false);	
	
	if(($answer_id != "") && ($page == "answer"))
	{
		$query = "SELECT answer_id, answer_text, answer_sample, questions.question_id,
						   question_text, question_type, topics.topic_id, topic_name,
						   tests.test_id, test_name, test_categories.test_category_id,
						   test_category_name
					FROM answers, questions, topics, tests, test_categories
					WHERE answers.question_id = questions.question_id
						 AND questions.topic_id = topics.topic_id
						 AND topics.test_id = tests.test_id
                         AND test_categories.test_category_id = tests.test_category_id
						 AND answers.answer_id ='".$answer_id."'";		
	}
	elseif(($question_id != "") && ($page == "question"))
	{
		$query = "SELECT question_id, question_text, topics.topic_id,
						   topic_name, tests.test_id, test_name,
						   test_categories.test_category_id, test_category_name,
						   question_disable, question_type
					FROM questions, topics, tests, test_categories
                    WHERE questions.topic_id = topics.topic_id
                         AND topics.test_id = tests.test_id
						 AND test_categories.test_category_id = tests.test_category_id
						 AND questions.question_id ='".$question_id."'";
	}
    elseif(($topic_id != "") && ($page == "topic"))
    {
		$query = "SELECT topics.topic_id, topics.topic_name, tests.test_id, tests.test_name,
						   test_categories.test_category_id, test_categories.test_category_name,
						   topics.topic_disable
					FROM topics, tests, test_categories
					WHERE topics.test_id = tests.test_id
                         AND test_categories.test_category_id = tests.test_category_id
						 AND topics.topic_id ='".$topic_id."'";
	}
	elseif((($test_id != "")||($for_test_id != "")) && (($page == "test")||($page == "rights")||($page == "group_category")||($page == "group")) )
	{
		if (($test_id == "")&&($for_test_id != "")) $test_id =$for_test_id; 
		$query = "SELECT tests.test_id, tests.test_name, test_categories.test_category_id,
						   test_categories.test_category_name, tests.test_disable
					FROM tests, test_categories
                    WHERE test_categories.test_category_id = tests.test_category_id
						 AND tests.test_id ='".$test_id."'";
	}
	elseif(($test_category_id != "") && ($page == "category"))
    {
		$query = "SELECT test_categories.test_category_id,
						   test_categories.test_category_name
					FROM test_categories
					WHERE test_categories.test_category_id ='".$test_category_id."'";
	}

	if(isset($query))
		$row=sql_single_query($query);	
	
	$content = "<SCRIPT LANGUAGE='JavaScript'>
				function toggle(ctrl)
				{
					var titles = document.all.title;
					if(titles.length)					
						if(titles.item(0).style.display == 'none')
						{
							for(i=0;i<titles.length;++i)
								titles.item(i).style.display = '';
							
							if(ctrl.children.item(0).tagName=='IMG')
								ctrl.children.item(0).src = 'themes/".$current_theme."/images/minus.png';
						}
						else
						{
							for(i=0;i<titles.length;++i)
								titles.item(i).style.display = 'none';
							
							if(ctrl.children.item(0).tagName=='IMG')
								ctrl.children.item(0).src = 'themes/".$current_theme."/images/plus.png';
						}
					else
						if(titles.style.display == 'none')
						{
							titles.style.display = '';
							
							if(ctrl.children.item(0).tagName=='IMG')
								ctrl.children.item(0).src = 'themes/".$current_theme."/images/minus.png';
						}
						else
						{
							titles.style.display = 'none';
							
							if(ctrl.children.item(0).tagName=='IMG')
								ctrl.children.item(0).src = 'themes/".$current_theme."/images/plus.png';
						}
				}
				</SCRIPT>";
				
	if (isset ($row['test_category_id']))
    {		
        $test_category_id = $row['test_category_id'];
		$temp = $row['test_category_name'];
        if(strlen($temp)>20)
        	$temp=preg_replace('/^(.{20}).*$/uSs', '$1', $temp)."..." ;
            //$temp = mb_substr($temp,0,20)."...";
        $content.= "<table border=0>
						<tr>
							<td>
								<a onclick='toggle(this);'><img src='themes/".$current_theme."/images/minus.png'></a>
							</td>
							<td>
								<strong>"._MENU_CATEGORY."</strong><br>							
								<div id='title'><a href='index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."' title='".$row['test_category_name']."'>&ldquo;".$temp."&rdquo;</a></div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>";

		if (isset($row['test_id']))
		{
            $test_id = $row['test_id'];
			$test_name = $row['test_name'];
            if (strlen($test_name)>20) 
		$temp=preg_replace('/^(.{20}).*$/uSs', '$1', $test_name)."..." ;
		else
				$temp = $test_name;
            $content.= "<table border=0>
							<tr>
								<td>
									<img src='themes/".$current_theme."/images/leaf.png'>
								</td>
								<td>
									<strong>"._MENU_TEST."</strong><br>
									<div id='title'><a href='index.php?module=".$module."&page=test&action=view_test&test_id=".$test_id."' title='".$test_name."'>&ldquo;".$temp."&rdquo;</a></div>
								</td>	
							</tr>
								<td></td>
								<td>";
			if ( isset ($row['topic_id']))
            {
                $topic_name=$row['topic_name'];
				$topic_id = $row['topic_id'];
                if (strlen($topic_name)>20)
                   $temp=preg_replace('/^(.{20}).*$/uSs', '$1', $topic_name)."..." ;
				else
					$temp = $topic_name;
                $content.= "<table border=0>
								<tr>
									<td>
										<img src='themes/".$current_theme."/images/leaf.png'>
									</td>
									<td>
										<strong>"._MENU_TOPIC."</strong><br>
										<div id='title'><a href='index.php?module=".$module."&page=topic&action=view_topic&topic_id=".$topic_id."' title='".$topic_name."'>&ldquo;".$temp."&rdquo;</a></div>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>";
				if (isset ($row['question_id']))
				{
					$question_id = $row['question_id'];
					$question_text = $row['question_text'];
					$question_type = $row['question_type'];					
					$temp=preg_replace($search_html_tags,"",$question_text);
                    if (strlen($temp)>20)
						$temp=preg_replace('/^(.{20}).*$/uSs', '$1', $temp)."..." ;
                    $content.= "<table border=0>
									<tr>
										<td>
											<img src='themes/".$current_theme."/images/leaf.png'>
										</td>
										<td>
											<strong>"._MENU_QUESTION."</strong><br>
											<div id='title'><a href='index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."' title='".$question_text."'>&ldquo;".$temp."&rdquo;</a></div>
										</td>
									</tr>
										<td></td>
										<td>";
					if(isset ($row['answer_id']))
					{
						$answer_id = $row['answer_id'];
						$answer_text = $row['answer_text'];
						$answer_sample = $row['answer_sample'];
						if($question_type == 3)
							$temp=preg_replace($search_html_tags,"",$answer_sample);
						else
							$temp=preg_replace($search_html_tags,"",$answer_text);
                        if (strlen($temp)>20)
							$temp=preg_replace('/^(.{20}).*$/uSs', '$1', $temp)."..." ;
                        $content.=" <table border=0>
										<tr>
											<td>
												<img src='themes/".$current_theme."/images/leaf.png'>
											</td>
											<td>
												<strong>"._MENU_ANSWER."</strong><br>
												<div id='title'><a href='index.php?module=".$module."&page=answer&action=view_answer&answer_id=".$answer_id."'title='".($question_type!=3?$answer_text:$answer_sample)."'>&ldquo;".$temp."&rdquo;</a></div>
											</td>
										</tr>
									</table>";
					}					
					$content .= "</td></tr></table>";
                }				
				$content .= "</td></tr></table>";
            }			
			$content .= "</td></tr></table>";
        }		
		$content .= "</td></tr></table>";
		themeleftbox("<a href='index.php?module=".$module."&page=category'>"._MENU_TREE."</a>", $content,"",false);
    }
	
	 if(($user_id != "") && (($page == "group")||($page == "rights")))
	 {
          $query = "SELECT users.user_disable, users.user_id, users.user_name, groups.group_id, groups.group_name,
                           group_categories.group_category_id, group_categories.group_category_name

                    FROM users, groups, group_categories
                    WHERE users.group_id = groups.group_id
                         AND group_categories.group_category_id = groups.group_category_id
                         AND users.user_id =".$user_id;

	 }
	 elseif(($group_id != "") && (($page == "group")||($page == "rights")))
	 {
          $query = "SELECT groups.group_disable, groups.group_id, groups.group_name, group_categories.group_category_id,
                           group_categories.group_category_name
                    FROM groups, group_categories
                    WHERE group_categories.group_category_id = groups.group_category_id
                         AND groups.group_id =".$group_id;

	 }
     elseif($group_category_id != "")
     {
		  $query = "SELECT group_categories.group_category_id, group_categories.group_category_name
					FROM group_categories
					WHERE group_categories.group_category_id =".$group_category_id;

	 }

	
	if(isset($query))
		$row=sql_single_query($query);	
	
	$content=""; 
	if (isset ($row['group_category_id']))
    {		
        $test_category_id = $row['group_category_id'];
		$temp = $row['group_category_name'];
        if(strlen($temp)>20)
            $temp = mb_substr($temp,0,20)."...";
        $content.= "<table border=0>
						<tr>
							<td>
								<img src='themes/".$current_theme."/images/leaf.png'>
							</td>
							<td>
								<strong>"._MENU_GROUP_CAT."</strong><br>
								<div id='title'><a href='#'>&ldquo;".$temp."&rdquo;</a></div>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>";

		if (isset($row['group_id']))
		{
            $test_id = $row['group_id'];
			$group_name = $row['group_name'];
            if (strlen($group_name)>20)
                $temp=substr($group_name,0,20)."...";
			else
				$temp = $group_name;
            $content.= "<table border=0>
							<tr>
								<td>
									<img src='themes/".$current_theme."/images/leaf.png'>
								</td>
								<td>
									<strong>"._MENU_GROUP."</strong><br>
									<div id='title'><a href='#'>&ldquo;".$temp."&rdquo;</a></div>
								</td>	
							</tr>
								<td></td>
								<td>";
			if ( isset ($row['user_id']))
            {
                $user_name=$row['user_name'];
				$user_id = $row['user_id'];
                if (strlen($user_name)>20)
                    $temp=substr($user_name,0,20)."...";
				else
					$temp = $user_name;
                $content.= "<table border=0>
								<tr>
									<td>
										<img src='themes/".$current_theme."/images/leaf.png'>
									</td>
									<td>
										<strong>"._MENU_USER."</strong><br>
										<div id='title'><a href='#'>&ldquo;".$temp."&rdquo;</a></div>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>";
					
				$content .= "</td></tr></table>";
            }			
			$content .= "</td></tr></table>";
        }		
		$content .= "</td></tr></table>";
		themeleftbox("<a href='#'>"._MENU_TREE_USER."</a>", $content,"",false);
    }
	
    $on_off_icons[0]="<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c10.gif' align=absmiddle> ";
    $on_off_icons[1]="<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r4_c6.gif' align=absmiddle> ";
    switch($page)
	{

		case"rights":
		case"group_category":
		case"group":
		case "test":
			if(isset($row['test_disable']))
				$test_disabled = $row['test_disable'];					
			else
				$test_disabled = 1;
				
			$content ="<a href='index.php?module=$module&page=test&action=view_export_form&test_id=".$test_id."'>
<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c18.gif' align=absmiddle> "._MENU_EXPORT_TEST."</a><br>
					   <a href='index.php?module=$module&page=test&action=add_topic_form&test_id=".$test_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c12.gif' align=absmiddle> "._MENU_ADD_TOPIC."</a><br>
					   <a href='index.php?module=$module&page=test&action=view_rename_form&test_id=".$test_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c6.gif' align=absmiddle> "._MENU_RENAME_TEST."</a><br>
					   <a href='index.php?module=$module&page=test&action=view_delete_form&test_id=".$test_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r14_c4.gif' align=absmiddle> "._MENU_DELETE_TEST."</a><br>
					   <a href='index.php?module=$module&page=test&action=switch&test_id=".$test_id."'>
					   ".$on_off_icons[$test_disabled]."
					   ".$on_off['menu']['test'][$test_disabled]."</a><br>
					   <a href='index.php?module=$module&page=rights&for_test_id=".$test_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r8_c4.gif' align=absmiddle> "._MENU_SECURITY."</a><br>
					   <a target='_blank' href='index.php?module=$module&page=test&action=test_print_ver&test_id=".$test_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r12_c18.gif' align=absmiddle> "._MENU_PRINT_VER."</a><br>
					  ";
			
			themeleftbox(_MENU_TASKS_FOR_TEST, $content,"",false);
			
			$content = _MENU_TEST_CONTAIN.":<b> ".get_count($test_id,1,false)." </b><br>";
			$update_row = get_update_info($test_id);
			
			if ($update_row !== false) {
				$content .=	"<br>"._MENU_LAST_CHANGE.":<br>					  
					  <table width='100%' border='0' cellpadding='0' cellspacing='2'>
					  	<tr>
					  		<td>"._MENU_DATE.":</td>
					  		<td><b>".date("Y-m-d H:i:s",$update_row['update_time'])."</b></td>
					  	</tr>					  
					  	<tr>
					  		<td>"._MENU_USER.":</td>
					  		<td><b>".$update_row['user_name']."</b></td>
					  	</tr>					  
					  	<tr>
					  		<td>"._MENU_GROUP.":</td>
					  		<td><b>".$update_row['group_name']."</b></td>
					  	</tr>					  
					  	<tr>
					  		<td>"._MENU_GROUP_CAT.":</td>
					  		<td><b>".$update_row['group_category_name']."</b></td>
					  	</tr>					  
					  </table>";
			}
			
			themeleftbox(_MENU_DETAILS, $content,"",false);
		break;
		
		case "topic":
			if(isset($row['topic_disable']))
				$topic_disabled = $row['topic_disable'];
			else
				$topic_disabled = 1;
				
			$content ="
					   <a href='index.php?module=$module&page=".$page."&action=view_add_form&topic_id=".$topic_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c12.gif' align=absmiddle> "._MENU_ADD_QUESTION."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=view_rename_form&topic_id=".$topic_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c6.gif' align=absmiddle> "._MENU_RENAME_TOPIC."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=view_delete_form&topic_id=".$topic_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r14_c4.gif' align=absmiddle> "._MENU_DELETE_TOPIC."</a><br>
					   <a href='index.php?module=$module&page=category&next_action=copy_topic_select_test&topic_id=".$topic_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r4_c10.gif' align=absmiddle> "._MENU_COPY_TOPIC."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=switch&topic_id=".$topic_id."'>					".$on_off_icons[$topic_disabled]."
					   ".$on_off['menu']['topic'][$topic_disabled]."</a><br>
					   <a target='_blank' href='index.php?module=$module&page=".$page."&action=topic_print_ver&topic_id=".$topic_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r12_c18.gif' align=absmiddle>  "._MENU_PRINT_VER."</a>";
			themeleftbox(_MENU_TASKS_FOR_TOPIC, $content,"",false);
			
			$content = _MENU_TOPIC_CONTAIN.":<b> ".get_count($topic_id,2,false)." </b><br>
					  <!--a href='index.php?module=".$module."'>"._MENU_LAST_CHANGE."</a><br-->";
			themeleftbox(_MENU_DETAILS, $content,"",false);
		break;
		
		case "question":
			if(isset($row['question_disable']))
				$question_disabled = $row['question_disable'];
			else
				$question_disabled = 0;
				
			$content ="<a href='index.php?module=$module&page=".$page."&action=view_add_form&question_id=".$question_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c12.gif' align=absmiddle> "._MENU_ADD_ANSWER."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=view_edit_form&question_id=".$question_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c6.gif' align=absmiddle>  "._MENU_EDIT_QUESTION."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=view_delete_form&question_id=".$question_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r14_c4.gif' align=absmiddle> "._MENU_DELETE_QUESTION."</a><br>
					   <a href='index.php?module=$module&page=".$page."&action=switch&question_id=".$question_id."'>
					   ".$on_off_icons[$question_disabled]." ".$on_off['menu']['question'][$question_disabled]."</a><br>
					   <a target='_blank' href='index.php?module=$module&page=".$page."&action=question_print_ver&question_id=".$question_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r12_c18.gif' align=absmiddle>  "._MENU_PRINT_VER."</a>";
			themeleftbox(_MENU_TASKS_FOR_QUESTION, "<div style='padding-left:0px;line-height:18px;'>".$content."</div>","",false);
		break;
		
		case "answer":
			$content = "<a href='index.php?module=$module&page=".$page."&action=view_delete_form&answer_id=".$answer_id."'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r14_c4.gif' align=absmiddle> "._MENU_DELETE_ANSWER."</a><br>";
			themeleftbox(_MENU_TASKS_FOR_ANSWER, $content,"",false);
		break;
		
		  
		case "category":
		default:
			$act="next_action";
			if($test_category_id!="")
				$act="test_category_id=".$test_category_id."&action";

            $crt_frm = "<a href='index.php?module=".$module."&page=category&".$act."=view_create_form'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r6_c20.gif' align=absmiddle> "._MENU_CRETAE_TEST."</a><br>";
            $imp_frm = "<a href='index.php?module=".$module."&page=category&".$act."=view_import_form'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c2.gif' align=absmiddle> "._MENU_IMPORT_TEST."</a><br>";
            $open_cat = "<a href='index.php?module=".$module."&page=category&".$act."=view_category'><img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r8_c16.gif' align=absmiddle> "._MENU_OPEN_TEST."</a><br>";

			switch($action)
            {
            	case "view_create_form":
                	$content = $imp_frm.$open_cat;
                break;

                case "view_import_form":
                	$content = $crt_frm.$open_cat;
                break;

                case "view_category":
                	$content = $crt_frm.$imp_frm;
                break;

                default:
                	$content = $crt_frm.$imp_frm.$open_cat;
            }


			themeleftbox(_MENU_TEST_CONTROL, $content,"",false);
		break;
	}

	echo "</div>";
	themeleftbox(_MENU_AUTHORIZATION, "","",false);
	include("modules/auth/auth_menu_form.php");