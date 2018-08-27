<?php

defined('_JEXEC') or die('Restricted access');


class DoskaViewUsermessages extends JViewLegacy
{

	protected $items;
	protected $pagination;
	protected $state;
	protected $params;

	protected $listOrder;
	protected $listDirn;

	public function display($tpl = null)
	{

		$items            = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->state      = $this->get('State');
		$this->params     = JFactory::getApplication()->getParams();

		$this->listOrder = $this->escape($this->state->get('list.ordering'));
		$this->listDirn  = $this->escape($this->state->get('list.direction'));

		if ($items)
		{

			$menu      = JFactory::getApplication()->getMenu('site');
			$component = JComponentHelper::getComponent('com_doska');

			$attributes = array('component_id');
			$values     = array($component->id);

			$menu_items = $menu->getItems($attributes, $values);

			if (!empty($menu_items) && is_array($menu_items))
			{
				foreach ($menu_items as $item)
				{
					if (isset($item->query) && isset($item->query['view']))
					{

						if ($item->query['view'] == 'form')
						{
							$Itemid = $item->id;
						}
					}
				}
			}

			foreach ($items as $item)
			{
				//id:alias
				$item->slug   = $item->alias ? ($item->id . ':' . $item->alias) : $item->id; // slug - это строка для формирования ЧПУ (человеко понятный урл)
				$item->Itemid = $Itemid;
			}
		}

		$this->canDo = Doskahelper::getActions();


		$this->items = $items;


		parent::display($tpl);

		$this->setDocument();
	}


	protected function setDocument()
	{
		$doc = JFactory::getDocument();

		$doc->addStyleSheet(JUri::base(true) . '/media/jui/css/icomoon.css');
		$doc->addStyleSheet(JUri::base(true) . '/media/com_doska/css/style.css');


	}
}