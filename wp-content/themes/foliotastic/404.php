<?php get_header() ?>

<div id="main-container" class="container_12">

	<div class="grid_8 right-side">
        <div id="content" class="narrowcolumn">
        
        	<div class="single-title-image">
            <h2>Error 404 - Not Found</h2>
            <p>That page or post cannot be found. Please go back or browse the site map below.</p>
            </div>
    	
        	<div class="notfound-column">
                <ul class="sidebar-subpages">
                <? wp_list_pages('title_li=<h2>Pages</h2>') ?>
                </ul>
            </div>
            
            <div class="notfound-column">
                <ul class="sidebar-subpages">
                <? wp_list_categories('title_li=<h2>Categories</h2>') ?>
                </ul>
            </div>
            
        </div>
   	</div>
    
    <div class="grid_4">      
		<?php get_sidebar(); ?>
    </div>
    
    <div class="clear"></div>
    
</div>

<?php get_footer(); ?>