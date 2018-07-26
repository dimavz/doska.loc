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
	protected $items;
	protected $pagination;
	protected $state;
	protected $sidebar;
	protected $listOrder;
	protected $listDirn;
	public $filterForm;
	protected $activeFilters;

    public function display($tpl = null)
    {
	    $app = JFactory::getApplication();

	    $this->sidebar = $this->addSubMenu('messages');
        $this->addToolBar();
        $this->setDocument();

        $this->items = $this->get('Items'); // Обращение к методу getItems модели

	    $this->pagination = $this->get('Pagination');//getPagination

	    $this->state = $this->get('State');//getState

//	    print_r($this->state);
//	    exit();

	    $this->listOrder = $this->escape($this->state->get('list.ordering'));
	    $this->listDirn = $this->escape($this->state->get('list.direction'));

	    if (count($errors = $this->get('Errors')))
	    {
		    $app->enqueueMessage(implode('<br />', $errors), 'error');
		    return false;
	    }
	    $this->filterForm = $this->get('FilterForm'); // getFilterForm();
//	    echo "<PRE>";
//	    print_r($this->filterForm );
//	    echo "</PRE>";

	    $this->activeFilters = $this->get('ActiveFilters'); // getActiveFilters


        parent::display($tpl);
	    return TRUE;
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_MESSAGES"), 'doska');

        JToolbarHelper::addNew('message.add', JText::_('COM_DOSKA_MANEGER_MESSAGE_ADD'));
        JToolbarHelper::editList('message.edit');

        JToolbarHelper::divider();

        JToolbarHelper::publish('messages.publish', 'JTOOLBAR_PUBLISH', TRUE);
        JToolbarHelper::unpublish('messages.unpublish', 'JTOOLBAR_UNPUBLISH', TRUE);

        //JToolbarHelper::cancel();


        /*JToolbarHelper::custom('type.create','doskabutton','doskabutton_hover',JText::_('COM_DOSKA_MANEGER_TYPES_CUSTOM'),FALSE);*/
	    JToolBarHelper::archiveList('messages.archive');
	    JToolBarHelper::trash('messages.trash');
	    JToolbarHelper::deleteList(JText::_('COM_DOSKA_MANEGER_MESSAGES_DELETE_MSG'), 'messages.delete','JTOOLBAR_EMPTY_TRASH');
        JToolbarHelper::preferences('com_doska');

    }

    protected function setDocument()
    {
        $doc = JFactory::getDocument();
        $doc->addStyleSheet(JUri::root(TRUE) . "/media/com_doska/css/style.css");
    }

    private function addSubMenu($viewName)
    {
        return DoskaHelper::addSubMenu($viewName);
    }
}
?>