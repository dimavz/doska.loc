<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

?>

	<?php if (!empty($this->lead_items)) : ?>
		
			<?php foreach ($this->lead_items as &$item) : ?>
				<div class="items">
					<?php if($item->params->get('show_title')) :?>
						<h1 class="content-zag"><?php echo htmlspecialchars($item->title);?></h1>
					<?php endif; ?>
					
					<?php if($item->params->get('show_intro')) :?>
						<?php echo $item->event->afterDisplayTitle;?>
						<?php echo $item->event->beforeDisplayContent;?>
						
						<?php $images = json_decode($item->images);?>
						<?php if($images->image_intro) :?>
							<div>
								<img src="<?php echo $images->image_intro?>" >
							</div>
						<?php endif; ?>
						<?php echo $item->introtext;?>	
						<?php if($item->params->get('show_readmore') && $item->readmore) :?>
		<?php $link = JRoute::_(ContentHelperRoute::getArticleRoute($item->slug,$item->catid));?>
							<p class="readmore">
								<a href="<?php echo $link;?>"><?php echo JText::_("COM_CONTENT_READ_MORE_TITLE");?></a>
							</p>
						<?php endif; ?>
					<?php endif; ?>
					<?php echo $item->event->afterDisplayContent;?>
				</div>
			<?php endforeach; ?>
		
	<?php endif; ?>

	
	
	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?> </div>
	<?php endif; ?>

