<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 07.08.2018
 * Time: 14:50
 */
defined('_JEXEC') or die;

class DoskaViewMessages extends JViewLegacy {

	protected $items;
	protected $pagination;
	protected $state;
	protected $params;


	public function display ($tpl = NULL) {


		$items = $this->get('Items');//getItems()
		$this->pagination = $this->get('Pagination');//getPagination()
		$this->state = $this->get('State');//getState()
		$this->params = JFactory::getApplication()->getParams();

//		print_r($items);
//		exit();

		if(is_array($items)) {
			foreach($items as $item) {

				$item->slug = $item->alias ? ($item->id.':'.$item->alias):$item->id;

				if($item->id_categories && $item->catalias){
					$item->catslug = $item->id_categories.':'.$item->catalias;
				}

				if($item->id_types && $item->typealias){
					$item->typeslug = $item->id_types.':'.$item->typealias;
				}

				$item->images = json_decode($item->images);
			}
		}

		$this->items = $items;

		parent::display($tpl);
	}
}

?>