<?php
defined('_JEXEC') or die();

//Регистрация класса DoskaHelper
JLoader::register('DoskaHelper',JPATH_ADMINISTRATOR.'/components/com_doska/helpers/doska.php');
JLoader::register('DoskaRoute',JPATH_SITE.'/components/com_doska/helpers/route.php');

$controller = JControllerLegacy::getInstance('Doska');//DoskaController

$input = JFactory::getApplication()->input;

$controller->execute($input->getCmd('task', 'display'));

$controller->redirect();
?>