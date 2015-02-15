<?php
	if (INDEXPHP!=1)
		die ("You can't access this file directly...");

	$orders = array("ASC"=>"DESC",
					"DESC"=>"ASC");

	//-- ���������� � �������� �������� ����������
	if(isset($_REQUEST['action']))
		$action = $_REQUEST['action'];
	else $action = "";

	if(isset($_REQUEST['new_teacher_id']))
		$new_teacher_id = $_REQUEST['new_teacher_id'];
	else
		$new_teacher_id = 0;

	if(isset($_REQUEST['order']))
		$order = $_REQUEST['order'];
	else
		$order = "ASC";

	if(isset($_REQUEST['field']))
		$field = $_REQUEST['field'];
	else
		$field = "user_name";

	if(isset($_REQUEST['date_filter']))
		$date_filter = $_REQUEST['date_filter'];
	else
		$date_filter = 0;

	if(isset($_REQUEST['f_date']))
		$f_date = $_REQUEST['f_date'];
	else
		$f_date = array("y"=>date("Y"),
						"m"=>date("m"),
						"d"=>date("d"));

	if(isset($_REQUEST['t_date']))
		$t_date = $_REQUEST['t_date'];
	else
		$t_date = array("y"=>date("Y"),
						"m"=>date("m"),
						"d"=>date("d"));

	if(isset($_REQUEST['ball_num']))
		$ball_num = intval($_REQUEST['ball_num']);
	else
		$ball_num = 4;


	if ($action!="print_ver") {
		themeleftbox(_MENU_TEST_RESULTS,"","",true);
	}

	$page_buf = "<tr><td>";

	switch($action)
	{
		default:
			$page_buf .=   "<form method='post' name='selection' action='index.php?module=".$module."&page=test_results'>
							<input type='hidden' name='order' value='".$order."'>
							<input type='hidden' name='field' value='".$field."'>
							<table width=100% border=0>
								<tr align='center'>
									<td></td>
									<td nowrap>"._FROM." :<select name='f_date[y]'>";
			$year = date("Y");
			for ($i=$year-5;$i<$year+5;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$f_date['y']?"selected":"")." >$i</option>";
			}

			$page_buf .="		</select>";
			$page_buf .=" <select name='f_date[m]'>";

			for ($i=1;$i<=12;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$f_date['m']?"selected":"")." >".sprintf("%02d",$i)."</option>";
			}

			$page_buf .="		</select>";
			$page_buf .=" <select name='f_date[d]'>";

			for ($i=1;$i<=31;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$f_date['d']?"selected":"")." >".sprintf("%02d",$i)."</option>";
			}

			$page_buf .="		</select></td>
									<td nowrap>"._TO." :<select name='t_date[y]'>";
			$year = date("Y");
			for ($i=$year-5;$i<$year+5;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$t_date['y']?"selected":"")." >$i</option>";
			}

			$page_buf .="		</select>";
			$page_buf .=" <select name='t_date[m]'>";

			for ($i=1;$i<=12;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$t_date['m']?"selected":"")." >".sprintf("%02d",$i)."</option>";
			}

			$page_buf .="		</select>";
			$page_buf .=" <select name='t_date[d]'>";

			for ($i=1;$i<=31;++$i)
			{
				$page_buf .= "<option value='$i' ".($i==$t_date['d']?"selected":"")." >".sprintf("%02d",$i)."</option>";
			}

			$_f_date = mktime(0,0,0,$f_date['m'],$f_date['d'],$f_date['y']);
				$_t_date = mktime(23,59,59,$t_date['m'],$t_date['d'],$t_date['y']);

				$date_where = "";
				if ($_f_date!=$_t_date) {
					$date_where = " AND UNIX_TIMESTAMP(stop_datetime)>=$_f_date AND UNIX_TIMESTAMP(stop_datetime)<=$_t_date ";
				}
			if($group_id<=0)
				$result_test = sql_query("SELECT DISTINCT test_id, test_name, test_category_name
					FROM recent_objects, tests, test_categories
					WHERE test_id = object_id
					AND object_code =0
					AND test_categories.test_category_id = object_category_id
					AND recent_objects.user_id = '".$teacher_id."'
					ORDER BY last_used DESC");
			else
				$result_test = sql_query("SELECT DISTINCT tests.test_id, test_name, test_category_name
					FROM results, tests, test_categories
					WHERE results.test_id = tests.test_id
					AND results.group_id='".$group_id."'
					AND test_categories.test_category_id = tests.test_category_id
					AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			if($test_id<=0)
				$result_group = sql_query("SELECT DISTINCT group_id, group_name, group_category_name
					FROM recent_objects, groups, group_categories
					WHERE group_id = object_id
					AND object_code = 1
					AND group_categories.group_category_id = object_category_id
					AND user_id = '".$teacher_id."'
					ORDER BY last_used DESC");
			else
				$result_group = sql_query("SELECT DISTINCT groups.group_id, group_name, group_category_name
					FROM results, groups, group_categories
					WHERE results.group_id = groups.group_id
					AND results.test_id='".$test_id."'
					AND group_categories.group_category_id = groups.group_category_id
					AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			$page_buf .="		</select></td>
									<td><input type='submit' value='"._REFRESH."'></td>
									<td>
										"._UNIT_SCALE."
										<select name='ball_num' onchange='document.selection.submit();'>";
			for ($ball=3; $ball<=100; ++$ball){
				$page_buf .= '<option value="'.$ball.'" '.($ball==$ball_num?'selected':'').'>'.$ball.'</option>';
			}
			$page_buf .="				</select>
									</td>
								</tr>
								<tr align='center'>
									<td></td>
									<td width='70%'>"._SELECTION_TEST."</td>
									<td width='30%'>"._SELECTION_GROUP."</td>
									<td></td>
									<td>"._TEACHER."</td>
								</tr>
								<tr align='center'>
									<td>
										<a href='index.php?module=".$module."&page=t_category&next_action=return_statistics_results&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_TEST."</a>
									</td>
									<td><input type='hidden' name='test_id' value=".$test_id.">
										<select  name='new_test_id' onchange='document.selection.submit();' style='width:100%'>
											<option value=\"0\">"._CHOOSE_TEST."</option>";
			//-- �������� ������ ������
			while($row = mysql_fetch_assoc($result_test))
				{     				$page_buf .=  "<option value=".$row['test_id']." ".($test_id==$row['test_id']?'selected':'').">".$row['test_category_name']."/".$row['test_name']."</option>";
     			}


			$page_buf .=		   "</td>
									<td><input type='hidden' name='group_id' value=".$group_id.">
										<select  name='new_group_id' onchange='document.selection.submit();' style='width:100%'>
											<option value=\"-1\">"._CHOOSE_GROUP."</option>";

			while($row = mysql_fetch_assoc($result_group))
				$page_buf .=  "<option value=".$row['group_id']." ".($group_id==$row['group_id']?'selected':'').">".$row['group_category_name']."/".$row['group_name']."</option>";

            if (mysql_num_rows($result_group)>0)
    		{    			$all_groups_selected = "";
				if ($new_group_id==0)
					$all_groups_selected="selected";
            	$page_buf .=  "<option value='0' ".$all_groups_selected.">"._SELECTION_ALL_TESTS."</option>";
            }

			$page_buf .=		   "</td>
									<td>
										<a href='index.php?module=".$module."&page=g_category&next_action=return_statistics_results&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_GROUP."</a>
									</td>";

            if($test_id >0 && ($group_id >=0 && $new_group_id>=0))
			{
                if ($group_id>0)
				$teachers = sql_query("SELECT DISTINCT teacher_id, user_name
									   FROM results, users
									   WHERE test_id='".$test_id."'
									   AND results.group_id='".$group_id."'
									   AND users.user_id=results.teacher_id
									   AND hide_result=0 ".$date_where);
				else
				$teachers = sql_query("SELECT DISTINCT teacher_id, user_name
									   FROM results, users
									   WHERE test_id='".$test_id."'
									   AND users.user_id=results.teacher_id
									   AND hide_result=0 ".$date_where);

				if(mysql_num_rows($teachers)>1)
				{
					$teachers_opts = "<select name=\"new_teacher_id\" onchange='document.selection.submit();'>
									<option value=\"0\">"._ALL_TEACHERS."</option>";

					while($teacher = mysql_fetch_assoc($teachers))
					{
						$teachers_opts.="<option value=\"".$teacher['teacher_id']."\" ".($new_teacher_id==$teacher['teacher_id']?"selected":"").">".$teacher['user_name']."</option>";
					}

					$teachers_opts .= "</select>";
				}
				else
				{
					$teacher = mysql_fetch_assoc($teachers);
					$new_teacher_id = $teacher['teacher_id'];
					$teachers_opts=$teacher['user_name'];
				}
			}
			else
				$teachers_opts=$GLOBALS['auth_result']['user']['user_name'];


			$page_buf .=		"<td>".$teachers_opts."</td></tr>
							</table></form>";

			flush();
			if($test_id >0 &&($group_id >=0 && $new_group_id>=0))
			{
				if($new_teacher_id>0)
					$query_add = " AND r.teacher_id='".$new_teacher_id."' ";
				else
					$query_add = "";


                if ($group_id>0)
					$results = sql_query("SELECT DISTINCT result_id, user_name, user_disable, start_datetime, stop_datetime,
										mark, percent, percent_simple, r.teacher_id, total_unit
									  	FROM users u, results r 
 									    WHERE u.user_id = r.user_id
 									    AND r.test_id = '".$test_id."'
									    AND r.group_id = '".$group_id."'$query_add $date_where
    								    ORDER BY ".$field." ".$order);

                else
               			$results = sql_query("SELECT DISTINCT result_id, user_name, user_disable, start_datetime, stop_datetime,
										mark, percent, percent_simple, r.teacher_id, total_unit
									    FROM users u, results r
 									    WHERE u.user_id = r.user_id
 									    AND r.test_id = '".$test_id."'$query_add $date_where
									    ORDER BY ".$field." ".$order);

				if(mysql_num_rows($results) == 0)
				{
					if(get_count($group_id,3,false)>0)
						$page_buf .= "<center><b>"._NO_TESTED_USERS."</b></center>";
					else
						$page_buf .= "<div align='center'><strong>"._NO_USERS."</strong></div>";
				}
				else
				{	$page_buf .= "<script>
							function change_order(ord_field,ord_order)
							{
								document.forms.selection.elements.field.value=ord_field;
								document.forms.selection.elements.order.value=ord_order;
								document.forms.selection.submit();
							}
						</script>";
					//--------------------------------------
					
					//--------------------------------------
					$page_buf .=   "<table width='100%' borde=0>
										<tr class='tab' align='center'>
											<td width='10%'>"._NUMBER."</td>
											<td width='40%'><a href='#' onclick='change_order(\"user_name\",\"".$orders[$order]."\");'>"._NAME."</a></td>
                                            <td width='20%'><a href='#' onclick='change_order(\"start_datetime\",\"".$orders[$order]."\");'>"._START_TIME."</a></td>
                                            <td>"._TEST_TIME."</td>
                                            <td><a href='#' onclick='change_order(\"teacher_id\",\"".$orders[$order]."\");'>"._TEACHER."</a></td>
                                            <td>"._QUESTIONS_NUM."</td>
                                            <td><a href='#' onclick='change_order(\"total_unit\",\"".$orders[$order]."\");'>"._TOTAL_UNIT."</a></td>
   											<td width='10%'><a href='#' onclick='change_order(\"percent_simple\",\"".$orders[$order]."\");'>"._PERCENT_SIMPLE."</a></td>
											<td width='10%'><a href='#' onclick='change_order(\"percent\",\"".$orders[$order]."\");'>"._PERCENT."</a></td>
											<td width='10%'><a href='#' onclick='change_order(\"percent\",\"".$orders[$order]."\");'>"._MARK."</a></td>
										</tr>";
					$i=0;


					 ////////////////////////////////////////////////

 					$tmp_mark=0.0;
					$tmp_arr[]=0.0;
					$tmp_mark_simple=0.0;
					$tmp_arr_simple[]=0.0;
					$tmp_squared=0.0;
					$tmp_squared_simple=0.0;
					$tmp_t=0.0;
					$tmp_m=0.0;
					$tmp_t_simple=0.0;
					$tmp_m_simple=0.0;

                    if ($group_id>0)
					$marks_values = sql_query("SELECT DISTINCT result_id, user_name, user_disable,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									  FROM users u, results r, test_access ta
 									  WHERE u.user_id = r.user_id
 									   AND ta.test_id = r.test_id
 									   AND ta.group_id=r.group_id
 									   AND ta.test_id=r.test_id
									   AND r.test_id = '".$test_id."'
									   AND r.group_id = '".$group_id."'$query_add $date_where

									  ORDER BY ".$field." ".$order);
					else
					$marks_values = sql_query("SELECT DISTINCT result_id, user_name, user_disable,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									  FROM users u, results r, test_access ta
 									  WHERE u.user_id = r.user_id
 									   AND ta.test_id = r.test_id

 									   AND ta.test_id=r.test_id
									   AND r.test_id = '".$test_id."'
									  $query_add $date_where

									  ORDER BY ".$field." ".$order);
                    $tmp_counts=0;
                     while($marks_values_data = mysql_fetch_assoc($marks_values))
					{
						$tmp_mark+=$marks_values_data['percent'];
						$tmp_arr[$tmp_counts]= $marks_values_data['percent'];
						$tmp_mark_simple+=$marks_values_data['percent_simple'];
						$tmp_arr_simple[$tmp_counts] = $marks_values_data['percent_simple'];
						$tmp_counts++;
					}
					$tmp_m = $tmp_mark/$tmp_counts;
					$tmp_m_simple = $tmp_mark_simple/$tmp_counts;
					for ($a=0;$a<$tmp_counts;$a++)
					{
                       $tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
                       $tmp_squared_simple+=pow($tmp_arr_simple[$a]-$tmp_m_simple,2);
					}

					 if ($tmp_counts>1)
						{
							$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
							$tmp_t_simple = sqrt($tmp_squared_simple/($tmp_counts-1));
						}
					 else
					 	{
					 		$tmp_t=16.7;
					 		$tmp_t_simple=16.7;
					 	}
   					 $tmp_m_out = sprintf ("%01.2f", $tmp_m);
      				 $tmp_t_out = sprintf ("%01.2f", $tmp_t);
   					 $tmp_m_simple = sprintf ("%01.2f", $tmp_m_simple);
      				 $tmp_t_simple = sprintf ("%01.2f", $tmp_t_simple);
///////////////////////////////////////////////////////////////////////////////

					while($marks = mysql_fetch_assoc($results))
					{
						if($marks['user_disable'])
							$user_name = "<font color=red>".$marks['user_name']."</font>";
						else
							$user_name = $marks['user_name'];

						$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");
						// mark calculateing with new algorithm =============================
						$_percent = $marks['percent'];
						if ($_percent <= 2)
						{
							$x=-1.92;
						} elseif ($_percent >= 98)
						{
							$x=1.92;
						}

						if ($tmp_t>0)
                       	{
                       		$x = ($_percent - $tmp_m)/($tmp_t);
                       		if ($x>1.92)
								$x=1.92;
							if ($x<-1.92)
								$x=-1.92;
							$percentile = sql_single_query("SELECT proc FROM percentile WHERE value>=$x ORDER BY value ASC, proc ASC LIMIT 0,1");
							$percentile = $percentile['proc'];
						}
                       	else
                       		$percentile = 0;

//						$marks['_mark'] = ($percentile * $ball_num / 100)."&nbsp;&nbsp;&nbsp;".$percentile."&nbsp;&nbsp;&nbsp;".$x;
						$marks['_mark'] = ceil($percentile * $ball_num / 100);
						if ($ball_num == 4) {
							++$marks['_mark'];
						}
						//===================================================================
						//======num questions=============================================================
					$results_n = sql_query("SELECT  history_testing_id
											FROM  history_testing
											WHERE result_id = ".$marks['result_id']);

					$marks['num_questions']=mysql_num_rows($results_n);
					//===================================================================


						$page_buf .=   "<tr align='center'>
											<td>".++$i."</td>
											<td align='left'><a href='index.php?module=".$module."&page=show_log&result_id=".$marks['result_id']."'>".$user_name."</a></td>
                                            <td nowrap>".substr($marks['start_datetime'],0,strlen($marks['start_datetime'])-3)."</td>
                                            <td>".round(((strtotime($marks['stop_datetime'])-strtotime($marks['start_datetime']))/60),2)." мин</td>
                                            <td nowrap>".$teacher_name['name']."</td>
                                            <td>".$marks['num_questions']."</td>
                                            <td>".$marks['total_unit']."</td>
											<td>".$marks['percent_simple']."</td>
											<td>".$marks['percent']."</td>
											<td>".$marks['_mark']."</td>
										</tr>";
					}
					$page_buf .= "</table>";
					$page_buf .="<br><table width='30%'>
								<tr>
									<td width='50%'>M = $tmp_m_simple  <br>
											SIGMA = $tmp_t_simple
									</td>
									<td width='50%'>M* = $tmp_m_out  <br>
											SIGMA* = $tmp_t_out
									</td>
								</tr>
									</table>";
					$page_buf .= "<br><a href=\"index.php?module=$module&page=$page&action=print_ver&test_id=$test_id&group_id=$group_id&new_teacher_id=$new_teacher_id&f_date[y]=".$f_date['y']."&f_date[m]=".$f_date['m']."&f_date[d]=".$f_date['d']."&t_date[y]=".$t_date['y']."&t_date[m]=".$t_date['m']."&tmp_m_out=".$tmp_m_out."&tmp_t_out=".$tmp_t_out."&tmp_m_simple=".$tmp_m_simple."&tmp_t_simple=".$tmp_t_simple."&t_date[d]=".$t_date['d']."&ball_num=$ball_num\" target=\"blank\">"._PRINT_VERSION."</a>";

				}
			}
			else
				$page_buf .= "<center><b>"._CHOOSE."</b></center>";
		break;


		case "add_new_test":
			if(is_allow(12,$test_category_id,$new_test_id,1))
			{
				add_recent(0,$test_category_id,$new_test_id,$teacher_id);
				//-- ��������
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test_results&new_test_id=".$new_test_id."&group_id=".$group_id."'>";
			}
			else

				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&next_action=return_statistics_results&page=test&test_id=".$test_id."&group_id=".$group_id."&test_category_id=".$test_category_id."&status_code=0&status_num=op_permited'>";
		break;

		case "add_new_group":
			if(is_allow(14,$group_category_id,$new_group_id,1))
            {
				add_recent(1,$group_category_id,$new_group_id,$teacher_id);

				// ��������
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test_results&test_id=".$test_id."&new_group_id=".$new_group_id."'>";
            }
			else
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&next_action=return_test_results&page=group&test_id=".$test_id."&group_id=".$group_id."&group_category_id=".$group_category_id."&status_code=0&status_num=op_permited'>";
		break;

		case "print_ver":
			if(isset($_REQUEST['test_id']))
				$test_id = intval($_REQUEST['test_id']);
			else $test_id = 0;

			if(isset($_REQUEST['group_id']))
				$group_id = intval($_REQUEST['group_id']);
			else $group_id = 0;

			if(isset($_REQUEST['f_date']))
				$f_date = $_REQUEST['f_date'];
			else
				$f_date = array("y"=>date("Y"),
								"m"=>date("m"),
								"d"=>date("d"));

			if(isset($_REQUEST['t_date']))
				$t_date = $_REQUEST['t_date'];
			else
				$t_date = array("y"=>date("Y"),
								"m"=>date("m"),
								"d"=>date("d"));
            if(isset($_REQUEST['tmp_m_simple']))
				$tmp_m_simple = $_REQUEST['tmp_m_simple'];
			else
				$tmp_m_simple = 0;

			if(isset($_REQUEST['tmp_t_simple']))
				$tmp_t_simple = $_REQUEST['tmp_t_simple'];
			else
				$tmp_t_simple = 0;

			if(isset($_REQUEST['tmp_t_out']))
				$tmp_t_out = $_REQUEST['tmp_t_out'];
			else
				$tmp_t_out = 0;

			if(isset($_REQUEST['tmp_m_out']))
				$tmp_m_out = $_REQUEST['tmp_m_out'];
			else
				$tmp_m_out = 0;


				if($new_teacher_id>0)
					$query_add = " AND r.teacher_id='".$new_teacher_id."'
									AND r.teacher_id=ta.teacher_id ";
				else
					$query_add = "";

				$_f_date = mktime(0,0,0,$f_date['m'],$f_date['d'],$f_date['y']);
				$_t_date = mktime(0,0,0,$t_date['m'],$t_date['d'],$t_date['y']);

				if ($_f_date!=$_t_date) {
					$query_add .= " AND UNIX_TIMESTAMP(stop_datetime)>=$_f_date AND UNIX_TIMESTAMP(stop_datetime)<=$_t_date ";
				}
                $group_name=_SELECTION_ALL_TESTS;
				$date_where = "";
				if ($_f_date!=$_t_date) {
					$date_where = " AND UNIX_TIMESTAMP(stop_datetime)>=$_f_date AND UNIX_TIMESTAMP(stop_datetime)<=$_t_date ";
				}

				if ($group_id>0)
					{						$results = sql_query("SELECT DISTINCT result_id, user_name, user_disable, start_datetime, stop_datetime,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									  	FROM users u, results r, test_access ta
 									    WHERE u.user_id = r.user_id
 									    AND ta.test_id = r.test_id
 									    AND ta.group_id=r.group_id
									    AND r.test_id = '".$test_id."'
									    AND r.group_id = '".$group_id."'$query_add $date_where
    								    ORDER BY ".$field." ".$order);
    					$group_name = sql_single_query("SELECT group_name FROM groups WHERE group_id=$group_id");
    				}

                else
               		$results = sql_query("SELECT DISTINCT result_id, user_name, user_disable, start_datetime, stop_datetime,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									    FROM users u, results r, test_access ta
 									    WHERE u.user_id = r.user_id
 									    AND ta.test_id = r.test_id
                                        AND ta.test_id=r.test_id
                                        AND ta.group_id=r.group_id
									    AND r.test_id = '".$test_id."'$query_add $date_where
									    ORDER BY ".$field." ".$order);

            if ($group_id>0)
            	 $group_name = $group_name['group_name'];
			$test_group = sql_single_query("SELECT test_name FROM tests WHERE test_id=$test_id");


			$page_buf .="<table cellpadding='2' cellspacing='0'>
			<tr>
				<td>"._GROUP.":&nbsp;".$group_name."</td>
				<td style='padding-left: 25'>M = $tmp_m_simple</td>
				<td style='padding-left: 25'>M* = $tmp_m_out</td>

			</tr>
			<tr>
				<td>"._TEST.":&nbsp;".$test_group['test_name']."</td>
				<td style='padding-left: 25'>SIGMA = $tmp_t_simple</td>
				<td style='padding-left: 25'>SIGMA* = $tmp_t_out</td>
			</tr>
			<tr>
				<td colspan='3'>"._UNIT_SCALE.": $ball_num</td>
			</tr>
			</table>";



   			$page_buf .=   "<table cellpadding='2' cellspacing='0' class='results'>
								<tr class='tab' align='center'>
									<td width='10%' >"._NUMBER."</td>
									<td width='40%'>"._NAME."</td>
                                    <td width='20%'>"._START_TIME."</td>
                                    <td>"._TEST_TIME."</td>
                                    <td>"._TEACHER."</td>
                                    <td>"._QUESTIONS_NUM."</td>
                                    <td>"._TOTAL_UNIT."</td>
									<td width='10%'>"._PERCENT_SIMPLE."</td>
									<td width='10%'>"._PERCENT."</td>
									<td width='10%'>"._MARK."</td>
								</tr>";
					$i=0;
					$tmp_mark=0.0;
					$tmp_arr[]=0.0;
					$tmp_mark_simple=0.0;
					$tmp_arr_simple[]=0.0;
					$tmp_squared=0.0;
					$tmp_squared_simple=0.0;
					$tmp_t=0.0;
					$tmp_m=0.0;
					$tmp_t_simple=0.0;
					$tmp_m_simple=0.0;

                    if ($group_id>0)
						$marks_values = sql_query("SELECT DISTINCT result_id, user_name, user_disable,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									  FROM users u, results r, test_access ta
 									  WHERE u.user_id = r.user_id
 									   AND ta.test_id = r.test_id
 									   AND ta.group_id=r.group_id
 									   AND ta.test_id=r.test_id
									   AND r.test_id = '".$test_id."'
									   AND r.group_id = '".$group_id."'$query_add

									  ORDER BY ".$field." ".$order);
					else
						$marks_values = sql_query("SELECT DISTINCT result_id, user_name, user_disable,
										mark, percent, percent_simple, r.teacher_id, total_unit, num_questions
									  FROM users u, results r, test_access ta
 									  WHERE u.user_id = r.user_id
 									   AND ta.test_id = r.test_id

 									   AND ta.test_id=r.test_id
									   AND r.test_id = '".$test_id."'
									  $query_add

									  ORDER BY ".$field." ".$order);
                    $tmp_counts=0;
                     while($marks_values_data = mysql_fetch_assoc($marks_values))
					{
						$tmp_mark+=$marks_values_data['percent'];
						$tmp_arr[$tmp_counts]= $marks_values_data['percent'];
						$tmp_mark_simple+=$marks_values_data['percent_simple'];
						$tmp_arr_simple[$tmp_counts] = $marks_values_data['percent_simple'];
						$tmp_counts++;
					}
					$tmp_m = $tmp_mark/$tmp_counts;
					$tmp_m_simple = $tmp_mark_simple/$tmp_counts;
					for ($a=0;$a<$tmp_counts;$a++)
					{
                       $tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
                       $tmp_squared_simple+=pow($tmp_arr_simple[$a]-$tmp_m_simple,2);
					}

					 if ($tmp_counts>1)
						{
							$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
							$tmp_t_simple = sqrt($tmp_squared_simple/($tmp_counts-1));
						}
					 else
					 	{
					 		$tmp_t=16.7;
					 		$tmp_t_simple=16.7;
					 	}
   					 $tmp_m_out = sprintf ("%01.2f", $tmp_m);
      				 $tmp_t_out = sprintf ("%01.2f", $tmp_t);
   					 $tmp_m_simple = sprintf ("%01.2f", $tmp_m_simple);
      				 $tmp_t_simple = sprintf ("%01.2f", $tmp_t_simple);




			while ($marks = mysql_fetch_assoc($results)) {
				$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");

				// mark calculateing with new algorithm =============================
						$_percent = $marks['percent'];
						if ($_percent <= 2)
						{
							$x=-1.92;
						} elseif ($_percent >= 98)
						{
							$x=1.92;
						}

						if ($tmp_t>0)
                       	{                       		$x = ($_percent - $tmp_m)/($tmp_t);
                       		if ($x>1.92)
								$x=1.92;
							if ($x<-1.92)
								$x=-1.92;
							$percentile = sql_single_query("SELECT proc FROM percentile WHERE value>=$x ORDER BY value ASC, proc ASC LIMIT 0,1");
							$percentile = $percentile['proc'];
						}
                       	else
                       		$percentile = 0;



				$marks['_mark'] = ceil($percentile * $ball_num / 100);
				if ($ball_num == 4) {
					++$marks['_mark'];
				}
				//===================================================================

				$page_buf .=   "<tr align='center'>
									<td>".++$i."</td>
									<td align='left'>".$marks['user_name']."</td>
                                    <td>".substr($marks['start_datetime'],0,strlen($marks['start_datetime'])-3)."</td>
                                    <td>".round(((strtotime($marks['stop_datetime'])-strtotime($marks['start_datetime']))/60),2)." мин</td>
                                    <td nowrap>".$teacher_name['name']."</td>
                                    <td>".$marks['num_questions']."</td>
                                    <td>".$marks['total_unit']."</td>
									<td>".$marks['percent_simple']."</td>
									<td>".$marks['percent']."</td>
									<td>".$marks['_mark']."</td>
								</tr>";
                   }
            $page_buf .= "</table>";


			break;
	}

	echo $page_buf;

?>