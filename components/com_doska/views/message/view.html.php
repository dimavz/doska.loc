<?php

defined('_JEXEC') or die('Restricted access');

class DoskaViewMessage extends JViewLegacy {

	protected $item;
	protected $state;
	
	public function display($tpl = null) {
		
		$this->item = $this->get('Item');//getItem()
		$this->state = $this->get('State');//getItem()
		$this->params = JFactory::getApplication()->getParams();

		
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		$model = $this->getModel();
		$model->setHit();

		$this->_prepareDocument();

		parent::display($tpl);
		$this->setDocument();

		return true;
	}
	
	protected function setDocument()
	{
		$document = JFactory::getDocument();

		$document->addScript(JUri::root(TRUE).'/media/com_doska/js/jquery.flexslider.js');
		$document->addStyleSheet(JUri::root(TRUE).'/media/com_doska/css/flexslider.css');

		$script = "jQuery(window).load(function() {
				  jQuery('.flexslider').flexslider({
				    animation: 'slide',
				    controlNav: 'thumbnails'
				  });
				});";

		$document->addScriptDeclaration($script);
	}

	protected function _prepareDocument() {

		$app = JFactory::getApplication();


		$menu = $app->getMenu();

		$menuActive = $menu->getActive();

		$title = '';

		//$this->params->def('page_heading',$this->params->get('page_title',$menuActive->title));

		//$title = $this->params->get('page_heading');

		if(empty($title)) {
			$title = $app->get('sitename').' - '.$this->item->title;
		}

		if(empty($title)) {
			$title = $menuActive->title;
		}

		if(empty($title)) {
			$title = $app->get('sitename');
		}


		$this->document->setTitle($title);

//		print_r($this->params);
//		exit();

		if($this->item->metadesc) {
			$this->document->setDescription($this->item->metadesc);
		}
		elseif(!$this->item->metadesc && $this->params->get('menu-meta_description')) {
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
//
		if ($this->item->metakey)
		{
			$this->document->setMetadata('keywords', $this->item->metakey);
		}
		elseif (!$this->item->metakey && $this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
	}
}