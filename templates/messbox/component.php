<?php
defined('_JEXEC') or die;

$doc = Jfactory::getDocument();
$doc->addStyleSheet(JUri::base(true).'/media/jui/css/icomoon.css');
		
// Framework
JHtml::_('bootstrap.framework');
// CSS
JHtml::_('bootstrap.loadCss');
?>

<!DOCTYPE html>
<html>
<head>
	<jdoc:include type="head" />
</head>
<body class="contentpane component">
	<jdoc:include type="message" />
	<jdoc:include type="component" />
</body>
</html>
