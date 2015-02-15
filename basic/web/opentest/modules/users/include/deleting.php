<?php

function delete_group($group_id) {
	$group_id = (int)$group_id;
	if ($group_id!="") {
		$query="SELECT user_id FROM users WHERE group_id='".$group_id."'";
		$res=sql_query($query);
		while ($row=mysql_fetch_array($res)) {
			delete_user($row['user_id']);
		}
		$query="DELETE FROM groups WHERE group_id='".$group_id."'";
		sql_query($query);
		$query="DELETE FROM permissions WHERE object_code=14 AND object_id='$group_id'";
		sql_query($query);
		$query="DELETE FROM permissions WHERE group_id='$group_id'";
		sql_query($query);
		return 1;
	} else {
		return 0;
	}
}

function delete_user($user_id) {
	$user_id = (int)$user_id;

	if ($user_id!="") {
		$query="DELETE FROM recent_objects WHERE user_id='".$user_id."'";
		sql_query($query);
		
		$query="SELECT * FROM history_testing WHERE user_id='$user_id'";
		$res=sql_query($query);
		while ($row=mysql_fetch_array($res)) {
			sql_query("DELETE FROM history_testing_answers WHERE history_testing_id='".$row['history_testing_id']."'");
		}
		
		$query="DELETE FROM history_testing WHERE user_id='".$user_id."'";
		sql_query($query);
		$query="DELETE FROM results WHERE user_id='".$user_id."'";
		sql_query($query);
		$query="DELETE FROM test_access WHERE user_id='".$user_id."'";
		sql_query($query);
		$query="DELETE FROM permissions WHERE user_id='$user_id'";
		sql_query($query);
		$query="DELETE FROM users WHERE user_id='".$user_id."'";
		sql_query($query);
		return 1;
	} else {
		return 0;
	}
}