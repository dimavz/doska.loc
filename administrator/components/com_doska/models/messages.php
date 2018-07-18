<?php
defined('_JEXEC') or die;

class DoskaModelMessages extends JModelList {
	
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id',
				'title',
				'author_name',
				'category',
				'type',
				'town',
				'price',
				'state'
			);
		}
 
		parent::__construct($config);
	}
	
	
	protected function getListQuery()
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);
		$user = JFactory::getUser();

		// Select the required fields from the table.
		$query->select('p.id, title, text, id_user, town, images, confirm, price, created, publish_up, publish_down, hits, metadesc, metakey, modified, p.alias, p.state');
		$query->from('#__doska_post AS p');
		
		$query->select('c.name as category');
		$query->join('LEFT','#__doska_categories AS c ON c.id=p.id_categories');
		
		$query->select('t.name as type');
		$query->join('LEFT','#__doska_types AS t ON t.id=p.id_types');
		
		$query->select('u.name AS author_name');
		$query->join('LEFT', '#__users AS u ON u.id=p.id_user');
		
		/*echo $query;*/
		
		/*echo "<pre>";
		 print_r($this->state);
		 echo "</pre>";*/
       
	    
		$orderCol  = $db->escape($this->state->get('list.ordering', 'id'));
		$orderDirn = $db->escape($this->state->get('list.direction', 'asc'));
		$query->order($orderCol . ' ' . $orderDirn);

		return $query;
	}
	
	protected function populateState($ordering = null, $direction = null)
	{
		parent::populateState('id', 'desc');
	}
	
}