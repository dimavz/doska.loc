<?php
defined('_JEXEC') or die;

$app = JFactory::getApplication();

if ($app->isSite())
{
	JSession::checkToken('get') or die(JText::_('JINVALID_TOKEN'));
}

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.framework', true);
JHtml::_('formbehavior.chosen', 'select');

$function  = $app->input->getCmd('function', 'jSelectMessage');


$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
?>
<form action="<?php echo JRoute::_('index.php?option=com_doska&view=messages&layout=modal&tmpl=component&function=' . $function . '&' . JSession::getFormToken() . '=1');?>"
      method="post" name="adminForm" id="adminForm" class="form-inline">

	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<th class="title">
					<?php echo JHtml::_('grid.sort', 'JGLOBAL_TITLE', 'a.title', $listDirn, $listOrder); ?>
				</th>
				<th width="15%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_TYPE_NAME', 'type', $this->listDirn, $this->listOrder); ?>
				</th>
				<th width="15%" class="center nowrap">
					 <?php echo JHtml::_('grid.sort', 'JCATEGORY', 'category', $this->listDirn, $this->listOrder); ?>
				</th>
				<th width="5%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'JSTATUS', 'state', $this->listDirn, $this->listOrder); ?>
				</th>
				<th width="5%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'COM_DOSKA_MESSAGES_CONFIRM', 'confirm', $this->listDirn, $this->listOrder); ?>
				</th>
				<th width="1%" class="center nowrap">
					<?php echo JHtml::_('grid.sort', 'COM_MESSAGE_ID', 'id', $this->listDirn, $this->listOrder); ?>
				</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="15">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
		
		<?php if (!empty($this->items)) : ?>
			<?php foreach($this->items as $key =>$item) :?>
				
			
				<tr>
						<td>
			
				<?php echo $val->title;?>
	<a href="javascript:void(0)" onclick="if (window.parent) window.parent.<?php echo $this->escape($function);?>('<?php echo $item->id; ?>', '<?php echo $this->escape(addslashes($item->title)); ?>');">
						<?php echo $this->escape($item->title); ?></a>	
							
						</td>
						
						<td>
							<?php echo $item->type; ?>
						</td>
						
						<td>
							<?php echo $item->category; ?>
						</td>
						
						
						 <td>
	<?php echo JHtml::_('jgrid.published', $item->state, $key, 'messages.', false, 'cb', $item->publish_up, $item->publish_down); ?>
					     </td> 
						 
						 <td>
	<?php echo DoskaHelper::confirm_mes($item->confirm,$key,'messages.',false);?>
					     </td>

						<td align="center">
							<?php echo $item->id; ?>
						</td>
					</tr>
			<?php endforeach;?>
		<?php endif;?>
		</tbody>
	
	
	</table>
	
	
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		
		<input type="hidden" name="filter_order" value="<?php echo $this->listOrder?>" />
		<input type="hidden" name="filter_order_Dir" value="<?php echo $this->listDirn?>" />
		
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</form>