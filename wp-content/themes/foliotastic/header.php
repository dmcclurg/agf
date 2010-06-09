<?php error_reporting(0); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<? // Get style/color variables
$background_color = get_theme_var('bgThemeColor');
$background_color = str_replace('#','',$background_color);
$highlight_color = get_theme_var('mainThemeColor');
$highlight_color = str_replace('#','',$highlight_color);
$midrange_color = get_theme_var('midThemeColor');
$midrange_color = str_replace('#','',$midrange_color);
$text_color = get_theme_var('textThemeColor');
$text_color = str_replace('#','',$text_color);
$searchbox_color = get_theme_var('searchThemeColor');
$searchbox_color = str_replace('#','',$searchbox_color);

if (!$background_color) { $background_color = "FFFFFF"; }
if (!$highlight_color) { $highlight_color = "147CB2"; }
if (!$midrange_color) { $midrange_color = "F0F0F0"; }
if (!$text_color) { $text_color = "5F5F5F"; }
if (!$searchbox_color) { $searchbox_color = "DFDFDF"; } ?>

<!-- This is where we load the stylesheets.
     NOTE: Keep in mind that Foliotastic has devised a more complex way to load stylesheets so that you can change
     the colors/style in the admin panel. If you want to edit the css from scratch, simply go into the
     "/css_customize_optional/" folder and use those files INSTEAD of the below files. -->

<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/main.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/css_colors.php?<?
	echo "background_color=".$background_color;
	echo "&highlight_color=".$highlight_color;
	echo "&midrange_color=".$midrange_color;
	echo "&text_color=".$text_color;
	echo "&searchbox_color=".$searchbox_color; ?>" media="screen" type="text/css" />
	
<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie_fixes.php<? if ($custom_color) { ?>?color=<? echo $custom_color; } ?><? if ($theme_style) { ?>&style=<? echo $theme_style; } ?>&ie=7" media="screen" type="text/css" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/ie_fixes.php<? if ($custom_color) { ?>?color=<? echo $custom_color; } ?><? if ($theme_style) { ?>&style=<? echo $theme_style; } ?>&ie=6" media="screen" type="text/css" /><![endif]-->

<!-- Load the 960 Grid System & PrettyPhoto Lightbox stylesheet -->
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/960.css" media="screen" type="text/css" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<link rel="shortcut icon" href="favicon.ico" />
<!-- END Stylesheet loading -->


<!-- This fixes PNG issues with IE6 -->
<!--[if IE 6]>
	<script src="<?php bloginfo('template_url'); ?>/scripts/DD_belatedPNG_0.0.7a-min.js"></script>
	<script>DD_belatedPNG.fix('.pp_left,.pp_right,a.pp_close,a.pp_arrow_next,a.pp_arrow_previous,.pp_content,.pp_middle,.flickr h2,.twitter h2,a.next,a.previous,.featured-entry div.comments,.portfolio-entry div.comments');</script>
<![endif]-->


<!-- If you have set a background image/color in the admin panel, this is where it gets set up! -->
<? if (get_theme_var('bgImage') != '') { ?>
	<style type="text/css">
		body { background: url('<?php theme_var('bgImage') ?>')<?php if (get_theme_var('bgImageRepeat')) { echo ' '.get_theme_var('bgImageRepeat'); } else { echo ' no-repeat'; } ?><?php if (get_theme_var('bgImageAlignment')) { echo ' '.get_theme_var('bgImageAlignment'); } else { echo ' top center'; } ?> !important }
	</style>
<? } ?>
<!-- END Background color/image -->

<!-- And here's where we load the scripts for jQuery implementation -->
<?php // Includes the jQuery framework
if(!is_admin()){
	wp_deregister_script('jquery');
	wp_register_script('jquery', (get_bloginfo('template_url')."/scripts/jquery-1.4.2.min.js"), false, '1.4.2');
	wp_enqueue_script('jquery');
}

// calls hook to WordPress head functions
wp_head(); 
?>

<script type="text/javascript">var $ = jQuery.noConflict();</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/cufon_setup.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/hoverIntent.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/superfish.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-tabs.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery.elastic.js"></script>

<script type="text/javascript">
	<? if (get_theme_var('slideShowAutoRotate')){ ?>var autoRotate = 1;<? } else { ?>var autoRotate = 0;<? } ?>
	<? if (get_theme_var('slideshowSpeed')){ ?>var slideSpeed = <?php theme_var('slideshowSpeed'); ?>;<?php } else { ?>var slideSpeed = 1200;<? } ?>
	<? if (get_theme_var('slideshowDelay')){ ?>var slideDelay = <?php theme_var('slideshowDelay'); ?>;<?php } else { ?>var slideDelay = 5;<? } ?>
</script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/foliotastic.js"></script>
<!-- END Scripts -->

</head>
<body>