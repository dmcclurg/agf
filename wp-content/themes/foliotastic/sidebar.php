<?php global $themeTitle; ?>

<?php if (get_theme_var('logoImage')) { ?>
	<a href="<?php echo get_option('home'); ?>/">
    	<img class="logo-img" src="<?php theme_var('logoImage'); ?>" alt="<?php echo $themeTitle; ?>" />
   	</a>
<?php } else { ?>
	<a href="<?php echo get_option('home'); ?>/">
    	<img class="logo-img" src="<?php bloginfo('template_url'); ?>/graphics/logo.png" alt="<?php echo $themeTitle; ?>" />
   	</a>
<?php } ?>

<div id="sidebar">

	<?php if (is_home() && !get_theme_var('introductionHidden')) { ?>
	<div class="introduction">
	    <h2><?php echo stripslashes(get_theme_var('homepageHeadline')); ?></h2>
	    <p><?php echo stripslashes(get_theme_var('homepageMessage')); ?></p>
	</div>
	<?php } ?>
	
	<?php if (is_category() || is_single()) {
		
		foreach((get_the_category()) as $category) { $single_post_categories[] = $category->cat_ID; }
		$cat = $single_post_categories[0];
		
		$parentCatList = get_category_parents($cat,false,',');
		$parentCatListArray = split(",",$parentCatList);
		$topParentName = $parentCatListArray[0];
		$sdacReplace = array(" " => "-", "(" => "", ")" => "");
		$topParent = strtolower(strtr($topParentName,$sdacReplace)); 
		$topCatID = get_category_ID_by_name($topParent);
		
		$sub_cat_count = wp_list_categories('echo=0&child_of='.$topCatID.'&title_li=');
		
		if ($sub_cat_count != "<li>No categories</li>") { ?>
	    <ul class="sidebar-subpages">
	        <h2><a href="<?php echo get_category_link($topCatID) ?>"><?php echo get_cat_name($topCatID) ?></a></h2>
	        <ul><?
	            wp_list_categories('title_li=&child_of='.$topCatID);
	        ?></ul>
		</ul><?php }
	
	} ?>
	
	<?php if (is_page()) {
        widget_subpages('<ul class="sidebar-subpages">','','</ul>','');
    }
    
    if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) : endif; ?>
	
	<?php if (get_theme_var('twitterEnabled')) { ?>
	    <div class="twitter">
	        <h2>Recent Twitter Posts</h2>
	        <?php parse_cache_feed(get_theme_var('twitterUsername'),get_theme_var('twitterPosts')); ?>
	    </div>
	<?php } ?>
	
</div>