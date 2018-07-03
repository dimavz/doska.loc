<?php
defined("_JEXEC") or die();

class DoskaModelTypes extends JModelList
{
    protected function getListQuery()
    {

        $query = parent::getListQuery();

        $query->select('id, name, state, alias');
        $query->from('#__doska_types');

        return $query;
    }
}
?>
