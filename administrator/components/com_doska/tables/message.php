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

		$podr = preg_match($pattern,$array['text']);

		if($podr == 0) {
			$this->introtext = $array['text'];
			$this->fulltext = '';
		}
		elseif($podr == 1) {
			list($this->introtext,$this->fulltext) = preg_split($pattern,$array['text'],2);
		}

		if (isset($array['params']) && is_array($array['params']))
		{
			// Конвертируем поле параметров в JSON строку.
			$parameter = new Registry;
			$parameter->loadArray($array['params']);
			$array['params'] = (string) $parameter;
		}

		if (is_array($array['images'])) {
			$registry = new Registry;
			$registry->loadArray($array['images']);
			$array['images'] = (string)$registry;
		}

		return parent::bind($array, $ignore);
	}

	public function load($pk = null, $reset = true)
	{
		if (parent::load($pk, $reset)) {

			$registry = new Registry;
			$registry->loadString($this->images);
			$this->images = $registry;

			$params_reg = new Registry;
			$params_reg->loadString($this->params);
			$this->params = $params_reg;
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function publish($pks = null, $state = 1, $userId = 0) {

		JArrayHelper::toInteger($pks);
		$state = (int)$state;

		if(empty($pks)) {
			throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
		}

		foreach($pks as $pk) {
			if(!$this->load($pk)) {
				throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE'));
			}
			$this->state = $state;

			if(!$this->store()) {
				throw new RuntimeException(JText::_('COM_DOSKA_TABLE_ERROR_TYPE_STORE'));
			}
		}

		return true;

	}
}
