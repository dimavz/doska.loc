<?php
defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.framework');

JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss');

?>

	<?php if (is_object($this->item)) : ?>
		<?php
//        print_r($this->item);
		$item = $this->item; ?>
        <div class="t_mess">
            <h4 class="title_p_mess">
				<?php echo $item->title; ?>
            </h4>

            <p class="p_mess_cat">
                <span><strong>Категория:</strong> <?php echo $item->category; ?></span>
                <span><strong>Тип объявления:</strong><?php echo $item->type; ?> </span>
                <span><strong>Город:</strong><?php echo $item->town; ?> </span></p>
            <p class="p_mess_cat">
                <span><strong>Дата добавления объявления:</strong><?php echo $item->publish_up; ?></span>
                <span><strong>Дата снятия с публикации:</strong><?php echo $item->publish_down; ?> </span>
                <span><strong>Цена:</strong><?php echo $item->price; ?></span>
                <span><strong>Автор:</strong><?php echo $item->author_name; ?> </span>
            </p>
            <p>
                <img class="mini_mess"
                     src="<?php echo $this->params->get('img_path') . '/' . $this->params->get('img_thumb') . '/' . $item->images->get('img') ?>">
            </p>
			<?php echo $item->introtext; ?>

			<?php echo nl2br($item->fulltext); ?>

        </div>
	<?php endif; ?>
