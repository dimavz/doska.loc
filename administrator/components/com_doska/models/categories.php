<?php
defined("_JEXEC") or die();

class DoskaModelCategories extends JModelList
{
    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query =$db->getQuery(true);

        $query->select('id, name, parentid, alias, state');
        $query->from('#__doska_categories');

        return $query;
    }
}
?>
