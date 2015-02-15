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

	//print_r($GLOBALS);

	$orders = array("ASC"=>"DESC",
					"DESC"=>"ASC");

	//-- ?????????? ? ???????? ???????? ??????????
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
	if(isset($_REQUEST['groups_list_id']))
		$groups_list_id = $_REQUEST['groups_list_id'];
	else
		$groups_list_id = "";
	if(isset($_REQUEST['tests_list_id']))
		$tests_list_id = $_REQUEST['tests_list_id'];
	else
		$tests_list_id = "";
	if(isset($_REQUEST['selector_value']))
		$selector_value = $_REQUEST['selector_value'];
	else
		$selector_value = "";

		if ($action!="test_parameters")
			themeleftbox(_MENU_SHOW_TESTS,"","",true);

	$page_buf = "<tr><td>";


	switch($action)
	{
		default:
			$page_buf .=   "<form method='post' name='selection' action='index.php?module=".$module."&page=test_list' onsubmit='SubmitGroups()'>
							<input type='hidden' name='order' value='".$order."'>
							<input type='hidden' name='field' value='".$field."'>
							<table width=100% border=0>
								<tr align='center'>
                                   <td></td>
									<td nowrap>  "._FROM.": <select name='f_date[y]'>";
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

			$page_buf .="		</select></td><td> "._TO.":
									<!--//<td nowrap> ://--><select name='t_date[y]'>";
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
					AND test_categories.test_category_id = tests.test_category_id".$date_where."
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
					AND group_categories.group_category_id = groups.group_category_id".$date_where."
					AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			/*if($group_id<=0)
			{
				$result_test = sql_query("SELECT DISTINCT tests.test_id, test_name, test_category_name
										  FROM results, tests, test_categories
										  WHERE results.test_id = tests.test_id
											AND test_categories.test_category_id = tests.test_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");

			}
			else
			{
				$result_test = sql_query("SELECT DISTINCT tests.test_id, test_name, test_category_name
										  FROM results, tests, test_categories
										  WHERE results.test_id = tests.test_id
											AND results.group_id='".$group_id."'
											AND test_categories.test_category_id = tests.test_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			}

			if($test_id<=0)
			{
				$result_group = sql_query("SELECT DISTINCT groups.group_id, group_name, group_category_name
										   FROM results, groups, group_categories
										   WHERE results.group_id = groups.group_id
											AND group_categories.group_category_id = groups.group_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			}
			else
			{
				$result_group = sql_query("SELECT DISTINCT groups.group_id, group_name, group_category_name
										   FROM results, groups, group_categories
										   WHERE results.group_id = groups.group_id
											AND results.test_id='".$test_id."'
											AND group_categories.group_category_id = groups.group_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
			}*/


			               $page_buf .= "<td><input type='button' value="._REFRESH." onclick='document.selection.submit();'></td>
			                             <td><input type='button' id='btnClean' onclick='ClearAll()' value='C' style='width:50%' /> </td>
			               </td></tr>";
			                $page_buf .= "<tr align='center'>
			                		<td></td>
			                		<td width='65%'>"._SELECTION_TEST."</td>
									<td width='35%'>"._SELECTION_GROUP."</td>
									<td></td>
									<td>"._TEACHER."</td>


								</tr>
								<tr align='center' width='100%'>";
							$page_buf .= "
							    <td>
									<a href='index.php?module=".$module."&page=t_category&next_action=return_test_list_results&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_TEST."</a>
								</td>

							<td><input type='hidden' name='test_id' value=".$test_id.">
							<input type='hidden' name='tests_list_id' value='0' id='tests_list_id'>
										<select  name='new_test_id' id='new_test_id' onchange='document.selection.submit();' style='width:94%'>
											<option value=0>"._CHOOSE_TEST."</option>";
            /*$all_tests_selected = "";
			if ($test_id==0&&$new_test_id>0)
				$all_tests_selected="selected";  */
			while($row = mysql_fetch_assoc($result_test))
				{
					$page_buf .=  "<option value=".$row['test_id']." ".($test_id==$row['test_id']?'selected':'').">".$row['test_category_name']."/".$row['test_name']."</option>";
				}
				//$page_buf .=  "<option value='0' ".$all_tests_selected.">"._ALL_TESTS."</option>";

                        $page_buf .="<script>
                         resulted=0;
                         function ClearAll()
                         {
                            getHidden = '';

                            getSelect = document.getElementById('SelectedGroups');
                         	getSelect.length=0;
                         	getSelect = document.getElementById('btn_add');
                         	getSelect.disabled=false;
                         	getSelect = document.getElementById('btnAddTest');
                         	getSelect.disabled=false;
                         	getSelect = document.getElementById('groups_list_id');
                         	getSelect.value=0;
                         	getSelect = document.getElementById('tests_list_id');
                         	getSelect.value='0';
                         	selector = document.getElementById('selector_value');
	                       	selector.value='';
                         }



                         function AddGroup()
                         {                         	  wasResult = document.getElementById('was_result');
                         	  getSelect = document.getElementById('SelectedGroups');
                         	  if (wasResult!=null && wasResult!=undefined)
                         	  	if (resulted==0)
                         	  	    {
                         	  	    	getSelect.length=0;
                         	  	    	resulted=1;
                         	  	    }                         	  selector = document.getElementById('selector_value');
	                       	  selector.value='group';                         	  someList = document.getElementById('new_group_id');
                         	  if (someList.options[someList.selectedIndex].value==-1 || someList.options[someList.selectedIndex].value==0)
                              		return null;
                         	  testList = document.getElementById('new_test_id');
                         	  testList.onchange = '';
                         	  deactivator = document.getElementById('btnAddTest');
                              deactivator.disabled = true;
                              groupList = document.getElementById('new_group_id');


                              getHidden = document.getElementById('groups_list_id');
                              if (groupList.selectedIndex>0)
                              {
                              	for (i=0;i<getSelect.length;i++)
                              		if (getSelect.options[i].value == groupList.options[groupList.selectedIndex].value)
                              			return null;
                              	opt=document.createElement('OPTION');
	                        	opt.value = groupList.options[groupList.selectedIndex].value;
                              	opt.text = groupList.options[groupList.selectedIndex].text;
                              	getSelect.options[getSelect.options.length] = opt;
                              	if (getHidden.value=='0')
                              		getHidden.value= opt.value+',';
                              	else
                              	    getHidden.value+= opt.value+',';
                              }
                         }

                         function AddTest()
                         {                         	  wasResult = document.getElementById('was_result');
                          	  getSelect = document.getElementById('SelectedGroups');
                         	  if (wasResult!=null && wasResult!=undefined)                         	  	if (resulted==0)
                         	  	    {                         	  	    	getSelect.length=0;
                         	  	    	resulted=1;
                         	  	    }
	                       	  selector = document.getElementById('selector_value');
	                       	  selector.value='test';                         	  someList = document.getElementById('new_group_id');

                              testList = document.getElementById('new_test_id');
                         	  if (testList.options[testList.selectedIndex].value==-1 || testList.options[testList.selectedIndex].value==0)
                              		return null;
                         	  testList.onchange = '';

                              deactivator = document.getElementById('btn_add');
                              deactivator.disabled = true;
                              testList = document.getElementById('new_test_id');
                              //getSelect = document.getElementById('SelectedTests');

                              getHidden = document.getElementById('tests_list_id');
                              if (testList.selectedIndex>0)
                              {
                              	for (i=0;i<getSelect.length;i++)
                              		if (getSelect.options[i].value == testList.options[testList.selectedIndex].value)
                              			return null;
                              	opt=document.createElement('OPTION');
	                        	opt.value = testList.options[testList.selectedIndex].value;
                              	opt.text = testList.options[testList.selectedIndex].text;
                              	getSelect.options[getSelect.options.length] = opt;
                              	if (getHidden.value=='0')
                              		getHidden.value= opt.value+',';
                              	else
                              	    getHidden.value+= opt.value+',';
                              }
                         }

                         function SubmitGroups()
                         {
                         	getHidden = document.getElementById('groups_list_id');
                         	getSelect = document.getElementById('SelectedGroups');
                            if (getSelect.length==0)
                            	getHidden.value=0;
                            else
                            	getHidden.value=getSelect.options[0].value;
                         }
           				 </script>";
			$page_buf .=		   "<input type='button' id='btnAddTest' onclick='AddTest()' value='+' style='width:6%'/>
									</td>
									<td><input type='hidden' name='group_id' value=".$group_id." id='group_id'>
									<input type='hidden' name='groups_list_id' value='0' id='groups_list_id'>
									<input type='hidden' name='selector_value' value='' id='selector_value'>
										<select name='new_group_id' id='new_group_id' style='width:90%'>
											<option value=-1>"._CHOOSE_GROUP."</option>";
											//<option value=\"-1\">"._CHOOSE_GROUP."</option>";// onchange='document.selection.submit();'

			while($row = mysql_fetch_assoc($result_group))
				$page_buf .=  "<option value=".$row['group_id']." ".($group_id==$row['group_id']?'selected':'').">".$row['group_category_name']."/".$row['group_name']."</option>";


    		if (mysql_num_rows($result_group)>0)
    		{    			$all_groups_selected = "";
				if ($new_group_id==0)
					$all_groups_selected="selected";
    			$page_buf .=  "<option value='0' ".$all_groups_selected.">"._SELECTION_ALL_TESTS."</option>";
    		}

			$page_buf .=		   "<input type='button' id='btn_add' onclick='AddGroup()' value='+' style='width:10%'/>
									</td>
									<td>
										<a href='index.php?module=".$module."&page=g_category&next_action=return_test_list_results&test_id=".$test_id."&group_id=".$group_id."'>"._NEW_GROUP."</a>
									</td>";


			$teachers_opts=$GLOBALS['auth_result']['user']['user_name'];

			$page_buf .=		"</td><td>".$teachers_opts."</td></tr><tr>";

			$page_buf .="<td></td>
				<td align='center' colspan='2'>"._CHOOSED_OBJECTS."<br />
					<select name='SelectedGroups' id='SelectedGroups' multiple='multiple' style='width:60%'>";
                    if ($groups_list_id!=0)
                	{
                		$filling_group_array = explode(",",$groups_list_id);
						if ($filling_group_array[0]!=0)
						{
                            $filling_group_count =  count($filling_group_array);
                            for ($tim=0;$tim<$filling_group_count-1;$tim++)
                            {
                            	 $result_group_list = sql_query("SELECT DISTINCT group_id, group_name, group_category_name
                            	 								FROM groups, group_categories
                            	 								WHERE groups.group_id=".$filling_group_array[$tim]."
                            	 								AND groups.group_category_id = group_categories.group_category_id
                            	 								");
                            	 while($row = mysql_fetch_assoc($result_group_list))
									$page_buf .=  "<option value=".$row['group_id']." ".($group_id==$row['group_id']?'selected':'').">".$row['group_category_name']."/".$row['group_name']."</option>";

                            }

						}
					}
					else
					if ($tests_list_id!=0)
                	{
                		$filling_test_array = explode(",",$tests_list_id);
						if ($filling_test_array[0]!=0)
						{
      						$filling_test_count =  count($filling_test_array);
                            for ($tim=0;$tim<$filling_test_count-1;$tim++)
                            {
                            	 $result_test_list = sql_query("SELECT DISTINCT test_id, test_name, test_category_name
                            	 								FROM tests, test_categories
                            	 								WHERE tests.test_id=".$filling_test_array[$tim]."
                            	 								AND tests.test_category_id = test_categories.test_category_id
                            	 								");
                                 while($row = mysql_fetch_assoc($result_test_list))
								 	  $page_buf .=  "<option value=".$row['test_id']." ".($test_id==$row['test_id']?'selected':'').">".$row['test_category_name']."/".$row['test_name']."</option>";

                            }
				   		}
					 }

			$page_buf .="<script language='JavaScript'>
							getSelect = document.getElementById('SelectedGroups');
							getSelect.length==0
							getSelector = document.getElementById('selector_value');
	     				 </script>
                         ";
			$page_buf .="</select>
										<input type='button' value='>' name='btnShow' onclick='document.selection.submit();' style='width:5%' />
									</td>
								</tr>
							</table>
						</form>";

           //     echo($group_id);

			if($test_id >=0 && $group_id >=0)
			{
					$page_buf .= "<script>
							function change_order(ord_field,ord_order)
							{
								document.forms.selection.elements.field.value=ord_field;
								document.forms.selection.elements.order.value=ord_order;
								document.forms.selection.submit();
							}
							</script>";
					$selector = $selector_value;

                if ($groups_list_id!=0)
                	{                		$selector = "group";                		$group_array = explode(",",$groups_list_id);
						if ($group_array[0]!=0)
						{
							$group_array_count = count($group_array);
						}
					}
				else
					if ($tests_list_id!=0)
                	{   $selector = "test";                		$test_array = explode(",",$tests_list_id);
						if ($test_array[0]!=0)
						{
							$test_array_count = count($test_array);
				   		}
					 }
			   $global_counter=0;
			   $tmp_m_overall=0;
			   $tmp_t_overall=0;
			   $tmp_count_overall=0;
			   $tmp_mark_overall=0;
			   $tmp_arr_overall[]=0.0;
			   if((isset($test_array_count)&&$new_group_id>=0)||(isset($group_array_count)&&$new_test_id>0))
               if ($selector!="")
               {
               		flush();
               		if ($selector=="group")
               		{               			$result_for_check_collision =-1;
               			if ($test_id>0)
	               			{	               				$result_for_check_collision = sql_query("SELECT distinct result_id
	               														FROM  results
	               														WHERE results.group_id = ".$group_id." and results.test_id = ".$test_id.$date_where."");
	               				$result_for_check_collision = mysql_num_rows($result_for_check_collision);
	               			}
		               else
		               		$result_for_check_collision = 1;
               			if (mysql_num_rows($result_group)>0 && $result_for_check_collision>0)
               			{	$page_buf .=   "<table width='100%' border=0>
                    						<input type='hidden' name='was_result' value='was_result' id='was_result'>
											<tr class='tab' align='center'>
											<td width='5%'>"._NUMBER."</td>
											<td width='30%'>"._TEST_NAME."</td>
                                            <td>"._GROUP_NAME."</td>
                                            <td>"._START_TIME."</td>
											<td>"._TEACHER."</td>
											<td width='5%'>"._COUNT_USERS."</td>
											<td width='5%'>M</td>
											<td width='5%'>SIGMA</td>
										</tr>";
							for($tim=0;$tim<$group_array_count-1;$tim++)
							{						   if($new_teacher_id>0)
								$query_add = " AND teacher_id='".$new_teacher_id."' ";
						   else
								$query_add = "";

                           if($test_id>0)
							{
								$results = sql_query("SELECT result_id, user_name, user_disable, start_datetime,
										mark, percent, percent_simple, teacher_id, total_unit,
										results.group_id, results.test_id
                                      FROM users, results
									  WHERE users.user_id = results.user_id
									  AND test_id = ".$test_id."
									  AND results.group_id = ".$group_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);
                                if(mysql_num_rows($results)>0)
                                {
                                	$teacher_results = sql_query("SELECT DISTINCT teacher_id
                                      FROM users, results
									  WHERE users.user_id = results.user_id
									  AND test_id = ".$test_id."
									  AND results.group_id = ".$group_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);
								$tmp_mark=0.0;
								$tmp_arr[]=0.0;
								$tmp_squared=0.0;
								$tmp_t=0.0;
								$tmp_m=0.0;
	   	                 		if ($group_id>0)
									$marks_values = sql_query("SELECT mark, percent, percent_simple
									   FROM users, results
									   WHERE users.user_id = results.user_id
									   AND test_id = ".$test_id."
									   AND results.group_id = ".$group_array[$tim].$query_add."
            						   ORDER BY ".$field." ".$order);
           		 				else
           		 					$marks_values = sql_query("SELECT mark, percent, percent_simple
									   FROM users, results
									   WHERE users.user_id = results.user_id
									   AND test_id = ".$test_id."
									   ".$query_add."
            						   ORDER BY ".$field." ".$order);

                 		   		$tmp_counts=0;
                    	 		while($marks_values_data = mysql_fetch_assoc($marks_values))
								{
									$tmp_mark+=$marks_values_data['percent_simple'];
									$tmp_arr[$tmp_counts]= $marks_values_data['percent_simple'];
									$tmp_counts++;
									$tmp_mark_overall+=$marks_values_data['percent_simple'];
									$tmp_arr_overall[$tmp_count_overall] = $marks_values_data['percent_simple'];
									$tmp_count_overall++;
								}
								if ($tmp_counts>0)
									$tmp_m = $tmp_mark/$tmp_counts;
								else
									$tmp_m=0;
								for ($a=0;$a<$tmp_counts;$a++)
								{                       				$tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
								}

					 			if ($tmp_counts>1)
									$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
					 			else
					 				$tmp_t=16.7;

								$marks = mysql_fetch_assoc($results);



                           		$current_group = sql_single_query("SELECT group_name FROM groups WHERE group_id='".$marks['group_id']."'");
								$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");

								if (mysql_num_rows($teacher_results)>1)
									$teacher_name['name']=_MORE_THAN_ONE_TEACHER;
                       			$test_name = sql_single_query("SELECT test_name FROM tests WHERE test_id='".$marks['test_id']."'");
                        		$tmp_m_out = sprintf ("%01.2f", $tmp_m);
                  		      	$tmp_t_out = sprintf ("%01.2f", $tmp_t);
                  		      	++$tim;
								$page_buf .=   "<tr align='center'>
											<td>".++$global_counter."</td>
											<td width='30%'><a href=\"index.php?module=$module&page=$page&action=test_parameters&test_id=".$marks['test_id']."\" target=\"blank\">".$test_name['test_name']."</a></td>
											<td>".$current_group['group_name']."</td>
                                            <td>".$marks['start_datetime']."</td>
                                            <td>".$teacher_name['name']."</td>
                                            <td>".$tmp_counts."</td>
											<td>".$tmp_m_out."</td>
											<td>".$tmp_t_out."</td>
										</tr>";
                                        $tim--;

                             }
                           }
                           elseif ($test_id==0)
                           {
                                $current_test_count = sql_query("SELECT DISTINCT tests.test_id, test_name
										   FROM results, tests, groups, test_categories
										   WHERE results.test_id = tests.test_id
										   AND results.group_id = ".$group_array[$tim]."
										   AND test_categories.test_category_id = tests.test_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");
								while($each_result = mysql_fetch_assoc($current_test_count))	                           	{	                           		$results = sql_query("SELECT result_id, user_name, user_disable, start_datetime,
											mark, percent, percent_simple, teacher_id, total_unit,
											results.group_id, results.test_id
	                                      FROM users, results
										  WHERE users.user_id = results.user_id
										  AND test_id = ".$each_result['test_id']."
										  AND results.group_id = ".$group_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);
									$teacher_results = sql_query("SELECT DISTINCT teacher_id
	                                      FROM users, results
										  WHERE users.user_id = results.user_id
										  AND test_id = ".$each_result['test_id']."
										  AND results.group_id = ".$group_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);
									$tmp_mark=0.0;
									$tmp_arr[]=0.0;
									$tmp_squared=0.0;
									$tmp_t=0.0;
									$tmp_m=0.0;
										$marks_values = sql_query("SELECT mark, percent, percent_simple
										   FROM users, results
										   WHERE users.user_id = results.user_id
										   AND test_id = ".$each_result['test_id']."
										   AND results.group_id = ".$group_array[$tim].$query_add."
	            						   ORDER BY ".$field." ".$order);


	                 		   		$tmp_counts=0;
	                    	 		while($marks_values_data = mysql_fetch_assoc($marks_values))
									{
										$tmp_mark+=$marks_values_data['percent_simple'];
										$tmp_arr[$tmp_counts]= $marks_values_data['percent_simple'];
										$tmp_counts++;
										//$tmp_mark_overall+=$marks_values_data['percent_simple'];
										//$tmp_arr_overall[$tmp_count_overall] = $marks_values_data['percent_simple'];
										//$tmp_count_overall++;
									}
									if ($tmp_counts>0)
										$tmp_m = $tmp_mark/$tmp_counts;
									else
										$tmp_m=0;
									for ($a=0;$a<$tmp_counts;$a++)
									{
	                       				$tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
									}

						 			if ($tmp_counts>1)
										$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
						 			else
						 				$tmp_t=16.7;

									$marks = mysql_fetch_assoc($results);


	                        		$current_group = sql_single_query("SELECT group_name FROM groups WHERE group_id='".$marks['group_id']."'");
									$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");
	                       			$test_name = sql_single_query("SELECT test_name FROM tests WHERE test_id='".$marks['test_id']."'");

									if (mysql_num_rows($teacher_results)>1)
										$teacher_name['name']=_MORE_THAN_ONE_TEACHER;
	                        		$tmp_m_out = sprintf ("%01.2f", $tmp_m);
	                  		      	$tmp_t_out = sprintf ("%01.2f", $tmp_t);
	                  		      	++$tim;
									$page_buf .=   "<tr align='center'>
												<td>".++$global_counter."</td>
												<td width='30%'><a href=\"index.php?module=$module&page=$page&action=test_parameters&test_id=".$marks['test_id']."\" target=\"blank\">".$test_name['test_name']."</a></td>
												<td>".$current_group['group_name']."</td>
	                                            <td>".$marks['start_datetime']."</td>
	                                            <td>".$teacher_name['name']."</td>
	                                            <td>".$tmp_counts."</td>
												<td>".$tmp_m_out."</td>
												<td>".$tmp_t_out."</td>
											</tr>";
	                                        $tim--;
	       						}
                           }
						}
                        }
						if ($tmp_count_overall>0)
			   	   			{
			   	   				$tmp_squared=0;
			   	   				$tmp_m_overall = $tmp_mark_overall/$tmp_count_overall;
			   	   				for ($a=0;$a<$tmp_count_overall;$a++)
									{
	              	         			$tmp_squared+=pow($tmp_arr_overall[$a]-$tmp_m_overall,2);
									}
								if ($tmp_count_overall>1)
										$tmp_t_overall = sqrt($tmp_squared/($tmp_count_overall-1));
							 		else
							 			$tmp_t_overall = 16.7;

                                $tmp_m_overall = sprintf ("%01.2f", $tmp_m_overall);
		                       	$tmp_t_overall = sprintf ("%01.2f", $tmp_t_overall);
								$page_buf .= "<tr><td colspan='3'>"._OVERALL_BY_TEST.":&nbsp;M = ".$tmp_m_overall.";&nbsp;&nbsp;SIGMA = ".$tmp_t_overall."<br /></td></tr>";
			   		   			$tmp_mark_overall=0;
			   		   			$tmp_count_overall=0;
			   	   			}
						$page_buf .= "</table>";

			   	    }
			   	    elseif ($selector=="test")
			   	    {
			   	    	$first_success_result=0;

			   	    	$teacher_count=0;
			   	    	for($tim=0;$tim<$test_array_count-1;$tim++)
						{

							if($new_teacher_id>0)
								$query_add = " AND teacher_id='".$new_teacher_id."' ";
							else
								$query_add = "";
                            if ($group_id>0)
                            {
   		                   		$results = sql_query("SELECT result_id, user_name, user_disable, start_datetime,
										mark, percent, percent_simple, teacher_id, total_unit,
										results.group_id, results.test_id
                                      FROM users, results
									  WHERE users.user_id = results.user_id
									  AND results.group_id = ".$group_id.$date_where."
									  AND results.test_id = ".$test_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);
								$teacher_results  = sql_query("SELECT DISTINCT teacher_id
                                      FROM users, results
									  WHERE users.user_id = results.user_id
									  AND results.group_id = ".$group_id."
									  AND results.test_id = ".$test_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);

								if(mysql_num_rows($results)>0)
	                            {	                            	$page_buf .=   "<table width='100%' border=0>
                    						<input type='hidden' name='was_result' value='was_result' id='was_result'>
											<tr class='tab' align='center'>
											<td width='5%'>"._NUMBER."</td>
											<td width='30%'>"._TEST_NAME."</td>
                                            <td>"._GROUP_NAME."</td>
                                            <td>"._START_TIME."</td>
											<td>"._TEACHER."</td>
											<td width='5%'>"._COUNT_USERS."</td>
											<td width='5%'>M</td>
											<td width='5%'>SIGMA</td>
										</tr>";
									$first_success_result=1;
									$tmp_mark=0.0;
									$tmp_arr[]=0.0;
									$tmp_squared=0.0;
									$tmp_t=0.0;
									$tmp_m=0.0;
	            	        		if ($group_id>0)
										$marks_values = sql_query("SELECT mark, percent, percent_simple
										   FROM users, results
										   WHERE users.user_id = results.user_id
										   AND results.group_id = ".$group_id."
										   AND results.test_id = ".$test_array[$tim].$query_add."
	            						   ORDER BY ".$field." ".$order);
	            					else
	            						$marks_values = sql_query("SELECT mark, percent, percent_simple
										   FROM users, results
										   WHERE users.user_id = results.user_id
										   AND test_id = ".$test_id."
										   ".$query_add."
	            						   ORDER BY ".$field." ".$order);

	                    			$tmp_counts=0;
	                    			while($marks_values_data = mysql_fetch_assoc($marks_values))
									{
										$tmp_mark+=$marks_values_data['percent_simple'];
										$tmp_arr[$tmp_counts]= $marks_values_data['percent_simple'];
										$tmp_counts++;
										//Global calculation
										$tmp_mark_overall+=$marks_values_data['percent_simple'];
										$tmp_arr_overall[$tmp_count_overall] = $marks_values_data['percent_simple'];
										$tmp_count_overall++;
									}
									if ($tmp_counts>0)
										$tmp_m = $tmp_mark/$tmp_counts;
									else
										$tmp_m=0;

									for ($a=0;$a<$tmp_counts;$a++)
									{
	              	         			$tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
									}

							 		if ($tmp_counts>1)
										$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
							 		else
							 			$tmp_t=16.7;

		 							$marks = mysql_fetch_assoc($results);

		                        	$current_group = sql_single_query("SELECT group_name FROM groups WHERE group_id='".$marks['group_id']."'");
                                    $test_name = sql_single_query("SELECT test_name FROM tests WHERE test_id='".$marks['test_id']."'");
									$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");

                                  	if (mysql_num_rows($teacher_results)>1)
										$teacher_name['name']=_MORE_THAN_ONE_TEACHER;
		                        	$tmp_m_out = sprintf ("%01.2f", $tmp_m);
		                       	 	$tmp_t_out = sprintf ("%01.2f", $tmp_t);
		                       	 	++$tim;
									$page_buf .=   "<tr align='center'>
													<td>".++$global_counter."</td>
													<td width='30%'><a href=\"index.php?module=$module&page=$page&action=test_parameters&test_id=".$marks['test_id']."\" target=\"blank\">".$test_name['test_name']."</a></td>
													<td>".$current_group['group_name']."</td>
		                                            <td>".$marks['start_datetime']."</td>
		                                            <td>".$teacher_name['name']."</td>
		                                            <td>".$tmp_counts."</td>
													<td>".$tmp_m_out."</td>
													<td>".$tmp_t_out."</td>
												</tr>";
		                                        $tim--;
	        					}
        					}
        					elseif ($group_id==0)
							{									$current_group_count = sql_query("SELECT DISTINCT groups.group_id, group_name
										   FROM results, groups, group_categories
										   WHERE results.group_id = groups.group_id
										   AND test_id = ".$test_array[$tim]."
											AND group_categories.group_category_id = groups.group_category_id"
											.$date_where." AND (results.teacher_id = '".$teacher_id."' OR hide_result='0')");

									while($each_result = mysql_fetch_assoc($current_group_count))
									{											$results = sql_query("SELECT result_id, user_name, user_disable, start_datetime,
											mark, percent, percent_simple, teacher_id, total_unit,
											results.group_id, results.test_id
	                                        FROM users, results
										    WHERE users.user_id = results.user_id
										    AND results.group_id = ".$each_result['group_id']."
										    AND results.test_id = ".$test_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);

                                            $teacher_results = sql_query("SELECT DISTINCT teacher_id
	                                        FROM users, results
										    WHERE users.user_id = results.user_id
										    AND results.group_id = ".$each_result['group_id']."
										    AND results.test_id = ".$test_array[$tim]."".$query_add." ORDER BY ".$field." ".$order);

										    if (mysql_num_rows($results)>0 && $first_success_result==0)
										    {										    	$first_success_result=1;
										    	$page_buf .=   "<table width='100%' border=0>
                    						<input type='hidden' name='was_result' value='was_result' id='was_result'>
											<tr class='tab' align='center'>
											<td width='5%'>"._NUMBER."</td>
											<td width='30%'>"._TEST_NAME."</td>
                                            <td>"._GROUP_NAME."</td>
                                            <td>"._START_TIME."</td>
											<td>"._TEACHER."</td>
											<td width='5%'>"._COUNT_USERS."</td>
											<td width='5%'>M</td>
											<td width='5%'>SIGMA</td>
										</tr>";										    }

										$tmp_mark=0.0;
										$tmp_arr[]=0.0;
										$tmp_squared=0.0;
										$tmp_t=0.0;
										$tmp_m=0.0;
											$marks_values = sql_query("SELECT mark, percent, percent_simple
											   FROM users, results
											   WHERE users.user_id = results.user_id
											   AND results.group_id = ".$each_result['group_id']."
											   AND results.test_id = ".$test_array[$tim].$query_add."
		            						   ORDER BY ".$field." ".$order);

		                    			$tmp_counts=0;
		                    			while($marks_values_data = mysql_fetch_assoc($marks_values))
										{
											$tmp_mark+=$marks_values_data['percent_simple'];
											$tmp_arr[$tmp_counts]= $marks_values_data['percent_simple'];
											$tmp_counts++;
											//Global calculation
											$tmp_mark_overall+=$marks_values_data['percent_simple'];
											$tmp_arr_overall[$tmp_count_overall] = $marks_values_data['percent_simple'];
											$tmp_count_overall++;
										}
										if ($tmp_counts>0)
											$tmp_m = $tmp_mark/$tmp_counts;
										else
											$tmp_m=0;

										for ($a=0;$a<$tmp_counts;$a++)
										{
		              	         			$tmp_squared+=pow($tmp_arr[$a]-$tmp_m,2);
										}

								 		if ($tmp_counts>1)
											$tmp_t = sqrt($tmp_squared/($tmp_counts-1));
								 		else
								 			$tmp_t=16.7;

			 							$marks = mysql_fetch_assoc($results);

			                        	$current_group = sql_single_query("SELECT group_name FROM groups WHERE group_id='".$marks['group_id']."'");
////////////////////
										$teacher_name = sql_single_query("SELECT user_name AS name FROM users WHERE user_id='".$marks['teacher_id']."'");
										$test_name = sql_single_query("SELECT test_name FROM tests WHERE test_id='".$marks['test_id']."'");
                                        if (mysql_num_rows($teacher_results)>1)
											$teacher_name['name']=_MORE_THAN_ONE_TEACHER;
			                        	$tmp_m_out = sprintf ("%01.2f", $tmp_m);
			                       	 	$tmp_t_out = sprintf ("%01.2f", $tmp_t);
			                       	 	++$tim;
										$page_buf .=   "<tr align='center'>

														<td>".++$global_counter."</td>
														<td width='30%'><a href=\"index.php?module=$module&page=$page&action=test_parameters&test_id=".$marks['test_id']."\" target=\"blank\">".$test_name['test_name']."</a></td>
														<td>".$current_group['group_name']."</td>
			                                            <td>".$marks['start_datetime']."</td>
			                                            <td>".$teacher_name['name']."</td>
			                                            <td>".$tmp_counts."</td>
														<td>".$tmp_m_out."</td>
														<td>".$tmp_t_out."</td>
													</tr>";
			                                        $tim--;
			 						}
			 						if ($tmp_count_overall>0)
			   	   					{			   	   						$tmp_squared=0;
			   	   						$tmp_m_overall = $tmp_mark_overall/$tmp_count_overall;
			   	   						for ($a=0;$a<$tmp_count_overall;$a++)
										{
	              	      		   			$tmp_squared+=pow($tmp_arr_overall[$a]-$tmp_m_overall,2);
										}
										if ($tmp_count_overall>1)
											$tmp_t_overall = sqrt($tmp_squared/($tmp_count_overall-1));
								 		else
								 			$tmp_t_overall = 16.7;

                    	   	            $tmp_m_overall = sprintf ("%01.2f", $tmp_m_overall);
		        		               	$tmp_t_overall = sprintf ("%01.2f", $tmp_t_overall);
			   		   					$page_buf .= "<tr><td colspan='3'>"._OVERALL_BY_TEST.":&nbsp;M = ".$tmp_m_overall.";&nbsp;&nbsp;SIGMA = ".$tmp_t_overall."<br /></td></tr>";
			   		   					$tmp_mark_overall=0;
			   		   					$tmp_count_overall=0;
			   	   					}
	        					}
			   	   		}

                       $page_buf .= "</table>";
                    }
			   		else
			   			$page_buf .= "<center><b>"._CHOOSE."</b></center>";
				}
			}
			else
				$page_buf .= "<center><b>"._CHOOSE."</b></center>";
		break;
		case "add_new_test":
		//	if(is_allow(12,$test_category_id,$new_test_id,1))
			{
				add_recent(0,$test_category_id,$new_test_id,$teacher_id);

				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test_list&new_test_id=".$new_test_id."&group_id=".$group_id."'>";
			}
		//	else
	//			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&next_action=return_test_list&page=test&test_id=".$test_id."&group_id=".$group_id."&test_category_id=".$test_category_id."&status_code=0&status_num=op_permited'>";
		break;

		case "add_new_group":
		//	if(is_allow(14,$group_category_id,$new_group_id,1))
            {
				add_recent(1,$group_category_id,$new_group_id,$teacher_id);

				$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=test_list&test_id=".$test_id."&new_group_id=".$new_group_id."'>";
            }
	//		else
		break;
		case "test_parameters":
			if(isset($_REQUEST['test_id']))
				$test_id = intval($_REQUEST['test_id']);
			else $test_id = 0;

		$test_result = sql_query("SELECT DISTINCT test_name, test_category_name
								FROM tests, test_categories
								WHERE tests.test_id='".$test_id."'AND test_categories.test_category_id = tests.test_category_id");
		$test_name = mysql_fetch_assoc($test_result);
		if (mysql_num_rows($test_result)>0)
			$page_buf.= "<p>".$test_name['test_category_name']."/".$test_name['test_name']."</p>";
		$count_result = sql_query("select topic_name,topic_id
									from topics where topics.test_id = '".$test_id."'");
		if (mysql_num_rows($count_result)>0)
			{
				$page_buf .= "<table cellspacing='0' cellpadding='2' class='results' width='50%'>
								<tr class='tab'>
									<td style='width:80%'><center>Theme name</center></td>
									<td ><center>Questions count</center></td>
								</tr>";
				$question_count=0;				while ($themes = mysql_fetch_assoc($count_result))
				{
					$question_result = sql_query("select question_id
												from questions
												where questions.topic_id =".$themes['topic_id']."");
					$page_buf .= "<tr align='center'>
									<td align='left'>".$themes['topic_name']."</td>
									<td>".mysql_num_rows($question_result)."</td>
								 </tr>";
					$question_count += mysql_num_rows($question_result);				}
				$page_buf .= "</table><br />
								Total questions: ".$question_count."</td>";

			}

		break;
	}

	echo $page_buf;
?>