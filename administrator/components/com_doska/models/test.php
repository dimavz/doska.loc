<?php
defined("_JEXEC") or die();

class DoskaModelTest extends JModelAdmin {
	
	public function getMyMethod(){
	    return  "Вывод данных метода getMyMethod() <br/>";
    }

    public function getForm($data = array(),$loadData = true) {

        $form = array(1,2,3,4,5);
		return $form;
	}
}
?>