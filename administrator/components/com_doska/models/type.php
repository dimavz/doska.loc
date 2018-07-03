<?php
defined("_JEXEC") or die();

class DoskaModelType extends JModelAdmin {

    public function getForm($data = array(),$loadData = true) {


        $form = $this->loadForm(
            $this->option.'_type',
            'type',
            array('control'=>'jform','load_data'=>$loadData)
        );


        if(empty($form)) {
            return FALSE;
        }

        return $form;
    }

    public function getTable($type = 'Type', $prefix = 'DoskaTable',$config = array()) {
        $table = JTable::getInstance($type,$prefix,$config);
        return $table;
    }

    protected function loadFormData()
    {
        // Вытаскиваем данные из сесии
        $data = JFactory::getApplication()->getUserState('com_doska.edit.type.data',array());

        if(empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
}
?>