<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");
		
$orders = array("ASC"=>"DESC","DESC"=>"ASC");
	
if(isset($_REQUEST['action']))
	$action = $_REQUEST['action'];
else $action = "";
	
if(isset($_REQUEST['new_teacher_id']))
	$new_teacher_id = intval($_REQUEST['new_teacher_id']);
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

	@$check_item=$_REQUEST['check_item'];

	@$graph_style=$_REQUEST['graph_style'];
	@$approx_step=$_REQUEST['approx_step'];
	if ($approx_step=="")
		{$approx_step=1;}
	@$combined_mode=$_REQUEST['combined_mode'];
	if ($combined_mode=="")
		{$combined_mode=0;}
	
	themeleftbox(_VIEWING_RESULTS,"","",true);
	
	$page_buf = "<tr><td>";	
		
switch($action) {
		default:					
			if($group_id<=0)
			{
				$result_test = sql_query("SELECT DISTINCT test_id, test_name, test_category_name
										  FROM recent_objects, tests, test_categories
										  WHERE test_id = object_id
											AND object_code =0
											AND test_categories.test_category_id = object_category_id
											AND recent_objects.user_id = '$teacher_id' 
											ORDER BY last_used DESC");
			}
			else
			{
				$result_test = sql_query("SELECT DISTINCT tests.test_id, test_name, test_category_name
										  FROM results, tests, test_categories
										  WHERE results.test_id = tests.test_id											
											AND results.group_id='$group_id'
											AND test_categories.test_category_id = tests.test_category_id
											AND (results.teacher_id = '$teacher_id' OR hide_result='0')");
			}

			if($test_id<=0)
			{
				$result_group = sql_query("SELECT DISTINCT group_id, group_name, group_category_name
										   FROM recent_objects, groups, group_categories
										   WHERE group_id = object_id
											AND object_code =1
											AND group_categories.group_category_id = object_category_id
											AND user_id = '$teacher_id'
											ORDER BY last_used DESC");			
			}
			else
			{
				$result_group = sql_query("SELECT DISTINCT groups.group_id, group_name, group_category_name
										   FROM results, groups, group_categories
										   WHERE results.group_id = groups.group_id
											AND results.test_id='$test_id'
											AND group_categories.group_category_id = groups.group_category_id
											AND (results.teacher_id = '$teacher_id' OR hide_result='0')");			
			}			

			$page_buf .=   "<form method='post' name='selection' id='selection' action='index.php?module=".$module."&page=gystograms'>
							<input type='hidden' id='form_action' name='action' value=''>
							<input type='hidden' name='order' value='".$order."'>
							<input type='hidden' name='field' value='".$field."'>
							<table width=100% border=0>
								<tr align='center'>
									<td></td>
									<td>"._SELECTION_TEST."</td>
									<td>"._SELECTION_GROUP."</td>
									<td></td>
									<td>"._TEACHER."</td>
								</tr>
								<tr align='center'>
									<td>
										<a href='index.php?module=".$module."&page=t_category&next_action=return_gystograms&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_TEST."</a>
									</td>
									<td><input type='hidden' name='test_id' value=".$test_id.">
										<select  name='new_test_id' onchange='document.selection.submit();'>
											<option value=0></option>";
			while($row = mysql_fetch_assoc($result_test))
				$page_buf .=  "<option value=".$row['test_id']." ".($test_id==$row['test_id']?'selected':'').">".$row['test_category_name']."/".$row['test_name']."</option>";
			
			$page_buf .=		   "</td>
									<td><input type='hidden' name='group_id' value=".$group_id.">
										<select  name='new_group_id' onchange='document.selection.submit();'>
											<option value=0></option>";
			while($row = mysql_fetch_assoc($result_group))
				$page_buf .=  "<option value=".$row['group_id']." ".($group_id==$row['group_id']?'selected':'').">".$row['group_category_name']."/".$row['group_name']."</option>";
		
			$page_buf .=		   "</td>
									<td>
										<a href='index.php?module=".$module."&page=g_category&next_action=return_gystograms&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_GROUP."</a>
									</td>";
			
			if($test_id >0 && $group_id >0)
			{
				$teachers = sql_query("SELECT DISTINCT teacher_id, user_name
									   FROM results, users
									   WHERE test_id='$test_id'
									   AND results.group_id='$group_id'
									   AND users.user_id=results.teacher_id
									   AND hide_result=0");
									   
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
					$teachers_opts=$teacher['user_name'];
				}
			}
			else
				$teachers_opts=$GLOBALS['auth_result']['user']['user_name'];			


			$page_buf .=		"<td>".$teachers_opts."</td></tr>
							</table>";
			
			if($test_id >0 && $group_id >0)
			{
				if($new_teacher_id>0)
					$query_add = " AND teacher_id='$new_teacher_id' ";
				else
					$query_add = "";
					
									
				$results = sql_query("SELECT user_name, user_disable, start_datetime, 
										mark, percent, percent_simple, teacher_id, total_unit
									  FROM users, results
									  WHERE users.user_id = results.user_id								   
									   AND test_id = '$test_id'
									   AND results.group_id = '$group_id' $query_add
									   
									  ORDER BY ".$field." ".$order);
			
				if(mysql_num_rows($results) == 0)
				{					
					if(get_count($group_id,3,false)>0)
						$page_buf .= "<center><b>"._NO_TESTED_USERS."</b></center>";
					else
						$page_buf .= "<div align='center'><strong>"._NO_USERS."</strong></div>";					
				}
				else				
				{	
				$page_buf .= "<script>
							function change_order(ord_field,ord_order)
							{
								document.forms.selection.elements.field.value=ord_field;
								document.forms.selection.elements.order.value=ord_order;
								document.forms.selection.submit();
							}
						</script>";
			
				// -- Building main graph by active comboboxes
				$i=0;
				$data=array();
				$data2=array();
				
				for ($i=0;$i<=100;$i+=$approx_step)
					{
					$data2[$i]="";
					}
				$data2[0]=0;$data2[100]=0;
				while($marks = mysql_fetch_assoc($results))
				{
				$data2[round($marks['percent']/$approx_step)*$approx_step]++;
				}
				for ($i=0;$i<=100;$i+=$approx_step)
					{
					if ($graph_style=="bars")
						{
							$label="$i";

						$data[]=array($label,$data2[$i]);}
					else 
						{$data[]=array("",$i,$data2[$i]);}
					}

				//-- mergining all results from session
				if (@count($_SESSION['datas'])>=1)	
					{
					$page_buf .=  "<br>
					<center>"._ADDITIONAL_RESULTS_ON_GRAPH."</center>
					

					<table width=100%>
						<tr class='tab'>
							<td style='width:10px;' nowrap=1>"._GRAPH_NUMBER."</td>
							<td>"._SELECTION_TEST."</td>
							<td>"._SELECTION_GROUP."</td>
							<td>"._TEACHER."</td>
							<td>"._CHECK_ITEMS."</td>
						</tr>
						";
					$counter=0;
					foreach ($_SESSION['datas'] as $session_data)
						{
						$f_test=mysql_fetch_array(sql_query("select * from tests where test_id='".$session_data['test_id']."' "));
						$f_group=mysql_fetch_array(sql_query("select * from groups where group_id='".$session_data['group_id']."' "));
						
						if (@$session_data['new_teacher_id']==0)
							{$f_teacher['user_name']=_ALL_TEACHERS;}
						else 	
							{$f_teacher=mysql_fetch_array(sql_query("select * from users where user_id='".$session_data['new_teacher_id']."' "));};
						// draw saved graphs in session	
						$page_buf .=  "
						<tr style='color:gray'>
							<td  style='color:gray'>".($counter+1)."</td>
							<td  style='color:gray'>".$f_test['test_name']."</td>
							<td  style='color:gray'>".$f_group['group_name']."</td>
							<td  style='color:gray'>".$f_teacher['user_name']."</td>
							<td  style='color:gray'><input type=checkbox name='check_item[".$counter."]' value='".$counter."'></td>
						</tr>						
						
							";
						
						for ($i=0;$i<=100;$i+=$approx_step)
							{
							$sess_data2[$i]="";
							}
						if(!$combined_mode) {$sess_data2[0]=0;$sess_data2[100]=0;}
						if(@$session_data['new_teacher_id']>0)
							$sess_query_add = " AND teacher_id='".$session_data['new_teacher_id']."' ";
						else
							$sess_query_add = "";
						$sess_results = sql_query("SELECT user_name, user_disable,  
								mark, percent, percent_simple, teacher_id, total_unit
							  FROM users, results
							  WHERE users.user_id = results.user_id								   
							   AND test_id = '".$session_data['test_id']."'
							   AND results.group_id = '{$session_data['group_id']}' $sess_query_add
							   ");	
						while($sess_marks = mysql_fetch_assoc($sess_results))
							{
							$sess_data2[round($sess_marks['percent']/$approx_step)*$approx_step]++;
							}
						for ($i=0;$i<=100;$i+=$approx_step)
							{
							if($combined_mode=='1' )
								{
								if ($sess_data2[$i]!="")
									{
									if ($graph_style=="bars")
										{$data[$i/$approx_step][1]+=$sess_data2[$i];}
									else 
										{$data[$i/$approx_step][2]+=$sess_data2[$i];}
									}
								}
							else
								{
								array_push($data[$i/$approx_step],$sess_data2[$i]);
								}
							}										
						$counter++;
						}
					$page_buf .= "</table>";
					}

				$page_buf .=   "<br>
				<a href='javascript:{selection.form_action.value=\"add_additional_results\";selection.submit();void(0);}'>
				<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c12.gif' align=absmiddle> 
				"._ADD_ADDITIONAL_RESULTS."</a>
				&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;				
				<a href='javascript:{selection.form_action.value=\"delete_checked\";selection.submit();void(0);}'>
				<img  class='img_icon' src='themes/opentest2/images/icons/trinux-sb_r2_c14.gif' align=absmiddle> 
				"._DELETE_CHECKED_RESULTS."</a>
				 <br>
				";				
				
					
					
				$_SESSION['data']=$data;
				$_SESSION['approx_step']=$approx_step;
				$_SESSION['combined_mode']=$combined_mode;
				
				
				
				if ($graph_style=="")
					{$graph_style="linepoints";}
				$_SESSION['graph_style']=$graph_style;
				$graph_style_selected[$graph_style]="selected";
				
				$approx_step_selected[$approx_step]="selected";
				$combined_mode_selected[$combined_mode]="selected";
				
				$page_buf .= "<br
				<center>
				<img src='index.php?module=".$module."&page=show_graph1&donot_show_headers=1'>
				</center>
				<br><br>
				<center>
				"._DYSPLAY_GRAPH_OPTIONS."
				</center>
				<br>
				"._GRAPH_STYLE.":  
				<select name='graph_style'>
					<option value='linepoints' ".@$graph_style_selected['linepoints'].">"._LINEPOINTS."</option>
					<option value='bars' ".@$graph_style_selected['bars'].">"._BARS."</option>
					<option value='thinbarline' ".@$graph_style_selected['thinbarline'].">"._THINBARS."</option>
					<option value='points' ".@$graph_style_selected['points'].">"._POINTS."</option>
					<option value='squared' ".@$graph_style_selected['squared'].">"._SQUARED."</option>
					<option value='area' ".@$graph_style_selected['area'].">"._AREA."</option>
				</select>
				&nbsp; &nbsp; &nbsp; 
				
				"._APPROX_STEP.":  
				<select name='approx_step'>
					<option value='1' ".@$approx_step_selected[1].">1 "._BAL."</option>
					<option value='2' ".@$approx_step_selected[2].">2 "._BAL."</option>
					<option value='4' ".@$approx_step_selected[4].">4 "._BALA."</option>
					<option value='5' ".@$approx_step_selected[5].">5 "._BALS."</option>
					<option value='10' ".@$approx_step_selected[10].">10 "._BALS."</option>
					<option value='20' ".@$approx_step_selected[20].">20 "._BALS."</option>
				</select>
				&nbsp; &nbsp; &nbsp; 
				"._DYSPLAY_MODE.":  
				<select name='combined_mode'>
					<option value='0' ".@$combined_mode_selected[0].">"._DYSPLAY_SEPARATED_GRAPHS."</option>
					<option value='1' ".@$combined_mode_selected[1].">"._DYSPLAY_COMBINED_GRAPH."</option>
				</select>
				
				
				
				<br>
				<input type='submit' value='"._REFRESH."'>
				";
				}
			}			
			else
				$page_buf .= "
				</form>
				<center><b>"._CHOOSE."</b></center>";
		break;
		
		case "add_new_test":
			if(is_allow(12,$test_category_id,$new_test_id,1))
			{
				add_recent(0,$test_category_id,$new_test_id,$teacher_id);
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=gystograms&test_id=".$new_test_id."&group_id=".$group_id."'>";
			}
			else
			
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&next_action=return_gystograms&page=test&test_id=".$test_id."&group_id=".$group_id."&test_category_id=".$test_category_id."&status_code=0&status_num=op_permited'>";
		break;

		case "add_new_group":
			if(is_allow(14,$group_category_id,$new_group_id,1))
            		{
				add_recent(1,$group_category_id,$new_group_id,$teacher_id);
	
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=gystograms&test_id=".$test_id."&group_id=".$new_group_id."'>";
            		}
			else				
				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&next_action=return_gystograms&page=group&test_id=".$test_id."&group_id=".$group_id."&group_category_id=".$group_category_id."&status_code=0&status_num=op_permited'>";
		break;
		case "add_additional_results":
			$_SESSION['datas'][]=$_POST;
			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=gystograms&new_test_id=".$test_id."&new_group_id=".$group_id."'>";
		break;
		case "delete_checked":
			if (count($check_item>=1))
				{
				foreach($check_item as $item)
					{
					unset($_SESSION['datas'][$item]);
					}
				}
			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=gystograms&new_test_id=".$test_id."&new_group_id=".$group_id."'>";

		break;
	}
echo $page_buf;