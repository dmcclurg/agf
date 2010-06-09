<?php
#==================================================================
#
#	Display control panel options
#
#==================================================================

global $themePath;

?>
<script src="<?php echo bloginfo('template_url'); ?>/scripts/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript"> var $j = jQuery.noConflict(); </script>
<script type="text/javascript">
	// launches help document
	function openHelp(section) {
		window.open('<?php echo $themePath; ?>theme_admin/readme.html#'+section,'help','width=750,height=500,scrollbars=yes,resizable=yes');
	}

	// show and hide custom fields function
	function checkForCustom(el,custom) {
		var _this = $j(el),
			_custom = $j('#'+$j(el).attr('id')+'_customOption');
		if (_this.val() == 'custom') {
			$j(_custom).slideDown();
		}else if ($j(custom).length >= 0) {
			// we checked for a custom field first, since one exists it needs to be hidden
			$j(_custom).slideUp();
		}
	}
</script>

<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/theme_admin/css/styles.css" />
<div class="wrap">

	<h2 class="logo-settings"><?php echo $themeTitle; ?></h2>

	<?php
	
	// save options to database (on submit)
	if (isset($_POST['save_theme_options'])) :
		foreach ($options as $value) {
			if ($value['id'] == $shortname.'cat_setting'){
				$categories = get_categories('hide_empty=0'); 
				foreach ($categories as $cat) {
						
					$variable_name = $value['id']."_".$cat->cat_ID;
					update_option($variable_name, $_POST[$variable_name]);
					
				}
			}
			update_option($value['id'], $_POST[$value['id']]);
		}
		echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';
	endif;
	
	// call function to print options for current page
	listOptions($options);
	
	?>
	
</div>