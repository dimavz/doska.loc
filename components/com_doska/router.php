<?php
defined('_JEXEC') or die;

class DoskaRouter extends JComponentRouterBase {

	public function build(&$query) {

		$segments = array();

//		echo '<pre>';
//		print_r($query);
//		echo '</pre>';

		if(!empty($query['Itemid'])) {
			$menuItem = $this->menu->getItem($query['Itemid']);
		}

		if(isset($menuItem) && $menuItem->component != 'com_doska') {
			unset($query['Itemid']);
		}

		if(isset($query['view'])) {
			$view = $query['view'];
		}
		else {
			return $segments;
		}


		if($query['filter_author'] || $query['filter_town']) {

			//messages/author(/town)/
			$segments[] = $view;
			$segments[] = $query['filter_author'] ? 'author' :'town';
			unset($query['view']);

			$segments[] = $query['filter_author'] ? $query['filter_author']:$query['filter_town'];

			if(isset($query['filter_author'])) {
				unset($query['filter_author']);
			}

			if(isset($query['filter_town'])) {
				unset($query['filter_town']);
			}
			return $segments;
		}


		//isset menu item for message
		if(isset($menuItem) && $menuItem->query['view'] == $view && isset($query['id']) && $menuItem->query['id'] == (int)$query['id']) {

			unset($query['view']);

			if (isset($query['idcat'])) {
				unset($query['idcat']);
			}
			if (isset($query['idt'])) {
				unset($query['idt']);
			}

			unset($query['id']);

			//[option] => com_doska, [Itemid] => 231, array()
			return $segments;
		}
		return $segments;
	}

	public function parse(&$segments) {

	}
}
