<?php

$options = array (
	
	array(	"name" => "slideshow",
			"format" => "help"),

	array(	"name" => "Slide Show",
			"format" => "title"),
			
	array(	"format" => "start",
			"title" => "Slide Show Options"),
			
		array(	"name" => "Auto-Rotate the Slide Show",
				"desc" => "If you want your slideshow to auto-rotate, check this box.",
				"label" => "Auto-Rotate the Slide Show",
				"id" => $shortname."slideShowAutoRotate",
				"default" => "1",
				"format" => "checkbox"),
				
		array(	"name" => "Animation Speed",
				"desc" => "This is how fast the slides will transition between eachother.",
				"id" => $shortname."slideshowSpeed",
				"default" => "1200",
				"options"=> array(
					'250'=>'Very Fast', 
					'600'=>'Fast', 
					'1200'=>'Normal', 
					'1500'=>'Slow', 
					'2000'=>'Very Slow'),
				"format" => "select"),
				
		array(	"name" => "Delay",
				"desc" => "The delay in seconds between slides between slides.",
				"id" => $shortname."slideShowDelay",
				"default" => "5",
				"options"=> array(
					'1'=>'1', 
					'2'=>'2', 
					'3'=>'3', 
					'4'=>'4', 
					'5'=>'5', 
					'6'=>'6', 
					'7'=>'7', 
					'8'=>'8', 
					'9'=>'9', 
					'10'=>'10', 
					'11'=>'11', 
					'12'=>'12', 
					'13'=>'13', 
					'14'=>'14', 
					'15'=>'15'),
				"format" => "select"),
				
	array(	"format" => "end")
	
);

?>