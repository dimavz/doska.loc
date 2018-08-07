<?php 
	
	defined("_JEXEC") or die();
	
	$doc = JFactory::getDocument();
	$config  = JFactory::getConfig();
	$doc->addStyleSheet(JUri::base(TRUE)."/templates/".$doc->template."/css/style.css");
	JHtml::_('jquery.framework');
	
?>

<!DOCTYPE html>
<html>
<head>
	
<jdoc:include type="head"/>
<script>
jQuery(document).ready(function()
{
    //удалить всплывающие подсказки tooltip с пагинации
    jQuery('.pagination a').removeClass('hasTooltip');
    jQuery('.pagination a').removeAttr('title');
});
</script>
</head>

<body>
<div id="karkas">
	
	<div id="header">
			<h2><a href="<?php echo JUri::base(TRUE)?>"><?php echo $config->get(sitename);?></a></h2>
			
      <div id="auth">
        <a class="login-link" href="http://localhost/doska/?action=login">Вход</a>
        |
        <a class="reg-link" href="http://localhost/doska/?action=registration">Регистрация</a>
      </div><!-- /End of #auth -->	
	</div><!-- /End of #header -->

	  <div id="menu">
	 
			<jdoc:include type="modules" name="position-0"/>
			
      <div style="clear:both"></div>	
		</div><!-- /End of #menu -->
    
    <div id="center">
      <div id="side_bar">
		
				<div class="cat-box">
					<jdoc:include type="modules" name="position-1"/>
				</div>
				
				<div class="search-box">
					<jdoc:include type="modules" name="position-2"/>
				</div>	
      </div><!-- /End of #side_bar -->
      
      <div id="content">
      
        <h3 class="title_page">Объявления</h3>
		<jdoc:include type="modules" name="position-3"/>
		<jdoc:include type="message" />
		<jdoc:include type="component" />
		<jdoc:include type="modules" name="position-4"/>
          	
       <!-- /End of .t_mess -->
                        
      </div><!-- /End of #content -->
      <div style="clear:both"></div>
    </div><!-- /End of #center -->

    <div id="footer">
		<jdoc:include type="modules" name="position-5"/>
      <p class="footer_text">Доска объявлений &copy; Все права защищены. 2015</p>
    </div><!-- /End of #footer -->
    
	</div><!-- /End of #karkas -->
</body>
</html>