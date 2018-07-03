<?php
defined("_JEXEC") or die();

class DoskaViewTest extends JViewLegacy
{

    public function display($tpl = null)
    {

        /*$db = jFactory::getDbo();

        $query = $db->getQuery(TRUE);


        $select = $db->quoteName(array('a.id', 'a.title', 'a.alias', 'a.link'), array('one', 'two', 'three', 'four'));
        $query->select($select);
        $query->from($db->quoteName('#__menu', 'a'));
        $query->select('b.name, b.extension_id');
        $query->join('LEFT', $db->quoteName('#__extensions', 'b') . ' ON (' . $db->quoteName('b.extension_id') . ' = ' . $db->quoteName('a.component_id') . ')');*/

        //$query->order($db->quoteName('id').' DESC');

        //$query->group($db->quoteName('title'));
//        $id = 3;


//        $query->where($db->quoteName('id') . ' > ' . $db->quote($id));
        //$query->where($db->quoteName('itle').' LIKE '.$db->quote('Banners'));

//        $db->setQuery($query);

//        $result = $db->loadAssocList();
//        $result = $db->loadAssoc();
//        $result = $db->loadRow();
//        $result = $db->loadRowList(2);
//        $result = $db->loadResult();
//        $result = $db->loadObjectList();
//        $result = $db->loadObject();

//        echo $query;

//        $db->execute();
//        echo "<br/>";
//        echo $db->getNumRows();
        //SELECT * FROM table WHERE id=2
        //$result = '';

        $option = array();
        $option['driver'] = 'mysqli';
        $option['host'] = 'localhost';
        $option['user'] = 'root';
        $option['password'] = '';
        $option['database'] = 'doska';


        $db = JDatabaseDriver::getInstance($option);
//        $tables = $db->getTableList();
        $db->connect();
        $conn = $db->connected();
        if($conn) {
            echo "Подключение к БД установлено";
        }
        else{
            echo "НЕТ Подключения к БД";
        }

        /*$mini = new stdClass();
        $mini->id_menu = 5;
        $mini->name_menu = 'Тест 2';
        $mini->text_menu = 'Текст меню 2';

        //$result = $db->insertObject('menu',$mini);
        $result = $db->updateObject('menu', $mini, 'id_menu');

        $query = $db->getQuery(TRUE);

        $query->delete('menu');
        $query->where('id_menu = 5');

        $db->setQuery($query);
        $result = $db->execute();*/

//        echo "<pre>";
//        print_r($tables);
//        echo "</pre>";


        parent::display($tpl);
    }

}

?>