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


	public function display ($tpl = NULL) {


		$items = $this->get('Items');//getItems()
		$this->pagination = $this->get('Pagination');//getPagination()
		$this->state = $this->get('State');//getState()

		$this->items = $items;

		parent::display($tpl);
	}
}

?>