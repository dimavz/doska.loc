<?php

defined('_JEXEC') or die;

class DoskaModelMessages extends JModelList
{

	protected function getListQuery()
	{
		$query = parent::getListQuery();

		$query->select($this->getState('list.select','p.id, p.id_categories,p.id_types, title, introtext, id_user, town, images, confirm, price, created, publish_up, publish_down, hits, metadesc, metakey, modified, p.alias, p.state'));

		$query->from('#__doska_post AS p');

		$query->select('c.name as category, c.alias AS catalias');
		$query->join('LEFT','#__doska_categories AS c ON c.id=p.id_categories');

		$query->select('t.name as type, t.alias AS typealias');
		$query->join('LEFT','#__doska_types AS t ON t.id=p.id_types');

		$query->select('u.name AS author_name')
			->join('LEFT', '#__users AS u ON u.id=p.id_user');


		$state  = $this->getState('filter.state','1');
		$query->where('p.state = '.(int)$state);

		$confirm = $this->getState('filter.confirm',1);
		$query->where('p.confirm = "'.(int)$confirm.'"');

		//category
		$category = (int)$this->getState('filter.category',FALSE);
		if($category) {
			$query->where('p.id_categories = "'.$category.'"');
		}

		$type = (int)$this->getState('filter.type',FALSE);
		if($type) {
			$query->where('p.id_types = '.$type);
		}

		$author = (int)$this->getState('filter.author',FALSE);
		if($author) {
			$query->where('p.id_user = '.$author);
		}

		$town = (string)$this->getState('filter.town',FALSE);
		if($town) {
			$query->where('p.town = "'.$town.'"');
		}

		$min_price = (int)$this->getState('filter.price.min',FALSE);
		$max_price = (int)$this->getState('filter.price.max',FALSE);

		if($min_price && $max_price) {
			$query->where('p.price >= '.$min_price);
			$query->where('p.price <= '.$max_price);
		}
		elseif($min_price && $max_price == FALSE) {
			$query->where('p.price >= "'.$min_price.'"');
		}
		elseif($max_price && $min_price == FALSE) {
			$query->where('p.price <= "'.$max_price.'"');
		}


		$query->where('p.publish_up <= NOW()');
		$query->where('p.publish_down >= NOW()');


		$orderCol  = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($orderCol . ' ' . $orderDirn);

//		echo $query;

		return $query;
	}

	protected function populateState($ordering = null,$direction = null) {

		$app = JFactory::getApplication();
		$input = $app->input;

		$value = $input->getInt('filter_price_min');
		$this->setState('filter.price.min', $value);

		$value = $input->getInt('filter_price_max');
		$this->setState('filter.price.max', $value);

		$value = $input->getInt('state');
		$this->setState('filter.state', $value);

		//////
		$value = $input->getInt('idcat');
		$this->setState('filter.category', $value);

		$value = $input->getInt('idt');
		$this->setState('filter.type', $value);
		//////
		$value = $input->getString('filter_town');
		$this->setState('filter.town', $value);

		$value = $input->getInt('filter_confirm');
		$this->setState('filter.confirm', $value);

		$value = $input->get('filter_author');
		$this->setState('filter.author', $value);


		parent::populateState('id', 'desc');

	}

	protected function getStoreId($id = '')
	{

		$id .= ':' . $this->getState('filter.category');
		$id .= ':' . $this->getState('filter.state');
		$id .= ':' . $this->getState('filter.type');
		$id .= ':' . $this->getState('filter.author');
		$id .= ':' . $this->getState('filter.town');
		$id .= ':' . $this->getState('filter.price.min');
		$id .= ':' . $this->getState('filter.price.max');
		return parent::getStoreId($id);
	}


}