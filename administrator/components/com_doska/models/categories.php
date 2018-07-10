<?php
defined("_JEXEC") or die();

class DoskaModelCategories extends JModelList
{
//    protected  $orderCol ='id';
//    protected  $orderDirn ='desc';

	public function __construct($config = array())
	{
	    $config['filter_fields'] = array(
	        'id',
            'name',
            'state',
            'alias',
            'ordering'
        );

        parent::__construct($config);
    }


    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query =$db->getQuery(true);

        $query->select('id, name, parentid, alias, state, ordering');
        $query->from('#__doska_categories');

//	    echo $this->getState('mylist.paramlist', 'default');
//        print_r($this->state);

        $orderCol = $db->escape($this->getState('list.ordering', 'id'));
        $orderDirn = $db->escape($this->getState('list.direction', 'desc'));

        $query->order($orderCol.' '.$orderDirn);

//        echo $query;

        return $query;
    }

    protected function populateState($ordering = null, $direction = null)
    {
//	    $key = 'com_doska.categories.mylist.paramlist';
//        $state = $this->getUserStateFromRequest($key,'paramlist', 'default');
//	    $this->setState('mylist.paramlist',$state);
//
//	    $key2 = 'com_doska.categories.my_list.param2';
//	    $state2 = $this->getUserStateFromRequest($key,'param2', 'default');
//	    $this->setState('mylist.param2',$state2);


        parent::populateState($ordering, $direction);
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
				$condition = $this->getReorderConditions($this->table);
				$found = false;

				foreach ($conditions as $cond)
				{
					if ($cond[1] == $condition)
					{
						$found = true;
						break;
					}
				}

				if (!$found)
				{
					$key = $this->table->getKeyName();
					$conditions[] = array($this->table->$key, $condition);
				}
			}
		}

		// Execute reorder for each category.
		foreach ($conditions as $cond)
		{
			$this->table->load($cond[0]);
			$this->table->reorder($cond[1]);
		}

		// Clear the component's cache
		$this->cleanCache();

		return true;
	}

}
?>
