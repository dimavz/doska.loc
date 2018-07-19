Joomla.submitbutton = function(task) {

	if(task == '') {
		return false;
	}
	else {
		var isValid = true;
		//message.add
		var action = task.split('.');
		
		if(action[1] != 'cancel') {
			
			var forms = jQuery('form.form-validate');
			
			for(var i=0;i<forms.length;i++ ) {
				if(!document.formvalidator.isValid(forms[i])) {
					isValid = false;
					break;
				}
			}
		}
		if(isValid) {
			Joomla.submitform(task);
		}
		else {
			alert(Joomla.JText._('COM_DOSKA_MESSAGE_ERROR_UNACCEPTABLE'));
			return false;
		}
	}
}