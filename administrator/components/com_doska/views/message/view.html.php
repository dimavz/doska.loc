<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 

class DoskaViewMessage extends JViewLegacy
{
	protected $form;
	protected $item;
	protected $script;
	protected $ignore_fieldsets;
	
	
	
	function display($tpl = null) 
	{
		
		$this->form	= $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');
		$this->ignore_fieldsets = array('mesinfo', 'accesscontrol'); // Удаляем из вывода в шаблоне параметров вкладки  фиелдсетов


		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
 
			return false;
		}
		
		
		$this->addToolBar();

		parent::display($tpl);
		$this->setDocument();
		
		
	}
	
	
	protected function addToolBar() 
	{
		
		JFactory::getApplication()->input->set('hidemainmenu', true);
		
		JToolBarHelper::title(JText::_('COM_DOSKA_MANAGER_MESSAGE'));
		
		
		$isNew = ($this->item->id == 0);
	;
		if ($isNew)
		{
			$title = JText::_('COM_DOSKA_MANAGER_MESSAGE_NEW');
		
			JToolBarHelper::apply('message.apply');
			JToolBarHelper::save('message.save');
			JToolBarHelper::save2new('message.save2new');
			
		}
		else
		{
			$title = JText::_('COM_DOSKA_MANAGER_MESSAGE_EDIT');
			
			JToolBarHelper::apply('message.apply');
			JToolBarHelper::save('message.save');
		}
 
		JToolBarHelper::title($title);
		
		JToolBarHelper::cancel('message.cancel',$isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE');
		
		
	
	}
	
	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument() 
	{
		$document = JFactory::getDocument();
		$document->addStyleSheet(JUri::root(TRUE)."/media/com_doska/css/style.css");
		$document->addScript(JUri::root(TRUE)."/administrator/components/com_doska/views/message/title.js");
		$document->addScript(JUri::root(TRUE).$this->script);
		JText::script('COM_DOSKA_MESSAGE_ERROR_UNACCEPTABLE');
	}
}