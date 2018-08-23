<?php
defined('_JEXEC') or die;

///JRoute::_('index.php?option=com_doska&view=message&id=4&Itemid=101');

//http://domen.com/message/id.html

//index.php?option=com_doska&view=message&id=id:alias
abstract class DoskaRoute {


	// slug id:alias
	public static  function getMessageRoute($id,$catid = 0, $type = 0) {
		$link = '';
		$view = 'message';

		$link .= 'index.php?option=com_doska&view='.$view;
		$link .='&id='.$id;

		if(!empty($catid)) {
			$link .= '&idcat='.$catid;
		}

		if(!empty($type)) {
			$link .= '&idt='.$type;
		}

		$menu = JFactory::getApplication()->getMenu('site');
		$component = JComponentHelper::getComponent('com_doska');

		$attributes = array('component_id');
		$values = array($component->id);


		$items = $menu->getItems($attributes,$values);

		if(!empty($items) &&  is_array($items)) {

			$tmp = explode(':',$id);
			$id_m = $tmp[0];

			foreach($items as $item) {
				if($item->query && isset($item->query['view'])) {

					if($item->query['view'] == $view) {
						if($item->query['id'] == $id_m) {
							//$link .='&Itemid='.$item->id;
							//return $link;
							$link_m = '&Itemid='.$item->id;
						}
					}


					if($item->query['view'] == 'messages') {
						$tmp_c = explode(':',$catid);
						$tmp_t = explode(':',$type);
						/*JTable::addIncludePath(JPATH_ADMINISTRATOR.'/components/com_doska/tables');
						$table = JTable::getInstance('Message','DoskaTable');
						$table->load($id_m);*/

						if($item->query['idcat']==$tmp_c[0]) {
							//$link .='&Itemid='.$item->id;
							//return $link;
							$link_c = '&Itemid='.$item->id;
						}
						elseif($item->query['idt'] == $tmp_t[0]) {
							$link_t = '&Itemid='.$item->id;
						}
					}

				}


			}

			if($link_m) {
				$link .= $link_m;
				return $link;
			}
			if($link_c) {
				$link .= $link_c;
				return $link;
			}
			if($link_t) {
				$link .= $link_t;
				return $link;
			}

		}


		/*echo '<pre>';
		print_r($items);
		echo '</pre>';*/

		$link .= '&Itemid='.$menu->getDefault()->id;
		return $link;
	}

	public static function getCategoryRoute($catid = 0) {
		$view = 'messages';
		$link = '';

		list($cid,$calias) = explode(':',$catid);

		$link .= 'index.php?option=com_doska&view='.$view.'&idcat='.$catid;

		$menu		= JFactory::getApplication()->getMenu('site');
		$component  = JComponentHelper::getComponent('com_doska');

		$attributes = array('component_id');
		$values     = array($component->id);

		$items = $menu->getItems($attributes, $values); // Элементы меню

		if(!empty($items) && is_array($items)) {
			foreach($items as $item) {
				if (isset($item->query) && isset($item->query['view']))	{

					if($item->query['view'] == $view) {
						if($item->query['idcat'] == $cid) {
							$link .= '&Itemid=' . $item->id;
							return $link;
						}

					}
				}
			}
		}

		$link .= '&Itemid='.$menu->getDefault()->id;
		return $link;

	}

	public static function getTypeRoute($typeid = 0)	{

		$view = 'messages';
		$link = '';
		// Create the link

		list($t_id,$t_alias) = explode(':',$typeid);

		$link .= 'index.php?option=com_doska&view='.$view.'&idt='.$typeid;

		$menu		= JFactory::getApplication()->getMenu('site');
		$component  = JComponentHelper::getComponent('com_doska');

		$attributes = array('component_id');
		$values     = array($component->id);

		$items = $menu->getItems($attributes, $values);
		if(!empty($items) && is_array($items)) {
			foreach($items as $item) {
				if (isset($item->query) && isset($item->query['view']))	{
					if($item->query['view'] == $view) {
						if($item->query['idt'] == $t_id) {
							$link .= '&Itemid=' . $item->id;
							return $link;
						}
					}
				}
			}
		}

		$link .= '&Itemid='.$menu->getDefault()->id;
		return $link;
	}

	public static function getFilterRoute($filter_type,$val)
	{
		$view = 'messages';
		$link = '';

		$link .= 'index.php?option=com_doska&view='.$view.'&filter_'.$filter_type.'='.$val;

		return $link;
	}


}