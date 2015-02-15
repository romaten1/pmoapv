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
	require_once("answer_funcs.php");
	
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
	
	if(isset($_REQUEST['post_regexp']))
		$post_regexp = $_REQUEST['post_regexp'];
	else $post_regexp="";
	
	
	
	
	if(isset($_REQUEST['check_answer']))
		$check_answer = $_REQUEST['check_answer'];
	else $check_answer="";
	
	//print_r($_POST);
	if ($use_regexp=='2')
		{
		if(isset($_POST['new_answer_sample']))
			{$post_regexp = $_POST['new_answer_sample'];}
		else 
			{$post_regexp=$_POST['answer_sample'];
			}
			
		if (@preg_match($post_regexp,'')===false)
			{
			echo _ERROR_IN_REGEXP;
			exit();	
				
			}
	
		}
	$post_regexp=stripslashes($post_regexp);
	if (!$post_regexp)
		{
	
		if (!is_array($answer_alternatives))
		{echo _ERROR_IN_REGEXP;
		exit();
		}
		
			
		require_once('regexp_funcs.php');
		$result_regexp_dunc=generate_regexp($answer_alternatives,$answer_alternatives,$answer_options);
		$result_regexp=$result_regexp_dunc['result_regexp'];
		$regexp_settings=$result_regexp_dunc['regexp_settings'];
		$post_regexp=$result_regexp;
		}
	else 
		{
		$result_regexp=$post_regexp;
		}			
					
					
					
					echo "		

					<body marginheight='0' marginwidth='0'>
					<table width=100% height=100% cellspacing=0 cellpadding=0>
						<tr>
							<td bgcolor='#8CB2FD' height=30>
								<b>&nbsp; "._CHECK_REGEXP."</b>
							</td>
						</tr>
						<tr valign=top>
							<td bgcolor='#ffffff' style='padding:5px;'>
							<form method=post>
							"._YOUR_REGURAL_EXPRESSION." : 
							<p><b>
							$post_regexp";
					
					if ($check_answer)
						{
						$res_check=preg_match($post_regexp,$check_answer);
						if($res_check)
							{
							echo "<p>
							"._ANSWER."  '$check_answer'  "._MATCH."
							</p>";
							}
						else 
							{
							echo "<p>
							"._ANSWER."  '$check_answer'  "._DONOTMATCH."
							</p>";
							}
							
						}
					
					echo "
							</b></p>
							<input type=text name='check_answer'>
							<input type=hidden name='post_regexp' value='$post_regexp'>
							<input type=submit value='"._SUBMIT_CHECK."'>
							</form>
							</td>
						</tr>
						<tr>
							<td bgcolor='#8CB2FD' height=30>&nbsp;</td>
						</tr>
					
					</table>
					</body>
					
					
					";