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
		
	
	//определение типа вопроса
	if ($action=="add_variant")
		if (is_array($answer_alternatives ))
				$answer_alternatives[]="";
				
	if ($action=="del_variant")
		if (count($answer_alternatives)>1)
				unset($answer_alternatives[$answer_alternative]);
	if ($use_regexp)
		$old_regexp=$use_regexp;
	if ($enter_regexp_mode)
	{
		$old_regexp=$enter_regexp_mode;
		$use_regexp=$enter_regexp_mode;
	}
	
	if ($alt_action)
	$action=$alt_action;
		
	//var_dump($action);
	
		
				
	
	switch ($action)
	{
		case "add_variant":
		case "del_variant":
		case "view_answer":
			
			$query = "SELECT questions.question_type
					  FROM questions,answers
					  WHERE questions.question_id=answers.question_id
					   AND answers.answer_id=".$answer_id;
			
			extract(sql_single_query($query),EXTR_OVERWRITE);
			
			$row = sql_single_query("SELECT true_percent, answer_true, answer_sample, use_regexp, serialized_regexp
									 FROM answers
									 WHERE answer_id=".$answer_id);

			extract($row,EXTR_OVERWRITE);
			if (isset($old_regexp))
				$use_regexp=$old_regexp;
			if ($question_type==3)
			{
				if ($use_regexp)
				{
					if ($serialized_regexp)
					{
						$answer_settings=unserialize($serialized_regexp);
						$answer_alternatives=$answer_settings['answer_alternatives'];
						$answer_options=$answer_settings['answer_options'];
					}
					else 
					{
						if (!is_array($answer_options))
							$answer_options=array(	"ignore_case"=>1,
													"ignore_layout"=>1,
													"ignore_start_end_spaces"=>1,
													"ignore_few_spaces"=>1);
						if (!is_array($answer_alternatives))
							$answer_alternatives=array('0'=>"");
					}
				}
			}
			
			
			$answer_sample = htmlspecialchars($answer_sample);
			
			$str = array('header'      	=> _ANSWER_EDIT_HEADER,
						 'answer_text' 	=> _ANSWER_EDIT_ANSWER_TEXT,
						 'action'      	=> "edit_answer&answer_id=".$answer_id,
						 'button'      	=> _ANSWER_EDIT_BUTTON,
						 'field'		=> 'new_answer_text',
	                     'sample'		=> 'new_answer_sample');
			
			
		break;
		
		default:
			
			$query = "SELECT questions.question_type
					  FROM questions
					  WHERE questions.question_id=".$question_id;	
			
			extract(sql_single_query($query),EXTR_OVERWRITE);
			
			if($question_type==4)
			{
				$answer_true=1;
			}
			elseif($question_type==3)
			{
				if (!$use_regexp)
					$use_regexp=0;
				if (!$answer_options)
					$answer_options=array(		"ignore_case"=>1,
												"ignore_layout"=>1,
												"ignore_start_end_spaces"=>1,
												"ignore_few_spaces"=>1);
				if (!$answer_alternatives)
					$answer_alternatives=array('0'=>"");
											
			}
			$str = array('header' 	    => _QUESTION_CREATE_HEADER,
						 'answer_text' 	=> _QUESTION_CREATE_ANSWER_TEXT,
						 'action'      	=> "add_answer&question_id=".$question_id,
						 'button'      	=> _QUESTION_CREATE_BUTTON,
						 'field'		=> 'answer_text',
	                     'sample'		=> 'answer_sample');
	              
	        if ($page=='answer' and $use_regexp)             
		        {
		        $str = array('header'      	=> _ANSWER_EDIT_HEADER,
							 'answer_text' 	=> _ANSWER_EDIT_ANSWER_TEXT,
							 'action'      	=> "edit_answer&answer_id=".$answer_id,
							 'button'      	=> _ANSWER_EDIT_BUTTON,
							 'field'		=> 'new_answer_text',
		                     'sample'		=> 'new_answer_sample');
		        }
	        
		break;
	}
	//
	
	
	
	// заголовок
	themeleftbox($str['header'],"","",true);

	// форма варианта ответа
	echo "<tr><td><br>
		<form method=POST name='answer_form' id='answer_form' action='index.php?module=".$module."&page=".$page."&action=".$str['action']."&question_type=".$question_type."'       onSubmit=\"popupform(this, 'join')\"    open_in_popup='0' >
		 <table cellspacin='0' cellpadding='0' border='0' width='100%'>
		 <tr><td colspan='4'>".($question_type!=3?"<b>".$str['answer_text']."</b><br><br>":"");	
	
	if($question_type!=3)
    {
        // создание объекта класса FCKeditor
    	$oFCKeditor = new FCKeditor($str['field']);
    	// конфигшурация редактора
    	ConfigFCK($oFCKeditor,$test_id,$answer_text);
        // отображение редактора
        $oFCKeditor->Create();
    }
	
	// продолжение формы ввода
	$page_buf = "</td></tr><tr>";
	switch($question_type)
	{
		case 1:
			require_once("modules/".$module."/include/display.php");
			$page_buf .= "<td align='left' valign='bottom'>
						<input name='answer_true' ".($answer_true==1?"checked":"")." type='checkbox' onclick='display_field(this.checked,document.all.percents);' value=1>&nbsp;
						"._QUESTION_CREATE_ANSWER_TRUE."</td>";
		break;
		
		case 2:
			$page_buf .= "<td align='left' valign='bottom'>
						<input name='answer_true' ".($answer_true==1?"checked":"")." type=checkbox value=1>&nbsp;
						"._QUESTION_CREATE_ANSWER_TRUE."</td>";
		break;
		
		case 4:
			$page_buf .= "<td align='left' valign='bottom'>
						<input name='answer_true' ".($answer_true==1?"checked":"")." type=checkbox value=1>&nbsp;
						"._QUESTION_CREATE_ANSWER_TRUE."</td>";
			$page_buf .= "<td align='left' valign='bottom'><b>"._QUESTION_CREATE_RIGHT_ANSWER."</b><br>
						<input type=text name='".$str['sample']."' value=\"".$answer_sample."\"></td>";
		break;
		
		case 3:
			if ($use_regexp==1)
			{
				
				$page_buf .= "		<td colspan='3' align='left' valign='bottom'>
									<b>"._QUESTION_ENTER_ANSWER_VARIANT."</b><br><br>
							  </td>
							  </tr>";
				$alt_count=0;
				foreach ($answer_alternatives as $key=>$value)
				{
					$alt_count++;
					$page_buf .= "	<tr>
									  <td align='left' valign='bottom'>
										<b>"._QUESTION_ANSWER_ALTERNATIVE."&nbsp;".$alt_count.":</b>&nbsp;
										<input type=text name='answer_alternatives[".$key."]' value=\"".$value."\">&nbsp;&nbsp;&nbsp;&nbsp;
										<!--<a href='#1'>"._QUESTION_ANSWER_ADD_MASK."</a>-->
									  </td>
							  		</tr>";
					if (count($answer_alternatives)>1)
						$page_buf .= "
							  		<tr>
									  <td align='left' valign='bottom'>
										<a onclick='document.forms.answer_form.action=\"index.php?module=".$module."&page=".$page."&action=del_variant&question_type=".$question_type."&alt_action=".$str['action']."&answer_alternative=".$key."\";document.forms.answer_form.submit();' href='#a'>"._QUESTION_ANSWER_DELETE_ALTERNATIVE."</a>
									  </td>
							  		</tr>
							  		";
				}
							  
					$page_buf .= "
								<tr>
								  <td colspan='2' align='left' valign='bottom'><br>
									  <table>
										  <tr>
											  <td><input name='answer_options[ignore_case]' ".(isset($answer_options['ignore_case'])&&$answer_options['ignore_case']==1?"checked":"")." type=checkbox value=1>&nbsp;</td>
											  <td>"._QUESTION_ANSWER_IGNORE_CASE."</td>
										  </tr>
										  <tr>
											  <td><input name='answer_options[ignore_layout]' ".(isset($answer_options['ignore_layout'])&&$answer_options['ignore_layout']==1?"checked":"")." type=checkbox value=1>&nbsp;</td>
											  <td>"._QUESTION_ANSWER_IGNORE_LAYOUT."</td>
										  </tr>
										  <tr>
											  <td><input name='answer_options[ignore_start_end_spaces]' ".(isset($answer_options['ignore_start_end_spaces'])&&$answer_options['ignore_start_end_spaces']==1?"checked":"")." type=checkbox value=1>&nbsp;</td>
											  <td>"._QUESTION_ANSWER_IGNORE_SPACE."</td>
										  </tr>
										  <tr>
											  <td><input name='answer_options[ignore_few_spaces]' ".(isset($answer_options['ignore_few_spaces'])&&$answer_options['ignore_few_spaces']==1?"checked":"")." type=checkbox value=1>&nbsp;</td>
											  <td>"._QUESTION_ANSWER_IGNORE_FEW_SPACES."</td>
										  </tr>
									  </table>
								  </td>
								</tr>
								<tr>
									<td>
										<a onclick=' document.forms.answer_form.action=\"index.php?module=".$module."&page=".$page."&action=add_variant&question_type=".$question_type."&alt_action=".$str['action']."\";document.forms.answer_form.submit();' href='#a'>"._QUESTION_ANSWER_ADD_ALTERNATIVE."</a>
										<a onclick=' document.forms.answer_form.action=\"index.php?module=".$module."&page=question&action=add_variant&question_type=".$question_type."&alt_action=".$str['action']."\";document.forms.answer_form.submit();' href='#a'>"._QUESTION_ANSWER_ADD_ALTERNATIVE."</a>
										
									</td>
								</tr>
								
								
								<tr><td><input type='hidden' name='use_regexp' value='".$use_regexp."'>&nbsp;</td>
							  ";
			}
			elseif ($use_regexp==2)
				{
					$page_buf .= "<td colspan=2 align='left' valign='bottom'><b>"._QUESTION_CREATE_RIGHT_ANSWER."</b><br>
							<input type=text style='width:700px;'name='".$str['sample']."' value=\"".$answer_sample."\"></td>
							<input type=hidden name=use_regexp value=2>
							<tr>
								<td>
									
									";
					
				}
			else 
				{
				$page_buf .= "<td align='left' valign='bottom'><b>"._QUESTION_CREATE_RIGHT_ANSWER."</b><br>
							<input type=text name='".$str['sample']."' value=\"".$answer_sample."\"></td>";
				}
			
			
			
		break;
	}
	
	
	//FOR NEW VERSION!!! NOW ITS COMMENTED
	//if($question_type!=3)
	if(false==true)
		$page_buf .= "<td id='percents' ".($question_type==1&&$answer_true==1?"style='display:none'":"").">"._ANSWER_EDIT_TRUE_PERCENT.":
					  <input name='true_percent' type='text' value='".$true_percent."'>%</td>";
	if($use_regexp)
		{
		$page_buf .= "<td colspan ='4' align='right' valign='bottom'>
					<input type=submit onclick='document.forms.answer_form.open_in_popup=1;document.forms.answer_form.action=\"index.php?module=".$module."&page=check_regexp&question_type=".$question_type."&donot_show_headers=1;\"' value='"._zzz."'>&nbsp;&nbsp;&nbsp;
					
					
					<input type=submit onclick='document.forms.answer_form.target=\"_self\";document.forms.answer_form.open_in_popup=0;document.forms.answer_form.action=\"index.php?module=".$module."&page=".$page."&action=".$str['action']."&question_type=".$question_type.";\"'  value='".$str['button']."'>
					
					
				  </td></tr></tr></table></form>
				  
				  <SCRIPT TYPE='text/javascript'>

function popupform(myform, windowname)
{
//myform.open_in_popup=1;
if(myform.open_in_popup=='1')
	{
	if (! window.focus)return true;
	window.open('', windowname, 'height=200,width=400,scrollbars=yes');
	myform.target=windowname;
	return true;
	}
}

</SCRIPT>
				 
				  
				  
				  
				  ";
		}
	else 
		{
		$page_buf .= "<td align='right' valign='bottom'>";
		
		if ($page=='question' and $question_type==3 )
			{
			$page_buf .= "<input type=button value='"._USE_REGURAL_EXPRESSION_WIZARD."' onclick=\"window.location='index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&use_regexp=1'\"/> 
			<input type=button value='"._USE_REGURAL_EXPRESSION_EXPERT."' onclick=\"window.location='index.php?module=".$module."&page=".$page."&action=view_add_form&question_id=".$question_id."&use_regexp=2'\"/>
			
			
			";
			}
		$page_buf .= "			
					<input type=submit value='".$str['button']."'>
				  </td></tr></tr></table></form>";
			
		}
	
	echo $page_buf;