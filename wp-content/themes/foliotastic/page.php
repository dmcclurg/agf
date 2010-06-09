<?php get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
    
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="post" id="post-<?php the_ID(); ?>">
            
                <div class="single-title-image">	
                    <h2><?php the_title(); ?></h2>
                </div>
                
                <div class="entry">
                    <?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
                </div>
                
                <div class="clear"></div>
            
            </div>
            <?php endwhile; endif; ?>
        	<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
            
        </div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>