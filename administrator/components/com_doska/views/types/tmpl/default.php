<?php

defined("_JEXEC") or die();

?>

<form action="<?php echo JRoute::_("index.php?option=com_doska&view=types");?>" method="post" name="adminForm" id="adminForm">
 
	
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	
	<?php echo JHtml::_('form.token');?>
</form>
