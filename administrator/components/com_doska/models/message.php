<?php
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

class DoskaModelMessage extends JModelAdmin
{

	public function getForm($data = array(), $loadData = true)
	{

		$form = $this->loadForm(
			$this->option . ".message",
			"message",
			array('control' => 'jform', 'load_data' => $loadData));

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	public function getTable($type = 'Message', $prefix = 'DoskaTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}


	protected function loadFormData()
	{
		$data = JFactory::getApplication()->getUserState(
			'com_doska.edit.message.data',
			array()
		);

		if (empty($data))
		{
			$data = $this->getItem();
		}

		return $data;
	}

	public function getScript()
	{
		return '/administrator/components/com_doska/models/forms/button.js';
	}

	protected function prepareTable($table)
	{
		if ((int) $table->created == 0)
		{
			$table->created = JFactory::getDate()->toSql();
		}
		if ((int) $table->publish_up == 0 && $table->state == 1)
		{
			$table->publish_up = JFactory::getDate()->toSql();
		}
		if ((int) $table->publish_down == 0 && $table->state == 1)
		{
			$table->publish_down = JFactory::getDate('+ 1 week')->toSql();
		}
//		print_r($table);
//		exit();
	}

	public function save($data)
	{
		$data['id_user'] = JFactory::getUser()->id;

		$config = JComponentHelper::getParams('com_doska');

		if (!trim($data['title']))
		{
			$this->setError(JText::_('COM_DOSKA_WARNING_PROVIDE_VALID_NAME'));

			return false;
		}

		if (trim($data['alias']) == '')
		{
			$data['alias'] = $data['title'];
			$data['alias'] = JApplicationHelper::stringURLSafe($data['alias']);
		}
		else
		{
			$data['alias'] = JApplicationHelper::stringURLSafe($data['alias']);
		}

		foreach ($data['images'] as $k => $img)
		{
			if (empty($img))
			{
				continue;
			}
			$path = JPATH_SITE. '/' ;

//			print_r($path . $img);
//			exit();

			$image = new JImage($path . $img);

			$thumbs = $image->generateThumbs(array('250x250', '350x350'), 2);

//			print_r($path . $img);
//			exit();


			if ($thumbs && is_array($thumbs))
			{
				$type = JImage::getImageFileProperties($path . $img)->type;

				if ($type)
				{
					$file = $thumbs[0]->toFile($path . $config->get('img_path').'/'.$config->get('img_thumb').'/'. basename($img), $type);
					if ($file)
					{
						$thumbs[0]->destroy();
						$image->destroy();
					}
				}
//				print_r($type);
			}
			$data['images'][$k] = basename($img);
		}
		$registry = new Registry();
		$registry->loadArray($data['images']);
		$data['images'] = (string) $registry;


//		print_r($data);
//		exit();

		if (parent::save($data))
		{
			return true;
		}

		return false;
	}

	public function confirm($cid, $value)
	{
		if(!parent::canEditState(JArrayHelper::toObject($value)))
		{
			throw new RuntimeException(JFactory::getApplication()->enqueueMessage(JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'),'warning'));
			return false;
		}
		$table = $this->getTable();

//		echo $cid."|".$value;
//		exit();

		if ($table->load($cid))
		{
			if (!$table->confirm($cid, $value))
			{
				$this->setError($table->getError());

				return false;
			}
		}
		else
		{
			$this->setError($table->getError());

			return false;
		}
		$this->cleanCache();

		return true;
	}

	protected function canEditState($record)
	{
		$user      = \JFactory::getUser();
		$userId    = $user->get('id');
		$messageId = (int) $record->id ? $record->id : 0;

		if (!$messageId)
		{
			return parent::canEditState($record);
		}

		if ($user->authorise('core.edit.state', 'com_doska'))
		{
			return true;
		}
		if ($user->authorise('core.edit.state.own', 'com_doska'))
		{
			$message = $this->getItem($messageId);
			if (empty($message))
			{
				return false;
			}

			$id_author = $message->id_user;

			if ($userId == $id_author)
			{
				return true;
			}
		}
		throw new RuntimeException(JFactory::getApplication()->enqueueMessage(JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'),'warning'));
		return false;
	}

	public function getItem($pk = null) {
		$item = array();
		if($item = parent::getItem($pk)) {

			$registry = new Registry;
			$registry->loadString($item->images);

			$config = JComponentHelper::getParams('com_doska');

			$item->images = $registry->toArray();

			//DIR.'/'.name.jpg
			foreach($item->images as $k=>$img) {

				if (!empty($img))
				{
					$item->images[$k] = $config->get('img_path').'/'.$img;
				}

			}
			return $item;
		}
		return $item;
	}
}