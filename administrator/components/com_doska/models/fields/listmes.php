<?php

defined('_JEXEC') or die('Restricted access');
JFormHelper::loadFieldClass('list');

class JFormFieldListmes extends JFormFieldList {
	
	protected $type = 'Listmes';
 
	protected function getOptions() {
		
		$parent = parent::getOptions();
		
		$opt = $this->getAttribute('option');
		
		$options = array();
		if(!empty($parent)) {
			foreach($parent as $option) {
				array_push($options, $option);
			}
		}
		
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		
		if($opt == "town") {
			$query->select('DISTINCT town AS value, town AS text')
			->from('#__doska_post')
			->where("state > 0")
			->where("town != ''");
		}
		
		if($opt == "type") {
			$query->select('a.id AS value, a.name AS text')
			->from('#__doska_types AS a')
			->where("a.state = 1");
		}
		if($opt == "author") {
			$query->select('DISTINCT id_user as value');
			$query->from('#__doska_post');

			$query->select('u.name AS text')
			->join('LEFT', '#__users AS u ON u.id=id_user')
			->where("state > 0")
			->where("u.name != ''")
			->where("id_user != ''");
		}
		
		$db->setQuery($query);
		
		try
		{
			$row = $db->loadObjectList();
		}
		catch (RuntimeException $e)
		{
			JFactory::getApplication()->unqueueMessage($e->getMessage,'error');
		}
		
		if ($row)
		{
			for($i = 0;$i<count($row);$i++)
			{
				array_push($options,$row[$i]);
			}
		}
		
		return $options;
	}
}