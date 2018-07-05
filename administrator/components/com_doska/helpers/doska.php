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

        if ($viewName == 'types'){
            $doc = JFactory::getDocument();
            $doc->addStyleDeclaration('.doska-myclass : {color: red; }');
        }

        $options[] = JHtml::_('select.option', '1', JText::_('JPUBLISHED'));
		$options[] = JHtml::_('select.option', '0', JText::_('JUNPUBLISHED'));
		$options[] = JHtml::_('select.option', '2', JText::_('JARCHIVED'));
		$options[] = JHtml::_('select.option', '-2', JText::_('JTRASHED'));
		$options[] = JHtml::_('select.option', '*', JText::_('JALL')) ;

       JHtmlSidebar::addFilter(
		    JText::_('JOPTION_SELECT_PUBLISHED'),
		    'filter[state]',
		    JHtml::_('select.options', $options, "value", "text")
		);

        return JHtmlSidebar::render();
    }

}