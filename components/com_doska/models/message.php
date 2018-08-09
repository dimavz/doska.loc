<?php
defined('_JEXEC') or die;

class DoskaModelMessage extends JModelItem
{


	protected function populateState()
	{
		$app = JFactory::getApplication();

		$id = $app->input->getInt('id');
		$this->setState('message.id', $id);

		$params = $app->getParams();
		$this->setState('params', $params);
	}

	public function getItem($pk = null)
	{
		$item = null;
		$pk   = (!empty($pk)) ? $pk : $this->getState('message.id');

		if ($pk)
		{

			$db    = $this->getDbo();
			$query = $db->getQuery(true);

			$query->select('p.id, p.params, p.id_categories,p.id_types, title, introtext, `fulltext`, id_user, town, images, price, created, publish_up, publish_down, hits, metadesc, metakey, modified, p.alias');
			$query->from('#__doska_post AS p');
			$query->select('c.name as category, c.alias AS catalias');
			$query->join('LEFT', '#__doska_categories AS c ON c.id=p.id_categories');
			$query->select('t.name as type, t.alias AS typealias');
			$query->join('LEFT', '#__doska_types AS t ON t.id=p.id_types');

			$query->select('u.name AS author_name')
				->join('LEFT', '#__users AS u ON u.id=p.id_user');


			$query->where('p.id = ' . $pk);
			$query->where('p.state = 1');
			$query->where('p.confirm = "1"');
			$query->where('p.publish_up <= NOW()');
			$query->where('p.publish_DOWN >= NOW()');

//			echo $query;
//			exit();

			$db->setQuery($query);

			$item = $db->loadObject();


			if ($item)
			{
				$params = new JRegistry;
				$params->loadString($item->params);
				$item->params = $params;

				$params = clone $this->getState('params');

				$params->merge($item->params);
				$item->params = $params;

//				print_r($params);
//				exit();

				$images = new JRegistry;
				$images->loadString($item->images);
				$item->images = $images;

				return $item;

			}
		}
		return $item;
	}

	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('message.id');
		$id .= ':' . $this->getState('params');

		//
		return parent::getStoreId($id);
	}
}