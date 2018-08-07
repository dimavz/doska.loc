<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>

<ul class="menu">
<?php

foreach ($list as $i => &$item) {
	
	
	$curent = FALSE;
	
	if($item->id == $active_id) {
		$curent = TRUE;
	}
	
	
	echo "<li>";
	
	if($curent) {
		echo "<a href='".$item->flink."' class='now'>".$item->title."</a>";
	}
	else {
		echo "<a href='".$item->flink."'>".$item->title."</a>";
	}
}
?>
</ul>

