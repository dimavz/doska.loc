<?php

defined('_JEXEC') or die('Restricted access');


class DoskaViewUsermessages extends JViewLegacy {
	
	protected $items;
	protected $pagination;
	protected $state;
	protected $params;
	
	protected $listOrder;
	protected $listDirn;
	
	public function display($tpl = NULL) {
		
		$items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state = $this->get('State');
		$this->params = JFactory::getApplication()->getParams();
		
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn = $this->escape($this->state->get('list.direction'));
		
		if($items) {
			foreach($items as $item) {
				//id:alias
	$item->slug = $item->alias ? ($item->id.':'.$item->alias) : $item->id; // slug - это строка для формирования ЧПУ (человеко понятный урл)
			}
		}
		
		$this->canDo = Doskahelper::getActions();
		
		
		$this->items = $items;
		
		
		parent::display($tpl);
		
		$this->setDocument();
	}
	
	
	protected function setDocument() {
		$doc = JFactory::getDocument();
		
		$doc->addStyleSheet(JUri::base(TRUE).'/media/jui/css/icomoon.css');
		$doc->addStyleSheet(JUri::base(TRUE).'/media/com_doska/css/style.css');
	
		
		
	}
}