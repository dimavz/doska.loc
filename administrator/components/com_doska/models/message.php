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
			$path  = JPATH_SITE . '/';

			$image = new JImage($path.$img);

			$thumbs = $image->generateThumbs(array('250x250', '350x350'), 2);

//			print_r($thumbs);
//			exit();


			if ($thumbs && is_array($thumbs))
			{
				$type = JImage::getImageFileProperties($path.$img)->type;

				if ($type)
				{
					$file = $thumbs[0]->toFile($path . 'images/thumbs/' . basename($img), $type);
					if ($file)
					{
						$thumbs[0]->destroy();
						$image->destroy();
					}
				}
//				print_r($type);
			}

//			print_r($result);
//			break;

//			$thumb = $image->createThumbs(array('250x250','350x350'),2,$path.'images/thumbs/');

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
}