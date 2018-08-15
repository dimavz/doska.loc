<?php
defined('_JEXEC') or die;

require_once JPATH_ADMINISTRATOR.'/components/com_doska/models/messages.php';

class DoskaModelUsermessages extends DoskaModelMessages {
	
	protected function populateState($ordering = null, $direction = null) {
		
		$this->setState('filter.author',JFactory::getUser()->id);
		
		parent::populateState('id','DESC');
		
	}
}