<?php
defined('_JEXEC') or die;


class DoskaRouter extends JComponentRouterBase
{


	public function build(&$query)
	{

		$segments = array();

//		echo '<pre>';
//		print_r($query);
//		echo '</pre>';

		if (!empty($query['Itemid']))
		{
			$menuItem = $this->menu->getItem($query['Itemid']);

//			echo '<pre>';
//			print_r($menuItem->query);
//			echo '</pre>';
		}

		if (isset($menuItem) && $menuItem->component != 'com_doska')
		{
			unset($query['Itemid']);
		}

		if (isset($query['view']))
		{
			$view = $query['view'];
		}
		else
		{
			return $segments;
		}


		if ($query['filter_author'] || $query['filter_town'])
		{

			//messages/author(/town)/
			$segments[] = $view;
			$segments[] = $query['filter_author'] ? 'author' : 'town';
			unset($query['view']);

			$segments[] = $query['filter_author'] ? $query['filter_author'] : $query['filter_town'];

			if (isset($query['filter_author']))
			{
				unset($query['filter_author']);
			}

			if (isset($query['filter_town']))
			{
				unset($query['filter_town']);
			}


			return $segments;
		}


		//isset menu item for message
		if (isset($menuItem) && $menuItem->query['view'] == $view && isset($query['id']) && $menuItem->query['id'] == (int) $query['id'])
		{

			unset($query['view']);

			if (isset($query['idcat']))
			{
				unset($query['idcat']);
			}
			if (isset($query['idt']))
			{
				unset($query['idt']);
			}

			unset($query['id']);

			//[option] => com_doska, [Itemid] => 231, array()
			return $segments;


		}
		//edit message  from fronted
		if ($menuItem && $menuItem->query['view'] == $query['view'])
		{
			if (empty($query['idcat']) && empty($query['idt']))
			{

				//menuItem?id = 7
				unset($query['view']);
				if (isset($query['layout']))
				{
					unset($query['layout']);

					return $segments;
				}
			}
		}

		if ($menuItem && ($menuItem->query['idcat'] || $menuItem->query['idt']))
		{

			unset($query['view']);

			if (isset($query['idcat']))
			{
				list($catid, $catalias) = explode(':', $query['idcat']);
			}

			if (isset($query['idt']))
			{
				list($typeid, $typealias) = explode(':', $query['idt']);
			}

			if ($menuItem->query['idcat'] == $catid)
			{
				unset($query['idcat']);

				if (isset($query['idt']))
				{
					unset($query['idt']);
				}

				if (isset($query['id']))
				{
					$id         = explode(':', $query['id']);
					$segments[] = $id[0] . '-' . $id[1];
					unset($query['id']);
				}

				return $segments;

			}

			if ($menuItem->query['idt'] == $typeid)
			{
				unset($query['idt']);
				if (isset($query['idcat']))
				{
					unset($query['idcat']);
				}

				if (isset($query['id']))
				{
					$id         = explode(':', $query['id']);
					$segments[] = $id[0] . '-' . $id[1];
					unset($query['id']);
				}

				return $segments;
			}

		}

		///http://localhost/lessons/j_prof/view/29-test.html
		//view
		//message.html?id=36:test-novogo-kontrollera&idcat=2:kategoriya-2&idt=1:prodayu
		if (isset($query['view']))
		{
			$segments[] = $query['view'];
			unset($query['view']);
		}

		if (isset($query['idcat']) && !isset($query['id']))
		{
			$cid        = explode(':', $query['idcat']);
			$segments[] = $cid[0] . '-' . $cid[1];
		}
		//message/2-kategoriya-2/1-prodayu.html?id=36:test-novogo-kontrollera

		if (isset($query['idt']) && !isset($query['id']))
		{
			$tid        = explode(':', $query['idt']);
			$segments[] = $tid[0] . '-' . $tid[1];
		}
//http://localhost/lessons/j_prof/message/2-kategoriya-2/1-prodayu/36-test-novogo-kontrollera.html
		if (isset($query['id']))
		{
			$id         = explode(':', $query['id']);
			$segments[] = $id[0] . '-' . $id[1];
			unset($query['id']);
		}

		//http://localhost/lessons/j_prof/message/36-test-novogo-kontrollera.html?idcat=2:kategoriya-2&idt=1:prodayu

		unset($query['idt']);
		unset($query['idcat']);


//http://localhost/lessons/j_prof/message/36-test-novogo-kontrollera.html

//http://localhost/lessons/j_prof/messages/2-kategoriya-2.html
//http://localhost/lessons/j_prof/messages/1-prodayu.html
		return $segments;
	}

	public function parse(&$segments)
	{

		/* echo '<pre>';
		print_r($segments);
		echo '</pre>'; */

		$vars  = array();
		$total = count($segments);

		for ($i = 0; $i < $total; $i++)
		{
			$segments[$i] = preg_replace('/-/', ':', $segments[$i], 1);
		}

		$item = $this->menu->getActive();

		$vars['option'] = 'com_doska';

		$db = JFactory::getDbo();
		if ($total == 1) //Формируем ссылку на объявление
		{
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('id_categories', 'id_types')));
			$query->from($db->quoteName('#__doska_post'));
			$query->where($db->quoteName('id') . ' = ' . (int) $segments[0]);

			$db->setQuery($query);
			$message = $db->loadObject();

			if ($message)
			{
				if (($item->query['idcat'] == $message->id_categories) || ($item->query['idt'] == $message->id_types))
				{
					$vars['view'] = 'message';
					$vars['id']   = (int) $segments[0];

					return $vars;
				}
			}
		}

		switch($segments[0]) {

			case 'messages':

				if(!$segments[1]) {
					$vars['view'] = $segments[0];
					return $vars;
				}

				if($segments[1] == 'author') {
					$vars['view'] = $segments[0];
					$vars['filter_author'] = $segments[2];
					break;
				}
				elseif($segments[1] == 'town') {
					$vars['view'] = $segments[0];
					$vars['filter_town'] = $segments[2];
					break;
				}

				list($id,$alias) = explode(':',$segments[1]);

				$query  = $db->getQuery(TRUE);
				$query->select($db->quoteName(array('alias', 'id')));
				$query->from($db->quoteName('#__doska_categories'));
				$query->where($db->quoteName('id') . ' = ' . $id);

				$db->setQuery($query);
				$category = $db->loadObject();

				if($category && $category->alias == $alias) {
					$vars['view'] = $segments[0];
					$vars['idcat'] = $id;
				}
				else {
					$query = $db->getQuery(true)
						->select($db->quoteName(array('alias', 'id')))
						->from($db->quoteName('#__doska_types'))
						->where($db->quoteName('id') . ' = ' . $id);
					$db->setQuery($query);

					$type = $db->loadObject();
					if($type) {
						if ($type->alias == $alias)
						{
							$vars['view'] = $segments[0];
							$vars['idt'] = (int)$segments[1];
						}
					}
				}
				break;

			case 'message':
				$vars['view'] = $segments[0];

				list($id,$alias) = explode(':',$segments[1]);

				$query = $db->getQuery(TRUE);
				$query->select($db->quoteName(array('alias', 'id')));
				$query->from($db->quoteName('#__doska_post'));
				$query->where($db->quoteName('id') . ' = ' . (int) $id);

				$db->setQuery($query);
				$message = $db->loadObject();

				if($message) {
					if ($message->alias == $alias)
					{
						$vars['id'] = (int) $id;
					}
				}

				break;
		}

		return $vars;
	}
}

function doskaBuildRoute(&$query)
{

	$router = new DoskaRouter;

	return $router->build($query);
}

function doskaParseRoute(&$segments)
{
	$router = new DoskaRouter;

	return  $router->parse($segments);
}
