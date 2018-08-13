<?php

defined('_JEXEC') or die('Restricted access');

class DoskaViewCategory extends JViewLegacy {
	
	protected $items;
	protected $pagination;
	protected $state;

	public function display ($tpl = NULL) {

		$items = $this->get('Items');//getItems()
		$this->pagination = $this->get('Pagination');//getPagination()
		$this->state = $this->get('State');//getState()
		
		$this->params = JFactory::getApplication()->getParams();
		
		
		if($items) {
			foreach($items as $item) {
				$item->images = json_decode($item->images);
			}
		}
		
		$this->items = $items;
		
		parent::display($tpl);
	}
}
?>