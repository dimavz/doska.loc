<?php
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

class DoskaModelMessage extends JModelAdmin {

	public function getForm($data = array(), $loadData = true) {
		
		$form = $this->loadForm(
								$this->option.".message",
								"message",
								array('control' => 'jform', 'load_data' => $loadData));
		
		if (empty($form))
	    {
	        return false;
	    }
	 
	    return $form;
	}
	
	public function getTable($type = 'Message', $prefix = 'DoskaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}
	
	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_doska.edit.message.data',
			array()
		);
		
		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}
}