	<div id="footer">
      <div class="container_12">
            <div class="navigation-footer grid_12">
            	<?php echo stripslashes(get_theme_var('footerLeft')); ?>
                <div class="copyright"><?php echo stripslashes(get_theme_var('footerRight')); ?></div>
            </div>
        </div>
   	</div>
    
    <div id="navigation-top">
        <div class="container_12">
			<div class="feature-header">
				Sydney Experience ride
			</div>
			
            <div class="navigation-top grid_12">
                <ul class="navigation-top-ul">
                    <li<? if (is_home()) { ?> class="current_page"<? } ?>><a href="<? bloginfo('home') ?>">Home</a></li>
                	<? if (get_theme_var('categoryNavPos') == "before" || !get_theme_var('categoryNavPos')) { wp_list_categories('title_li='); } ?>
                	<? wp_list_pages('title_li='); ?>
                    <? if (get_theme_var('categoryNavPos') == "after") { wp_list_categories('title_li='); } ?>
                </ul>
                
                <div id="search">
                
                	<form id="searchform" action="<? bloginfo('home') ?>" method="get">
                        <div>
                        <input id="s" type="text" name="s" class="textbox" onblur="if (this.value == '') {this.value = 'Search ...';}" onfocus="if (this.value == 'Search ...') {this.value = '';}" value="Search ..." />
                        <input id="searchsubmit" type="submit" class="button-go" value="GO" />
                    	</div>
                    </form>

                </div>
            </div>
        </div>
   	</div>

	<?php wp_footer(); ?>
</body>
</html>
