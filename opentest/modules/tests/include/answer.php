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
	require_once("answer_funcs.php");
	

    // Получение переменых из суперглобальных массивов
	if(isset($_REQUEST['new_answer_text']))
		$new_answer_text = $_REQUEST['new_answer_text'];
	else $new_answer_text="";

	if(isset($_REQUEST['new_answer_sample']))
		$new_answer_sample = $_REQUEST['new_answer_sample'];
	else $new_answer_sample="";

	if(isset($_REQUEST['answer_true']))
		$answer_true = intval($_REQUEST['answer_true']);
	else $answer_true=0;

	if(isset($_REQUEST['true_percent']))
		$true_percent = intval($_REQUEST['true_percent']);
	else $true_percent = 0;

    if(isset($_REQUEST['return_up']))
        $return_up = intval($_REQUEST['return_up']);
	else $return_up= 0;	
	
	if(isset($_REQUEST['alt_action']))
		$alt_action = $_REQUEST['alt_action'];
	else $alt_action="";
	
	if(isset($_REQUEST['answer_alternatives']))
		$answer_alternatives = $_REQUEST['answer_alternatives'];
	else $answer_alternatives="";
	if(isset($_REQUEST['answer_alternative']))
		$answer_alternative = $_REQUEST['answer_alternative'];
	else $answer_alternative="";
	
	if(isset($_REQUEST['answer_options']))
		$answer_options = $_REQUEST['answer_options'];
	else $answer_options="";
	if(isset($_REQUEST['use_regexp']))
		$use_regexp = $_REQUEST['use_regexp'];
	else $use_regexp="";
	if(isset($_REQUEST['enter_regexp_mode']))
		$enter_regexp_mode = $_REQUEST['enter_regexp_mode'];
	else $enter_regexp_mode="";
	
	
	$serialized_regexp="";
	
	switch($action)
	{
		// ============= Блок реализующий вывод варианта ответа =============
		case "view_answer":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{	
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
            require_once("modules/".$module."/include/form_answer.php");
		break;

        // ============= Блок реализующий изменение варианта ответа =============
		case "edit_answer":			
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{	
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			if ($question_type!=3)
				$new_answer_text = remove_p($new_answer_text);
			
			//экранирование спецсимволов в тексте примера
			if(!ini_get('magic_quotes_gpc'))
			{
				$new_answer_text = addslashes($new_answer_text);				
				if(strlen($new_answer_sample)>0)
					$new_answer_sample = addslashes($new_answer_sample);
			}
				
			$stat_str = "&status_code=1&status_num=answer_edited";	
			
			
			if ($question_type==3)
			{
				if($use_regexp==1)
				{
					if (!is_array($answer_alternatives))
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=sample_empty&enter_regexp_mode=".$use_regexp."'>";
					
						
					require_once('regexp_funcs.php');
					$result_regexp_dunc=generate_regexp ($answer_alternatives,$answer_alternatives,$answer_options);
					$result_regexp=$result_regexp_dunc['result_regexp'];
					$regexp_settings=$result_regexp_dunc['regexp_settings'];
					if (preg_match($result_regexp,'')===false)
					{
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=regexp_error&enter_regexp_mode=".$use_regexp."'>";
					}
					else 
					{
						$serialized_regexp=serialize($regexp_settings);
						$new_answer_text='';
						$new_answer_sample=$result_regexp;
						$query = "UPDATE answers
								  SET answer_text='".$new_answer_text."',
									  answer_sample='".$new_answer_sample."',
									  use_regexp=".$use_regexp.",
			                          serialized_regexp='".$serialized_regexp."'
								  WHERE answer_id='$answer_id'";
						//echo $query; exit();
						sql_query($query);
						
					}
					
				}
				elseif ($use_regexp==2)
				{
					$new_answer_text='';
					
					
					$query = "UPDATE answers
							  SET answer_text='".$new_answer_text."',
								  answer_sample='".$new_answer_sample."',
								  use_regexp='".$use_regexp."'
							  WHERE answer_id='".$answer_id."'";
					
					sql_query($query);						
				}
				//break;
				
				
			}
			
			//находим количество вариантов отвтета с заданным текстом в вопросе с найденным id
			$query = "SELECT COUNT(*)
					  FROM answers
					  WHERE question_id=".$question_id."
					  AND ".((($question_type!=3)&&!$use_regexp)?"answer_text='".$new_answer_text."'":"answer_sample='".$new_answer_sample."'")."
					  AND answer_id<>".$answer_id;
			$row = sql_single_query($query);

			if ($row['COUNT(*)']!=0)
			{
				// редирект на форму редактирования варианта ответа
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=answer_exist'>";
				break;
			}
			
			


			if($answer_true==1 && $question_type==1)
			{
				if(true_exists($question_id,$answer_id))
				{
					// редирект на форму редактирования варианта ответа
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=true_exist'>";
					break;
				}

                if($true_percent>0)
                {
                    $true_percent=0;
                    $stat_str = "&status_code=1&status_num=zero_percent";
                }
      		}
      		elseif($question_type>=2)
			{			
			
				if(sample_empty($new_answer_sample) && ($question_type>=4))
				{
					echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=sample_empty'>";
					break;
				}
				
				// проверка дублей в вопросе на соответсвие
				if ($question_type==4) {
					$check_res = check_clones($question_id,$answer_id,$new_answer_text,$new_answer_sample);
					if ($check_res==1) {
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=text_clone'>";
						break;
					}
					if ($check_res==2) {
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=sample_clone'>";
						break;
					}
				}	
				
					
				//=========================================
			}
			
			//скрипт изменения варианта ответа
			$query = "UPDATE answers
					  SET answer_text='".$new_answer_text."',
						  answer_sample='".$new_answer_sample."',
						  answer_true='$answer_true',
                          true_percent='$true_percent'
					  WHERE answer_id='$answer_id'";
			sql_query($query);

			// если в вопросе после изменения ответа нет правильных вариантов, то отключить вопрос
			if(!true_exists($question_id,0) && ($question_type==1 || $question_type==2) && !$question_disabled)
			{
				$stat_str = "&status_code=1&status_num=answer_ed_question_off";
				disable($question_id,2,1);				
			}

			// проверка правильности введенных процентов
			$check_value = check_percent($question_id,$question_type);
			if($check_value>0)
			{
				if($check_value==2)
				{
					sql_query("UPDATE answers
							   SET true_percent=0
							   WHERE answer_id='$answer_id'");
				}
				else
				{
					$row = sql_single_query("SELECT question_disable
											 FROM questions
											 WHERE question_id='$question_id'");

					if(!$question_disabled)
					{
						disable($question_id,2,1);
						$stat_str="&status_code=1&status_num=answer_ed_question_off".$check_value;						
					}
				}
			}

			// запись ссылок ответа на ресурсы в БД
			add_referer($new_answer_text, $answer_id, 1);

			//редирект на вывод списка вариантов ответа в текущем вопросе
			//занести в стату информацию о том, что вариант ответа был успешно изменен
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id.$stat_str."'>";
		break;

		// ============= Блок реализующий "удалить вариант ответа"  =============
		case "view_delete_form":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{	
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			// Форма удаления варианта ответа
			themeleftbox(_ANSWER_DELETE_HEADER,"","",false);

            if($return_up==1)
                $url = "index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id;
            else
				$url = "index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id;

			echo "<tr><td><br>
				  <b>"._ANSWER_DELETING_CONFIRM."</b><br><br>
				  <a href='index.php?module=".$module."&page=".$page."&action=delete&answer_id=".$answer_id."'>"._YES."</a>&nbsp;&nbsp;
				  <a href='".$url."'>"._NO."</a>";
		break;

		case "delete":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{	
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			//находим id текущего вопроса, для вывода вариантов ответа
			$query = "SELECT question_type
					  FROM questions
					  WHERE question_id=".$question_id;
			$row = sql_single_query($query);

			// удаление варианта ответа
			if(del_answer($answer_id))
			{
				$status_code = 1;
				// количество ответов в вопросе после удаления
				$count = get_count($question_id,8);
				// если тип вопроса 3,4 и нет ответов или вопрос типа 1,2 и нет првильного ответа - отключить вопрос
				if(($count>0&&($row['question_type']==3||$row['question_type']==4))||(true_exists($question_id,0)&&($row['question_type']==1||$row['question_type']==2)))
					$status_num = "answer_deleted";
				else
				{
					disable($question_id,2,1);
					$status_num = "ans_del_ques_off";
				}
			}
			else
			{
				$status_code = 0;
				// количество ответов в вопросе после удаления
				$count = get_count($question_id,8);
				// если тип вопроса 3,4 и нет ответов или вопрос типа 1,2 и нет првильного ответа - отключить вопрос
				if(($count>0&&($row['question_type']==3||$row['question_type']==4))||(true_exists($question_id,0)&&($row['question_type']==1||$row['question_type']==2)))
					$status_num = "answer_not_deleted";
				else
				{
					disable($question_id,2,1);
					$status_num = "ans_ndel_ques_off";
				}
			}

            //редирект на вывод списка вариантов ответа в текущем вопросе
            //занести в стату информацию о том, что вариант ответа был успешно удален
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_question&question_id=".$question_id."&status_code=".$status_code."&status_num=".$status_num."'>";
		break;
		
		case "add_variant":
		case "del_variant":
		case "enter_regexp_mode":
			require_once("modules/".$module."/include/form_answer.php");
		break;
    }
?>