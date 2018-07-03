<?php

defined("_JEXEC") or die();

class DoskaViewTypes extends JViewLegacy
{
    protected $items;

    public function display($tpl = null)
    {

        $this->addToolBar();
        $this->setDocument();

        $this->items = $this->get('Items'); // Обращение к методу getItems модели
//        var_dump($this->items);

        parent::display($tpl);
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_TYPES"), 'doska');

        JToolbarHelper::addNew('type.add', JText::_('COM_DOSKA_MANEGER_TYPES_ADD'));
        JToolbarHelper::editList('type.edit');
        JToolbarHelper::deleteList(JText::_('COM_DOSKA_MANEGER_TYPES_DELETE_MSG'), 'types.delete');
        JToolbarHelper::divider();

        JToolbarHelper::publish('types.publish', 'JTOOLBAR_PUBLISH', TRUE);
        JToolbarHelper::unpublish('types.unpublish', 'JTOOLBAR_UNPUBLISH', TRUE);

        //JToolbarHelper::cancel();


        /*JToolbarHelper::custom('type.create','doskabutton','doskabutton_hover',JText::_('COM_DOSKA_MANEGER_TYPES_CUSTOM'),FALSE);*/


        JToolbarHelper::preferences('com_doska');

        //echo JUri::root(true)."<br />";
        //echo JUri::base(true)."<br />";
        //echo JUri::current()."<br />";
        //print_r(JUri::getInstance()->getVar('task','default'));


    }

    protected function setDocument()
    {
        $document = JFactory::getDocument();
        $document->addStyleSheet(JUri::root(TRUE) . "/media/com_doska/css/style.css");
        //print_r($document);
    }

}

?>