<? get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
	
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            
            	<?php // Get current category ID
				foreach(get_the_category() as $category) { $thecat = $category->cat_ID; } ?>
        
                <div class="navigation">
                    <div class="alignleft page-button"><?php previous_post_link('%link','<strong>PREVIOUS:</strong> %title',TRUE) ?></div>
                    <div class="alignright page-button"><?php next_post_link('%link','<strong>NEXT:</strong> %title',TRUE) ?></div>
                </div>
                
                <div class="clear"></div>
        
                <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
                	
                    <div class="single-title-image">
						<? if (get_theme_var('cat_setting_'.$thecat) == "portfolio") { ?>
                            <?php if( get_post_meta($post->ID, "post_image_value", true) ) { ?>
                                <img src="<? bloginfo('template_url') ?>/image.php?width=620&amp;image=<? echo get_post_meta($post->ID, 'post_image_value', true) ?>" alt="" />
                            <? } ?>
                        <? } ?>
                    	<h2><?php the_title(); ?><br />
                        <span class="cat">Category:</span>&nbsp;<span class="catname"><?php the_category(', ') ?></span></h2>
                    </div>
        
                    <div class="entry">
                    
                        <?php the_content('<p class="serif">Read the rest of this entry &raquo;</p>'); ?>
        
        				<div class="clear"></div>
        
                        <?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
                        <?php the_tags( '<p>Tags: ', ', ', '</p>'); ?>
        
                        <p class="postmetadata alt">
                            <small>
                                This entry was posted on <?php the_time('l, F jS, Y') ?> at <?php the_time() ?>
                                and is filed under <?php the_category(', ') ?>.
                                You can follow any responses to this entry through the <?php post_comments_feed_link('RSS 2.0'); ?> feed.
        
                                <?php if (('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                                    // Both Comments and Pings are open ?>
                                    You can <a href="#respond">leave a response</a>, or <a href="<?php trackback_url(); ?>" rel="trackback">trackback</a> from your own site.
        
                                <?php } elseif (!('open' == $post-> comment_status) && ('open' == $post->ping_status)) {
                                    // Only Pings are Open ?>
                                    Responses are currently closed, but you can <a href="<?php trackback_url(); ?> " rel="trackback">trackback</a> from your own site.
        
                                <?php } elseif (('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                                    // Comments are open, Pings are not ?>
                                    You can skip to the end and leave a response. Pinging is currently not allowed.
        
                                <?php } elseif (!('open' == $post-> comment_status) && !('open' == $post->ping_status)) {
                                    // Neither Comments, nor Pings are open ?>
                                    Both comments and pings are currently closed.
        
                                <?php } edit_post_link('Edit this entry','','.'); ?>
        
                            </small>
                        </p>
        
                    </div>
                </div>
                
            <?php comments_template(); ?>
        
            <?php endwhile; else: ?>
        
                <p>Sorry, no posts matched your criteria.</p>
        
            <?php endif; ?>

		</div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>
