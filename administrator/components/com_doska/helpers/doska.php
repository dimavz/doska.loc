<?php
defined("_JEXEC") or die();

abstract class DoskaHelper
{
    public static function addSubMenu($viewName){

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_MESSAGES'),
            'index.php?option=com_doska',
            $viewName =='messages'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_CATEGORIES'),
            'index.php?option=com_doska&view=categories',
            $viewName =='categories'
        );

        JHtmlSidebar::addEntry(
            JText::_('COM_DOSKA_SUBMENU_TYPES'),
            'index.php?option=com_doska&view=types',
            $viewName =='types'
        );

        if ($viewName == 'types'){
            $doc = JFactory::getDocument();
            $doc->addStyleDeclaration('.doska-myclass : {color: red; }');
        }

        $options[] = JHtml::_('select.option', '1', JText::_('JPUBLISHED'));
		$options[] = JHtml::_('select.option', '0', JText::_('JUNPUBLISHED'));
		$options[] = JHtml::_('select.option', '2', JText::_('JARCHIVED'));
		$options[] = JHtml::_('select.option', '-2', JText::_('JTRASHED'));
		$options[] = JHtml::_('select.option', '*', JText::_('JALL')) ;

       JHtmlSidebar::addFilter(
		    JText::_('JOPTION_SELECT_PUBLISHED'),
		    'filter[state]',
		    JHtml::_('select.options', $options, "value", "text")
		);

        return JHtmlSidebar::render();
    }

    public static function confirm_mes($value,$i,$prefix='',$can=false,$img1='tick.png',$img0='publish_x.png')
    {
	    echo $confirm;
	    if(is_object($value)) {
		    $value = $value->confirm;
	    }


	    $class = "class='btn btn-micro hasTooltip ";

	    if(!$can) {
		    $class .= "disabled";
	    }
	    $class .= "'";

	    $img = $value ? $img1 : $img0;

	    $task = $value ? 'unconfirm' : 'confirm';

	    $alt = $value ? JText::_('COM_DOSKA_UNCONFIRM') : JText::_('COM_DOSKA_CONFIRM');

	    $action = $value ? JText::_('COM_DOSKA_ACTION_UNCONFIRM') : JText::_('COM_DOSKA_ACTION_CONFIRM');

	    $html = '<a '.$class;//<a class="....."
	    //cb3
	    if($can) {
		    $html .= ' onclick="return listItemTask(\'cb'.$i.'\',\''.$prefix.$task.'\')" title="'.$action.'"';
	    }

	    $html .= '>'.JHtml::_('image','admin/'.$img,$alt,NULL,true).'</a>';

	    return $html;

    }

	public static function getActions($messageId = 0) {

		$result = new JObject();

		if(empty($messageId)) {
			$assetName = 'com_doska';
		}
		elseif($messageId) {
			$assetName = 'com_doska.message.'.$messageId;//com_doska.message.ID
		}
		//$actions = JAccess::getActions('com_doska','component');

		$path  = JPATH_ADMINISTRATOR.'/components/com_doska/access.xml';
		$actions = JAccess::getActionsFromFile($path,"/access/section[@name='component']/");

		/*echo "<pre>";
		print_r($actions);
		echo "</pre>";*/

		foreach($actions as $action) {
			$result->set($action->name,JFactory::getUser()->authorise($action->name,$assetName));
		}

		return $result;
	}
}