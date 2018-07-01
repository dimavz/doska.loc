<?php
defined('_JEXEC') or die('Restricted Access');

$controller = JControllerLegacy::getInstance('Doska');//DoskaController
// $controller->registerTask('hello','h'); // регистрация задачи в контроллере
$input = jFactory::getApplication()->input; // Получаем объект, который содержит переменные строки запроса
$controller->execute($input->get('task','display'));
$controller->redirect();

?>