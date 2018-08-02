<?php
defined('_JEXEC') or die;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_content
 * @since       1.6
 */
class DoskaControllerMessage extends JControllerForm
{

	public function __construct($config = array())
	{
		parent::__construct($config);

	}

	protected function allowAdd($data = array())
	{
		$user = \JFactory::getUser();

		return $user->authorise('core.create.messages', $this->option) || parent::allowAdd($data);
	}

	protected function allowEdit($data = array(), $key = 'id')
	{
		$user      = \JFactory::getUser();
		$userId    = $user->get('id');
		$messageId = (int) $data[$key] ? $data[$key] : 0;

		if ($messageId)
		{
			if ($user->authorise('core.edit', 'com_doska.message.' . $messageId))
			{
				return true;
			}
			if ($user->authorise('core.edit.own', 'com_doska.message.' . $messageId))
			{
				$message = $this->getModel()->getItem($messageId);

				if (empty($message))
				{
					return false;
				}

				$id = $message->id_user;

				if ($userId == $id)
				{
					return true;
				}
			}
		}
		else
		{
			return parent::allowEdit($data, $key);
		}

		return false;

	}
}