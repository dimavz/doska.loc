<?php

JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.tooltip');

$app = JFactory::getApplication();
$input = $app->input;
?>

<form action="<?php echo JRoute::_('index.php?option=com_doska&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate">

	<?php echo JLayoutHelper::render('joomla.edit.title_alias', $this); ?>

    <div class="form-horizontal">

		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>


		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_DOSKA_MESSAGE_CONTENT', true)); ?>
        <div class="row-fluid">
            <div class="span9">
                <fieldset class="adminform">
					<?php echo $this->form->getInput('text'); ?>
                </fieldset>
            </div>
            <div class="span3">
				<?php echo JLayoutHelper::render('joomla.edit.global', $this); ?>
                <fieldset class="form-vertical">
					<?php echo $this->form->renderFieldset('mesinfo');?>
                </fieldset>
            </div>
        </div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

	    <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'image', JText::_('COM_DOSKA_FIELDSET_IMAGE', true)); ?>
        <div id="forimgs" class="forforms">
            <div class="span6">
			    <?php echo $this->form->getControlGroup('images'); ?>
			    <?php foreach ($this->form->getGroup('images') as $field) : ?>
				    <?php echo $field->getControlGroup(); ?>
			    <?php endforeach; ?>
            </div>

        </div>
	    <?php echo JHtml::_('bootstrap.endTab'); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'publishing', JText::_('COM_DOSKA_FIELDSET_PUBLISHING', true)); ?>
        <div class="row-fluid form-horizontal-desktop">
            <div class="span6">
				<?php echo JLayoutHelper::render('joomla.edit.publishingdata', $this); ?>
            </div>
            <div class="span6">
				<?php //echo JLayoutHelper::render('joomla.edit.metadata', $this); ?>
				<?php //echo $this->form->renderFieldset('metadata') ?>
            </div>
        </div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>



		<?php echo JLayoutHelper::render('joomla.edit.params', $this); ?>


		<?php echo $this->form->getField('id')->renderField();?>

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>
    </div>
    <input type="hidden" name="task" value="message.edit" />
    <input type="hidden" name="return" value="<?php echo $input->getCmd('return'); ?>" />
	<?php echo JHtml::_('form.token'); ?>

	<?php foreach($this->form->getFieldset() as $form) {
		//echo $form->label; echo $form->input;
	}
	?>
</form>