<?php

defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');


?>

<form action="<?php echo JRoute::_('index.php?option=com_doska&view=categories'); ?>" method="post" name="adminForm" id="adminForm">

	<?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
        </div>
	<?php endif;?>
    <div id="j-main-container" class="span10">

        <table class="table table-striped table-hover">
            <thead>
            <th width="1%"><?php echo JText::_('COM_DOSKA_NUM'); ?></th>
            <th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
            </th>
            <th width="90%">
				<?php echo JHtml::_('grid.sort','COM_DOSKA_CATEGORIES_NAME','name',$this->listDirn,$this->listOrder);?>
            </th>

            <th width="10%">
				<?php echo JHtml::_('grid.sort','JSTATUS','status',$this->listDirn,$this->listOrder);?>
            </th>

            <th width="3%">


				<?php echo JHtml::_('grid.sort','JGRID_HEADING_ORDERING','ordering',$this->listDirn,$this->listOrder);?>
				<?php if($this->saveOrder) :?>
					<?php echo JHtml::_('grid.order',$this->categories,'filesave.png','categories.saveorder');?>
				<?php endif;?>

            </th>
            <th width="2%">
				<?php echo JHtml::_('grid.sort','COM_DOSKA_CATEGORY_ID','id',$this->listDirn,$this->listOrder);?>
            </th>
            </thead>



            <tbody>

			<?php if (!empty($this->items)) : ?>

				<?php $i = 0;?>
				<?php foreach($this->items as $id=>$cat):?>



					<?php if($cat['name']):?>
						<?php $link = JRoute::_('index.php?option=com_doska&task=category.edit&id=' . $id);?>

                        <tr>
                            <td><?php echo $i; ?></td>
                            <td>
								<?php echo JHtml::_('grid.id', $i, $id); ?>
                            </td>
                            <td>

                                <strong><?php echo JHtml::_('link',$link,$cat['name'],array('title'=>JText::_('COM_DOSKA_EDIT_CATEGORY')))  ?></strong>
                            </td>

                            <td>
								<?php echo JHtml::_('jgrid.published', $cat['state'], $i, 'categories.'); ?>
                            </td>

                            <td>

								<?php if($this->saveOrder) :?>
									<?php if($this->listDirn = 'asc') :?>
                                        <span><?php echo $this->pagination->orderUpIcon($i,true,'categories.orderup','JLIB_HTML_MOVE_UP',$this->saveOrder)?></span>
                                        <span><?php echo $this->pagination->orderDownIcon($i,$this->pagination->total,true,'categories.orderdown','JLIB_HTML_MOVE_DOWN',$this->saveOrder)?></span>
									<?php elseif($this->listDirn = 'desc') :?>

                                        <span><?php echo $this->pagination->orderUpIcon($i,true,'categories.orderdown','JLIB_HTML_MOVE_UP',$this->saveOrder)?></span>
                                        <span><?php echo $this->pagination->orderDownIcon($i,$this->pagination->total,true,'categories.orderup','JLIB_HTML_MOVE_DOWN',$this->saveOrder)?></span>

									<?php endif;?>
								<?php endif;?>

								<?php $disabled = $this->saveOrder ? '' : 'disabled="disabled"'?>
                                <input type="text" name="order[]" value="<?php echo $cat['ordering']?>" <?php echo $disabled;?>/>
                            </td>

                            <td align="center">
								<?php echo $id; ?>
                            </td>
                        </tr>
						<?php $i++;?>
					<?php endif;?>
					<? if(is_array($cat['next'])) :?>
						<?php $k = "--";?>
						<?php foreach($cat['next'] as $sub): ?>
							<?php $link = JRoute::_('index.php?option=com_doska&task=category.edit&id=' . $sub['id']);?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td>
									<?php echo JHtml::_('grid.id', $i, $sub['id']); ?>
                                </td>
                                <td>
									<?php echo JHtml::_('link',$link,$k.$sub['name'],array('title'=>JText::_('COM_DOSKA_EDIT_CATEGORY')))  ?>
                                </td>

                                <td>
									<?php echo JHtml::_('jgrid.published', $sub['state'], $i, 'categories.'); ?>
                                </td>

                                <td>

									<?php if($this->saveOrder) :?>
										<?php if($this->listDirn = 'asc') :?>
                                            <span><?php echo $this->pagination->orderUpIcon($i,true,'categories.orderup','JLIB_HTML_MOVE_UP',$this->saveOrder)?></span>
                                            <span><?php echo $this->pagination->orderDownIcon($i,$this->pagination->total,true,'categories.orderdown','JLIB_HTML_MOVE_DOWN',$this->saveOrder)?></span>
										<?php elseif($this->listDirn = 'desc') :?>

                                            <span><?php echo $this->pagination->orderUpIcon($i,true,'categories.orderdown','JLIB_HTML_MOVE_UP',$this->saveOrder)?></span>
                                            <span><?php echo $this->pagination->orderDownIcon($i,$this->pagination->total,true,'categories.orderup','JLIB_HTML_MOVE_DOWN',$this->saveOrder)?></span>

										<?php endif;?>
									<?php endif;?>

									<?php $disabled = $this->saveOrder ? '' : 'disabled="disabled"'?>
                                    <input type="text" name="order[]" value="<?php echo $sub['ordering']?>" <?php echo $disabled;?>/>
                                </td>

                                <td align="center">
									<?php echo $sub['id']; ?>
                                </td>
                            </tr>
							<?php $i++;?>
						<?php endforeach;?>

					<?php endif;?>




				<?php endforeach;?>
			<?php endif;?>

            </tbody>

            <tfoot>
            <tr>
                <td colspan='5'>
                    <div style="float:left"><?php echo $this->pagination->getListFooter();?></div>
                    <div style="float:right">Показать - <?php echo $this->pagination->getLimitBox();?></div>

                    <div style="clear:both"></div>
					<?php //echo $this->pagination->getPagesCounter();?>
					<?php //echo $this->pagination->getPagesLinks();?>
					<?php //echo $this->pagination->getPaginationLinks();?>
					<?php //print_r($this->pagination->getPaginationPages());?>
                </td>
            </tr>
            </tfoot>
        </table>


    </div>

    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />

    <input type="hidden" name="filter_order" value="<?php echo $this->listOrder?>" />
    <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn?>" />



	<?php echo JHtml::_('form.token'); ?>
</form>



