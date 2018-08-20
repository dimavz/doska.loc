<?php

defined('_JEXEC') or die('Restricted access');

class DoskaViewForm extends JViewLegacy
{

	protected $form;
	protected $item;
	protected $script;
	protected $ignore_fieldsets;


	function display($tpl = null)
	{

		$this->form   = $this->get('Form');
		$this->item   = $this->get('Item');
		$this->script = $this->get('Script');//getScript();
		$this->ignore_fieldsets = array('mesinfo', 'accesscontrol'); // Удаляем из вывода в шаблоне параметров вкладки  фиелдсетов

		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));

			return false;
		}

		parent::display($tpl);
		$this->set_document();
		return true;

	}

	protected function set_document()
	{
		$doc = JFactory::getDocument();
		$doc->addStyleSheet(JUri::base(true) . '/media/jui/css/icomoon.css');

		$doc->addScript(JUri::root(true) . '/administrator/components/com_doska/views/message/title.js');

		$doc->addScript(JUri::root(true) . $this->script);
		JText::script('COM_DOSKA_MESSAGE_ERROR_UNACCEPTABLE');
	}
}