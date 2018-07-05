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

    <input type="hidden" name="task" value="category.edit"/>
    <?php echo JHtml::_('form.token');//Обращаемся к методу token класса JHtmlForm ?>
</form>



