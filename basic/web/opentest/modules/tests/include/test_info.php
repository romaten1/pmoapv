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

	/**
	 * функция регистрации изменений в тесте
	 *
	 * @param int $test_id - id теста
	 * @param int $user_id - id пользователя
	 */
	function update_info($test_id, $user_id) {
		$row = sql_single_query("SELECT COUNT(*) FROM test_info WHERE test_id=$test_id");
		if ($row['COUNT(*)']) {
			sql_query("UPDATE test_info SET user_id=$user_id, update_time=UNIX_TIMESTAMP() WHERE test_id='$test_id'");
		} else {
			sql_query("INSERT INTO test_info(test_id, user_id, update_time) VALUES ('$test_id','$user_id', UNIX_TIMESTAMP() )");
		}				
	}
	
	/**
	 * функция получает данные о последнем изменении
	 *
	 * @param int $test_id - id теста
	 * @return false - если нет информации об изменениях
	 * 			array - информация об изменении
	 */
	function get_update_info($test_id) {
		$result = sql_query("SELECT gc.group_category_name, g.group_name, u.user_name, t.update_time 
									FROM test_info t, group_categories gc, groups g, users u
									WHERE u.user_id=t.user_id
									AND g.group_id=u.group_id
									AND gc.group_category_id=g.group_category_id
									AND t.test_id='$test_id'");
		if (!mysql_num_rows($result)) {
			return false;
		} else {
			return mysql_fetch_assoc($result);
		}
	}
?>
