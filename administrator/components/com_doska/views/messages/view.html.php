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
	protected $canDo;

    public function display($tpl = null)
    {
	    $app = JFactory::getApplication();

	    $this->sidebar = $this->addSubMenu('messages');

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
	    $this->canDo = DoskaHelper::getActions();

//	    print_r($this->canDo);
//	    echo "Значение 1 = ".$this->canDo->get('core.create.messages');

	    $this->addToolBar();
	    $this->setDocument();

        parent::display($tpl);
	    return TRUE;
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_MESSAGES"), 'doska');

	    if($this->canDo->get('core.create.messages') || $this->canDo->get('core.create')) {
		    JToolBarHelper::addNew('message.add',JText::_('COM_DOSKA_MANEGER_MESSAGES_ADD'));
	    }

	    if ($this->canDo->get('core.edit')|| $this->canDo->get('core.edit.own')) {
		    JToolBarHelper::editList('message.edit');
	    }



	    if ($this->canDo->get('core.edit.state') || $this->canDo->get('core.edit.state.own')) {
		    JToolBarHelper::divider();
		    JToolbarHelper::publish('messages.publish', 'JTOOLBAR_PUBLISH', true);
		    JToolbarHelper::unpublish('messages.unpublish', 'JTOOLBAR_UNPUBLISH', true);
		    JToolBarHelper::archiveList('messages.archive');
		    JToolBarHelper::trash('messages.trash');
	    }



	    if ($this->canDo->get('core.delete')) {
		    JToolBarHelper::deleteList('', 'messages.delete', 'JTOOLBAR_EMPTY_TRASH');
	    }

	    if ($this->canDo->get('core.admin')) {
		    JToolBarHelper::preferences('com_doska');
	    }
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