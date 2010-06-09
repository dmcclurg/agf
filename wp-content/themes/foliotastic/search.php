<?php get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
    
            <?php if (have_posts()) : ?>
				
                <div class="single-title-image">
                <h2>Search Results</h2>
        		</div>
        
                <div class="navigation">
                    <div class="alignleft page-button"><?php previous_posts_link('Previous') ?></div>
                    <div class="alignright page-button"><?php next_posts_link('Next') ?></div>
                </div>
        
        		<div class="clear"></div>
        
                <?php while (have_posts()) : the_post(); ?>
                
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
        
                <?php endwhile; ?>
        
                <div class="navigation">
                    <div class="alignleft page-button"><?php previous_posts_link('Previous') ?></div>
                    <div class="alignright page-button"><?php next_posts_link('Next') ?></div>
                </div>
        
            <?php else : ?>
        
                <h2 class="center">No posts found. Try a different search?</h2>
                <?php get_search_form(); ?>
        
            <?php endif; ?>
            
        </div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>