<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

	if(isset($_REQUEST['page']))
		$page = $_REQUEST['page'];	
	if(isset($_REQUEST['next_action']))
		$next_action = $_REQUEST['next_action'];	
		
	if(!isset($_REQUEST['letter']))
		$letter="";
	else
		$letter=$_REQUEST['letter'];

	if(!isset($_REQUEST['keyword']))
		$keyword="";
	else
		$keyword=$_REQUEST['keyword'];

	if(!isset($_REQUEST['page_num']))
		$page_num=0;
	else
		$page_num=$_REQUEST['page_num']-1;

	if(isset($_REQUEST['f_date'])) $f_date = $_REQUEST['f_date'];
		else $f_date = array("y"=>date("Y"), "m"=>date("m"),"d"=>date("d"));

	if(isset($_REQUEST['t_date'])) $t_date = $_REQUEST['t_date'];
		else $t_date = array("y"=>date("Y"),"m"=>date("m"),"d"=>date("d"));


	themeleftbox(_GCATEGORY_CHOOSE_HEADER,"","",false);

	echo "<tr><td><br><center><b>"._GCATEGORY_CHOOSE_CATEGORY."</b></center><br><br>";

	if ($keyword!='')
	{	
		$null_message = _GCATEGORY_NO_C_KEYWORD;
	}
	elseif ($letter=='')
	{
		$null_message = _GCATEGORY_NO_CATEGORY;
	}
	else
	{	
		$null_message = _GCATEGORY_NO_C_LETTER;
	}	
	$count = get_count(0,6,0,$keyword,$letter);
	
	if(!($letter=='' && $count==0 && $keyword==''))
	   show_abc('index.php?module='.$module.'&page='.$page.'&next_action='.$next_action.'&test_id='.$test_id.'&group_id='.$group_id.'&letter=');

	if ($count==0) 
		echo "<center><b>".$null_message."</b></center>";
	else
	{  
		if($keyword!='')
			$query = "SELECT *
					  FROM group_categories
					  WHERE group_category_name RLIKE '.*$keyword.*'
					  ORDER BY group_category_name ASC
					  LIMIT ".$page_num*$limit_page.",".$limit_page;
	
		elseif ($letter=='')
			$query = "SELECT *
					  FROM group_categories
					  ORDER BY group_category_name ASC
					  LIMIT ".$page_num*$limit_page.",".$limit_page;
		else
			$query = "SELECT *
					  FROM group_categories
					  WHERE group_category_name RLIKE '^$letter.*'
					  ORDER BY group_category_name ASC
					  LIMIT ".$page_num*$limit_page.",".$limit_page;
		$result=sql_query($query);
	
		CloseTable();
		$n=0;
		$col_width=100/$limit_col;
	
		$page_buf = '<table border="0"style="width:100%"><tr><td width="'.$col_width.'%">';
	
		while ($row=mysql_fetch_assoc($result))
		{
			if ($n==$limit_row)
			{
				$page_buf .= "<td width=".$col_width."%>";
				$n=0;
			}
			$n++;
		switch ($next_action)
			{
			case "return_show_results":
			$page_buf .= "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						<tr><td nowrap>
						<a href='index.php?module=".$module."&page=group&next_action=".$next_action."&test_id=".$test_id."&group_id=".$group_id."&group_category_id=".$row['group_category_id']."&f_date[y]=".$f_date['y']."&f_date[m]=".$f_date['m']."&f_date[d]=".$f_date['d']."&t_date[y]=".$t_date['y']."&t_date[m]=".$t_date['m']."&t_date[d]=".$t_date['d']."'><img title='"._GCATEGORY_VIEW."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>
						</td><td>
						&nbsp;".$row['group_category_name']."
						</td></tr></table>
						<br>";
			break;
			case "return_gystograms":
			$page_buf .= "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						<tr><td nowrap>
						<a href='index.php?module=".$module."&page=group&next_action=".$next_action."&test_id=".$test_id."&group_id=".$group_id."&group_category_id=".$row['group_category_id']."'><img title='"._GCATEGORY_VIEW."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>
						</td><td>
						&nbsp;".$row['group_category_name']."
						</td></tr></table>
						<br>";			
			break;
			}	
		}
		echo $page_buf."<tr><td colspan=".$limit_col."><br>".nav_bar($count,"index.php?module=".$module."&next_action=".$next_action."&page=".$page."&test_id=".$test_id."&group_id=".$group_id."&page=".$page."&letter=".$letter."&page_num=")."</center>";
}