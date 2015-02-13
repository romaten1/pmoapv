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
	if (INDEXPHP!=1) {
		die ("You can't access this file directly...");	
	}

	/**
	 * функция проверки на дубли в вопросе на соответствие
	 *
	 * @param int $q_id - id текущего вопроса
	 * @param int $a_id - id текущего ответа
	 * @param int $a_text - новый текст ответа
	 * @param int $a_sample - новый эталон ответа
	 * @return int 0 - дублей нет
	 * 			   1 - дубль в текстах
	 * 			   2 - дубль в эталонах
	 */
	function check_clones ($q_id,$a_id,$a_text,$a_sample) {
		$text_clones = sql_single_query("SELECT COUNT(*) FROM answers WHERE question_id=$q_id AND answer_id<>$a_id AND answer_text='$a_text'");
		$sample_clones = sql_single_query("SELECT COUNT(*) FROM answers WHERE question_id=$q_id AND answer_id<>$a_id AND answer_sample='$a_sample'");
		
		if ($text_clones['COUNT(*)']) {
			return 1;
		}
		
		if ($sample_clones['COUNT(*)']) {
			return 2;
		}
		
		return 0;
	}
?>
