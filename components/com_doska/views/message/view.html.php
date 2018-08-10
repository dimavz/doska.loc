<?php

defined('_JEXEC') or die('Restricted access');

class DoskaViewMessage extends JViewLegacy {

	protected $item;
	protected $state;
	
	public function display($tpl = null) {
		
		$this->item = $this->get('Item');//getItem()
		$this->state = $this->get('State');//getItem()

		
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseWarning(500, implode("\n", $errors));

			return false;
		}

		$model = $this->getModel();
		$model->setHit();

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
}