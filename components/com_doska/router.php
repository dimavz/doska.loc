<?php
defined('_JEXEC') or die;


class DoskaRouter extends JComponentRouterBase {


	public function build(&$query) {

		$segments = array();

		/*echo '<pre>';
		print_r($query);
		echo '</pre>';*/

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
		//edit message  from fronted
		if($menuItem && $menuItem->query['view'] == $query['view']) {
			if(empty($query['idcat']) && empty($query['idt'])) {

				//menuItem?id = 7
				unset($query['view']);
				if(isset($query['layout'])) {
					unset($query['layout']);
					return $segments;
				}
			}
		}

		if($menuItem && ($menuItem->query['idcat'] || $menuItem->query['idt'] )) {

			unset($query['view']);

			if(isset($query['idcat'])) {
				list($catid,$catalias) = explode(':',$query['idcat']);
			}

			if(isset($query['idt'])) {
				list($typeid,$typealias) = explode(':',$query['idt']);
			}

			if($menuItem->query['idcat'] == $catid) {
				unset($query['idcat']);

				if(isset($query['idt'])) {
					unset($query['idt']);
				}

				if(isset($query['id'])) {
					$id = explode(':',$query['id']);
					$segments[] = $id[0].'-'.$id[1];
					unset($query['id']);
				}

				return $segments;

			}

			if($menuItem->query['idt'] == $typeid) {
				unset($query['idt']);
				if(isset($query['idcat'])) {
					unset($query['idcat']);
				}

				if(isset($query['id'])) {
					$id = explode(':',$query['id']);
					$segments[] = $id[0].'-'.$id[1];
					unset($query['id']);
				}

				return $segments;
			}

		}
		return $segments;
	}

	public function parse(&$segments) {

	}
}
