<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

	 $result_state = sql_query("SELECT start_status, test_time, status_date, user_id,
					   last_end_test_status, test_time
   				FROM test_access
   				WHERE teacher_id='".$teacher_id."'
   				 AND test_id='".$test_id."'
				 AND group_id='".$group_id."'");

	 while($states=mysql_fetch_assoc($result_state))
	 {
                  $result_session = sql_query("SELECT session_id, last_log_date, start_test_time
                                               FROM sessions
											   WHERE teacher_id='".$teacher_id."'
												AND test_id='".$test_id."'
												AND group_id='".$group_id."'
												AND user_id='".$states['user_id']."'");

				  $row_session = mysql_fetch_assoc($result_session);

			  $time=0;$term=0;

			  switch($states['start_status'])
			  {
					case 1:
						 $time = strtotime($states['status_date']);
						 $term = $config['waiting_timeout'];
					break;

					case 2:
						 $time = strtotime($states['status_date']);
						 $term = $config['prestarting_timeout'];
					break;

					case 3:
						 $time = @strtotime($row_session['last_log_date']);
						 $term = $config['authorization_timeout'];
					break;
			  }

			  if(time()-$time>$term*60 && $states['start_status']>0 )
			   sql_query("UPDATE test_access
						  SET last_status=start_status, start_status=0, status_date=NOW()".($states['start_status']==3?',last_end_test_status=4':'')."
						  WHERE teacher_id='".$teacher_id."'
							AND test_id='".$test_id."'
							AND group_id='".$group_id."'
							AND user_id='".$states['user_id']."'
							AND start_status='".$states['start_status']."'");
	 }
?>