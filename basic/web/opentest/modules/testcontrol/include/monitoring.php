<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

	if(isset($_REQUEST['action']))
	   $action = $_REQUEST['action'];
	else $action = "";
	
	if(isset($_REQUEST['user_id']))
		$user_id = intval($_REQUEST['user_id']);
	else $user_id = 0;

	if(isset($_REQUEST['test_access_id']))
		$test_access_id = intval($_REQUEST['test_access_id']);
	else $test_access_id = 0;

	if(isset($_REQUEST['status']))
		$status = $_REQUEST['status'];
	else $status = "all";

	if(isset($_REQUEST['update_time']))
		$update_time = intval($_REQUEST['update_time']);
	else $update_time = 15;
	
	if(isset($_REQUEST['hide_result']))
		$hide_result = intval($_REQUEST['hide_result']);
	else $hide_result = 0;		

	require_once("modules/".$module."/include/overdue.php");	

	switch($action)
	{
		case "switch_result":
			sql_query("UPDATE test_access
					   SET hide_result='".$hide_result."'
					   WHERE teacher_id='".$teacher_id."'
					    AND test_id='".$test_id."'
						AND group_id='".$group_id."'");
		default:
			themeleftbox(_MONITORING,"","",true);
		require_once("modules/".$module."/include/selection.php");

			if($test_id>0 && $group_id>0)
			{
				$query = "SELECT users.user_id, user_name, user_disable, num_try,
								 num_questions,test_time, start_status, start_type,
								 status_date, last_status, last_end_test_status,
								 user_ip, hide_result
						  FROM test_access, users
						  WHERE test_id='".$test_id."'
							AND test_access.group_id=users.group_id
							AND test_access.user_id=users.user_id
							AND teacher_id='".$teacher_id."'
							AND users.group_id='".$group_id."'";

				switch($status)
				{
					case "testing":
						 $query .= 	" AND start_status=3";
					break;

					case "waiting":
						 $query .= " AND (start_status=1 OR start_status=2)";
					break;
				}

				$query .= " ORDER BY user_name ASC";

				$result = sql_query($query);

				if(mysql_num_rows($result)>0)
				{
					$user_num=0;
					$page_buf .=  "<table border=0 width=100%>
						   <tr class='tab' align='center'>
							<td>"._NUMBER."</td>
							<td>"._NAME."</td>
							<td>"._NUM_TRY."</td>
							<td>"._NUM_QUESTIONS."</td>
							<td>"._TEST_TIME."</td>
							<td>"._MONITORING_TIME_LEFT."</td>
							<td>"._START_TYPE."</td>
							<td>"._STATUS."</td>
							<td>"._MONITORING_EXT_STATUS."</td>
							<td>"._MONITORING_TEST_STATE."</td>
							<td>"._MONITORING_IP."</td>
							<td>"._MONITORING_ACTION."</td>
						   </tr>";

					while($row = mysql_fetch_assoc($result))
					{						
						$user_action = "";
						$ext_status = 0;
						switch($row['start_status'])
						{
							case 0:

								 if($row['last_status']<=2)
									 $ext_status = $row['last_status'];
								else
                                 switch($row['last_end_test_status'])
                                 {
                                     case 2:
                                     case 5:
                                     case 7:
                                         $ext_status = 4;
                                         break;

                                     case 4:
                                         $ext_status = 3;
                                         break;
                                 }
							break;

							case 1:
								 $user_action = "start";
								 $action_str =  _MONITORING_START;
							break;

							case 2:
								 $user_action = "stop_start";
								 $action_str =  _MONITORING_ABORT;
							break;

							case 3:
								 $user_action = "stop";
								 $action_str =  _MONITORING_STOP;
							break;
						}

                        $num_result=sql_single_query("SELECT COUNT(*)
                                                      FROM results
                                                      WHERE user_id='".$row['user_id']."'
                                                       AND test_id='".$test_id."'
                                                       AND group_id='".$group_id."'
                                                       AND teacher_id='".$teacher_id."'");
													   
						if($row['user_disable'])
							$user_name = "<font color=red>".$row['user_name']."</font>";
						else
							$user_name = $row['user_name'];

                        $page_buf .= "<tr align='center'><td>".++$user_num."</td>
							   <td align='left'>".$user_name."</td>
							   <td>".$row['num_try']."/".($row['num_try']+$num_result['COUNT(*)'])."</td>
							   <td>".$row['num_questions']."</td>
							   <td>".sprintf("%02d:%02d",$row['test_time']/60,$row['test_time']%60)."</td>
							   <td>";

						if($row['last_end_test_status']==1)
						{
						   $row_time = sql_single_query("SELECT start_test_time
														 FROM sessions
														 WHERE user_id='".$row['user_id']."'
														  AND test_id='".$test_id."'
														  AND group_id='".$group_id."'
														  AND teacher_id='".$teacher_id."'");

						   $time_elapsed = min(time()-strtotime($row_time['start_test_time']),$row['test_time']*60);
						   $time_left = $row['test_time']*60-$time_elapsed;

						   $page_buf .= intval($time_elapsed/3600).":".date('i:s',mktime(0,0,$time_elapsed))."
								<br>".intval($time_left/3600).":".date('i:s',mktime(0,0,$time_left));
						}

						$page_buf .= "</td>
							   <td>".$type_of_start[$row['start_type']-1]."</td>
							   <td><img src='themes/".$current_theme."/images/".$start_status[$row['start_status']][0].".png' title='".$start_status[$row['start_status']][1]."'></td>
							   <td>".$extended_status[$ext_status]."</td>
							   <td>".$test_state[$row['last_end_test_status']]."</td>
							   <td>";
						if(strlen($row['user_ip']))
							$page_buf .= (substr($_SERVER['REMOTE_ADDR'],0,strrpos($_SERVER['REMOTE_ADDR'],"."))!=substr($row['user_ip'],0,strrpos($row['user_ip'],"."))?"<font color='red'>".$row['user_ip']."</font>":$row['user_ip']);
						$page_buf .= "</td>
							   <td>".($user_action!=""?"<a href='index.php?module=".$module."&page=".$page."&action=set_user_".$user_action."&user_id=".$row['user_id']."&test_id=".$test_id."&group_id=".$group_id."&update_time=".$update_time."&selector=".$selector."'><img title='".($user_action=='start'?_MONITORING_START:_MONITORING_STOP)."' src='themes/".$current_theme."/images/".$user_action.".png'></a>":"")."</td>
							  </tr>";
						
						$hide_result = $row['hide_result'];
					}

					$page_buf .= "<tr><td colspan=12><hr size=1></td></tr>
								  <tr align='center'>
									<td colspan=4>
										<form name='switcher' method='post' action='index.php?module=".$module."&page=".$page."&action=switch_result&test_id=".$test_id."&group_id=".$group_id."&update_time=".$update_time."&selector=".$selector."'>
										 <input name='hide_result' type='checkbox' ".($hide_result==1?"checked":"")." onclick='document.all.switcher.submit();' value='1'>"._MONITORING_NO_RESULT."</td>
										</form>
								   <td colspan=4>
									<a href='index.php?module=".$module."&page=".$page."&action=start_all&test_id=".$test_id."&group_id=".$group_id."&update_time=".$update_time."&selector=".$selector."'>"._MONITORING_START_ALL."</a>
								   </td>
								   <td colspan=4>
									<a href='index.php?module=".$module."&page=".$page."&action=stop_all&test_id=".$test_id."&group_id=".$group_id."&update_time=".$update_time."&selector=".$selector."'>"._MONITORING_STOP_ALL."</a>
								   </td></tr>
								  </table><META HTTP-EQUIV='Refresh' CONTENT='".$update_time."; URL=index.php?module=".$module."&page=monitoring&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time."&selector=".$selector."'>";
				}
				else
					switch($status)
					{
						case "waiting":
							  $page_buf .= "<p align='center'><b>"._MONITORING_NO_WAITING."</b><p>";
						break;

						case "testing":
							  $page_buf .= "<p align='center'><b>"._MONITORING_NO_TESTING."</b><p>";
						break;

						case "all":
							  $page_buf .= "<p align='center'><b>"._MONITORING_NO_USERS."</b><p>";
						break;

					}
			}
		break;

		case "set_user_start":
			sql_query("UPDATE test_access
					   SET last_status=1,start_status=2,status_date=NOW()
					   WHERE user_id='".$user_id."'
						AND test_id='".$test_id."'
						AND group_id='".$group_id."'
						AND start_status=1
						AND teacher_id='".$teacher_id."'");

			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time."&status_code=1&status_num=one_test_started'>";
		break;

		case "start_all":
			sql_query("UPDATE test_access
					   SET start_status=2,status_date=NOW(),last_status=1
					   WHERE start_status=1
						AND test_id='".$test_id."'
						AND teacher_id='".$teacher_id."'
						AND group_id='".$group_id."'");

			if(mysql_affected_rows()>0)
			   $stat_str = "&status_code=1&status_num=test_started";
			else
			   $stat_str = "&status_code=0&status_num=test_not_started";

			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time.$stat_str."'>";
		break;

		case "set_user_stop":
			sql_query("UPDATE sessions,test_access
					   SET test_access.last_status=test_access.start_status,
                           test_access.start_status=0,
                           test_access.status_date=NOW(),
                           test_access.last_end_test_status=3,
                           sessions.last_log_date=DATE_SUB(NOW(),INTERVAL ".($config['authorization_timeout']+1)." MINUTE)
					   WHERE test_access.user_id='".$user_id."'
						AND test_access.test_id='".$test_id."'
						AND test_access.group_id='".$group_id."'
						AND test_access.teacher_id='".$teacher_id."'
                        AND sessions.user_id='".$user_id."'
                        AND sessions.test_id='".$test_id."'
                        AND sessions.group_id='".$group_id."'
                        AND sessions.teacher_id='".$teacher_id."'");

			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time."&status_code=1&status_num=user_dropped'>";
		break;

		case "stop_all":
			sql_query("UPDATE sessions,test_access
                       SET test_access.last_status=test_access.start_status,
                           test_access.status_date=NOW(),
                           test_access.start_status=0,
                           test_access.last_end_test_status=3,
                           sessions.last_log_date=DATE_SUB(NOW(),INTERVAL ".($config['authorization_timeout']+1)." MINUTE)
                       WHERE test_access.start_status=3
                        AND test_access.test_id='".$test_id."'
                        AND test_access.group_id='".$group_id."'
                        AND test_access.teacher_id='".$teacher_id."'
                        AND sessions.user_id=test_access.user_id
                        AND sessions.test_id=test_access.test_id
                        AND sessions.group_id=test_access.group_id
                        AND sessions.teacher_id=test_access.teacher_id");

			if(mysql_affected_rows()>0)
			   $stat_str = "&status_code=1&status_num=group_dropped";
			else
			   $stat_str = "&status_code=0&status_num=test_not_stoped";

			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time.$stat_str."'>";
		break;

		case "set_user_stop_start":
			sql_query("UPDATE test_access
					   SET last_status=start_status,start_status=0,status_date=NOW()
					   WHERE user_id='".$user_id."'
						AND test_id='".$test_id."'
						AND group_id='".$group_id."'
						AND teacher_id='".$teacher_id."'
						AND start_status=2");

			$page_buf = "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&status=".$status."&update_time=".$update_time."&status_code=1&status_num=one_start_stoped'>";
		break;
	}

echo $page_buf;