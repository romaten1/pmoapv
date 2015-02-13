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

	function true_exists($question_id,$answer_id)
	{
		$row = sql_single_query("SELECT COUNT(*)
								 FROM answers
								 WHERE answer_true=1
								  AND question_id=".$question_id."
								  AND answer_id<>".$answer_id);

		return $row['COUNT(*)']>0;
	}

	function sample_empty($sample_text)
	{
		return strlen(preg_replace("/\s/","",$sample_text))==0;
	}

	/* 	Возвращаемые значения 
			0 - все ок
			1 - % неправильных вариантов ответа > 100
			2 - в вопросе "один из многих" % правильного варианта ответа не равен 0
			3 - в вопросе 2 и 4 типов % правильности не равен 100
            4 - в вопросе 2 и 4 типов % правильности = 100 но есть нулевые варианты ответа*/
	function check_percent($question_id,$question_type)
	{
		// выборка правильности вариантов ответа и процентов правильности
		$result = sql_query("SELECT SUM(answer_true*true_percent) AS true_per,
									SUM(!answer_true*true_percent) AS false_per
							 FROM answers
							 WHERE question_id='$question_id'");

		if($row = mysql_fetch_assoc($result))
		{
			switch($question_type)
			{
				case 1:
					if($row['false_per']<=100)
						if($row['true_per']==0)
							return 0;
						else
							return 2;
					else
						return 1;
				break;

				case 2:
				case 4:
					if($row['false_per']<=100)
                    	if($row['true_per']==0)
                        	return 0;
                        elseif($row['true_per']==100)
                        {
                        	$count_0 = sql_single_query("SELECT COUNT(*)
                            							 FROM answers
                                                         WHERE question_id=".$question_id."
                                                          AND answer_true=1
                                                          AND true_percent=0");

                            if($count_0['COUNT(*)']==0)
                            	return 0;
                            else
                            	return 4;
                        }
						else
							return 3;
					else
						 return 1;
				break;

				default:
					return 0;
				break;
			}
		}
	}
?>
