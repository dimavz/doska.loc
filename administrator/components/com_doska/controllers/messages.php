<?php

class DoskaControllerMessages extends JControllerAdmin
{

	public function getModel($name = 'Message', $prefix = 'DoskaModel', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, $config);
	}

	public function confirm()
	{

		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));

		$cid = JFactory::getApplication()->input->get('cid', array(), 'array');


		$data = array('confirm' => 1, 'unconfirm' => 0);

		$task = $this->getTask();

		$value = JArrayHelper::getValue($data, $task, 0, 'int');

		//		echo $value;
		//print_r(JFactory::getApplication()->input);
		//		exit();

		if ($cid){
			$model = $this->getModel();

			JArrayHelper::toInteger($cid);

			try{
				$model->confirm($cid[0],$value);

				if($value == 1){
					$text = 'COM_DOSKA_MESSAGE_CONFIRMED';
				}
				elseif ($value == 0)
				{
					$text = 'COM_DOSKA_MESSAGE_UNCONFIRMED';
				}

				$this->setMessage(JText::_($text));
			}
			catch (RuntimeException $e)
			{
				$this->setMessage($e->getMessage(),'error');
			}
		}

		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list, false));

	}
}

?>