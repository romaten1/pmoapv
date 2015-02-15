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
	/* 25/05/2005 20:32:01                                                                                    */
	/************************************************************************/
	if (INDEXPHP!=1) 
		die ("You can't access this file directly...");	
	
	//=====================-------------------- questions output    -------------------=======================
    while ($fetched_question=mysql_fetch_array($result_questions))
    {
        if ($fetched_question['question_disable']!=1) 
			$condition=_QUESTION_QUESTION_ENABLED;
        else 
			$condition=_QUESTION_QUESTION_DISABLED;
			
		if ($fetched_question['question_type']=='3')
			{
			$fetched_question['question_text']=preg_replace_callback("/\[_A([0-9]*)\]/U",'callback_question_text_2',$fetched_question['question_text']); 
			}
	
			
        echo "<table border=".$config['debug_table'].">
				<tr>
					<td valign='top' nowrap><a name='".$fetched_question['question_id']."'></a><b>"._MENU_QUESTION._QUESTION_NUMBER.$fetched_question['question_id']."</b></td>
					<td >".$fetched_question['question_text']."<br><br>("._QUESTION_TYPE.": ".$fetched_question['question_type']."; 
					"._QUESTION_CONDITION.": ".$condition.")</td>					
				</tr><tr><td></td><td><form>
				<table border=".$config['debug_table'].">";

        //=================---------------- answers output    ----------------=================
        $result_answers=sql_query("SELECT * 
								   FROM answers
								   WHERE question_id='".$fetched_question['question_id']."'");
        while ($fetched_answer=mysql_fetch_assoc($result_answers))
        {
            echo "<tr><td rowspan=2 valign='top'>";
            if ($fetched_answer['answer_true']=='1') 
				$checked='checked';
            else 
				$checked='';
				
            switch ($fetched_question['question_type'])
            {
                case 1: 
					echo "<input type=radio ".$checked." readonly disabled>
		            </td><td width=100%>".$fetched_answer['answer_text']."</td></tr><tr>";
		            if ($fetched_answer['answer_sample']!='')
		                echo "<td>"._QUESTION_EXAMPLE.": ".$fetched_answer['answer_sample']."</td>";				
           			 echo "</tr>";
				break;
                
				case 2: 
					echo "<input type=checkbox ".$checked." readonly disabled>
		            </td><td width=100%>".$fetched_answer['answer_text']."</td></tr><tr>";
		            if ($fetched_answer['answer_sample']!='')
		                echo "<td>"._QUESTION_EXAMPLE.": ".$fetched_answer['answer_sample']."</td>";				
		            echo "</tr>";
				break;
                
				case 3:
				
				break;
				
				case 4: 
					echo "</td><td width=100%>".$fetched_answer['answer_text']."</td></tr><tr>";
		            if ($fetched_answer['answer_sample']!='')
		                echo "<td>"._QUESTION_CORRESPONDANCE.": ".$fetched_answer['answer_sample']."</td>";				
		            echo "</tr>";
					
				break;
            }
		
            
            
        }
		echo "</table></form></td></tr></table>";
	}