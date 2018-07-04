<?php
defined("_JEXEC") or die();

class DoskaControllerTypes extends JControllerAdmin
{

    public function getModel($name = 'Type', $prefix = 'DoskaModel', $config = array())
    {
        return parent::getModel($name, $prefix, $config);
    }
}
?>