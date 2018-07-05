<?php
defined('_JEXEC') or die('Restricted Access');

class DoskaTableCategory extends JTable
{
    public function __construct($db) {
        parent::__construct('#__doska_categories','id',$db);
    }

    public function publish($pks = null, $state = 1, $userId =0){
        JArrayHelper::toInteger($pks);
        $state = (int)$state;
        if (empty($pks)){
            throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
        }

        foreach ($pks as $pk){
            if (!$this->load($pk)){
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
            }

            $this->state = $state;
            if(!$this->store()){
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE_STORE'));
            }
        }
        return true;
    }
}