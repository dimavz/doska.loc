<?php
defined("_JEXEC") or die();
?>
<form action="<?php echo JRoute::_("index.php?option=com_doska&view=categories"); ?>" method="post" name="adminForm"
      id="adminForm">
    <!-- Боковая панель навигации -->
    <?php if (!empty($this->sidebar)): ?>
        <div id="j-sidebar-container" class="j-sidebar-container j-toggle-transition j-sidebar-visible span2">
            <?php echo $this->sidebar; ?>
        </div>
    <?php endif; ?>
    <div id="j-main-container" class="j-toggle-main j-toggle-transition span10">
        <table class="table table-striped table-hover">
            <thead>
            <th width="3%">
                <?php echo JText::_('COM_DOSKA_NUM'); ?>
            </th>
            <th width="2%">
                <?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="50%">
                <?php echo JText::_('COM_DOSKA_CATEGORY_TITLE'); ?>
            </th>
            <th width="35%">
                <?php echo JText::_('COM_DOSKA_CATEGOR_ALIAS'); ?>
            </th>
            <th width="5%">
                <?php echo JText::_('JSTATUS'); ?>
            </th>
            <th width="5%">
                <?php echo JText::_('JGRID_HEADING_ORDERING'); ?>
            </th>
            <th width="5%">
                <?php echo JText::_('COM_DOSKA_CATEGORY_ID'); ?>
            </th>
            </thead>
            <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php $i = 1; ?>
                <?php foreach ($this->items as $id => $category) : ?>
                    <?php if ($category['name']): ?>
                        <?php $link = JRoute::_('index.php?option=com_doska&task=category.edit&id=' . $id); ?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
                                <?php echo JHtml::_('grid.id', $i, $id); ?>
                            </td>
                            <td>
                                <strong><?php echo JHtml::_('link', $link, $category['name'], array('title' => JText::_('COM_DOSKA_EDIT_CATEGORY'))) ?></strong>
                            </td>

                            <td>
                                <?php echo $category['alias']; ?>
                            </td>

                            <td>
                                <?php echo JHtml::_('jgrid.published', $category['state'], $i, 'categories.'); ?>
                            </td>

                            <td>

                            </td>
                            <td align="center">
                                <?php echo $id; ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endif; ?>
                    <? if (is_array($category['next'])) : ?>
                        <?php $pref = " -- "; ?>
                        <?php foreach ($category['next'] as $sub): ?>
                            <?php $link = JRoute::_('index.php?option=com_doska&task=category.edit&id=' . $sub['id']); ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
                                    <?php echo JHtml::_('grid.id', $i, $sub['id']); ?>
                                </td>
                                <td>
                                    <?php echo JHtml::_('link', $link, $pref . $sub['name'], array('title' => JText::_('COM_DOSKA_EDIT_CATEGORY'))) ?>
                                </td>

                                <td>
                                    <?php echo $sub['alias']; ?>
                                </td>

                                <td>
                                    <?php echo JHtml::_('jgrid.published', $sub['state'], $i, 'categories.'); ?>
                                </td>

                                <td>

                                </td>
                                <td align="center">
                                    <?php echo $sub['id']; ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>


            </tbody>
            <tfoot>
            <tr>
                <td colspan='5'>
                    <div style="float:left"><?php echo $this->pagination->getListFooter();?></div>
                    <div style="float:right">Показать элементов на странице - <?php echo $this->pagination->getLimitBox();?></div>

                    <div style="clear:both"></div>
                    <?php echo $this->pagination->getPagesCounter();?>
                    <?php //echo $this->pagination->getPagesLinks();?>
                    <?php //echo $this->pagination->getPaginationLinks();?>
                    <?php //print_r($this->pagination->getPaginationPages());?>
                </td>
            </tr>
            </tfoot>
        </table>

        <input type="hidden" name="task" value=""/>
        <input type="hidden" name="boxchecked" value="0"/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>





