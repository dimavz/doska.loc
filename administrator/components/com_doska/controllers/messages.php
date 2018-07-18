<?php
class DoskaControllerMessages extends JControllerAdmin
{
	
	public function getModel($name = 'Message', $prefix = 'DoskaModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}
?>