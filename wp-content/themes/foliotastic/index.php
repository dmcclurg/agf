<? get_header(); ?>


<div id="main-container" class="container_12">

	<div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <?php
	// Pull the Blog categories, and get the top level name for the tab
	$categories = get_categories('hide_empty=0'); 
	foreach ($categories as $cat) {
		$temp_name = "cat_setting_".$cat->cat_ID;
		if (get_theme_var($temp_name) == 'blog') { $blog_categories .= $cat->cat_ID.','; }
	}
	
	if ($blog_categories) {
		$split_blog_categories = explode(",",$blog_categories);
		$parentCatList = get_category_parents($split_blog_categories[0],false,',');
		$parentCatListArray = split(",",$parentCatList);
		$blog_tab_title = $parentCatListArray[0];
	} ?>
    
    <div class="grid_8">
    	
    	<? if (get_theme_var('slideShowDisabled') && get_theme_var('blogTabDisabled')) { /* Show Nothing */ } else { ?>
    
	        <ul class="idTabs">
	            <? if (!get_theme_var('slideShowDisabled')) { ?><li class="active"><a href="#featured">Featured Item</a></li><? } ?>
	            <? if ($blog_categories && !get_theme_var('blogTabDisabled')) { ?>
	            	<li<? if (empty($cf_post_array) || get_theme_var('slideShowDisabled')) { ?> class="active"<? } ?>><a href="#blog"><? echo $blog_tab_title ?>: Recent Entries</a></li>
	           	<? } ?>
	        </ul>
	        
	        <div class="windows">
	            
	          	<?php if (!get_theme_var('slideShowDisabled')){ printSlideShowItems(); } ?>
	            
	            <? if ($blog_categories && !get_theme_var('blogTabDisabled')) { ?>
	                <div id="blog">
	                    
	                    <div class="blog-holder">
	                        
	                        <? if ($blog_categories) {
	                    
	                            query_posts('cat='.$blog_categories.'&order=desc&showposts=10'); ?>
	                            <?php if (have_posts()) { ?>
	                                <?php while (have_posts()) : the_post();
	                                
	                                    $temp_count++; ?>
	                                    
	                                    <? //get_a_post($post->ID) ?>
	                                    
	                                    <div class="post-block">
	                                        <div class="thumb-comments">
	                                            <a href="<? the_permalink() ?>">
	                                            <?php if( get_post_meta($post->ID, "post_image_value", true) ) { ?>
	                                                <img src="<?php bloginfo('template_url'); ?>/image.php?width=78&amp;height=78&amp;cropratio=78:78&amp;quality=100&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>" alt="" />
	                                            <?php } else { ?><img src="<?php bloginfo('template_url'); ?>/graphics/default_thumb.gif" alt="<? the_title() ?>" /><? } ?>
	                                            </a>
	                                            <div class="comments"><a href="<? the_permalink() ?>"><?php comments_number('0', '1', '%'); ?></a></div>
	                                        </div>
	                                        <div class="post-entry">
	                                            <small>Posted in <?php the_category(', ') ?> on <strong><?php the_time('F j, Y'); ?></strong></small>
	                                            <h3><a href="<? the_permalink() ?>" title="<? the_title() ?>"><?php $title = get_the_title(); echo shrink_text($title,50) ?></a></h3>
	                                            <p><?php $content = echo_wswwpx_content_extract('', 500, 500, false, '', '', true, false ); echo shrink_text($content,320) ?>
	                                            <a href="<? the_permalink() ?>"><strong>Continue Reading</strong></a></p>
	                                        </div>
	                                    </div>
	                                           
	                                <?php endwhile; ?>
	                            <?php } else { ?>
	                                <p class="error"><strong>NOTE TO ADMIN:</strong><br />You don't have any posts in your &quot;Blog&quot; categories.</p>
	                            <? } ?>
	                            
	                        <? } else { ?>
	                            <p class="error"><strong>NOTE TO ADMIN:</strong><br />You haven't selected which categories
	                            should be &quot;Blog&quot; categories from your Foliotastic Admin Panel (&quot;Category Settings&quot; Tab).</p>
	                        <? } ?>
	                    </div>
	                   
	                    <a class="previous">PREV</a>
	                    <a class="next">NEXT</a>
	                
	                </div>
	            <? } ?>
	        </div>
		<?php } ?>
        
        <?php 
  		$categories = get_categories('hide_empty=0'); 
  		foreach ($categories as $cat) {	
			$temp_name = "cat_setting_".$cat->cat_ID;
        	if (get_theme_var($temp_name) == 'portfolio') { $homepage_categories .= $cat->cat_ID.','; }
		}
		
		if ($homepage_categories) { 
			$split_home_categories = explode(",",$homepage_categories);
			$parentCatList = get_category_parents($split_home_categories[0],false,',');
			$parentCatListArray = split(",",$parentCatList);
			$homepage_category_title = $parentCatListArray[0];
			
			$sdacReplace = array(" " => "-", "(" => "", ")" => "");
			$topParent = strtolower(strtr($homepage_category_title,$sdacReplace)); 
			$homepage_catid = get_category_ID_by_name($topParent);
		} ?>
        
        <h2><a href="<?php echo get_category_link($homepage_catid);?> "><? echo $homepage_category_title ?></a>: Recent Entries</h2>
        
		<? if ($homepage_categories) {
        
			$right_margin_count = 0; $temp_count = 0;
			query_posts('cat='.$homepage_categories.'&order=desc&showposts=-1'); ?>
			<?php if (have_posts()) : ?>
				<?php while (have_posts()) : the_post();
				
					// Get the Custom Field Value
					$cf_value = get_post_meta($post->ID, "featured_value", true);
					
					
					// ------------------------------------------------------------------
					// Change this number to the number of posts you want on the homepage
					$show_on_homepage = get_theme_var('homePostsCount');
					if (!$show_on_homepage) { $show_on_homepage = 6; }
					// ------------------------------------------------------------------
					
					
					if ($cf_value != "active" && $temp_count < $show_on_homepage) {
				
						$right_margin_count++;
						$temp_count++; ?>
						
						<? get_a_post($post->ID) ?>
						
						<div class="portfolio-entry<? if ($right_margin_count == 2) { ?> right<? $right_margin_count = 0; } ?>">
						
							<a href="<? the_permalink() ?>">
							<?php if( get_post_meta($post->ID, "post_image_value", true) ) { ?>
								<img src="<?php bloginfo('template_url'); ?>/image.php?width=300&amp;height=222&amp;cropratio=300:222&amp;quality=100&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>" alt="" />
							<?php } else { ?> Default Thumb <? } ?>
							</a>
							
							<div class="top-slide">
								<h3><a href="<? the_permalink() ?>" title="<? the_title() ?>"><?php $title = get_the_title(); echo shrink_text($title,25) ?></a></h3>
								<span class="cat">Category:</span> <span class="catname"><?php the_category(', ') ?></span>
                                
                                <? list($width, $height) = getimagesize(get_post_meta($post->ID, 'post_image_value', true));
                                if ($width > $height) { ?>
                                    <a class="lightbox-link" rel="prettyPhoto[portfolio]" title="<? the_title() ?>" href="<?php bloginfo('template_url'); ?>/image.php?width=800&amp;quality=100&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>"></a>
                                <? } else { ?>
                                    <a class="lightbox-link" rel="prettyPhoto[portfolio]" title="<? the_title() ?>" href="<?php bloginfo('template_url'); ?>/image.php?height=600&amp;quality=100&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>"></a>
                                <? } ?>
                                
							</div>
							<div class="bottom-slide">
								<div class="comments"><a href="<? the_permalink() ?>"><?php comments_number('0', '1', '%'); ?></a></div>
								<div class="date-link"><span class="date"><?php the_time('F j, Y'); ?></span><br />
								<a href="<? the_permalink() ?>">View Details</a></div>
							</div>
						</div>
					
					<? } ?>
						   
				<? endwhile; ?>
			<? endif;
			
		} else { ?>
        
        	<p class="error"><strong>NOTE TO ADMIN:</strong><br />For anything to show up here, you need to choose the categories that are &quot;Portfolio&quot;
            categories by using the built-in Foliotastic Admin Panel (&quot;Category Settings&quot; Tab).</p>
            
       	<? } ?>
        
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>