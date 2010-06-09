<?php 
#==================================================================
#
#	Functions used to load and display the theme options
#
#==================================================================


#-----------------------------------------------------------------
# Print options - Gets and runs function for each option type
#-----------------------------------------------------------------

function listOptions($options) {	
	echo '<form method="post" action="">';
	
	// load the function type for this option
	foreach ($options as $value) { 
		if (function_exists('options_'.$value['format'])) {
			// calls the specific function (i.e., options_start($value) )
			call_user_func('options_'.$value['format'], $value);
		}
	}
	echo '<p class="submit">';
	echo '<input type="submit" name="save_theme_options" class="button-primary autowidth" value="Save Changes" /></p>';
	echo '</form>';
}


#-----------------------------------------------------------------
# Option type functions
#-----------------------------------------------------------------

function options_theme_information($value) {

	global $themeVersion;

	echo '<tr><th scope="row"><h4>'. ucwords($value['themename']) .' - Version '.$themeVersion.'</h4></th>';
	echo '<td>';
	
	wp_enqueue_script('jquery');
	wp_head();

	echo "<script type=\"text/javascript\">var $ = jQuery.noConflict();</script>";
	
	// Is there a version update?
	
	$returned_content = get_data('http://themesnack.com/wp-content/themes/themesnack/updates.php?version='.$themeVersion.'&theme='.$value['themename']);
	if ($returned_content) {
		echo $returned_content;
	}
	
	echo '</td></tr>';
	
}


// start (begins the table and adds section title)
//................................................................
function options_start($value) {
	echo '<div class="themeTableWrapper">';
	echo '<table cellspacing="0" class="widefat themeTable">';
	echo '<thead><tr>';
	echo '<th scope="row" colspan="2">'. $value['title'] .'</th>';
	echo '</tr></thead><tbody>';
}

// end (closes the table)
//................................................................
function options_end($value) {
	echo '</tbody></table></div>';
}

// title (prints the options page title)
//................................................................
function options_title($value) {
	echo '<h3>'. $value['name'] .'</h3>';
}

// title (prints the options page title)
//................................................................
function options_help($value) {
	echo '<input type="button" class="button-secondary autowidth" style="float:right;" onClick="window.open(\'http://support.themesnack.com\');" value="ThemeSnack Support" />';
}

// select (drop down list)
//................................................................
function options_select($value) {
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th>';
	echo '<td><label>'. $value['label'] .'</label>';
	echo '<select style="width:350px;" name="'. $value['id'] .'" id="'. $value['id'] .'" onchange="checkForCustom(this, \''. $value['id'] .'_customOption\');">';
	echo '<option value="">Choose one...</option>';
	
	foreach ($value['options'] as $key=>$option) { 
		echo '<option value="'. $key .'"'; 
			if ( get_option( $value['id'] ) == $option || get_option( $value['id'] ) == $key) { 
				echo ' selected="selected"'; 
			} elseif  ( !get_option( $value['id']) && $key == $value['default'] ) {
				echo ' selected="selected"'; 
			}
		echo '>'. $option .'</option>';
	}
			
	echo '</select><br />';
	echo '<span class="description">'. $value['desc'] .'</span><br />';
	
	// this select allows for a custom value entered by the user 
	if ($value['custom']) {
		echo '<div class="customOption" id="'. $value['id'] .'_customOption"'; 
			if ( get_option( $value['id'] ) == 'custom' ) { 
				echo 'style="display:block;"'; 
			} 
		echo '><br />';
		echo '<label for="'. $value['custom'] .'">Custom:</label>';
		echo '<input style="width:297px;" name="'. $value['custom'] .'" id="'. $value['custom'] .'" type="text" value="'. get_option( $value['custom'] ) .'" />';
		echo '<br /><span class="description">'. $value['custom_desc'] .'</span>';
		echo '</div></td></tr>';
	}
}

// multiselect
//................................................................
function options_multiselect($value) {
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th>';
	echo '<td><label>'. $value['label'] .'</label>';
	echo '<select style="width:350px; height:100px" name="'. $value['id'] .'[]" id="'. $value['id'] .'" multiple="multiple">';
	echo '<option value="">No Selection</option>';
	
	foreach ($value['options'] as $key=>$option) { 
		echo '<option value="'. $key .'"'; 
			if ( is_array(get_option($value['id'])) ) {
				if ( in_array($key, get_option($value['id'])) ) { 
					echo ' selected="selected"'; 
				}
			}
		echo '>'. $option .'</option>';
	}
			
	echo '</select><br />';
	echo '<span class="description">'. $value['desc'] .'</span><br />';
}

// text (displays a text input)
//................................................................
function options_text($value) {
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>';
	echo '<label>'. $value['label'] .'</label>';
	echo '<input style="width:350px;" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['format'] .'" value="';
		if ( get_option( $value['id'] ) != "") { 
			echo stripslashes(get_option( $value['id'] )); 
		} else { 
			echo $value['default']; 
		}
	echo '" /><br />';
	echo '<span class="description">'. $value['desc'] .'</span>';
	echo '</td></tr>';
}

// textarea (displays a textarea)
//................................................................
function options_textarea($value) {
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>';
	echo '<label>'. $value['label'] .'</label>';
	echo '<textarea cols="" rows="" name="'. $value['id'] .'" style="width:350px; height:100px;" type="'. $value['format'] .'">';
		if ( get_option( $value['id'] ) != "") { 
			echo stripslashes(get_option( $value['id'] )); 
		} else { 
			echo $value['default']; 
		}
	echo '</textarea><br />';
	echo '<span class="description">'. $value['desc'] .'</span>';
	echo '</td></tr>';
}

// checkbox (adds a checkbox input)
//................................................................
function options_checkbox($value) {
	if ( get_option($value['id'],'No Value') != 'No Value' && get_option($value['id']) == true ) {
		$checked = 'checked="checked"'; 
	} elseif ( get_option($value['id'],'No Value') == 'No Value' && $value['default'] == true) { 
		$checked = 'checked="checked"'; 
	} else {
		$checked = ''; 
	}
	
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>';
	echo '<label>';
	echo '<input type="checkbox" name="'. $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />&nbsp;';
	echo $value['label'] .'</label><br />';
	echo '<span class="description">'. $value['desc'] .'</span>';
	echo '</td></tr>';
}

// radio (adds a radio series input)
function options_radio($value) {
	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>';
		
		foreach ($value['options'] as $key=>$option) { 
		
			$checked = '';
			if ( get_option($value['id'],'No Value') != 'No Value' && $key == get_settings($value['id']) ){
				$checked = ' checked="checked"';
			} elseif (isset($value['default']) && $key == $value['default']) {
				$checked = ' checked="checked"';
			}
			
			echo '<label><input type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />';
			echo '&nbsp;'. $option . ' &nbsp; '. $value['label'] .'</label><br />';
		}

	echo '<span class="description">'. $value['desc'] .'</span>';
	echo '</td></tr>';
}

// colorpicker (adds a colorpicker input)
function options_colorpicker($value) {

	global $colorpickerLoaded;
	
	if ( get_option( $value['id'] ) != "") { 
		$current_color = stripslashes(get_option( $value['id'] ));
	} else { 
		$current_color = $value['default'];
	}
	
	$current_color = str_replace('#','',$current_color);

	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>';
	echo '<label>'. $value['label'] .'</label>';
	echo 'Current color: <span id="color_'.$value['id'].'" style="display:inline-block; margin:0 8px 0 4px; border:1px solid #000; position:relative; top:5px; padding:8px; width:30px; height:5px; background:#'.$current_color.';"></span>';
	echo '<input style="width:350px;" name="'. $value['id'] .'" id="colorpicker_'. $value['id'] .'" type="text" value="';
	echo $current_color;
	echo '" /><br />';
	echo '<span class="description">'. $value['desc'] .'</span>';
	echo '</td></tr>';
	
	if (!$colorpickerLoaded) { ?>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/theme_admin/colorpicker/css/colorpicker.css" />
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.4.2.min.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/theme_admin/colorpicker/js/colorpicker.js"></script>
		<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/theme_admin/colorpicker/js/eye.js"></script>
    	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/theme_admin/colorpicker/js/utils.js"></script>
    	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/theme_admin/colorpicker/js/layout.js?ver=1.0.2"></script>
    <?php } ?>
	
	<script type="text/javascript">
		$(window).load(function() {
			$('#colorpicker_<?php echo $value['id']; ?>').ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val(hex);
					$(el).ColorPickerHide();
					$('#color_<?php echo $value['id']; ?>').css({'background':'#'+hex});
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				}
			})
			.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
			});
		});
	</script><?php $colorpickerLoaded = 1;

}

// Custom category selection (Foliotastic/Phototastic only)
function options_catSettings($value){

	global $shortname;

	echo '<tr><th scope="row"><h4>'. $value['name'] .'</h4></th><td>'; ?>

		<label><?php echo $value['label']; ?></label>
	    <p><?php echo $value['desc']; ?></p>
	    
	    <table width="100%" cellspacing="0" cellpadding="5">
	    
		    <tr>
		        <th width="30"><strong>ID</strong></td>
		        <th width="150"><strong>CATEGORY NAME</strong></td>
		        <th width="170"><strong>PAGE STYLE</strong></td>
		    </tr>
		    
		    <?php $categories = get_categories('depth=1&hide_empty=0'); 
			foreach ($categories as $cat) {
					
				$temp_count++;	
				$radio_name = $value['id']."_".$cat->cat_ID;
				$variable_name = str_replace($shortname, "", $radio_name); ?>
				
			    <tr<?php if ($temp_count == 1) { ?> style="background:#f5f5f5"<?php } else if ($temp_count == 2) { $temp_count = 0; } ?>>
			    	<td><?php echo $cat->cat_ID; ?></td>
			        <td><?php echo $cat->cat_name; ?></td>
			        <td>
			        	<input type="radio" id="<?php echo $radio_name ?>_portfolio" name="<?php echo $radio_name ?>" value="portfolio"<?php if (get_theme_var($variable_name) == 'portfolio' || !get_theme_var($variable_name)) { ?> checked="checked"<?php } ?> /> <label class="inline-label" for="<?php echo $radio_name ?>_portfolio">Portfolio</label>
			            &nbsp;-OR-&nbsp;
			            <input type="radio" id="<?php echo $radio_name ?>_blog" name="<?php echo $radio_name ?>" value="blog"<?php if (get_theme_var($variable_name) == 'blog') { ?> checked="checked"<?php } ?> /> <label class="inline-label" for="<?php echo $radio_name ?>_blog">Blog</label>
			        </td>
			  	</tr>
			<?php } ?>
	    
	    </table>
    
    </td></tr><?php
    
}
?>