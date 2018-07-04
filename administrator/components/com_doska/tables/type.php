<?php
defined('_JEXEC') or die('Restricted Access');
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.07.2018
 * Time: 15:05
 */
class DoskaTableType extends JTable
{
    public function __construct($db) {
        parent::__construct('#__doska_types','id',$db);
    }

    public function publish($pks = null, $state = 1, $userId =0){
        JArrayHelper::toInteger($pks);
        $state = (int)$state;
        if (empty($pks)){
            throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
        }
//        print_r($pks);
//        exit();

        foreach ($pks as $pk){
            if (!$this->load($pk)){
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
            }
//            print_r($this);
//            exit();
            $this->state = $state;
            if(!$this->store()){
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE_STORE'));
            }
        }
        return true;
    }
}