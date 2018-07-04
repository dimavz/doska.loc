<?php
defined("_JEXEC") or die();

abstract class DoskaHelper
{
    public static function addSubMenu($viewName){

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_MESSAGES'),
            'index.php?option=com_doska',
            $viewName =='messages'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_CATEGORIES'),
            'index.php?option=com_doska&view=categories',
            $viewName =='categories'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_TYPES'),
            'index.php?option=com_doska&view=types',
            $viewName =='types'
        );

        return JHtmlSidebar::render();
    }

}