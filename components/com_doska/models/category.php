<?php
defined('_JEXEC') or die;

require_once JPATH_SITE.'/components/com_doska/models/messages.php';

class DoskaModelCategory extends JModelList {

	/*protected function getListQuery()
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
		
		$query->where('p.publish_up <= NOW()');
		$query->where('p.publish_down >= NOW()');
		
		
		$orderCol  = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');
		$query->order($orderCol . ' ' . $orderDirn);


		return $query;
	}*/
	
	protected function populateState($ordering = null,$direction = null) {
		
		$app = JFactory::getApplication();
		$input = $app->input;
		
		
		//////
		$value = $input->getInt('idcat');
		$this->setState('filter.category', $value);

		//$this->setState('params', $app->getParams());

		parent::populateState('id', 'desc');
		
	}
	
	protected function getStoreId($id = '')
	{
		$id .= ':' . $this->getState('filter.category');
		return parent::getStoreId($id);
	}
	
	public function getItems() {
		
		$model = JModelLegacy::getInstance('Messages','DoskaModel');
		$model->setState('filter.category',$this->getState('filter.category'));
		
		$this->messages = $model->getItems();
		
		if($this->messages === false) {
			$this->setError($model->getError());
		}

		return $this->messages;
	}
}