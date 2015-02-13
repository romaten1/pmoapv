<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");	
	
	// Получение переменых из суперглобальных массивов	
	if(isset($_REQUEST['new_question_text']))
		$new_question_text = $_REQUEST['new_question_text'];
	else $new_question_text="";
	
	if(isset($_REQUEST['new_question_type']))
		$new_question_type = $_REQUEST['new_question_type'];
	else $new_question_type="";
	
	if(isset($_REQUEST['show_later']))
		$show_later = intval($_REQUEST['show_later']);
	else $show_later = 0;
	
	if(isset($_REQUEST['answer_text']))
		$answer_text = $_REQUEST['answer_text'];
	else $answer_text="";
	
	if(isset($_REQUEST['question_difficulty']))
		$question_difficulty = $_REQUEST['question_difficulty'];
	else $question_difficulty = "";
	
	if(isset($_REQUEST['answer_sample']))
		$answer_sample = $_REQUEST['answer_sample'];
	else $answer_sample="";
	
	if(isset($_REQUEST['answer_true']))
		$answer_true = intval($_REQUEST['answer_true']);
	else $answer_true = 0;
	
	if(isset($_REQUEST['true_percent']))
		$true_percent = intval($_REQUEST['true_percent']);
	else $true_percent=0;
	
	
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
	else $use_regexp=0;
	if(isset($_REQUEST['enter_regexp_mode']))
		$enter_regexp_mode = $_REQUEST['enter_regexp_mode'];
	else $enter_regexp_mode="";
	
	
	if(!isset($_REQUEST['letter']))
		$letter="";
	else
		$letter=$_REQUEST['letter'];
	
	if(!isset($_REQUEST['keyword']))
		$keyword="";
	else
		$keyword=$_REQUEST['keyword'];
	
	if(isset($_REQUEST['return_up']))
		$return_up = intval($_REQUEST['return_up']);
	else $return_up= 0;
	
	$serialized_regexp="";
	
	switch($action)
	{
		// ============= Блок реализующий вывод списка вариантов ответа на текущий вопрос  =============
		case "view_question":
        	//проверка прав на чтение
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			// Вывод списка вариантов ответа на текущий вопрос
			//запрос списка вариантов ответа
			themeleftbox(_QUESTION_VIEW_HEADER,"","",true);
			$query = "SELECT answer_id, answer_text,answer_sample,true_percent,answer_true
					  FROM answers
					  WHERE question_id='$question_id'
					   ORDER BY answer_id";
			$result=sql_query($query);
			
			echo "<tr><td><br>";
			//Если вопрос не имеет ниодного варианта ответа, то вывобим сообщение
			if (mysql_num_rows($result)==0)
				echo "<b>"._QUESTION_NO_ANSWER."</b>";
			else
				echo "<hr size=1 style='COLOR:#dddddd'>";
			while ($row=mysql_fetch_assoc($result))
			{
				$percent = "";
				echo "<table border='0'><tr>";
				// в зависимости от типа вопроса применять различное отображение ответов
				switch($question_type)
				{
					case 1:
						echo "<td><input type=radio readonly disabled".($row['answer_true']==1?' checked':'')."></td>
							  <td>".$row['answer_text']."</td>";
						if($row['answer_true']!=1)
							$percent = "<font color='red'>".$row['true_percent']."%</font>";
					break;
					
					case 2:
						echo "<td><input type=checkbox readonly disabled".($row['answer_true']==1?' checked':'')."></td>
							<td>".$row['answer_text']."</td>";
							
						$percent = "<font color='".($row['answer_true']!=1?"red":"green")."'>".$row['true_percent']."%</font>";
					break;
					
					case 4:
						$percent = "<font color='".($row['answer_true']!=1?"red":"green")."'>".$row['true_percent']."%</font>";
						echo "<td rowspan='2'><input type=checkbox readonly disabled".($row['answer_true']==1?' checked':'')."></td>";
						echo "<td>
							<table border='0'>
								<tr>
									<td>"._ANSWER_TEXT."</td>									
									<td>"._ANSWER_MODEL."</td>									
								</tr>
								<tr>
									<td>".$row['answer_text']."</td>
									<td>".$row['answer_sample']."</td>
								</tr>
							</table>
						</td></tr>";
					break;
					
					case 3:
						echo "<td>".$row['answer_sample']."</td></tr>";
					break;
				}
				
				echo "</tr></table><br>
					  <a href='index.php?module=".$module."&page=answer&action=view_answer&answer_id=".$row['answer_id']."'><img title='"._QUESTION_EDIT_ANSWER."' align='middle' src='themes/".$current_theme."/images/edit.png'></a>&nbsp;
					  <a href='index.php?module=".$module."&page=answer&action=view_delete_form&return_up=1&answer_id=".$row['answer_id']."'><img title='"._MENU_DELETE_ANSWER."' align='middle' src='themes/".$current_theme."/images/delete.png'></a>
					  &nbsp;".$percent."<hr size=1 style='COLOR:#dddddd'>";
			}
		break;
		
		// ============= Блок реализующий "добавить вариант ответа"  =============
		case "view_add_form":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			require_once("modules/".$module."/include/form_answer.php");
		break;
		
		case "add_answer":
        	//проверка прав на запись
        	
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			
			$answer_text = remove_p($answer_text);
			
			
			
			// creating regural expression if was posted ------------------------------------------------------
			
			
			
			
			
			
			if($use_regexp==1)
				{
					if (!is_array($answer_alternatives))
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=sample_empty&enter_regexp_mode=".$use_regexp."'>";
					
						
						
					require_once('regexp_funcs.php');
					$result_regexp_dunc=generate_regexp ($answer_alternatives,$answer_alternatives,$answer_options);
					$result_regexp=$result_regexp_dunc['result_regexp'];
					$regexp_settings=$result_regexp_dunc['regexp_settings'];
						
					/*
					if(is_array($answer_options))
					{
						if (!isset($answer_options['ignore_case'])) $answer_options['ignore_case']=0;
						if (!isset($answer_options['ignore_layout'])) $answer_options['ignore_layout']=0;
						if (!isset($answer_options['ignore_start_end_spaces'])) $answer_options['ignore_start_end_spaces']=0;
						if (!isset($answer_options['ignore_few_spaces'])) $answer_options['ignore_few_spaces']=0;
						
					}
					else 
						$answer_options=array(	"ignore_case"=>0,
												"ignore_layout"=>0,
												"ignore_start_end_spaces"=>0,
												"ignore_few_spaces"=>0);
					$regexp_settings=array("answer_options"=>$answer_options,"answer_alternatives"=>$answer_alternatives);
					$result_regexp="";
					$cnt=1;
					foreach ($answer_alternatives as $answer_alternative)
					{
						$answer_alternative=preg_replace('~((?:(?:\.)|(?:\\\d)|(?:\[.+?])){\d+?,\d*?})|([]{}()*+?.\\\^$=!<>|:])~e',"'$1'.(strlen('$2')?'\\\\\'.'$2':'')", $answer_alternative);
						if ($cnt==1)
							$result_regexp.="(".$answer_alternative.")";
						else 
							$result_regexp.="|(".$answer_alternative.")";
						$cnt++;
					}
					if ($answer_options['ignore_few_spaces'])
						$result_regexp=preg_replace('~ +~',' +',$result_regexp);
					
					if ($answer_options['ignore_layout'])
					{
						$search=array('(e|�)','(a|�)','(c|�)','(p|�)','(T|�)','(o|�)','(y|�)','(i|�)','(H|�)','(K|�)','(x|�)','(B|�)','(M|�)');
						$result_regexp=preg_replace($search,$search,$result_regexp);
					}
					if ($answer_options['ignore_start_end_spaces'])
						$result_regexp="~^ *(".$result_regexp.") *$~";
					else
						$result_regexp='~^('.$result_regexp.')$~';
					if ($answer_options['ignore_case'])
						$result_regexp.='i';
					*/
					
						
					if (preg_match($result_regexp,'')===false)
					{
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_answer&answer_id=".$answer_id."&status_code=0&status_num=regexp_error&enter_regexp_mode=".$use_regexp."'>";
					}
					else 
					{
						$serialized_regexp=serialize($regexp_settings);
						$answer_sample=$result_regexp;
						$new_answer_text=$result_regexp;
						$answer_text="";
					}
					
				}
				elseif ($use_regexp==2)
				{
					$query = "UPDATE answers
							  SET answer_text='".$new_answer_text."',
								  answer_sample='".$new_answer_sample."',
								  use_regexp=".$use_regexp.",
							  WHERE answer_id='$answer_id'";
				}			
			//экранирование спецсимволов в тексте примера
			if(!ini_get('magic_quotes_gpc'))
			{
				$answer_text = addslashes($answer_text);				
				if(isset($answer_sample) && $answer_sample != "")
					$answer_sample = addslashes($answer_sample);				
			}
		
			$stat_str = "&status_code=1&status_num=answer_added";
		
			// проверка текста ответа на уникальность в пределах вопроса
			$query = "SELECT COUNT(*)
					  FROM answers
					  WHERE question_id=".$question_id."
					   AND ".($question_type!=3?"answer_text='".$answer_text."'":"answer_sample='".$answer_sample."'");
			$row = sql_single_query($query);
			
			if($row['COUNT(*)']!=0)
			{
				//редирект на форму добавления ответа
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&status_code=0&status_num=answer_exist'>";				
			}
			else
			{
				if($answer_true==1 && $question_type==1)
				{
					if(true_exists($question_id,0))
					{
						//редирект на форму добавления ответа
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&status_code=0&status_num=true_exist'>";
						break;
					}
			
					if($true_percent>0)
					{
						$true_percent=0;
						$stat_str = "&status_code=1&status_num=answer_add_zero";
					}
				}
				elseif($question_type>=2)
				{					
					if(sample_empty($answer_sample) && ($question_type>=4))
					{
						//редирект на форму добавления ответа
						echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&status_code=0&status_num=sample_empty'>";
						break;
					}
					
					if ($question_type==4) {
						require_once("answer_funcs.php");
						$check_res = check_clones($question_id,0,$answer_text,$answer_sample);
						if ($check_res==1) {
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&status_code=0&status_num=text_clone'>";
							break;
						}
						if ($check_res==2) {
							echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&status_code=0&status_num=sample_clone'>";
							break;
						}
						
					}
				}			
			
				//скрипт добавдения варианта ответа
				$query = "INSERT INTO answers (question_id,answer_text,answer_sample,answer_true,true_percent, use_regexp, serialized_regexp)
						  VALUES ('".$question_id."','".$answer_text."','".$answer_sample."','".$answer_true."','".$true_percent."','$use_regexp','$serialized_regexp')";
				sql_query($query);
			
				//получаем id созданного ответа
				$answer_id = mysql_insert_id();
			
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
							$stat_str="&status_code=1&status_num=answer_add_question_off".$check_value;							
						}
					}
				}
			
				// запись ссылок ответа на ресурсы в БД
				add_referer($answer_text, $answer_id, 1);
			
				//редирект на вывод списка вариантов ответа в текущем вопросе
				//занести в статус сообщение о, том что ответ был успешно добавлен
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id.$stat_str."'>";
			}
		break;
		
		// ============= Блок реализующий "экспортировать вопрос в XML"  =============
		case "view_export_form":
        	//проверка прав на чтение
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			themeleftbox(_QUESTION_EXPORT_HEADER,"","",false);
			// Форма экспорта вопроса
			echo "<tr><td><br><b>"._QUESTION_EXPORT_TEXT."</b><br><br>
				 <form method=POST action='index.php?module=".$module."&page=".$page."&action=export_question&question_id=".$question_id."'>
				 <input type=file name=xml_file><br><br>
				 <input type=submit value='"._EXPORT_BUTTON."'>
				 </form>";
		break;
		
		case "export_question":
        	//проверка прав на чтение
			if(!is_allow(12,$test_category_id,$test_id,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			//скрипт экспорта вопроса
			//запрос имени текста вопроса из базы(это для наглядности)
			$query = "SELECT question_text
					 FROM questions
					 WHERE question_id=".$question_id;
			$row = sql_single_query($query);
			if(strlen($row['question_text'])>20)
				$row['question_text'] = substr($row['question_text'],0,20)."...";
			//редирект на спиок вариантов ответа в вопросе
			// заносим в статус сообщение о том, что вопрос был успешно экспортирован
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=1&status_num=question_exported'>";
		break;
		
		// ============= Блок реализующий "включить/выключить вопрос"  =============		
		case "switch":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}			
			$stat_str = "&status_code=1&status_num=";

			if($question_disabled)
			{
				switch($question_type)
				{
					case 1:
					case 2:
					case 4:
						// узнаем количество правильных ответов
						$count = sql_single_query("SELECT COUNT(*)
												   FROM answers
												   WHERE answer_true=1
												    AND question_id=".$question_id);
					break;
			
					case 3:
						// узнаем количество ответов
						$count = sql_single_query("SELECT COUNT(*)
												   FROM answers
												   WHERE question_id=".$question_id);

                        $empty_count = sql_single_query("SELECT COUNT(*)
                                                        FROM answers
                                                     WHERE question_id=".$question_id."
                                                      AND answer_sample RLIKE '^ *\$'");
					break;
				}
				if($count['COUNT(*)']==0)
					$stat_str = "&status_code=0&status_num=no_true_answer";
                elseif($question_type==1 && $count['COUNT(*)']>1)
               		$stat_str = "&status_code=0&status_num=to_many_true";
                elseif($question_type==3 && $empty_count['COUNT(*)']>0)
                	$stat_str = "&status_code=0&status_num=some_sam_empty";
				else
				{
					// проверка правильности введенных процентов
					$check_value = check_percent($question_id,$question_type);
					if($check_value>0)
					{
						if($check_value==2)
						{
							sql_query("UPDATE answers
										   SET true_percent=0
										   WHERE answer_true=1
											AND question_id='$question_id'");
						}
						else
						{
                            $stat_str="&status_code=0&status_num=switch_errno".$check_value;
						}
					}
					else
					{
						disable($question_id,2,0);
						$stat_str.="question_on";
					}
				}
			}
			else
			{		
				disable($question_id,2,1);
				$stat_str.="question_off";
			}
			
			if($return_up==1)
				$url = "index.php?module=".$module."&page=topic&action=view_topic&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$topic_id."&page_num=".($page_num+1);
			else
				$url = "index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id;
			//редирект на вывод списка ответов в текущем вопросе
			// занести в статус сообщение о том, что вопрос был успешно включен/выключен
//			echo urlencode($letter);
			echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=".$url.$stat_str."'>";
		break;
		
		// ============= Блок реализующий "изменить текст вопроса"  =============
		case "view_edit_form":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_test&test_id=".$test_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			require_once("modules/".$module."/include/form_question.php");
			
			if ($question_type == 3) {
				$page_buf = "</td></tr>
					  <tr><td>
					  <script language=\"javascript\">
					  	function show() {
					  		var out='';
					  		
					  		for(i=0;i<5;++i) {
					  			out += document.all.new_question_text___Frame.attributes[i].name+'\\n';
					  		}
					  		return out;
					  	}
					  </script>
					  ";
				//$res = sql_single_query("SELECT COUNT(*) from answers WHERE question_id=$question_id");
				$res = sql_query("SELECT answer_id, answer_sample FROM answers WHERE question_id='$question_id'");
				if (mysql_num_rows($res)>0) {
					$page_buf .= '
					<p style="color:red">'._DONT_FORGET_ADD_ANSWERS_WARNING.'</p>
					
					<table cellpadding="0" cellspacing="2" border="'.$config['debug_table'].'">';
					while ($row = mysql_fetch_assoc($res)) {
						$page_buf .= "
								<tr>
									<td>
										<!-- <a  href=\"#\" onclick=\"alert(window.getSelection())\">-->[_A".$row['answer_id']."]
									</td>
									<td style=\"padding-left:10px;\">
										".$row['answer_sample']."
									</td>
								</tr>";
					}
					$page_buf .= "</table>";
				} else {
					$page_buf .= "Вопрос не содержит ответов!!!";
				}
				
				$page_buf .= "</td></tr>";
				
				echo $page_buf;
			}
		break;
		
		case "edit":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			$new_question_text = remove_p($new_question_text);
		   
			//экранирование спецсимволов в тексте вопроса
			if(!ini_get('magic_quotes_gpc'))				
				$new_question_text = addslashes($new_question_text);				
		
			// проверка текста вопроса на уникальность в пределах темы		   
			//находим количество вопросов с саданным текстом в теме с найденным id
			$query = "SELECT COUNT(*)
					  FROM questions
					  WHERE topic_id=".$topic_id."
					   AND question_text='".$new_question_text."'
					   AND question_id<>".$question_id;
			
			$row = sql_single_query($query);
			
			if ($row['COUNT(*)']!=0)
			{
				// редирект на форму редактирования вопроса
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=question&action=view_edit_form&return_up=".$return_up."&question_id=".$question_id."&status_code=0&status_num=question_exist'>";				 
			}
			else
			{
				// изменяем соответсвующую запись в БД
				$query = "UPDATE questions
						  SET question_text='".$new_question_text."',
							  question_type='$new_question_type',
							  show_later='$show_later',
							  question_difficulty='$question_difficulty'
						  WHERE question_id='$question_id'";
				sql_query($query);
				
				// запись ссылок вопроса на ресурсы в БД
				add_referer($new_question_text, $question_id, 0);

                $stat_str = "";

                if(!$question_disabled)
                {
                    if($question_type<=2 && $new_question_type>2)
                    {
                    	$empty_count = sql_single_query("SELECT COUNT(*)
                        							 	 FROM answers
                                                     	 WHERE question_id=".$question_id."
                                                          AND answer_sample RLIKE '^ *\$'");
                        if($empty_count['COUNT(*)']>0 && !$question_disabled)
                        {
                        	disable($question_id,2,1);
                            $stat_str = "&status_code=1&status_num=q_off_sam_emp";
                        }
                    }
                    elseif($question_type==3 && $new_question_type!=3)
                    {
                        $tr_count = true_exists($question_id,0);
                        if(!$tr_count)
                        {
                            disable($question_id,2,1);
                            $stat_str = "&status_code=1&status_num=q_off_no_true";
                        }
                        elseif($new_question_type==1 && $tr_count>1)
                        {
                            disable($question_id,2,1);
                            $stat_str = "&status_code=1&status_num=q_off_true2";
                        }
                    }

                    if(!strlen($stat_str) && ($check_value = check_percent($question_id,$question_type))>0)
                    {
                        if($check_value==2)
                        {
                            sql_query("UPDATE answers
                                           SET true_percent=0
                                           WHERE answer_true=1
                                            AND question_id='$question_id'");
                        }
                        else
                        {
                            disable($question_id,2,1);
                            $stat_str = "&status_code=1&status_num=q_off_pecenter".$check_value;
                        }
                   	}
                }

                if(!strlen($stat_str))
                	$stat_str = "&status_code=1&status_num=question_edited";

				if($return_up==1)
					$url = "index.php?module=".$module."&page=topic&action=view_topic&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$topic_id."&page_num=".($page_num+1);
				else
					$url = "index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id;

				//редирект на вывод списка вариантов ответа на текущий вопрос
				//занести в статус сообщение о том, что вопрос был успешно изменен
				echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=".$url.$stat_str."'>";
			}
		break;
		
		// ============= Блок реализующий "удалить вопрос"  =============
		case "view_delete_form":
        	//проверка прав на запись
			if(!is_allow(12,$test_category_id,$test_id,0,1))
			{
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			// Форма удаления вопроса
			themeleftbox(_QUESTION_DELETE_HEADER,"","",false);
			
			if($return_up==1)
				$url = "index.php?module=".$module."&page=topic&action=view_topic&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$topic_id."&page_num=".($page_num+1);
			else
				$url = "index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id;
			
			echo "<tr><td><br>
				 <b>"._QUESTION_DELETING_CONFIRM."</b><br><br>
				 <a href='index.php?module=".$module."&page=".$page."&action=delete&letter=".urlencode($letter)."&keyword=".$keyword."&question_id=".$question_id."'>"._YES."</a>&nbsp;&nbsp;
				 <a href='".$url."'>"._NO."</a>";
		break;
		
case "delete":
	//проверка прав на запись
	if(!is_allow(12,$test_category_id,$test_id,0,1)) {
		echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=".$page."&action=view_question&question_id=".$question_id."&status_code=0&status_num=op_not_permitted'>";
		exit;
	}

	//скрипт удаления вопроса
	if(del_question($question_id)) {
		$status_code = 1;
		$status_num = "question_deleted";
	} else {
		$status_code = 0;
		$status_num = "question_not_deleted";
	}

	//редирект на вывод списка вопросов в текущей теме
	//занести в статус сообщение о том, что вопрос был успешно удален
	echo "<META HTTP-EQUIV='refresh' CONTENT='0; URL=index.php?module=".$module."&page=topic&action=view_topic&letter=".urlencode($letter)."&keyword=".$keyword."&topic_id=".$topic_id."&status_code=".$status_code."&status_num=".$status_num."'>";
break;

		// ============= Блок реализующий "версия для печати"  =============
		case "question_print_ver":
        	//проверка прав на чтение
			if(!is_allow(5,0,5,1)){
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0; URL=index.php?module=".$module."&page=category&action=view_category&test_category_id=".$test_category_id."&status_code=0&status_num=op_not_permitted'>";
				exit;
			}
			//вывод вопроса и ответов на него (+шапка) в новом окне
			$result_questions= sql_query("select * from questions
										 where question_id='$question_id'");
			include("print_ver.php");
		break;
		case "add_variant":
		case "del_variant":
		case "enter_regexp_mode":
			require_once("modules/".$module."/include/form_answer.php");
		break;
		
	}
?>