<?php get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
        
        	<?php if (have_posts()) : ?>
    
    			<div class="single-title-image">
                <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
                <?php /* If this is a category archive */ if (is_category()) { ?>
                <h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>
                <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
                <h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
                <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
                <h2>Archive for <?php the_time('F jS, Y'); ?></h2>
                <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
                <h2>Archive for <?php the_time('F, Y'); ?></h2>
                <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
                <h2>Archive for <?php the_time('Y'); ?></h2>
                <?php /* If this is an author archive */ } elseif (is_author()) { ?>
                <h2>Author Archive</h2>
                <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
                <h2>Blog Archives</h2>
                <?php } ?>
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
        
                <div class="clear"></div>
                
                <div class="navigation">
                    <div class="alignleft page-button"><?php previous_posts_link('Previous') ?></div>
                    <div class="alignright page-button"><?php next_posts_link('Next') ?></div>
                </div>
                
            <?php else :
        
                if ( is_category() ) { // If this is a category archive
                    printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
                } else if ( is_date() ) { // If this is a date archive
                    echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
                } else if ( is_author() ) { // If this is a category archive
                    $userdata = get_userdatabylogin(get_query_var('author_name'));
                    printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
                } else {
                    echo("<h2 class='center'>No posts found.</h2>");
                }
                get_search_form();
        
            endif ?>

		</div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>