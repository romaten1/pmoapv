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

	
	function generate_regexp ($answer_alternatives,$answer_alternatives,$answer_options) 
		{

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
			$search=array('(e|е)','(a|а)','(c|с)','(p|р)','(T|Т)','(o|о)','(y|у)','(i|і)','(H|Н)','(K|К)','(x|x)','(B|В)','(M|М)');
			$result_regexp=preg_replace($search,$search,$result_regexp);
		}
		if ($answer_options['ignore_start_end_spaces'])
			$result_regexp="~^ *(".$result_regexp.") *$~";
		else
			$result_regexp='~^('.$result_regexp.')$~';
		if ($answer_options['ignore_case'])
			$result_regexp.='i';
		
		return (array("result_regexp"=>$result_regexp,"regexp_settings"=>$regexp_settings));
				
		
		
	}
?>
