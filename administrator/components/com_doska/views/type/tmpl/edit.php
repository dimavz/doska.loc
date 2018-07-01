<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 28.06.2018
 * Time: 11:59
 */
defined('_JEXEC') or die('Restricted Access');

//echo "Шаблон Edit";
//echo $this->form->renderFieldset('basic');
//echo $this->form->getFieldAttribute('name','label'); // Получаем значение атрибута label в поле с именем name
//echo $this->form->setFieldAttribute('name','class', 'myClass'); //Присваивание атрибуту поля значения
//$obj = $this->form->getField('name');
//echo $obj->getControlGroup();
//echo $obj->renderField();

//$fields = $this->form->getFieldset('basic'); // Получаем только поля фиелдсета basic
//$fields = $this->form->getFieldset(); // Если фиелдсет не указан, то получаем все поля формы
$fields = $this->form->getGroup('type_fields'); //Получаем массив полей по группе полей
//print_r($fields);

//foreach ($fields as $field){
//    echo $field->renderField();
//}

// Альтернативный вывод полей
//foreach ($fields as $field){
//    echo $field->label;
//    echo $field->input;
//}

echo $this->form->getLabel('name','type_fields');
echo $this->form->getInput('name','type_fields');
echo $this->form->getName();

//print_r($obj);
