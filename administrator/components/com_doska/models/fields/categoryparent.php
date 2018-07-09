<?php
defined('_JEXEC') or die;

JFormHelper::loadFieldClass('list'); // Загрузка класса JFormFieldList

class JFormFieldCategoryparent extends JFormFieldList
{
    protected $type = 'Categoryparent';
    protected function getOptions()
    {
        $rows = array();
        $options = array();

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);

        $query->select($db->quoteName(array('id','name', 'parentid'), array('value','text','parentid')));
        $query->from($db->quoteName('#__doska_categories'));
        $query->where($db->quoteName('state').' = '. $db->quote(1));

        $db->setQuery($query);
        try{
            $rows = $db->loadObjectList();
        }
        catch(RuntimeException $e)
        {
            JError::raiseWarning(500,$e->getMessage());
        }
//        print_r($rows);
        $parent = new stdClass();
        $parent->text = JText::_('JGLOBAL_ROOT_PARENT');
        $parent->value = 0;

        array_push($options,$parent);

        if(!empty($rows)){
            foreach ($rows as $row)
            {
                if($row->parentid == 0){
                    array_push($options,$row);
                }
            }
        }
        return $options;
    }
}