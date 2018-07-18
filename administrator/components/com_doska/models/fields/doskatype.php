<?php 
defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('list');


class JFormFieldDoskatype extends JFormFieldList {
	
	
	protected $type='Doskatype';
	
	protected function getOptions() {
		$options = array();
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select('a.id as value, a.name AS text');
		$query->from('#__doska_types AS a');
		$query->where('a.state = 1');
		
		$db->setQuery($query);
		
		try {
			$rows = $db->loadObjectList();
		}
		catch(RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
			return false;
		}
		
		if($rows) {
			for($i = 0;$i < count($rows);$i++) {
				array_push($options,$rows[$i]);
			}
		}
		
		return $options;
	}
}	