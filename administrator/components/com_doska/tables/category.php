<?php
defined('_JEXEC') or die('Restricted Access');

use Joomla\Registry\Registry;
use Joomla\CMS\Table\Table;

class DoskaTableCategory extends JTable
{
    public function __construct($db)
    {
        parent::__construct('#__doska_categories', 'id', $db);
    }

    public function publish($pks = null, $state = 1, $userId = 0)
    {
        JArrayHelper::toInteger($pks);
        $state = (int)$state;
        if (empty($pks)) {
            throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
        }

        foreach ($pks as $pk) {
        	if($state == 0)
	        {
		        if($this->load(array('parentid'=>$pk,'state'=>'1')))
		        {
//			        JFactory::getApplication()->enqueueMessage('COM_DOSKA_MESSAGE_PUBLISH_CATEGORY', 'notice');
//			        return FALSE;

			        throw new RuntimeException(JText::_('COM_DOSKA_MESSAGE_PUBLISH_CATEGORY_IS_PARENT'));
		        }
	        }

            if (!$this->load($pk)) {
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
            }

            if($state == 1){
	            if($this->load(array('id'=>$this->parentid, 'state'=>0), FALSE))
	            {
		            throw new RuntimeException(JText::_('COM_DOSKA_MESSAGE_NOT_PUBLISH_CATEGORY_IS_PARENT'));
	            }
            }

            $this->state = $state;
            if (!$this->store()) {
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE_STORE'));
            }
        }
        return true;
    }

    public function bind($array, $ignore = array())
    {

        if (is_array($array['params'])) {
            $registry = new Registry;
            $registry->loadArray($array['params']);
            $array['params'] = (string)$registry;
        }

	    if(isset($array['rules']) && is_array($array['rules'])) {
		    $rules = new JAccessRules($array['rules']);
		    $this->setRules($rules);
	    }

        return parent::bind($array, $ignore);
    }

    public function load($pk = null, $reset = true)
    {
        if (parent::load($pk, $reset)) {

            $registry = new Registry;
            $registry->loadString($this->params);
            $this->params = $registry;
            return TRUE;
        } else {
            return FALSE;
        }
    }

	protected function _getAssetName()
	{
		return 'com_doska.category.'.(int)$this->id;//id
	}

	protected function _getAssetTitle()
	{
		return $this->name;
	}

	protected function _getAssetParentId(JTable $table =null, $id = NULL)
	{
		$assetParent = JTable::getInstance('Asset');

		$assetParentId = $assetParent->getRootId();

		$assetParent->loadByName('com_doska');

		if($assetParent->id) {
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}
}