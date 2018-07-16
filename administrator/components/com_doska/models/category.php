<?php
defined("_JEXEC") or die();

class DoskaModelCategory extends JModelAdmin {

    public function getForm($data = array(),$loadData = true) {


        $form = $this->loadForm(
            $this->option.'_category',
            'category',
            array('control'=>'jform','load_data'=>$loadData)
        );


        if(empty($form)) {
            return FALSE;
        }

        return $form;
    }

    public function getTable($type = 'Category', $prefix = 'DoskaTable',$config = array()) {
        $table = JTable::getInstance($type,$prefix,$config);
        return $table;
    }

    protected function loadFormData()
    {
        // Вытаскиваем данные из сесии
        $data = JFactory::getApplication()->getUserState('com_doska.edit.category.data',array());

        if(empty($data)) {
            $data = $this->getItem();
        }
//        print_r($data);
//        exit();
        return $data;
    }

    public function save ($data){
//        print_r($data);
//        exit();
        if(!trim($data['name'])) {
            $this->setError(JText::_('COM_DOSKA_WARNING_PROVIDE_VALID_NAME'));
            return FALSE;
        }

        if(trim($data['alias']) == '') {
            $data['alias'] = $data['name'];
            $data['alias'] = JApplicationHelper::stringURLSafe($data['alias']);
        }
        else{
            $data['alias'] = JApplicationHelper::stringURLSafe($data['alias']);
        }

//        $data['parent_id'] = $data['parentid'];

        if(parent::save($data)) {
            return TRUE;
        }
        return FALSE;
    }

	/**
	 * Saves the manually set order of records.
	 *
	 * @param   array    $pks    An array of primary key ids.
	 * @param   integer  $order  +1 or -1
	 *
	 * @return  boolean|\JException  Boolean true on success, false on failure, or \JException if no items are selected
	 *
	 * @since   1.6
	 */
	public function saveorder($pks = array(), $order = null)
	{
		// Initialize re-usable member properties
		$this->initBatch();

		$conditions = array();

		if (empty($pks))
		{
			return \JError::raiseWarning(500, \JText::_($this->text_prefix . '_ERROR_NO_ITEMS_SELECTED'));
		}

		$orderingField = $this->table->getColumnAlias('ordering');

		// Update ordering values
		foreach ($pks as $i => $pk)
		{
			$this->table->load((int) $pk);

			// Access checks.
			if (!$this->canEditState($this->table))
			{
				// Prune items that you can't change.
				unset($pks[$i]);
				\JLog::add(\JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'), \JLog::WARNING, 'jerror');
			}
			elseif ($this->table->$orderingField != $order[$i])
			{
				$this->table->$orderingField = $order[$i];

				if ($this->type)
				{
					$this->createTagsHelper($this->tagsObserver, $this->type, $pk, $this->typeAlias, $this->table);
				}

				if (!$this->table->store())
				{
					$this->setError($this->table->getError());

					return false;
				}

				// Remember to reorder within position and client_id
//				$condition = $this->getReorderConditions($this->table);
//				$found = false;
//
//				foreach ($conditions as $cond)
//				{
//					if ($cond[1] == $condition)
//					{
//						$found = true;
//						break;
//					}
//				}
//
//				if (!$found)
//				{
//					$key = $this->table->getKeyName();
//					$conditions[] = array($this->table->$key, $condition);
//				}
			}
		}

		 // Execute reorder for each category.
//		foreach ($conditions as $cond)
//		{
//			$this->table->load($cond[0]);
//			$this->table->reorder($cond[1]);
//		}

		// Clear the component's cache
		$this->cleanCache();

		return true;
	}
}
?>