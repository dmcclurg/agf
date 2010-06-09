<?php
global $theme_version_number;
global $theme_name_for_updates;

$options = array (
	
	array(	"name" => "config",
			"format" => "help"),

	array(	"name" => "Theme Update Information",
			"format" => "title"),

	array(	"format" => "start",
			"title" => "Theme Update Information"),			

		array(	"name" => "Theme Update Information",
				"version" => $theme_version_number,
				"themename" => $theme_name_for_updates,
				"format" => "theme_information"),
				
	array(	"format" => "end"),	

	array(	"name" => "General Settings",
			"format" => "title"),
			
	array(	"format" => "start",
			"title" => "Logo"),
		
		array(	"name" => "Main  Logo",
				"desc" => "Enter the full URL to your logo file. (i.e., http://www.mydomain.com/wp-content/uploads/logo.png)<br />It shouldn't be wider than 300px!",
				"id" => $shortname."logoImage",
				"default" => "",
				"format" => "text"),

	array(	"format" => "end"),
			
	array(	"format" => "start",
			"title" => "Color Settings"),
			
		array(	"name" => "Choose a Background Color",
				"desc" => "Choose a color for your background (default is #FFFFFF)",
				"id" => $shortname."bgThemeColor",
				"default" => "#FFFFFF",
				"format" => "colorpicker"),
		
		array(	"name" => "Choose a Highlight Color",
				"desc" => "Choose a color for your main highlight (default is #147CB2)",
				"id" => $shortname."mainThemeColor",
				"default" => "#147CB2",
				"format" => "colorpicker"),
				
		array(	"name" => "Choose a Midrange Color",
				"desc" => "Choose a color for your midranges (default is #F0F0F0)",
				"id" => $shortname."midThemeColor",
				"default" => "#F0F0F0",
				"format" => "colorpicker"),
				
		array(	"name" => "Choose a Text Color",
				"desc" => "Choose a color for your content (default is #5F5F5F)",
				"id" => $shortname."textThemeColor",
				"default" => "#5F5F5F",
				"format" => "colorpicker"),
				
		array(	"name" => "Choose a Search Box Background Color",
				"desc" => "Choose a color for your search box (default is #DFDFDF)",
				"id" => $shortname."searchThemeColor",
				"default" => "#DFDFDF",
				"format" => "colorpicker"),
	
	array(	"format" => "end"),
		
	array(	"format" => "start",
			"title" => "Background Settings"),
				
		array(	"name" => "Custom Background",
				"desc" => "Enter the full URL to a background image of your choice (i.e., http://www.mydomain.com/wp-content/uploads/background.jpg)",
				"id" => $shortname."bgImage",
				"default" => "",
				"format" => "text"),
				
		array(	"name" => "Background Image Alignment",
				"desc" => "Select how you want this background image to align itself.",
				"id" => $shortname."bgImageAlignment",
				"default" => "top center",
				"options"=>array('top center'=>'Top Center','top left'=>'Top Left','top right'=>'Top Right','bottom center'=>'Bottom Center','bottom left'=>'Bottom Left','bottom right'=>'Bottom Right','center center'=>'Center Center','center left'=>'Center Left','center right'=>'Center Right'),
				"format" => "select"),
				
		array(	"name" => "Background Repeat Settings",
				"desc" => "If this is a pattern or something similar, select the repeat style.",
				"id" => $shortname."bgImageRepeat",
				"default" => "no-repeat",
				"options"=>array('no-repeat'=>'No Repeat','repeat-x'=>'Repeat Horizontally','repeat-y'=>'Repeat Vertically','repeat'=>'Repeat Both'),
				"format" => "select"),

	array(	"format" => "end"),
	
	array(	"format" => "start",
			"title" => "Twitter Widget"),	
				
		array(	"name" => "Twitter Widget",
				"desc" => "Check this to enable the Twitter widget.",
				"id" => $shortname."twitterEnabled",
				"label" => "Enable Twitter Widget",
				"default" => "1",
				"format" => "checkbox"),
				
		array(	"name" => "Twitter Username",
				"desc" => "Enter your Twitter username if you have the widget enabled.",
				"id" => $shortname."twitterUsername",
				"default" => "",
				"format" => "text"),
				
		array(	"name" => "How many Twitter posts to show?",
				"desc" => "Select the number of Twitter posts to display in the sidebar.",
				"id" => $shortname."twitterPosts",
				"default" => "light",
				"options"=>array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
				"format" => "select"),

	array(	"format" => "end"),
	
	array(	"format" => "start",
			"title" => "Footer"),

		array(	"name" => "Footer - Left Side",
				"desc" => "Add your own text to the left side of the footer.",
				"id" => $shortname."footerLeft",
				"default" => 
					'Copyright &copy; 2010 - <a href="http://previews.themesnack.com/foliotastic/wp/" onclick="window.open(this.href); return false;">Foliotastic</a> - All rights reserved. Conforms to W3C Standard <a href="http://validator.w3.org/check?uri=referer" onclick="window.open(this.href); return false;">XHTML</a> &amp; <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3" onclick="window.open(this.href); return false;">CSS</a>',
				"format" => "textarea"),	
		array(	"name" => "Footer - Right Side",
				"desc" => "Add your own text to the right side of the footer.",
				"id" => $shortname."footerRight",
				"default" => 
					'Designed &amp; Developed by <a href="http://themesnack.com" onclick="window.open(this.href); return false;">ThemeSnack</a>',
				"format" => "textarea"),

	array(	"format" => "end")
	
);

?>