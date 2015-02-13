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
	/* 11/01/2005 08:00:00                                                                                    */
	/************************************************************************/
	if (INDEXPHP!=1)
		die ("You can't access this file directly...");
	
	themeleftbox(_MENU_TEST_CONTROL,"","",false);
	
	echo "<tr>
			<td>
				<strong><big>&middot;</big></strong>&nbsp;
				<a href='index.php?module=".$module."&page=category&next_action=view_create_form'>"._MENU_CRETAE_TEST."</a><br>
				<strong><big>&middot;</big></strong>&nbsp;
				<a href='index.php?module=".$module."&page=category&next_action=view_import_form'>"._MENU_IMPORT_TEST."</a><br>
				<strong><big>&middot;</big></strong>&nbsp;
				<a href='index.php?module=".$module."&page=category&next_action=view_category'>"._MENU_OPEN_TEST."</a><br>
			</td>
		</tr>";
?>