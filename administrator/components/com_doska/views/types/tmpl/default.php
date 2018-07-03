<?php
defined("_JEXEC") or die();
?>
<form action="<?php echo JRoute::_("index.php?option=com_doska&view=types"); ?>" method="post" name="adminForm"
      id="adminForm">

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <td width="1%">
                <?php echo JText::_('COM_DOSKA_NUM'); ?>
            </td>
            <td width="2%">
                check
            </td>
            <td width="90%">
                <?php echo JText::_('COM_DOSKA_TYPE_NAME'); ?>
            </td>
            <td width="5%">
                <?php echo JText::_('JSTATUS'); ?>
            </td>
            <td width="2%">
                <?php echo JText::_('COM_DOSKA_TYPE_ID'); ?>
            </td>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($this->items as $item) : ?>
                <tr>
                    <td>
                        <?php echo $i;?>
                    </td>
                    <td>
                    </td>
                    <td>
                        <?php $link = JRoute::_('index.php?option=com_doska&task=type.edit&id=' . $item->id); ?>
                        <a href="<?php echo $link; ?>"><?php echo $item->name; ?></a>
                    </td>
                    <td>
                        <?php echo $item->state; ?>
                    </td>
                    <td>
                        <?php echo $item->id; ?>
                    </td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
