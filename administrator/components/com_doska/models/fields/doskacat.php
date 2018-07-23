<?php 

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('groupedlist');

class JFormFieldDoskacat extends JFormFieldGroupedList {
	
	protected $type='Doskacat';
	
	protected function getGroups() {
		
		$db = JFactory::getDbo();
		$query = $db->getQuery(TRUE);
		
		$query->select('id AS value, name AS text,parentid'); 
		$query->from('#__doska_categories AS a');
		$query->where('state = 1');
		
		$db->setQuery($query);
		
		try {
			$rows = $db->loadObjectList();
		}
		catch(RuntimeException $e) {
			JFactory::getApplication()->enqueueMessage($e->getMessage(),'error');
			return false;
		}
		
		if($rows) {
			
			$options = array();
			
			for($i = 0; $i < count($rows);$i++) {
				
				if($rows[$i]->parentid == 0) {
					$options[$rows[$i]->value] = $rows[$i];
				}
				else {
					$options[$rows[$i]->parentid]->items[] = $rows[$i];
				}
			}
			
			$arr = array();
			foreach($options as $key=>$opt) {
				if(!isset($opt->items) || count($opt->items) == 0) {
					unset($options[$key]);
				}
				if(isset($opt->text)) {
					$arr[$opt->text] = $opt->items;
				}
			}
		}
		
		return $arr;
		
	}
	
}