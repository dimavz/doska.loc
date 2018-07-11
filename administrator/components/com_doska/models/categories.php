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
}
?>
