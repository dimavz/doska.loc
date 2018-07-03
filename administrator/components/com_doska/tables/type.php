<?php
defined('_JEXEC') or die('Restricted Access');
/**
 * Created by PhpStorm.
 * User: Дмитрий
 * Date: 02.07.2018
 * Time: 15:05
 */
class DoskaTableType extends JTable
{
    public function __construct($db) {
        parent::__construct('#__doska_types','id',$db);
    }
}