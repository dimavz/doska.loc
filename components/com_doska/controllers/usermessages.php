<?php
defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR . '/components/com_doska/controllers/messages.php';


class DoskaControllerUsermessages extends DoskaControllerMessages {
	
	protected $view_list = 'usermessages';
	
	
	public function getModel($name = 'Usermessage', $prefix = 'DoskaModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}
}