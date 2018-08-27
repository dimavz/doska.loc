<?php

defined('_JEXEC') or die('Restricted access');

JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss');

JHtml::_('behavior.framework'); // Подключение библиотеки mootools

?>


<div class="t_mess">

    <form action="<?php echo JRoute::_('index.php?option=com_doska&view=usermessages'); ?>" method="post"
          name="adminForm" id="adminForm">
        <table class="table table-striped ">

            <thead>
            <tr>
                <th width="1%"><?php echo JText::_('COM_DOSKA_NUM'); ?></th>
                <th width="2%">
					<?php echo JHtml::_('grid.checkall'); ?>
                </th>
                <th width="5%">
					<?php echo JText::_('COM_DOSKA_MESSAGES_TITLE') ?>
                </th>

                <th width="5%">
					<?php echo JText::_('JCATEGORY'); ?>
                </th>
                <th width="5%">
					<?php echo JText::_('COM_DOSKA_TYPE_NAME'); ?>
                </th>

                <th width="10%">
					<?php echo JText::_('JSTATUS'); ?>
                </th>
                <th width="10%">
					<?php echo JText::_('COM_DOSKA_MESSAGES_CONFIRM'); ?>
                </th>
                <th width="10%">
					<?php echo JText::_('COM_DOSKA_MESSAGES_HITS'); ?>
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

					$canEdit = $this->canDo->get('core.edit') || ($this->canDo->get('core.edit.own') && JFactory::getUser()->get('id') == $val->id_user);

					if ($canEdit)
					{
						$link = JRoute::_('index.php?option=com_doska&view=form&layout=edit&Itemid='.$val->Itemid.'&id=' . $val->id);
					}
					?>
                    <tr>
                        <td><?php echo $this->pagination->getRowOffset($key); ?></td>
                        <td>
							<?php echo JHtml::_('grid.id', $key, $val->id); ?>
                        </td>
                        <td>

							<?php if ($canEdit) : ?>
								<?php echo JHtml::_('link', $link, $val->title, array('title' => JText::_('COM_DOSKA_EDIT_MESSAGE'))) ?>
							<?php else : ?>
								<?php echo $val->title; ?>
							<?php endif; ?>

                        </td>

                        <td>
							<?php echo $val->category; ?>
                        </td>
                        <td>
							<?php echo $val->type; ?>
                        </td>

                        <td>
							<?php
							$canChange = ($this->canDo->get('core.edit.state')) || ($this->canDo->get('core.edit.state.own') && JFactory::getUser()->get('id') == $val->id_user);
							?>

							<?php echo JHtml::_('jgrid.published', $val->state, $key, 'usermessages.', $canChange, 'cb', $val->publish_up, $val->publish_down); ?>

							<?php echo JHtml::_('jgrid.action', $key, 'delete', 'usermessages.', 'delete', 'delete message', '', false, 'trash', '', $canChange); ?>


                        </td>

                        <td>

							<?php
							$canModerate = $this->canDo->get('core.edit.state');
							?>
							<?php echo DoskaHelper::confirm_mes($val->confirm, $key, 'messages.', false); ?>
                        </td>

                        <td>
							<?php echo $val->hits; ?>
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

    </form>
</div>