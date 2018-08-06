<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;
use Joomla\Registry\Registry;

class DoskaTableMessage extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__doska_post', 'id', $db);
	}

	public function bind($array, $ignore = array())
	{
		$pattern = '#<hr\s+id=("|\')system-readmore("|\')\s*\/*>#i';

		$podr = preg_match($pattern, $array['text']);

		if ($podr == 0)
		{
			$this->introtext = $array['text'];
			$this->fulltext  = '';
		}
		elseif ($podr == 1)
		{
			list($this->introtext, $this->fulltext) = preg_split($pattern, $array['text'], 2);
		}

		if (isset($array['params']) && is_array($array['params']))
		{
			// Конвертируем поле параметров в JSON строку.
			$parameter = new Registry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string) $parameter;
		}

		if (is_array($array['images']))
		{
			$registry = new Registry;
			$registry->loadArray($array['images']);
			$array['images'] = (string) $registry;
		}

		if (isset($array['rules']) && is_array($array['rules']))
		{
			$rules = new JAccessRules($array['rules']);
			$this->setRules($rules);
		}

		return parent::bind($array, $ignore);
	}

	public function load($pk = null, $reset = true)
	{
		if (parent::load($pk, $reset))
		{

//			$registry = new Registry;
//			$registry->loadString($this->images);
//			$this->images = $registry;

			$params_reg = new Registry;
			$params_reg->loadString($this->params);
			$this->params = $params_reg;

			return true;
		}
		else
		{
			return false;
		}
	}

	public function publish($pks = null, $state = 1, $userId = 0)
	{

		JArrayHelper::toInteger($pks);
		$state = (int) $state;

		if (empty($pks))
		{
			throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
		}

		foreach ($pks as $pk)
		{
			if (!$this->load($pk))
			{
				throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
			}
			$this->state = $state;

			if (!$this->store())
			{
				throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE_STORE'));
			}
		}

		return true;

	}

	public function confirm($cid, $value = 0)
	{
		if (empty($cid))
		{
			throw new RuntimeException(JText::_('COM_DOSKA_MESSAGE_CONFIRM_NO_ID'));
		}

		if (!isset($this->confirm))
		{
			throw new RuntimeException(JText::_('COM_DOSKA_MESSAGE_CONFIRM_NO_DATA'));
		}
//		print_r($this);
//		exit();
		$this->confirm = $value;

		if (!$this->store())
		{
			throw new RuntimeException(JText::_('COM_DOSKA_MESSAGE_CONFIRM_ERROR_SAVE_DB'));
		}

		return true;
	}

	protected function _getAssetName()
	{
		$key = $this->_tbl_key;

		return 'com_doska.message.' . (int) $this->$key;//id
	}

	protected function _getAssetTitle()
	{
		return $this->title;
	}

	protected function _getAssetParentId(JTable $table = null, $id = null)
	{
		$assetParent = JTable::getInstance('Asset');

		$assetParentId = $assetParent->getRootId();

		if (($this->id_categories)&& !empty($this->id_categories))	{
			$assetParent->loadByName('com_doska.category.' . (int) $this->id_categories);
		}

		else {
			$assetParent->loadByName('com_doska');
		}

		if ($assetParent->id)
		{
			$assetParentId=$assetParent->id;
		}
		return $assetParentId;
	}
}
