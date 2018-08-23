<?php
defined('_JEXEC') or die('Restricted Access');

JHtml::_('behavior.framework');

JHtml::_('bootstrap.framework');
JHtml::_('bootstrap.loadCss');

//print_r($this->params);
//exit();
?>

<form action="<?php echo htmlspecialchars(JUri::getInstance()->toString());?>" method="post" name="adminForm" id="adminForm">

	<?php if(is_array($this->items)) :?>
		<?php foreach($this->items as  $item) :?>
            <div class="t_mess">
                <h4 class="title_p_mess">
					<?php // $link = 'index.php?option=com_doska&view=message&id='.$item->id  // Старый способ формирования ссылки?>
					<?php $link = DoskaRoute::getMessageRoute($item->slug,$item->catslug, $item->typeslug );
//                    echo $link;
                    ?>
                    <a href="<?php echo JRoute::_($link);?>">
						<?php echo $item->title;?>
                    </a>
                </h4>
                <p class="p_mess_cat">
                    <span><strong>Категория:</strong> <a href="<?php echo JRoute::_(DoskaRoute::getCategoryRoute($item->catslug));?>"><?php echo $item->category;?></a></span>
                    <span><strong>Тип объявления:</strong><a href="<?php echo JRoute::_(DoskaRoute::getTypeRoute($item->typeslug));?>"> <?php echo $item->type;?></a></span>
                    <span><strong>Город:</strong><a href="<?php echo JRoute::_(DoskaRoute::getFilterRoute('town',$item->town));?>"><?php echo $item->town;?></a></span></p>
                <p class="p_mess_cat">
                    <span><strong>Дата добавления объявления:</strong> <?php echo $item->publish_up;?></span>
                    <span><strong>Дата снятия с публикации:</strong> <?php echo $item->publish_down;?> </span>
                    <span><strong>Цена:</strong> <?php echo $item->price;?></span>
                    <span><strong>Автор:</strong><a href="<?php echo JRoute::_(DoskaRoute::getFilterRoute('author',$item->id_user));?>"><?php echo $item->author_name;?></a></span>
                    <span><strong>Просмотров:</strong> <?php echo $item->hits; ?> </span>
                </p>
                <p><img class="mini_mess" src="<?php echo $this->params->get('img_path').'/'.$this->params->get('img_thumb').'/'.$item->images->img?>">

					<?php echo nl2br($item->introtext);?>


                </p>
            </div>
		<?php endforeach;?>

		<?php echo $this->pagination->getListFooter();?>
	<?php endif;?>



    <div class="pagination">
    </div>

</form>
