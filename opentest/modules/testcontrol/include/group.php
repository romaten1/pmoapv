<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

	// получаем, определяем и проверяем входяшие данные
	if(!isset($_REQUEST['page_num']))
	  $page_num=0;
	else
	  $page_num=(int)$_REQUEST['page_num']-1;

	if(!isset($_REQUEST['letter']))
	  $letter="";
	else
	  $letter=$_REQUEST['letter'];

	if(!isset($_REQUEST['keyword']))
	  $keyword="";
	else
	  $keyword=$_REQUEST['keyword'];	

	if(!isset($_REQUEST['group_category_id']))
		  $group_category_id="";
	else
		  $group_category_id=intval($_REQUEST['group_category_id']);

	themeleftbox(_GROUP_CHOOSE_HEADER,"","",true);

	echo "<tr><td><br>";
	
	if ($keyword!='')
	{	
		$null_message = _GROUP_NO_G_KEYWORD;
	}
	elseif ($letter=='')
	{
		$null_message = _GROUP_NO_GROUP;
	}
	else
	{	
		$null_message = _GROUP_NO_G_LETTER;
	}	
	$count = get_count($group_category_id,7,false,$keyword,$letter);	

	// Вывод алфавита
	show_abc('index.php?module='.$module.'&page='.$page.'&group_id='.$group_id.'&test_id='.$test_id.'&group_category_id='.$group_category_id.'&letter=');

	if ($count==0)
		echo "<center><b>".$null_message."</b></center>";
	else
	{
		CloseTable();

		// выводим список тестов в данной категории...
		if ($keyword!='')
			$query="SELECT group_id,group_name,group_disable
					   FROM groups
					   WHERE group_category_id='".$group_category_id."'
						AND group_name RLIKE '.*".$keyword.".*'						
					   ORDER BY group_name ASC
					   LIMIT ".$page_num*$limit_page.",".$limit_page;
		else
			if ($letter=='')
				$query="SELECT group_id,group_name,group_disable
					   FROM groups
					   WHERE group_category_id='".$group_category_id."'					   					    
					   ORDER BY group_name ASC
					   LIMIT ".$page_num*$limit_page.",".$limit_page;
			else
				$query="SELECT group_id,group_name,group_disable
					   FROM groups
					   WHERE group_category_id='".$group_category_id."'
					   AND group_name  RLIKE '^".$letter.".*'					  
					   ORDER BY group_name ASC
					   LIMIT ".$page_num*$limit_page.",".$limit_page;
		$result=sql_query($query);

		$n=0;

		$col_width=100/$limit_col;

		$page_buf = '<table border="0"style="width:100%"><tr><td width='.$col_width.'%>';
		while ($row=mysql_fetch_assoc($result))
		{
			if ($n==$limit_row)
				{
					 $page_buf .= "<td width=".$col_width."%>";
					 $n=0;

				}
			$n++;

		   $page_buf .= "<table cellpadding=0 cellspacing=0 border=".$config['debug_table'].">
						<tr><td nowrap>
						<a href='index.php?module=".$module."&page=editing&action=add_new_group&test_id=".$test_id."&group_id=".$group_id."&new_group_id=".$row['group_id']."&group_category_id=".$group_category_id."'><img title='"._GROUP_CHOOSE_GROUP."' align='absmiddle' src='themes/".$current_theme."/images/view.png'></a>
						</td><td>
						&nbsp;".($row['group_disable']==1?"<font color=#bbbbbb>":"").$row['group_name'].($row['group_disable']==1?"</font>":"")."
						</td></tr></table>";
		}
	    $page_buf .= "<tr><td colspan=".$limit_col."><br>";
		echo $page_buf.nav_bar($count,"index.php?module=".$module."&page=".$page."&group_id=".$group_id."&test_id=".$test_id."&group_category_id=".$group_category_id."&letter=".$letter."&page_num=");
}