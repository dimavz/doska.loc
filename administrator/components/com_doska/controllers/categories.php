<?php
defined("_JEXEC") or die();

class DoskaControllerCategories extends JControllerAdmin
{

	public function getModel($name = 'Category', $prefix = 'DoskaModel', $config = array())
	{
		return parent::getModel($name, $prefix, $config);
	}

	public function delete()
	{
// Check for request forgeries
		\JSession::checkToken() or die(\JText::_('JINVALID_TOKEN'));

		$app = JFactory::getApplication();

		// Get items to remove from the request.
//		print_r($this->input);
//		exit();
		$cid = $this->input->get('cid', array(), 'array');

		if (empty($cid) || !is_array($cid))
		{
			$app->enqueueMessage(JText::_('COM_DOSKA_MESSAGE_DELETE_CATEGORIES'), 'notice');
		}

		$flag = false;
		foreach ($cid as $id)
		{

			$db = JFactory::getDBo();
			$query = $db->getQuery(true);
			$query->select('count(*)');
			$query->from('#__doska_categories');
			$query->where('parentid ='.$id);

			$db->setQuery($query);

			try{
				$count = $db->loadResult();

				if($count > 0){
					$app->enqueueMessage(JText::_('COM_DOSKA_MESSAGE_DELETE_CATEGORY_IS_PARENT'), 'notice');
					break;
				}
				elseif($count === '0')
				{
					$flag = true;
				}
			}
			catch (RuntimeException $e)
			{
				$app->enqueueMessage(JText::_('COM_DOSKA_MESSAGE_DELETE_CATEGORIES_ERROR'), 'error');
				break;
			}
		}
		if($flag)
		{
			parent::delete();
		}

		$this->setRedirect('index.php?option='.$this->option.'&view='.$this->view_list);
	}
}

?>