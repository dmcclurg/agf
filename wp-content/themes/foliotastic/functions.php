<?php
if (!function_exists('shrink_text')) {
	function shrink_text($text, $chars) {
		$chars = $chars;
		$text = $text." ";
		if (strlen($text) > $chars) {
			$text = substr($text, 0, $chars);
			$text = $text . " ...";
		}
		return $text;
	}
}

function get_data($url){
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

// Create the Foliotastic Dashboard Widget
add_action('wp_dashboard_setup', 'foliotastic_wp_dashboard_setup');

// Add the Dashboard Widget
function foliotastic_wp_dashboard_setup() {

	global $themeVersion;
	global $theme_name_for_updates;
	
	wp_add_dashboard_widget('foliotastic_dashboard', __( 'Foliotastic Version '.$themeVersion ), 'foliotastic_wp_dashboard' );
}

// The actual Dashboard Widget is created here
function foliotastic_wp_dashboard() {

	global $themeVersion;
	global $theme_name_for_updates;

	wp_enqueue_script('jquery');
	wp_head();

	echo "<script type=\"text/javascript\">var $ = jQuery.noConflict();</script>";
	
	// Is there a version update?
	$returned_content = get_data('http://themesnack.com/wp-content/themes/themesnack/updates.php?version='.$themeVersion.'&theme='.$theme_name_for_updates);
	if ($returned_content) {
		echo $returned_content;
	}

}

function get_category_name_by_ID($category_id) {
	global $wpdb;
	return $wpdb->get_var("SELECT name FROM $wpdb->terms WHERE term_id=".$category_id); }

function get_category_ID_by_name($category_name) {
	global $wpdb;
	return $wpdb->get_var("SELECT term_id FROM $wpdb->terms WHERE slug='".$category_name."'"); }


// Define theme variables and other information
// ---------------------------------------------------------------

$themeInfo = get_theme_data(TEMPLATEPATH . '/style.css');
$themeVersion = trim($themeInfo['Version']);
$themeTitle = trim($themeInfo['Title']);
$shortname = strtolower(str_replace(" ","",$themeTitle)) . "_";
$theme_name_for_updates = strtolower(str_replace(" ","",$themeTitle));

// Set constants
// ---------------------------------------------------------------

define('THEMENAME', $themeTitle);
define('THEMEVERSION', $themeVersion);

// Set shortcuts variables
// ---------------------------------------------------------------

$cssPath = get_bloginfo('stylesheet_directory') . "/";
$themePath = get_bloginfo('template_url');
$themeUrlArray = parse_url(get_bloginfo('template_url'));
$themeLocalUrl = $themeUrlArray['path'] . "/";

// Setup info for dropdowns, etc. (category list, page list, etc)
// ---------------------------------------------------------------

$allCategories = get_categories('hide_empty=0');
$allPages = get_pages('hide_empty=0');
$pageList = array();
$categoryList = array();

// Create category and page list arrays
// ---------------------------------------------------------------

if (!empty($allPages)) { 
	foreach ($allPages as $thisPage) {
		$pageList[$thisPage->ID] = get_the_title($thisPage->ID);
		$pages_ids[] = $thisPage->ID;
	}
}

if (!empty($allCategories)) { 
	foreach ($allCategories as $thisCategory) {
		$categoryList[$thisCategory->cat_ID] = $thisCategory->cat_name;
		$cats_ids[] = $thisCategory->cat_ID;
	}
}

// ---------------------------------------------------------------
// Admin Menu Options
// ---------------------------------------------------------------

// include options functions
// ---------------------------------------------------------------

include_once('theme_admin/includes/option_functions.php');

// Theme menu structure
// ---------------------------------------------------------------

function this_theme_menu() {
	global $basenameFile;

	add_menu_page('Theme Options', THEMENAME, 10, 'theme-setup', 'loadOptionsPage', get_template_directory_uri().'/theme_admin/images/admin_icon.png');
	add_submenu_page('theme-setup', 'General', 'General', 10, 'theme-setup', 'loadOptionsPage');
	add_submenu_page('theme-setup', 'Homepage', 'Homepage', 10,  'homepage-options', 'loadOptionsPage');
	add_submenu_page('theme-setup', 'Categories', 'Categories', 10,  'category-settings', 'loadOptionsPage');
	add_submenu_page('theme-setup', 'Slide Show', 'Slide Show', 10,  'slideshow-options', 'loadOptionsPage');
}
	
// Create menu
// ---------------------------------------------------------------
add_action('admin_menu','this_theme_menu');

// call and display the requested options page
// ---------------------------------------------------------------

function loadOptionsPage() {
	global $themeTitle,$shortname,$pageList,$categoryList,$wp_deprecated_widgets_callbacks;
	include_once('theme_admin/includes/options_pages/'. $_GET['page'] .'.php');
	
	if ($_GET['page'] != 'slideshow-options') {
		include_once("theme_admin/options.php");
	}
}


// ---------------------------------------------------------------
// Addon Functions and Content
// ---------------------------------------------------------------

// include custom functions
include_once("theme_admin/includes/addon-functions.php");

// include meta boxes and sidebar registrations
include_once("theme_admin/includes/sidebars-metaboxes.php");

// include some other built-in plugins
include('included_plugins/wptwitter.php');
include('included_plugins/content_extract.php');
include('included_plugins/getapost.php');
include('included_plugins/subpages_widget.php');
?>