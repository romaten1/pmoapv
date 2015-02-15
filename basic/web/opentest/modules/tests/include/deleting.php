<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

set_time_limit(0);

if(!function_exists('scandir')) {
	function scandir($path) {
		$dh  = opendir($path);

		while (false !== ($filename = readdir($dh)))
		   $files[] = $filename;
  
		closedir($dh);
		sort($files);
		return $files;
	}
}
	
// функция рекурсивного удаления директории
function del_dir($path) {
	if(is_dir($path)) {
		// получение поддиректорий и файлов
		$dirs = scandir($path);
		for($i=2;$i<count($dirs);$i++)
			if(is_dir($path."/".$dirs[$i])) {
				// удаление поддиректорий
				if(!del_dir($path."/".$dirs[$i]))
					return false;
			} else {
				// удаление файлов
				if(!unlink($path."/".$dirs[$i])) {
					echo "unlink - failed!!!";
					return false;
				}
			}

		// удаление директории
		if(!rmdir($path)) {
			echo "rmdir - failed!!!";
			return false;
		}
	}	
	return true;
}

// функция удаления варианта ответа
function del_answer($answer_id,$stat = true) {
	del_refs($answer_id,1);

	$rez = sql_query("SELECT * FROM answers WHERE answer_id='$answer_id'");
	
	if ($stat) del_stat_question($rez['question_id']);
	
	// скрипт удаления варианта ответа
	$query = "DELETE FROM answers WHERE answer_id='$answer_id'";
	sql_query($query);

	return true;
}

function del_stat_question($question_id) {
	
	sql_query("DELETE `history_testing_answers`
		FROM
			`history_testing`, `history_testing_answers`
		WHERE
		( `history_testing_answers`.`history_testing_id` = `history_testing`.`history_testing_id`)
			AND
		(  `history_testing`.`question_id` = '$question_id' )");
	sql_query("DELETE FROM `history_testing` WHERE `question_id` = '$question_id'");
	
	sql_query("DELETE `sessions`
		FROM
			`prepared_questions`, `sessions`
		WHERE
		( `sessions`.`user_id` = `prepared_questions`.`user_id` )
		AND
		( `sessions`.`test_id` = `prepared_questions`.`test_id` )
		AND
		( `sessions`.`teacher_id` = `prepared_questions`.`teacher_id` )
		AND
		( `prepared_questions`.`question_id` = '$question_id')");
	
	sql_query("DELETE
		`prepared_answers`
		FROM
		`prepared_questions`, `prepared_answers`
		WHERE
		( `prepared_answers`.`prepared_question_id` = `prepared_questions`.`prepared_question_id` )
		AND
		( `prepared_questions`.`question_id` = '$question_id')");
	
	$rez = sql_query("DELETE FROM prepared_questions WHERE question_id='$question_id'");
}




// функция удаления вопроса
function del_question($question_id) {
	
	$result = sql_query("SELECT answer_id FROM answers WHERE question_id='$question_id'");
	while($row = mysql_fetch_assoc($result)) {
		if ($row['answer_id']>0) {
			del_answer($row['answer_id'],false);
		}
	}

	del_refs($question_id,0);
	
	del_stat_question($question_id);
	
	sql_query("DELETE FROM questions WHERE question_id='$question_id'");

	return true;
}

// функция удаления темы
function del_topic($topic_id) {		
	//получаем список вопросов в текущей теме
	while (true) {
		$result = sql_query("SELECT question_id FROM questions WHERE topic_id='$topic_id' LIMIT 1");
		if (mysql_num_rows($result)==0) break;
		$row=mysql_fetch_assoc($result);
		del_question($row['question_id']);
	}
	
	sql_query("DELETE FROM topics WHERE topic_id='$topic_id'");

	return true;
}

// функция удаления теста
function del_test($test_id) {
	global $config;

	// удаление тем в текущем тесте
	$result = sql_query("SELECT topic_id FROM topics WHERE test_id='$test_id'");
	while($row=mysql_fetch_assoc($result)) {
		if ( $row['topic_id']>0 ) {
			del_topic($row['topic_id']);
		}
	}
	
	del_recent(0,$test_id);
	
	$media_dir = $config['opentest_root_path'].substr($config['media_path_prefix'],strlen($config['additional_path'])).$test_id;
	del_dir($media_dir);

	sql_query("DELETE FROM permissions WHERE object_id='$test_id' AND object_code=12");
	sql_query("DELETE FROM test_info WHERE test_id='$test_id'");
	sql_query("DELETE FROM test_passwords WHERE test_id='$test_id'");
	sql_query("DELETE FROM test_access WHERE test_id='$test_id'");
	sql_query("DELETE FROM results WHERE test_id='$test_id'");

	sql_query("DELETE FROM tests WHERE test_id='$test_id'");

	return true;
}