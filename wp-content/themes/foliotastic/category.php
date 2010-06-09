<?php get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
        
        	<div class="single-title-image">
            <h2><?php single_cat_title(); ?></h2>
    		</div>
            
    		<?php if (have_posts()) : ?>
            
            	<div class="navigation">
                    <div class="alignleft page-button"><?php previous_posts_link('Previous') ?></div>
                    <div class="alignright page-button"><?php next_posts_link('Next') ?></div>
                </div>
                
                <div class="clear"></div>
                
                <? $cat_id = get_query_var('cat') ?>
                
				<? while (have_posts()) : the_post(); ?>
                
                	<!-- Is this a BLOG category? -->
                    <? if (get_theme_var('cat_setting_'.$cat_id) == "blog") { ?>
                        <div class="post-block">
                            <div class="thumb-comments">
                                <a href="<? the_permalink() ?>">
                                <?php if( get_post_meta($post->ID, "post_image_value", true) ) { ?>
                                    <img src="<? bloginfo('template_url') ?>/image.php?width=78&amp;height=78&amp;cropratio=78:78&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>" alt="<? the_title() ?>" />
                                <?php } else { ?><img src="<?php bloginfo('template_url'); ?>/graphics/default_thumb.gif" alt="<? the_title() ?>" /><? } ?>
                                </a>
                                <div class="comments"><a href="<? the_permalink() ?>"><?php comments_number('0', '1', '%'); ?></a></div>
                            </div>
                            <div class="post-entry">
                                <small>Posted in <?php the_category(', ') ?> on <strong><?php the_time('F j, Y'); ?></strong></small>
                                <h3><a href="<? the_permalink() ?>" title="<? the_title() ?>"><?php $title = get_the_title(); echo shrink_text($title,50) ?></a></h3>
                                <p><?php $content = echo_wswwpx_content_extract('', 200, 200, false, '', '', true, false ); echo shrink_text($content,290) ?>
                                <a href="<? the_permalink() ?>"><strong>Continue Reading</strong></a></p>
                            </div>
                        </div>
                        
                   	<!-- OR is this a PORTFOLIO category? -->
                   	<? } else {
						
						$right_margin_count++ ?>
                    
                        <div class="portfolio-entry<? if ($right_margin_count == 2) { ?> right<? $right_margin_count = 0; } ?>">
                        
                            <a href="<? the_permalink() ?>">
                            <?php if( get_post_meta($post->ID, "post_image_value", true) ) { ?>
                                <img src="<? bloginfo('template_url') ?>/image.php?width=300&amp;height=222&amp;cropratio=300:222&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>" alt="" />
                            <?php } else { ?> Default Thumb <? } ?>
                            </a>
                            
                            <div class="top-slide">
                                <h3><a href="<? the_permalink() ?>" title="<? the_title() ?>"><?php $title = get_the_title(); echo shrink_text($title,25) ?></a></h3>
                                <span class="cat">Category:</span> <span class="catname"><?php the_category(', ') ?></span>
                                
                                <? list($width, $height) = getimagesize(get_post_meta($post->ID, 'post_image_value', true));
                                if ($width > $height) { ?>
                                    <a class="lightbox-link" rel="prettyPhoto[portfolio]" title="<? the_title() ?>" href="<? bloginfo('template_url') ?>/image.php?width=800&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>"></a>
                                <? } else { ?>
                                    <a class="lightbox-link" rel="prettyPhoto[portfolio]" title="<? the_title() ?>" href="<? bloginfo('template_url') ?>/image.php?height=600&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>"></a>
                                <? } ?>
                            </div>
                            <div class="bottom-slide">
                                <div class="comments"><a href="<? the_permalink() ?>"><?php comments_number('0', '1', '%'); ?></a></div>
                                <div class="date-link"><span class="date"><?php the_time('F j, Y'); ?></span><br />
                                <a href="<? the_permalink() ?>">View Details</a></div>
                            </div>
                        </div>
                        
                   	<? } ?>
                    
                <?php endwhile; ?>
                
                <div class="clear"></div>
                
                <div class="navigation">
                    <div class="alignleft page-button"><?php previous_posts_link('Previous') ?></div>
                    <div class="alignright page-button"><?php next_posts_link('Next') ?></div>
                </div>
            
            <?php else :
				printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
			endif;?>
            
        </div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>