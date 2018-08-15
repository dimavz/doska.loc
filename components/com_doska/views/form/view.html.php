<?php

defined('_JEXEC') or die('Restricted access');


class DoskaViewForm extends JViewLegacy {
	
	protected $form;
	protected $item;
	protected $script;
	
	
	function display($tpl = NULL) {
		
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');//getScript();
		
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
		
		parent::display($tpl);
		$this->set_document();
		
	}
	
	protected function set_document() {
		$doc = Jfactory::getDocument();
		$doc->addStyleSheet(JUri::base(true).'/media/jui/css/icomoon.css');
		
	$doc->addScript(JUri::root(TRUE).'/administrator/components/com_doska/views/message/title.js');
	
	$doc->addScript(JUri::root(TRUE).$this->script);
	JText::script('COM_DOSKA_MESSAGE_ERROR_UNACCEPTABLE');
	
		
	}
	
}