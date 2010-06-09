<?php

$options = array (
	
	array(	"name" => "config",
			"format" => "help"),

	array(	"name" => "Category Settings",
			"format" => "title"),
			
	array(	"format" => "start",
			"title" => "Category Style Settings"),
			
		array(	"name" => "Show categories BEFORE or AFTER the pages in the main navigation?",
				"desc" => "",
				"id" => $shortname."categoryNavPos",
				"default" => "after",
				"options"=> array(
					'before'=>'Before', 
					'after'=>'After'),
				"format" => "radio"),
			
		array(	"name" => "Individual Category Styles",
				"desc" => "Select either <strong>Blog Style</strong> or <strong>Portfolio Style</strong> for each of your categories to set
   	up how the category pages are displayed. <strong><em>IMPORTANT NOTE:</em></strong> When you create new categories, the default
    will be <em>Portfolio</em>, so be sure to come here to change it if needed.",
				"id" => $shortname."cat_setting",
				"default" => "portfolio",
				"format" => "catSettings"),
				
	array(	"format" => "end")
	
);

?>