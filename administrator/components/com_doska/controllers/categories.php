<?php
defined("_JEXEC") or die();

class DoskaControllerCategories extends JControllerAdmin
{

    public function getModel($name = 'Category', $prefix = 'DoskaModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
?>