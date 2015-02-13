<?php
	/************************************************************************/
	/* OpenTEST System: The System Of Computer Testing Knowleges            */
	/* ============================================                         */
	/*                                                                      */
	/* Copyright (c) 2002-2005 by OpenTEST Team                             */
	/* https://opentest.com.ua                                              */
	/* e-mail: opentest@opentest.com.ua                                     */
	/*                                                                      */
	/************************************************************************/
	/* 11/01/2005 08:00:00                                                  */
	/************************************************************************/
	if (INDEXPHP!=1)
		die ("You can't access this file directly...");
	
	// определение id текущего теста
	if($action=="view_edit_form")
	{	// извлечение елементов массивов в переменные
		extract(sql_single_query("SELECT question_type, show_later, question_difficulty
								  FROM questions
								  WHERE question_id=".$question_id),EXTR_OVERWRITE);
		
		$str = array('header'	=> _QUESTION_EDIT_HEADER,
					 'button'   => _QUESTION_EDIT_BUTTON,
					 'action'   => "edit&return_up=".$return_up."&question_id=".$question_id."&letter=".urlencode($letter)."&page_num=".($page_num+1),
					 'field'	=> "new_question_text",
					 'type'		=> "new_question_type");
	}
	else
	{		
		$str = array('header'	=> _TOPIC_CREATE_HEADER,
					 'button'   => _TOPIC_CREATE_BUTTON,
					 'action'   => "add_question&topic_id=".$topic_id,
					 'field'	=> "question_text",
					 'type'		=> "question_type");
	}	
	
	// создание объекта класса FCKeditor
	$oFCKeditor = new FCKeditor($str['field']) ;
	//$oFCKeditor->Config['BaseHref'] = $config['additional_path'];
	//$oFCKeditor->BasePath	= $config['additional_path'];
	//echo $oFCKeditor->Config['BaseHref'];
	
	// конфигурация редактора
	ConfigFCK($oFCKeditor,$test_id,$question_text,($question_type==3?$question_id:0));
	
	
	// вывод заголовка
	themeleftbox(_QUESTION_EDIT_HEADER,"","",true);
	
	//выводим форму текста вопроса
	echo "<tr><td><br>
		<b>"._QUESTION_EDIT_TEXT."</b>:<br><br>
		<form method=POST action='index.php?module=".$module."&page=".$page."&action=".$str['action']."'>
		<table cellspacin='0' cellpadding='0' border='0' width='100%'>
		<tr><td colspan='4'>";
	
	// отображение редактора
	$oFCKeditor->Create();
	$page_buf = "</td></tr><tr><td>"._TOPIC_QUEST_TYPE." <select name='".$str['type']."'>";
	// вывод опций выюора
	for($i=0;$i<count($question_types);$i++)
		$page_buf .= "<option value=".($i+1)." ".($i+1==$question_type?"selected":"").">".$question_types[$i]."</option>";
	// сложность вопроса
	$page_buf .= "</select></td><td>"._TOPIC_QUEST_DIFFICULTY." <select name='question_difficulty'>";
	// вывод опций выбора
	for($i=1;$i<=10;$i++)
		$page_buf .= "<option value=".$i." ".($i==$question_difficulty?"selected":"").">".$i."</option>";
	// время "задержки"
	$page_buf .= "</select></td>
			   <td align='center'>".($question_type!=3?"<input type=text size=3 maxlength=3 name=show_later value=".$show_later.">&nbsp;"
			   ._TOPIC_ANSWER_DELAY:"")."</td>
			   <td align='right'><input type=submit value='".$str['button']."'></td>
			   </tr></table></form>";
	
	echo $page_buf;
?>