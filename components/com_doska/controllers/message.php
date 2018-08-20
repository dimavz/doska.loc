<?php
defined('_JEXEC') or die;

class DoskaControllerMessage extends JControllerForm {
	
	public function getModel($name = 'form', $prefix = '', $config = array('ignore_request' => true))
	{
		$model = parent::getModel($name, $prefix, $config);

		return $model;
	}
	
	protected function allowAdd($data = array()) {
		$user = JFactory::getUser();
		return ($user->authorise('core.create', $this->option) || $user->authorise('core.create.messages', $this->option));
	}
	
	protected function allowEdit($data = array(), $key = 'id')
    {
        $recordId = (int) isset($data[$key]) ? $data[$key] : 0;
 
        if ($recordId)
        {
            
			return (JFactory::getUser()->authorise('core.edit', $this->option . '.message.' . $recordId)|| JFactory::getUser()->authorise('core.edit.own', $this->option . '.message.' . $recordId));
        }
        else
        {
            return parent::allowEdit($data, $key);
        }
    }
    
    //id, myid
    public function save($key = '',$urlVar = '') {
		
		if(parent::save($key,$urlVar)) {
			
			$menu = JFactory::getApplication()->getMenu('site');
			$component = JComponentHelper::getComponent($this->option);
			
			$attributes = array('component_id');
			$values = array($component->id);
			
			
			//$attributes = $values 
			
			$items = $menu->getItems($attributes,$values);
			
			if(!empty($items) && is_array($items)) {
				foreach($items as $item) {
					if(isset($item->query) && isset($item->query['view'])) {
						if($item->query['view'] == 'usermessages') {
							$this->setRedirect(JRoute::_(
			'index.php?option='.$this->option.'&Itemid='.$item->id));
					return TRUE;
						}
					}
				}
			}
			
		}
		
		$this->setRedirect(JRoute::_('index.php'));
		return TRUE;
	}
	
	
	
	public function cancel($key = null) {
		
		if(parent::cancel($key)) {
			$menu		= JFactory::getApplication()->getMenu('site');
			$component  = JComponentHelper::getComponent($this->option);
			
			$attributes = array('component_id');
			$values     = array($component->id);
			
			$items = $menu->getItems($attributes, $values);
			
			if(!empty($items) && is_array($items)) {
				foreach($items as $item) {
					if (isset($item->query) && isset($item->query['view']))	{
						if($item->query['view'] == 'usermessages') {
							$this->setRedirect(
								JRoute::_(
									'index.php?option=' . $this->option.'&Itemid='.$item->id)
							);
							return TRUE;
						}
					}	
				}
			}
		}
		$this->setRedirect('index.php');
		return TRUE;	
	}
	
	
	
}