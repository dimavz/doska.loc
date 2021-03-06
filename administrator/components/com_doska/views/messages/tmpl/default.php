<?php

defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.tooltip');
JHtml::_('formbehavior.chosen', 'select');

?>
<form action="<?php echo JRoute::_('index.php?option=com_doska&view=messages'); ?>" method="post" name="adminForm"
      id="adminForm">

	<?php if (!empty($this->sidebar)) : ?>
        <div id="j-sidebar-container" class="span2">
			<?php echo $this->sidebar; ?>
        </div>
	<?php endif; ?>

    <div id="j-main-container" class="span10">

		<?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)) ?>
        <table class="table table-striped table-hover">

            <thead>
            <tr>
                <th width="1%"><?php echo JText::_('COM_DOSKA_NUM'); ?></th>
                <th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
                </th>
                <th width="50%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGES_TITLE', 'title', $this->listDirn, $this->listOrder); ?>
                </th>

                <th width="10%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGE_TOWN', 'town', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="10%">
					<?php echo JHtml::_('grid.sort', 'JAUTHOR', 'author_name', $this->listDirn, $this->listOrder); ?>
                </th>

                <th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGES_PRICE', 'price', $this->listDirn, $this->listOrder); ?>
                </th>

                <th width="10%">
					<?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_TYPE_NAME', 'type', $this->listDirn, $this->listOrder); ?>
                </th>

                <th width="5%">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGES_CONFIRM', 'confirm', $this->listDirn, $this->listOrder); ?>
                </th>
                <th width="5%">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGES_HITS', 'hits', $this->listDirn, $this->listOrder); ?>
                </th>


                <th width="2%">
					<?php echo JHtml::_('grid.sort', 'COM_MESSAGE_ID', 'id', $this->listDirn, $this->listOrder); ?>
                </th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <td colspan="5">
					<?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
            </tfoot>


            <tbody>

			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $key => $val) : ?>
					<?php

                    $canEdit = $this->canDo->get('core.edit')|| ($this->canDo->get('core.edit.own')&& JFactory::getUser()->get('id')==$val->id_user);
					if ($canEdit)
					{
						$link = JRoute::_('index.php?option=com_doska&task=message.edit&id=' . $val->id);
					}
					?>
                    <tr>
                        <td><?php echo $this->pagination->getRowOffset($key); ?></td>
                        <td>
							<?php echo JHtml::_('grid.id', $key, $val->id); ?>
                        </td>
                        <td>
							<?php
							if ($canEdit)
							{
								echo JHtml::_('link', $link, $val->title, array('title' => JText::_('COM_DOSKA_EDIT_MESSAGE')));
                            }
                            else
                            {
	                            echo $val->title;
                            }

							?>
                        </td>

                        <td>
							<?php echo $val->town; ?>
                        </td>

                        <td>
							<?php echo $val->author_name; ?>
                        </td>
                        <td>
							<?php echo $val->price; ?>
                        </td>
                        <td>
							<?php echo $val->category; ?>
                        </td>
                        <td>
							<?php echo $val->type; ?>
                        </td>

                        <td>
                            <?php $canChange = $this->canDo->get('core.edit.state')|| ($this->canDo->get('core.edit.state.own') && JFactory::getUser()->get('id')==$val->id_user); ?>
							<?php echo JHtml::_('jgrid.published', $val->state, $key, 'messages.', $canChange, 'cb', $val->publish_up, $val->publish_down); ?>
                        </td>

                        <td>
							<?php
							$canModerate = $this->canDo->get('core.edit.state');
                            echo DoskaHelper::confirm_mes($val->confirm, $key, 'messages.', $canModerate); ?>
                        </td>

                        <td>
							<?php echo $val->hits; ?>
                        </td>

                        <td align="center">
							<?php echo $val->id; ?>
                        </td>
                    </tr>
				<?php endforeach; ?>
			<?php endif; ?>
            </tbody>


        </table>


        <div>
            <input type="hidden" name="task" value=""/>
            <input type="hidden" name="boxchecked" value="0"/>

            <input type="hidden" name="filter_order" value="<?php echo $this->listOrder ?>"/>
            <input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn ?>"/>

			<?php echo JHtml::_('form.token'); ?>
        </div>
    </div>
</form>