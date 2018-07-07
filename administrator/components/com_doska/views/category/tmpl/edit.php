<?php
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');

$params = $this->form->getFieldsets('params');

?>
<form action="<?php echo JRoute::_('index.php?option=com_doska&layout=edit&id='.(int) $this->item->id); ?>" method="post" id="adminForm" name="adminForm" class="form-validate">
    <?php echo JHtml::_('bootstrap.startTabSet','myTab',array('active'=>'general'));?>
    <?php echo JHtml::_('bootstrap.addTab','myTab','general',JText::_('COM_DOSKA_CATEGORY_CONTENT'));?>

    <div class="row-fluid">
        <div class="span9">
            <?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>
            <?php echo $this->form->getField('parentid')->renderField();?>
        </div>
        <div class="span3">
            <?php //echo JHtml::_('bootstrap.startAccordion')?>

            <?php //echo JHtml::_('bootstrap.addSlide','myAccordian','Публикация','id')?>
            <?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
            <?php //echo JHtml::_('bootstrap.endSlide')?>

            <?php //echo JHtml::_('bootstrap.addSlide','myAccordian','Параметры','id2')?>

            <?php //foreach ($params as $name => $fieldset):?>
            <!--<fieldset >
                <ul>
                    <?php //foreach ($this->form->getFieldset($name) as $field) : ?>
                        <li><?php //echo $field->label; ?><?php echo $field->input; ?></li>
                    <?php //endforeach; ?>
                </ul>
            </fieldset>-->
            <?php //endforeach; ?>
            <?php //echo JHtml::_('bootstrap.endSlide')?>
            <?php //echo JHtml::_('bootstrap.endAccordion')?>

            <?php //echo JHtml::_('sliders.start', 'doska-slider');
            //foreach ($params as $name => $fieldset):
            //echo JHtml::_('sliders.panel', JText::_($fieldset->label), $name.'-params');?>
            <!--<fieldset >
                <ul>
                    <?php //foreach ($this->form->getFieldset($name) as $field) : ?>
                        <li><?php //echo $field->label; ?><?php //echo $field->input; ?></li>
                    <?php //endforeach; ?>
                </ul>
            </fieldset>-->
            <?php //endforeach; ?>
            <?php //echo JHtml::_('sliders.end'); ?>
        </div>
        <div>
            <?php echo $this->form->getField('id')->renderField();?>
        </div>
    </div>

    <?php echo JHtml::_('bootstrap.endTab');?>

    <?php echo JLayoutHelper::render('joomla.edit.params',$this)?>

    <?php echo JHtml::_('bootstrap.endTabSet');?>

    <input type="hidden" name="task" value="category.edit"/>
    <?php echo JHtml::_('form.token');//Обращаемся к методу token класса JHtmlForm ?>
</form>

