<?php
defined("_JEXEC") or die();
?>
<form action="<?php echo JRoute::_("index.php?option=com_doska&view=types"); ?>" method="post" name="adminForm"
      id="adminForm">

    <table class="table table-striped table-hover">
        <thead>
            <th width="2%">
                <?php echo JText::_('COM_DOSKA_NUM'); ?>
            </th>
            <th width="2%">
                <?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="58%">
                <?php echo JText::_('COM_DOSKA_TYPE_NAME'); ?>
            </th>
            <th width="25%">
                <?php echo JText::_('COM_DOSKA_TYPE_ALIAS'); ?>
            </th>
            <th width="5%">
                <?php echo JText::_('JSTATUS'); ?>
            </th>
            <th width="5%">
                <?php echo JText::_('COM_DOSKA_TYPE_ID'); ?>
            </th>
        </thead>
        <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php $i = 1; ?>
            <?php foreach ($this->items as $key=>$item) : ?>
                <tr>
                    <td>
                        <?php echo $i;?>
                    </td>
                    <td>
                        <?php echo JHtml::_('grid.id',$key,$item->id); ?>
                    </td>
                    <td>
                        <?php $link = JRoute::_('index.php?option=com_doska&task=type.edit&id=' . $item->id); ?>
<!--                        <a href="--><?php //echo $link; ?><!--">--><?php //echo $item->name; ?><!--</a>-->
                        <?php echo JHtml::_('link',$link,$item->name); ?>
                    </td>
                    <td>
                        <?php echo $item->alias; ?>
                    </td>
                    <td>
                        <?php echo JHtml::_('jgrid.published',$item->state,$key,'types.'); ?>
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
