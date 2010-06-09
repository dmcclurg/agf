<?php
#==================================================================
#
#	Display control panel options for Slide Show
#
#==================================================================

global $themePath, $categoryList;

$allPages = get_pages('hide_empty=0');
$pageList = array();

foreach ($allPages as $thisPage) {
	$pageList[$thisPage->ID] = $thisPage->post_title;
	$pages_ids[] = $thisPage->ID;
}

include_once("slideshow-setup-options.php");

?>
<script src="<?php echo bloginfo('template_url'); ?>/js/jquery-1.4.2.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo bloginfo('template_url'); ?>/theme_admin/js/sortMenu.js"></script>
<script type="text/javascript"> var $j = jQuery.noConflict(); </script>
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/theme_admin/css/styles.css" />
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/theme_admin/css/sortable-lists.css" />

<div class="wrap">

	<h2 class="logo-settings"><?php echo $themeTitle; ?></h2>

	<?php
	
	// save options to database (on submit)
	if (isset($_POST['save_theme_options'])) :
	
		// convert to and store setup options 
		parse_str($_POST['SS-Options'], $SlideOptions);

		foreach ($options as $value) {     
			update_option($value['id'], $SlideOptions[$value['id']]);
		}
		
		// convert to and store array 
		parse_str($_POST['SS-ItemLevels'], $SlideLevels);
		update_option($shortname.'SS-ItemLevels', $SlideLevels);
		
		// convert to and store array 
		parse_str($_POST['SS-ItemValues'], $SlideValues);
		update_option($shortname.'SS-ItemValues', $SlideValues);
		
		// display success message
		echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';
	endif;
	
	
	
	// Start printing page content
	
	// the default options
	echo '<form method="post" action="" id="optionsForm">';
		// load the function type for this option
		foreach ($options as $value) { 
			if (function_exists('options_'.$value['format'])) {
				// calls the specific function (i.e., options_start($value) )
				call_user_func('options_'.$value['format'], $value);
			}
		}
	echo '</form>';

	// middle buttons
	echo '<p>Recommended image size: 921 x 405 or larger. Larger images are resized/cropped automatically.</p>';
	echo '<input type="button" name="save_theme_options" class="button-primary autowidth" onClick="saveMenu();" value="Save Changes" style="float:left; margin-right: 2em;" />';
	echo '<input type="button" class="button-secondary autowidth" style="float:left;" onClick="addMenuItem(true);" value="Add New Slide" />';
	echo '<p style="clear:both; margin: 0;">&nbsp;</p>';
	
	// start the main slide setup table	
	echo '<form method="post" action="" id="editForm">';
	echo '<div class="themeTableWrapper">';
	echo '<table cellspacing="0" class="widefat themeTable">';
	echo '<thead><tr>';
	echo '<th colspan="2" scope="row">&nbsp; Slide Order</th>';
	echo '</tr></thead><tbody>';

	
	?>
	<td colspan="4">
	
		<div>
			<ul id="SlideShow">
				<?php
				// output the menu as an unordered list
				$SS_Levels = get_option($shortname.'SS-ItemLevels');
				$SS_Values = get_option($shortname.'SS-ItemValues');
				
				if(!empty($SS_Levels) && is_array($SS_Levels)) {
					buildList($SS_Levels['SlideShow'], $SS_Values);
				}
				?>
			</ul>
		</div>
	
	</td>
	<?php
	
	// call table end function
	options_end(NULL);
	
	echo '</form>';
	echo '<p class="submit"><input type="button" name="save_theme_options" class="button-primary autowidth" onClick="saveMenu();" value="Save Changes" /></p>';

	?>
	
	<br/>
	<form method="post" action="" id="submitForm" style="display:none;">
		<input type="hidden" name="SS-Options" id="SS-Options" value="" />
		<input type="hidden" name="SS-ItemLevels" id="SS-ItemLevels" value="" />
		<input type="hidden" name="SS-ItemValues" id="SS-ItemValues" value="" />
		<input type="hidden" value="true" name="save_theme_options" />
	</form>
	
	
	<ul style="display:none;" id="sample-ss-item">
		<?php 
		
		// Default options (for new items)
		$SS_Defaults = array(
			'mm-#-linkTitle'		=>	'Title',
			'mm-#-linkDescription'	=>	'Description',
			'mm-#-linkType'			=>	'page',
			'mm-#-linkPage'			=>	'',
			'mm-#-linkCategory'		=>	'',
			'mm-#-linkURL'			=>	'http://',
			'mm-#-slideImageTooltip'=>	'Give this slide a quick description.'
		);

		// create the template li used for inserting new items
		buildList(array('id' => '#'), $SS_Defaults);
		?>
	</ul>
	
	<ul style="display:none;" id="separator-ss-item">
		<?php 
		// create the template separator used for inserting a separator
		buildList(array('id' => '#'), array('ss-#-linkTitle' => 'ss-separator'));
		?>
	</ul>
	
	<?php


	// a function to print the items
	function buildList($theArray, $theValues = array()) {   
		foreach ($theArray as $key => $value) {
		
			// get variables setup
			$id = $value['id'];
			$options = $theValues;
			
			// is this a separator?
			if ($options['ss-'. $id .'-linkTitle'] == 'ss-separator') {
				
				// print the separator item type
				
				/* --- NO SEPARATOR FOR SLIDESHOW --- */

			// it's not a separator so print a standard menu item
			} else {
						
				$SS_LinkCategory = "";
				$SS_SelectCategory = "";
				$SS_LinkURL = "";
				$SS_SelectURL = "";
				$SS_LinkPage = "";
				$SS_SelectPage = "";
				
				switch ($options['ss-'. $id .'-linkType']) {
					case 'category':
						$SS_LinkCategory = "checked";
						$SS_SelectCategory = "display: block;";
						break;
					case 'url':
						$SS_LinkURL = "checked";
						$SS_SelectURL = "display: block;";
						break;
					default:
						$SS_LinkPage = "checked";
						$SS_SelectPage = "display: block;";
						break;
				}
							
				?>
				<li id="ss-item-<?php echo $id ?>" rel="<?php echo $id ?>" class="isSortable slide-item noNesting">
					<div class="sortItem">
						<table cellpadding="3" cellspacing="0" width="100%">
							<tbody>
								<tr>
									<td class="handle"><div></div></td>
									<td>
										<img src="<?php echo htmlspecialchars(stripslashes($options['ss-'. $id .'-slideImagePath'])) ?>" class="ss-ImageSample" />
										<table cellpadding="0" cellspacing="5" width="100%">
											<tbody>
												<tr>
													<td colspan="4">&nbsp;<strong>Slide Title:</strong><br />
													<input type="text" name="ss-<?php echo $id ?>-slideImageTitle" class="ss-ImageTitle" alt="Slide Title" value="<?php echo htmlspecialchars(stripslashes($options['ss-'. $id .'-slideImageTitle'])) ?>" /></td>
												</tr>
												<tr>
													<td colspan="4">&nbsp;<strong>Tooltip Content:</strong><br />
													<textarea type="text" name="ss-<?php echo $id ?>-slideImageTooltip" class="ss-ImageDesc" alt="Tooltip Content"><?php echo htmlspecialchars(stripslashes($options['ss-'. $id .'-slideImageTooltip'])) ?></textarea></td>
												</tr>
												<tr>
													<td align="left">
														&nbsp;<strong>Image URL / Slide Link:</strong><br />
														<input type="text" name="ss-<?php echo $id ?>-slideImagePath" value="<?php echo htmlspecialchars(stripslashes($options['ss-'. $id .'-slideImagePath'])) ?>" class="ss-Image" alt="Image Path"></td>
													<td style="white-space: nowrap;" align="left" width="200">
														<br />
														<label for="SS-LinkTypePage-<?php echo $id ?>" class="<?php echo $SS_LinkPage ?>">
															<input type="radio" name="ss-<?php echo $id ?>-linkType" id="SS-LinkTypePage-<?php echo $id ?>" value="page" <?php echo $SS_LinkPage ?> />&nbsp;Page
														</label>
														<label for="SS-LinkTypeCategory-<?php echo $id ?>" class="<?php echo $SS_LinkCategory ?>">
															<input type="radio" name="ss-<?php echo $id ?>-linkType" id="SS-LinkTypeCategory-<?php echo $id ?>" value="category" <?php echo $SS_LinkCategory ?> />&nbsp;Category
														</label>
														<label for="SS-LinkTypeURL-<?php echo $id ?>" class="<?php echo $SS_LinkURL ?>">
															<input type="radio" name="ss-<?php echo $id ?>-linkType" id="SS-LinkTypeURL-<?php echo $id ?>" value="url" <?php echo $SS_LinkURL ?> />&nbsp;URL
														</label>
													</td>
													<td align="center" width="175">
														<br />
														<?php 
																						
														// print page drop down
														SS_select_option(
															array(
																'name' => 'ss-'. $id .'-linkPage',
																'id' => 'SS-LinkPage-'. $id ,
																'style' => $SS_SelectPage,
																'selected' => $options['ss-'. $id .'-linkPage'],
																'default' => 'Choose a page...',
																'options' => $GLOBALS['pageList']
															)
														);
														
														// print category drop down
														SS_select_option(
															array(
																'name' => 'ss-'. $id .'-linkCategory',
																'id' => 'SS-LinkCategory-'. $id ,
																'style' => $SS_SelectCategory,
																'selected' => $options['ss-'. $id .'-linkCategory'],
																'default' => 'Choose a category...',
																'options' =>  $GLOBALS['categoryList']
															)
														);
														
														?>
														
														<input type="text" name="ss-<?php echo $id ?>-linkURL" value="<?php echo htmlspecialchars(stripslashes($options['ss-'. $id .'-linkURL'])) ?>" id="SS-LinkURL-<?php echo $id ?>" class="ss-Link" style="<?php echo $SS_SelectURL ?>">
													</td>
													<td align="center" width="90">
														<br />
														<div class="button-secondary delete-item">Delete</div>
													</td>
												</tr>
											</table>
										</tr>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
	
				<?php
				
				// check for child elements
				if (is_array($value['children'])) {
					echo "<ul>";
					buildList($value['children'], $options);
					echo "</ul>";
				}
				echo "</li>";
				
			} // end (if separator) else statement
		} // end foreach item
	}
	
	
	// pages and categories select boxes
	function SS_select_option($value) {
		echo '<select class="ss-Link" name="'. $value['name'] .'" id="'. $value['id'] .'" style="'. $value['style'] .'">';
		echo '<option value="">'. $value['default'] .'</option>';
		foreach ($value['options'] as $key=>$option) { 
			echo '<option value="'. $key .'"'; 
				if ( $value['selected'] == $key ) { 
					echo ' selected="selected"'; 
				}
			echo '>'. $option .'</option>';
		}
				
		echo '</select>';
	}
	
	
	// transition type select boxe
	function SS_transition_option($value, $id) {
	
		foreach ($value['options'] as $key=>$option) {
			echo '<option value="'. $key .'"'; 
				if ( $value['selected'] == $key ) { 
					echo ' selected="selected"'; 
				}
			echo '>'. $option .'</option>';
		}
	}
	
	?>
</div>



<script type="text/javascript">

// array to track all nested item id's
var nestedListIds = [];

// creates draggable nested item menu
function initializeMenu() {

	// convert into sortable list
	$j('#SlideShow').NestedSortable({
		accept: 'isSortable',
		noNestingClass: "noNesting",
		opacity: 0.8,
		helperclass: 'helper',
		onChange: function(serialized) {
			$j('#SS-ItemLevels').val((serialized[0].hash));
		},
		onStart: function() {
			// prevents a horizontal scroll when dragging
			$j(document.body).css('overflow-x','hidden');
		},
		onStop: function() {
			// restors scrolling after draggin completes
			$j(document.body).css('overflow-x','auto');
		},
		autoScroll: true,
		handle: '.handle'
	})
	.find('li').each( function() {
		
		// add onclick other dynamic functions
		if (!this.hasClickEventHandlers) {
			
			var thisItem = $j(this);
			var n = thisItem.attr('rel');
			nestedListIds.push(parseInt(n)); // add the id to a list (used to prevent duplicates when editing)
			var linkOptions = $j("input[name='ss-"+n+"-linkType']");
			var deleteButton = thisItem.find(".delete-item:first");
			// add click event for link options
			linkOptions.click( function() {
				var p = $j('#SS-LinkPage-'+n);
				var c = $j('#SS-LinkCategory-'+n);
				var u = $j('#SS-LinkURL-'+n);
				
				// toggle display of page/category/url field
				($j(this).val() == 'page') 		? p.css('display','block') : p.css('display','none');
				($j(this).val() == 'category') 	? c.css('display','block') : c.css('display','none');
				($j(this).val() == 'url') 		? u.css('display','block') : u.css('display','none');
				
				// mark active label with "checked" class
				$j(this + ':not(:checked)').parent('label').removeClass('checked');
				$j(this + ':checked').parent('label').addClass('checked');
				
			});
			
			// add click event for delete button
			deleteButton.click( function() {
				if (confirm("Are you sure you want to delete this item?")) {
					thisItem.remove();
				} else {
					return false;
				}
			});
			
			this.hasClickEventHandlers = true;
		}
	});
	
}

// inserts a new menu item
function addMenuItem(itemType) {

	var count = $j('#SlideShow').find('li').length,
		menuItem = $j('#sample-ss-item li'),
		//separator = $j('#separator-ss-item li'),
		template;
	
	if (itemType == 'separator') {
		// adding a separator
		template  = separator;
	} else {
		// adding a menu item
		template  = menuItem;
	}
	
	// prevent duplicate id's by checking agains all current ones	
	var newID = count;
	while ($j.inArray(newID, nestedListIds) != -1 ) {
		newID++;
	}

	template.clone()
		.attr('id',template.attr('id').replace('#',newID))
		.attr('rel',newID)
		.find('*').each( function() {
			
			var attrId = $j(this).attr('id'),
				attrName = $j(this).attr('name'),
				attrFor = $j(this).attr('for');
				
			if (attrId) $j(this).attr('id', attrId.replace('#',newID));
			if (attrName)$j(this).attr('name', attrName.replace('#',newID));
			if (attrFor)$j(this).attr('for', attrFor.replace('#',newID));
		
		}).end()
		.prependTo($j('#SlideShow'));
		
	// re-initialize sorting to include new item
	initializeMenu();
}


// save the menu options to the database
function saveMenu() {
	
	// get the individual item options
	$j('#SS-Options').val($j('#optionsForm').serialize());

	// get the individual item options
	$j('#SS-ItemValues').val($j('#editForm').serialize());
	
	// get the list in it's sorted order for creating menus and sub-menus
	$j('#SS-ItemLevels').val(jQuery.iNestedSortable.serialize('SlideShow').hash);
	
	$j('#submitForm').submit();
}


jQuery(document).ready(function() {

	// activate the sortable list
	initializeMenu();

});	
</script>
