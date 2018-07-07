<?php
defined('_JEXEC') or die('Restricted Access');

use Joomla\Registry\Registry;

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
            if (!$this->load($pk)) {
                throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
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
}