<?php
defined('_JEXEC') or die('Restricted Access');

if (!JFactory::getUser()->authorise('core.manage', 'com_doska'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

$controller = JControllerLegacy::getInstance('Doska');//DoskaController
$controller->registerTask('unconfirm', 'confirm');
// $controller->registerTask('hello','h'); // регистрация задачи в контроллере

//Регистрация класса DoskaHelper
JLoader::register('DoskaHelper',__DIR__.'/helpers/doska.php');

//echo "<pre>";
//print_r(JLoader::getClassList());
//echo "</pre>";

$input = JFactory::getApplication()->input; // Получаем объект, который содержит переменные строки запроса
$controller->execute($input->get('task','display'));
$controller->redirect();

?>