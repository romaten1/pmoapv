<?php
if (INDEXPHP!=1) die ("You can't access this file directly...");

echo "<script language='JavaScript'>
	function display_field(checked,object)
	{
	if(!checked)			
	object.style.display='';			
	else
	{
	object.style.display='none';
	document.all.true_percent.value='0';
	}
	}
	</script>";
