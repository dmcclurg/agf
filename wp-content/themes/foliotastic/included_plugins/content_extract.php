<?php

/*
	Plugin Name: Content Extract
	Version: 1.0
	Plugin URI: http://www.webspaceworks.com/resources/wordpress/44/
	Description: Provides PHP functions to provide extended extracts functionality
	Author: Rob Schumann
	Author URI: http://www.webspaceworks.com/
*/
/*
	v1.0:   RELEASE!! New features/bugfix [09 November, 2006]
			Extends 'sentence' identification to include ordered and unordered lists
			Fixes a bug where leading/trailing tags were stripped and then replaced with something different.
			Fixes a bug where truncated lists/items were not being closed in the output. Openlists/items are now tracked, and appropriate closing tags added, wherever needed. 
	v1.0b5: New features [11 August, 2006]
			Fixes a stupid bug with the striphtml argument not being correctly passed through
	v1.0b4: New features [21 April, 2006]
			Fixes a stupid bug when splitting on words, not sentences.
			Corrected the callable function in the 'Call as' section of this header
	v1.0b3: New features [04 February, 2006]
			Extends 'addtodb' to support updating of database excerpt
			Adds an option to retain html formatting of the excerpt, but will still strip the leading and trailing tags.
			Beefed-up sentence counting (still not perfect) to catch '. ', '? ', '! ' & '.</p>'
			Update header info and remove typos.
	v1.0b2: New features [21 January, 2006]
			Adds ability to base check and extract lengths on sentences rather than words. Each can be set independently of the other
			Adds option to write out the auto generated extract to the post_excerpt field for the post, reducing processing at subsequent page loads
	v1.0b1: First public release [19 January, 2006]
	Copyright (c) 2005  Rob Schumann  (email : robs_wp@webspaceworks.com)
	Released under the GPL license
	http://www.gnu.org/licenses/gpl.txt

	PHP functions for extended extracts functionality in WP 1.5 & 2.0
	*	Adds new filter
		-	If an excerpt is available, use it
		-	If no excerpt, look through content to see if a <!--more--> breakpoint exists. If so, use it
		-	If neither of the above, check content length against allowed full article length, dflt = 80 (words)
			.	If less than this length, post full length article
			.	If greater than this check length, cut back to a specified truncation length, dflt = 55 (words)
		-	If article is in any way shortened, add a link to the end of the 'extract'
		-	Optionally retain html formatting within the body of the excerpt, but stripping leading and trailing tags
		-	Place resulting extract in paragraph tags
		
	Call as:
			wswwpx_content_extract ( $more_text, $check_length, $cut_length, $addexcerpttodb, $tag_before, $tag_after, $striphtml, $withlink );
		where:
			$more_test		string	Text for onwards link								dflt: '(more...)'
			$check_length	string	Max allowed length									dflt: 80 (words)
											May optionally carry a ':s' suffix to denote checking on a number of sentences
			$cut_length		string	Length to cut back to								dflt: 55 (words - same as WP internal setting)
											May optionally carry a ':s' suffix to denote breaking on a number of sentences
			$addtodb			boolean	Add new extract to post record in db			dflt: false nb. Set to '2' to force update of database
			$tag_before		string	opening html tag for extract display			dflt: '<p>'
			$tag_after		string	closing html tag for extract display			dflt: '</p>'
			$striphtml		boolean	Strip html formatting from excerpt?				dflt: true (in keeping with WP default for excerpts)
			$withlink		boolean	Add '[...]' if $more_text not specified?		dflt: true (in keeping with WP default for excerpts)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

add_filter('wswwpx_get_extract', 'wswwpx_trim_extract');
function wswwpx_trim_extract($text) { // Fakes an excerpt if needed
	global $id, $post, $wpdb;
	global $check_length, $extract_length, $getmore_text, $withlink, $updatepost, $striphtml, $beforehtml, $afterhtml;
	if ( '' == $text || $updatepost == 2 ) {
		//
		// There is no current excerpt for the post... Let's go look for something usable.
		//
		$text = $post->post_content;
		$text = explode('<!--more-->', $text, 2);
		if (count($text) > 1) $gotmore = true;
		$text = apply_filters('the_content', $text[0]);
		$text = str_replace(']]>', ']]&gt;', $text);
		if ($striphtml) {
			$text = strip_tags($text);
		} else {
			//
			//	Strip leading and trailing tags from the entry.
			//
			$text = trim($text);
			if (strpos($text, '<')===0) $close_1stTag = strpos($text, '>');
			if (strrpos($text, '>')==strlen($text)-1) $open_lastTag = strrpos($text, '<')-$close_1stTag;

// v1.0: Presevre leading and trailing tags (if any) and then remove them from the text.

			if (isset($close_1stTag)) $beforehtml = substr($text, 0, $close_1stTag+1);
			if (isset($open_lastTag)) $afterhtml = substr($text, $open_lastTag+1);
			$text = substr ($text, $close_1stTag+1, $open_lastTag-1 );
		}
		if (!$gotmore) {
			//
			//	Strip linefeeds and set for checking on words or sentences.
			//
			$text = str_replace("\n", ' ', $text);
			$checkl   = explode(':', $check_length);			
			$check_length = $checkl[0];
			if ( strtolower($checkl[1]) == 's' ) {
				$parts = preg_split('=([\.|\?|!][\s+|</p>|</ul>|</ol>])=', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
			} else {
				$parts = explode(' ', $text);
			}
			if ( count($parts) > $check_length*2+1 ) {
				//
				//	Set cutting to be on words or sentences, as requested.
				//
				$extractl = explode(':', $extract_length);			
				$extract_length = $extractl[0];
				if ( strtolower($extractl[1]) == 's' ) {
					$parts = preg_split('=([\.|\?|!][\s+|</p>|</ul>|</ol>])=', $text, $extract_length + 1, PREG_SPLIT_DELIM_CAPTURE );
					array_pop($parts);
					$text = '';
					foreach ($parts AS $part) {
						$text .= $part;
						//
						//	[v1.0]: Keep tabs on whether we are inside a list/item set or not... setting up appropriate closing tags.
						//
						if (strtolower($part) == '<ol>') {
							$closeList = '</ol>';
						} else if (strtolower($part) =='<ul>') {
							$closeList = '</ul>';
						} else if (strtolower($part) =='<dl>' || strtolower($part) =='<dt>' || strtolower($part) =='<dd>') {
							$closeList = '</dl>';
						} else if (strtolower($part) =='<li>') {
							$closeItem = '</li>';
						} else if (strtolower($part) =='<dt>') {
							$closeItem = '</dt>';
						} else if (strtolower($part) =='<dd>') {
							$closeItem = '</dd>';
						} else if (strtolower($part) =='</ol>' || strtolower($part) =='</ul>' || strtolower($part) =='</dl>') {
							$closeList = '';
						} else if (strtolower($part) =='</li>' || strtolower($part) =='</dt>' || strtolower($part) =='</dd>') {
							$closeItem = '';
						}
					}
					//
					//	[v1.0]: Close any item and/or list that nees to be closed as a result of early truncation.
					//
					$text .= $closeItem . $closeList;
				} else {
					$parts = explode(' ', $text, $extract_length + 1);
					array_pop($parts);
					$text = implode($parts, ' ');
				}
			}
		}
		if ($updatepost) {
			//
			//	Update the post to add the calculated extract to the post_excerpt field.
			//
			$wpdb->query("UPDATE $wpdb->posts SET post_excerpt = '$text' WHERE ID = $post->ID");
		}
		if ($extractl || $gotmore) {
			//
			//	Check for adding the onwards link... only needed if some truncation took place.
			//
			if (!empty($getmore_text)) {
//				$text .= ' <a href="'. get_permalink() . "#more-$id\">$getmore_text</a>";
				$text .= ' <a href="'. get_permalink() . "/\">$getmore_text</a>";
			} else if ($withlink) {
//				$text .= ' <a href="'. get_permalink() . "#more-$id\">[...]</a>";
				$text .= ' <a href="'. get_permalink() . '/">[...]</a>';
			}
		}
	} else {
		if (!empty($getmore_text)) {
//			$text .= ' <a href="'. get_permalink() . "#more-$id\">$getmore_text</a>";
			$text .= ' <a href="'. get_permalink() . "/\">$getmore_text</a>";
		} else if ($withlink) {
//			$text .= ' <a href="'. get_permalink() . "#more-$id\">[...]</a>";
			$text .= ' <a href="'. get_permalink() . '/">[...]</a>';
		}
	}
	return $beforehtml . $text . $afterhtml;
}

function wswwpx_content_extract ($more_link_text = '(more...)', $test_len=80, $cut_len=55, $addtodb=false, $beforehtml='<p>', $afterhtml='</p>', $strip_tags=true, $with_more_link=true) {
	global $check_length, $extract_length, $getmore_text, $withlink, $updatepost, $striphtml, $beforehtml, $afterhtml;
	//
	//	Places parameters into global, obtains an extract... or fakes one
	//	echoes resulting excerpt to screen between paragraph tags
	//
	if ($cut_len > $test_len) $cut_len = $test_len;
	$check_length   = $test_len;
	$extract_length = $cut_len;
	$getmore_text   = $more_link_text;
	$withlink       = $with_more_link;
	$updatepost     = $addtodb;
	$striphtml      = $strip_tags;
	$excerpt = wswwpx_get_the_extract();
//	echo $before . $excerpt . $after;		// [v1.0]: Changed to move before after html into the filter...
	echo $excerpt;
}

function echo_wswwpx_content_extract ($more_link_text = '(more...)', $test_len=80, $cut_len=55, $addtodb=false, $beforehtml='<p>', $afterhtml='</p>', $strip_tags=true, $with_more_link=true) {
	global $check_length, $extract_length, $getmore_text, $withlink, $updatepost, $striphtml, $beforehtml, $afterhtml;
	//
	//	Places parameters into global, obtains an extract... or fakes one
	//	echoes resulting excerpt to screen between paragraph tags
	//
	if ($cut_len > $test_len) $cut_len = $test_len;
	$check_length   = $test_len;
	$extract_length = $cut_len;
	$getmore_text   = $more_link_text;
	$withlink       = $with_more_link;
	$updatepost     = $addtodb;
	$striphtml      = $strip_tags;
	$excerpt = wswwpx_get_the_extract();
//	echo $before . $excerpt . $after;		// [v1.0]: Changed to move before after html into the filter...
	return $excerpt;
}


function wswwpx_get_the_extract($fakeit = true) {
	global $post;
	$output = '';
	$output = $post->post_excerpt;
	if ( !empty($post->post_password) ) { // if there's a password
		if ( $_COOKIE['wp-postpass_'.COOKIEHASH] != $post->post_password ) {  // and it doesn't match the cookie
			$output = __('There is no excerpt because this is a protected post.');
			return $output;
		}
	}
	return apply_filters('wswwpx_get_extract', $output);
}

?>