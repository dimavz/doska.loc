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
    protected $items;
    protected $pagination;
    protected $state;

    protected $listOrder; // Хранит поле по которому производиться сортировка
    protected $listDirn;
    protected $saveOrder;
    protected $categories;

    public function display($tpl = null)
    {
        $this->addToolBar();
        $this->sidebar = $this->addSubMenu('categories');
        $this->setDocument();
        // Подключаем постраничную навигацию
        $this->pagination    = $this->get('Pagination');

        $categories = $this->get('Items'); // Обращение к методу getItems() модели
	    $this->categories = $categories;
//
        $this->items = array();

        if(is_array($categories))
        {
            foreach ($categories as $category){
                if($category->parentid == 0){
                    $this->items[$category->id]['name'] =  $category->name;
                    $this->items[$category->id]['state'] =  $category->state;
                    $this->items[$category->id]['alias'] =  $category->alias;
                    $this->items[$category->id]['ordering'] =  $category->ordering;
                }
                else{
                    $this->items[$category->parentid]['next'][] = array(
                        'id'=>$category->id,
                        'name'=>$category->name,
                        'state'=>$category->state,
                        'alias'=>$category->alias,
                        'ordering'=>$category->ordering
                    );
                }
            }
        }

//        $app = JFactory::getApplication();
        //$key = 'com_doska.categories.my_list.my_params';
        //$value = "data12234556";
        //$app->setUserState($key, $value);

//        $default = 'Значение по умолчанию';
//        echo "<PRE>";
//        print_r($app->getUserState($key, $default));
//        echo "</PRE>";

//	    $key = 'com_doska.categories.my_list.paramlist';
//	    $param = 'paramlist';
//	    $getstate = $app->getUserStateFromRequest($key,$param,$default );
//	    echo '<strong>Значение переменной $getstate = '.$getstate.'</strong><br/>>';


//	    echo $app->getUserState($key,$default );
//	    $this->state = $this->get('State'); // Вызов метода getState
//	    echo "<PRE>";
//        print_r($this->state);
//        echo "</PRE>";

	    $this->state = $this->get('State'); // Вызов метода getState
		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn = $this->escape($this->state->get('list.direction'));
		$this->saveOrder = $this->listOrder == 'ordering';

        parent::display($tpl);
    }


    protected function addToolBar()
    {

        JToolbarHelper::title(JText::_("COM_DOSKA_MANEGER_CATEGORIES"), 'doska');

        JToolbarHelper::addNew('category.add', JText::_('COM_DOSKA_MANEGER_CATEGORIS_ADD'));
        JToolbarHelper::editList('category.edit');

        JToolbarHelper::divider();


        JToolbarHelper::publish('categories.publish', 'JTOOLBAR_PUBLISH', TRUE);
        JToolbarHelper::unpublish('categories.unpublish', 'JTOOLBAR_UNPUBLISH', TRUE);

        JToolbarHelper::deleteList('COM_DOSKA_MANEGER_CATEGORIES_DELETE_MSG', 'categories.delete','JTOOLBAR_DELETE');

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