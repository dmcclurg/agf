<?php
#==================================================================
#
#	Sidebars and metaboxes for the theme
#
#==================================================================


#-----------------------------------------------------------------
# Sidebars (widget areas)
#-----------------------------------------------------------------

if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => '</h2>',
    ));
}


#-----------------------------------------------------------------
# META BOXES
#-----------------------------------------------------------------

$new_meta_boxes = 
array(
"post_image" => array(
"name" => "post_image",
"type" => "input",
"value_type" => "image",
"std" => "",
"size" => 80,
"title" => "Image for this Post",
"description" => "Using the \"<em>Add an Image</em>\" option, upload your media files and paste the <strong>Link URL</strong> in the fields below.
				This is the default image file associated with your post (full size image). On the homepage and category pages, this is the image that shows up
				with your posts (if you haven't hidden them). From your gallery pages this is the image shown in the lightbox window."));

function new_meta_boxes() {
global $post, $new_meta_boxes;
	
	foreach($new_meta_boxes as $meta_box) {
		
		echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		
		if( $meta_box['type'] == "input" ) { 
		
			echo'<h2 style="margin:0 0 0 5px">'.$meta_box['title'].'</h2>';
		
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		
			if($meta_box_value == "")
				$meta_box_value = $meta_box['std'];
		
			if ($meta_box['value_type'] == 'image'){
				if ($meta_box_value) {
					echo '<img style="display:block; margin:0 0 10px 5px;" src="'.get_bloginfo('template_url').'/image.php?width=200&amp;height=125&amp;cropratio=200:100&amp;image='.$meta_box_value.'" />';
				}
			}
		
			echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.$meta_box_value.'" size="'.$meta_box['size'].'" /><br />';
			echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].'</label></p>';
			
		} elseif ( $meta_box['type'] == "checkbox" ) {
			
			$meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);
		
			if($meta_box_value == "")
				$meta_box_value = $meta_box['std'];
		
			echo'<div style="background:#FFFEEF; padding:10px; margin:0 0 10px 0; border:1px solid #fffbc">';
			echo'<input type="checkbox" name="'.$meta_box['name'].'_value" value="active"';
			if ($meta_box_value == "active") { echo' checked="checked"'; }
			echo' /> <span style="position:relative; top:2px; font-size:14px; font-weight:bold">'.$meta_box['title'].'</span>';
			echo'</div>';
			
		}
	}
}

function create_meta_box() {
global $theme_name, $new_meta_boxes;
	if (function_exists('add_meta_box') ) {
	add_meta_box( 'new-meta-boxes', 'Image/Photo', 'new_meta_boxes', 'post', 'normal', 'high' );
	}
}

function save_postdata( $post_id ) {
	global $post, $new_meta_boxes;  
		foreach($new_meta_boxes as $meta_box) {  
		
		// Verify  
		if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) )) {  
		return $post_id;  
		}  
	
	if ( 'page' == $_POST['post_type'] ) {  
	if ( !current_user_can( 'edit_page', $post_id ))  
	return $post_id;  
	} else {  
	if ( !current_user_can( 'edit_post', $post_id ))  
	return $post_id;  
	}  
	
	$data = $_POST[$meta_box['name'].'_value'];
	
	if(get_post_meta($post_id, $meta_box['name'].'_value') == "")  
	add_post_meta($post_id, $meta_box['name'].'_value', $data, true);  
	elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))  
	update_post_meta($post_id, $meta_box['name'].'_value', $data);  
	elseif($data == "")  
	delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));  
	}

}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');
?>