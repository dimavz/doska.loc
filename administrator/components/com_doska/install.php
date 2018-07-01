<?php
defined('_JEXEC') or die();

class com_doskaInstallerScript {
	
	public function install($parent) {
		echo JText::_('COM_DOSKA_INSTALL_STRING');
	}
	public function update($parent) {
		echo JText::_('COM_DOSKA_UPDATE_STRING');
	}
	public function uninstall($parent) {
		echo JText::_('COM_DOSKA_UNINSTALL_STRING');
	}
	
	public function preflight($type,$parent) {
		echo JText::_('COM_DOSKA_PRE_STRING');
	}
	
	public function postflight($type,$parent) {
		echo JText::_('COM_DOSKA_POST_STRING');
	}
}

?>