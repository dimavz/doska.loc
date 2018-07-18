<?php
// Запрет прямого доступа.
defined('_JEXEC') or die;

class DoskaTableMessage extends JTable
{
	public function __construct(&$db)
	{
		parent::__construct('#__doska_post', 'id', $db);
	}
}
