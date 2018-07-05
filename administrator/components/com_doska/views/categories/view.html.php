<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 25.06.2018
 * Time: 21:49
 */

defined('_JEXEC') or die('Restricted Access');

class DoskaViewCategories extends JViewLegacy
{
//    public function display($tpl = null)
//    {
//        echo 'Отработала функция display из вида';
//    }

    protected $items;

    public function display($tpl = null)
    {

        $this->addToolBar();
        $this->sidebar = $this->addSubMenu('categories');
        $this->setDocument();

        $this->items = $this->get('Items'); // Обращение к методу getItems модели
//        var_dump($this->items);

        parent::display($tpl);
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_CATEGORIES"), 'doska');

        JToolbarHelper::addNew('category.add', JText::_('COM_DOSKA_MANEGER_CATEGORIS_ADD'));
        JToolbarHelper::editList('category.edit');
        JToolbarHelper::deleteList(JText::_('COM_DOSKA_MANEGER_CATEGORIES_DELETE_MSG'), 'category.delete');
        JToolbarHelper::divider();

        JToolbarHelper::publish('categories.publish', 'JTOOLBAR_PUBLISH', TRUE);
        JToolbarHelper::unpublish('categories.unpublish', 'JTOOLBAR_UNPUBLISH', TRUE);

        JToolbarHelper::preferences('com_doska');
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