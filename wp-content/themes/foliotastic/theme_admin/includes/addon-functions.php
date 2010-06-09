<?php
#==================================================================
#
#	Added functionality and custom functions for theme
#
#==================================================================



#-----------------------------------------------------------------
# Retrieve database options with $shortname
#-----------------------------------------------------------------


// Get theme variables, default action is echo 
//................................................................

//	$option = the option name in the database (without $shortname)
// 	$echo = print the return value (true, false). Default: true
// 	$default = value returned is no value exists in database

function theme_var($option, $act = 'echo', $default = '') {
	global $shortname;

	if ($default !== '') {
		$theme_option = get_option($shortname.$option, $default);
	} else {
		$theme_option = get_option($shortname.$option);
	}
	
	switch ($act){
		case "return":
			return $theme_option;
			break;
		default:
			echo $theme_option;
			break;
	}
}

// Shortcut for options without echo 
//................................................................

function get_theme_var($option, $default = '') {
	return theme_var($option, 'return', $default);
}


// Retrieve variables for the slide show from the database
//................................................................
$_SS_ItemLevels = get_option($shortname.'SS-ItemLevels');
$_SS_ItemLevels = $_SS_ItemLevels['SlideShow'];
$_SS_ItemValues = get_option($shortname.'SS-ItemValues');

// Print the slide show graphics
//................................................................
function printSlideShowItems($list = false, $options = false) {
	
	if (!is_array($list)) {$list = $GLOBALS['_SS_ItemLevels'];}
	if (!is_array($options)) {$options = $GLOBALS['_SS_ItemValues'];}
	
	if (count($list) > 0) { ?>
	
		<div id="featured">
			<div class="featured-entry"><?php
		
			foreach ($list as $key => $value) {
			
				// get variables setup
				$id = $value['id'];
				$URL = '';
				$hasLink = false;
				$hasContent = false;
		
				// get link path
				switch ($options['ss-'. $id .'-linkType']) {
					case 'page':
						if (!empty($options['ss-'. $id .'-linkPage'])) {
							$URL = get_page_link($options['ss-'. $id .'-linkPage']);
						}
						break;
					case 'category':
						if (!empty($options['ss-'. $id .'-linkCategory'])) {
							$URL = get_category_link($options['ss-'. $id .'-linkCategory']);
						}
						break;
					case 'url':
						$URL = $options['ss-'. $id .'-linkURL'];
						break;
					default:
						$URL = "#";
						break;
				} // end switch linkType ?>
	                            
	            <div class="slider-block">
	        
	                <?php echo '<a href="'. htmlspecialchars_decode(stripslashes($URL)) .'">';
	                echo '<img src="'. get_bloginfo('template_url') .'/image.php?width=620&amp;height=420&amp;cropratio=620:420&amp;image='. htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImagePath'])) .'" title="'. htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImageTitle'])) .'" alt="'. htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImageTooltip'])) .'" />';
	                echo '</a>'; ?>
	                <div class="top-slide">
	                    <h3><a href="<? echo htmlspecialchars_decode(stripslashes($URL)); ?>" title="<? echo htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImageTitle'])); ?>"><?php $title = htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImageTitle'])); echo shrink_text($title,40) ?></a></h3>
	                </div>
	                <div class="bottom-slide">
	                    <?php $content = htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImageTooltip'])); echo shrink_text($content,130) ?>
	                    <a href="<? echo htmlspecialchars_decode(stripslashes($URL)); ?>">More Information</a>
	                   	<a class="lightbox-link" rel="prettyPhoto[portfolio]" title="<? the_title() ?>" href="<?php bloginfo('template_url'); ?>/image.php?width=800&amp;quality=100&amp;image=<? echo htmlspecialchars_decode(stripslashes($options['ss-'. $id .'-slideImagePath'])) ?>"></a>
	                </div>
	                
	            </div>
			
			<?php } ?>
        
        </div>            
        
        <? if (count($list) > 1) { ?>
        	<a class="arrow-prev"></a>
        	<a class="arrow-next"></a>
        <? } ?>
        
        </div><?php
		
	}
} 


#-----------------------------------------------------------------
# Breadcrumbs
#-----------------------------------------------------------------

function show_breadcrumbs($homeLink = ''){
	global $post;

	$separator = ' <span>&raquo;</span> '; // what to place between the pages

	// the text to show for "Home" link
	if ($homeLink == '') {
		$homeLink = 'Home';
	} else {
		$homeLink = bloginfo('name');
	}

	if ( is_page() ){
		// bread crumb structure only logical on pages
		$trail = array($post); // initially $trail only contains the current page
		$parent = $post; // initially set to current post
		$show_on_front = get_option( 'show_on_front'); // does the front page display the latest posts or a static page
		$page_on_front = get_option( 'page_on_front' ); // if it shows a page, what page
		// while the current page isn't the home page and it has a parent
		while ( $parent->post_parent ){
			$parent = get_post( $parent->post_parent ); // get the current page's parent
			array_unshift( $trail, $parent ); // add the parent object to beginning of array
		}
		if ( 'posts' == $show_on_front ) // if the front page shows latest posts, simply display a home link
			echo '<a href="' . get_bloginfo('home') . '">'. $homeLink .'</a>'; // home page link
		else{ // if the front page displays a static page, display a link to it
			$home_page = get_post( $page_on_front ); // get the front page object
			echo '<a href="' . get_bloginfo('home') . '">'. $homeLink .'</a>'; // home page link
			if($trail[0]->ID == $page_on_front) // if the home page is an ancestor of this page
				array_shift( $trail ); // remove the home page from the $trail because we've already printed it
		}
		foreach ( $trail as $page){
			// print the link to the current page in the foreach
			if ($page->ID == $post->ID) {
				// don't need a link for the current page
				echo $separator . $page->post_title;
			} else {
				echo $separator .'<a href="'. get_page_link( $page->ID ) . '">'. $page->post_title .'</a>';
			}
		}
	}else{
		
		echo '<a href="'. get_option('home') .'">'. $homeLink .'</a>';
		
		// the text for different post types
		if (is_category() || is_single()) {
			single_cat_title($separator);
			if (is_single()) {
				echo $separator; the_title();
			}
		} elseif (is_tag()) {
			echo $separator; single_tag_title();
		} elseif (is_day()) {
			echo $separator .'Archive for '; the_time('F jS, Y');
		} elseif (is_month()) {
			echo $separator .'Archive for '; the_time('F, Y');
		} elseif (is_year()) {
			echo $separator .'Archive for '; the_time('Y');
		} elseif (is_author()) {
			echo $separator .'Author Archive';
		} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
			echo $separator .'Blog Archives';
		} elseif (is_search()) {
			echo $separator .'Search Results';
		}		

	}
}
?>