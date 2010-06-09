<?php

$options = array (

	array(	"name" => "config",
			"format" => "help"),

	array(	"name" => "Home Page",
			"format" => "title"),

	array(	"format" => "start",
			"title" => "Introduction Area"),
			
		array(	"name" => "Hide Introduction Area",
				"desc" => "Check this to hide the introduction area.",
				"id" => $shortname."introductionHidden",
				"label" => "Hide Introduction",
				"default" => "0",
				"format" => "checkbox"),
			
		array(	"name" => "Headline",
				"desc" => "The headline text to show on the home page. Use &lt;strong&gt;strong tags&lt;/strong&gt; to highlight specific words or phrases.",
				"id" => $shortname."homepageHeadline",
				"default" => "What is Foliotastic?",
				"format" => "text"),
				
		array(	"name" => "Message",
				"desc" => "The \"welcome\" message to show on the home page. This text immediately follows the headline.",
				"id" => $shortname."homepageMessage",
				"default" => 'Foliotastic is a premium WordPress theme from Theme Snack. It includes a full-featured, tabbed Admin Panel to change numerous options like colors, category settings, logo settings and more. With its ultra-clean layout, Foliotastic provides you with a theme that is extremely easy to install and quickly customize every aspect of your new portfolio. <a href=\"http://themesnack.com\">Get it at Theme Snack!</a>',
				"format" => "textarea"),
						
	array(	"format" => "end"),
	
	array(	"format" => "start",
			"title" => "Slideshow/Blog Tabs"),
			
		array(	"name" => "Hide Slide Show Tab",
				"desc" => "Check this to hide the slideshow area.",
				"id" => $shortname."slideShowDisabled",
				"label" => "Hide the Slide Show Tab",
				"default" => "0",
				"format" => "checkbox"),
			
		array(	"name" => "Hide Blog Tab",
				"desc" => "Check this to hide the Blog tab.",
				"id" => $shortname."blogTabDisabled",
				"label" => "Hide the Blog Tab",
				"default" => "0",
				"format" => "checkbox"),
						
	array(	"format" => "end"),
	
	array(	"format" => "start",
			"title" => "Homepage Posts"),
		
		array(	"name" => "Number of Portfolio Posts",
				"desc" => "Select the number of portfolio items to show on the home page.",
				"id" => $shortname."homePostsCount",
				"default" => "6",
				"options"=>array('2'=>'2','4'=>'4','6'=>'6','8'=>'8','10'=>'10','12'=>'12','14'=>'14','16'=>'16','18'=>'18','20'=>'20'),
				"format" => "select"),
					
	array(	"format" => "end")

);

?>