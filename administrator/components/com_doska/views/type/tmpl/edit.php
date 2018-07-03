<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 28.06.2018
 * Time: 11:59
 */
defined('_JEXEC') or die('Restricted Access');
JHtml::_('formbehavior.chosen','select'); // Стилизация выпадающего меню select для статуса публикации
JHtml::_('behavior.keepalive'); // Метод который продлевает время жизни сессии, удобно при добавлении данных
?>

<form action="<?php echo JRoute::_('index.php?option=com_doska&layout=edit&id='.(int)$this->item->id) ?>" method="post" id="adminForm"
      name="adminForm" class="form-validate">

    <div class="row-fluid">
        <div class="span9">
<!--            Вывод полей формы через Лэйаут-->
            <?php echo JLayoutHelper::render('edit.title_alias',$this,'administrator/components/com_doska');?>
        </div>

        <div class="span3">
            <!--            Вывод полей формы через Лэйаут-->
            <?php echo JLayoutHelper::render('edit.global',$this,'administrator/components/com_doska');?>
        </div>
    </div>

    <?php //echo $this->form->renderFieldset('basic'); ?>
    <?php echo $this->form->getField('id')->renderField(); ?>

    <input type="hidden" name="task" value="type.edit"/>
    <?php echo JHtml::_('form.token');//Обращаемся к методу token класса JHtmlForm ?>
</form>


<?php
/* Примеры отображения полей формы */
//echo $this->form->getFieldAttribute('name','label'); // Получаем значение атрибута label в поле с именем name
//echo $this->form->setFieldAttribute('name','class', 'myClass'); //Присваивание атрибуту поля значения
//$obj = $this->form->getField('name');
//echo $obj->getControlGroup();
//echo $obj->renderField();
//print_r($obj);

//$fields = $this->form->getFieldset('basic'); // Получаем только поля фиелдсета basic
//$fields = $this->form->getFieldset(); // Если фиелдсет не указан, то получаем все поля формы
//$fields = $this->form->getGroup('type_fields'); //Получаем массив полей по группе полей
//print_r($fields);

//foreach ($fields as $field){
//    echo $field->renderField();
//}

// Альтернативный вывод полей
//foreach ($fields as $field){
//    echo $field->label;
//    echo $field->input;
//}

//echo $this->form->getLabel('name','type_fields');
//echo $this->form->getInput('name','type_fields');
//echo $this->form->getName();
?>

