<?php
defined("_JEXEC") or die();

class DoskaViewCategory extends JViewLegacy {

    protected $form;

    public function display($tpl=null){

        // Подключение другой модели, отличной от модели по умолчанию
        /*$model = JModelLegacy::getInstance('Test','DoskaModel'); // Первый параметр имя Модели, второй параметр - префикс имени класса модели
        $this->setModel($model); // Устанавливаем модель для данного вида
        $this->form = $this->get('MyMethod', 'test'); // Обращение к методу getMyMethod модели Test
        print_r($this->form);
         */

        $this->form = $this->get('Form'); // Обращение к методу модели по умолчанию getForm
//        Метод вида get() является связующим методом между видом и моделью
        $this->item = $this->get('Item'); // Обращаемся к методу getItem модели

        $this->addToolBar();
        $this->setDocument();

        parent::display($tpl);
    }

    protected function addToolBar() {

        $isnew = ($this->item->id == 0);

        if($isnew){
            $title = JText::_("COM_DOSKA_ADD_CATEGORY_TITLE");
        }
        else{
            $title = JText::_("COM_DOSKA_EDIT_CATEGORY_TITLE");
        }

        JToolBarHelper::title($title,'doska');
        JToolBarHelper::apply('category.apply');
        JToolBarHelper::save('category.save');
        JToolBarHelper::cancel('category.cancel');

    }

    protected function setDocument() {
        $doc = JFactory::getDocument();
//        $doc->setTitle(JText::_("COM_DOSKA_PAGE_TYPE_TITLE"));
        $doc->addStyleSheet(JUri::root(TRUE)."/media/com_doska/css/style.css");

    }
}
?>

