<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 25.06.2018
 * Time: 21:49
 */

defined('_JEXEC') or die('Restricted Access');

class DoskaViewMessages extends JViewLegacy
{
//    public function display($tpl = null)
//    {
//        echo 'Отработала функция display из вида';
//    }

    protected $items;

    public function display($tpl = null)
    {

        $this->addToolBar();
        $this->sidebar = $this->addSubMenu('messages');
        $this->setDocument();

        $this->items = $this->get('Items'); // Обращение к методу getItems модели
//        var_dump($this->items);

        parent::display($tpl);
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_MESSAGES"), 'doska');

        JToolbarHelper::addNew('messsage.add', JText::_('COM_DOSKA_MANEGER_MESSAGE_ADD'));
        JToolbarHelper::editList('messsage.edit');
        JToolbarHelper::deleteList(JText::_('COM_DOSKA_MANEGER_MESSAGES_DELETE_MSG'), 'messsage.delete');
        JToolbarHelper::divider();

        JToolbarHelper::publish('messages.publish', 'JTOOLBAR_PUBLISH', TRUE);
        JToolbarHelper::unpublish('messages.unpublish', 'JTOOLBAR_UNPUBLISH', TRUE);

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

    private function addSubMenu($viewName)
    {
        return DoskaHelper::addSubMenu($viewName);
    }
}

?>