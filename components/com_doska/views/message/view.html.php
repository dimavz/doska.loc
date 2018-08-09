<?php

defined('_JEXEC') or die('Restricted access');

class DoskaViewMessage extends JViewLegacy {

	protected $item;
	protected $state;
	protected $params;
	
	public function display($tpl = null) {
		
		$this->item = $this->get('Item');//getItem()
		$this->state = $this->get('State');//getItem()
		$this->params = JFactory::getApplication()->getParams();
		
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}
		
		parent::display($tpl);
		$this->setDocument();

		return true;
	}
	
	protected function setDocument() {
		
	}
}