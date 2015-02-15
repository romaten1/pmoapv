<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

// функция для добавления ссылок вопросов и ответолв на картинки
// $referer_type - 0 вопрос
//				   1 вариант ответа	
function add_referer($text, $referer_id, $referer_type) {
	global $config;

	// удаление ссылок из таблицы для сответствующего объекта
	$query = "DELETE FROM media_refs
		WHERE referer_id='$referer_id'
		AND referer_type='$referer_type'";
	sql_query($query);

	// удаление экранирования
	$text = stripslashes($text);

	// получение путей ресурсов из текста объекта
	preg_match_all("/< *(?:img|embed).*(?:src|filename|movie)=(?:\"(.+)\"|(.+) ).*>/iU", $text, $matches);

	for($i=1;$i<3;$i++)
		if(count($matches[$i])>0) {
			// вставка ссылок в БД
			$query="";

			foreach($matches[$i] as $path)
				if(strlen($path)>0) {
					$path = preg_replace("/^(http:\/\/.+)(".addcslashes($config['media_path_prefix'],'/').".+)$/iU","\$2",$path);
					$query .= "('$referer_id','$referer_type','".$path."'),";
				}

			if(strlen($query)>0) {
				$query = "INSERT INTO media_refs (referer_id,referer_type,binary_filename)
					VALUES ".$query;
				$query = substr($query, 0, strlen($query)-1);
				sql_query($query);
			}
		}
	return true;
}

// функция для удаления ссылок на файл и самих файлов
// $referer_type такоже как и в add_referer
function del_refs($referer_id, $referer_type) {
	global $config;

	//получиение пути для объекта
	$query = "SELECT binary_filename
		FROM media_refs
		WHERE referer_id='$referer_id'
		AND referer_type='$referer_type'";
	$result = sql_query($query);

	// проверка путей и удаление незадействованных файлов
	while ($row = mysql_fetch_assoc($result)) {
		$query = "SELECT COUNT(*)
			FROM media_refs
			WHERE binary_filename='".$row['binary_filename']."'";

		$count = sql_single_query($query);

		if($count['COUNT(*)']==1 && file_exists($config['opentest_root_path'].$row['binary_filename']))
			unlink($config['opentest_root_path'].$row['binary_filename']);
	}

	// удаление путей для объекта
	$query = "DELETE FROM media_refs
		WHERE referer_id='$referer_id'
		AND referer_type='$referer_type'";
	sql_query($query);

	return true;
}