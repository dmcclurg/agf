<? header("Content-type: text/css");

// This file should not be edited unless you are completely comfortable with PHP/CSS. If you want to edit
// the CSS file to customize it, we recommend opening the included CSS file in "/css_customize_optional/ie_fixes.css" and editing
// that instead. You may then call the CSS file from header.php instead of this one.

if (!$_GET['style'] || $_GET['style'] == "light") {
	
	if ($_GET['color']) {
		$color = $_GET['color'];
	} else {
		$color = "147cb2";
	} 
	
	if ($_GET['ie'] == 6) { ?>
    
        /* IE6 CSS Fixes - Light */
    
        #navigation-top, #footer { background:#f0f0f0 !important }
        h2 { background:#f0f0f0 !important }
        ul.sidebar-subpages a, ul.idTabs li a { background:#f0f0f0 !important }
        ul.sidebar-subpages ul a { background:#FFF !important }
        .top-slide, .bottom-slide { background:#000 !important }
        .flickr h2 { background:#e3dfe0 url('../graphics/icon_flickr.png') no-repeat 7px 0 !important }
        .twitter h2 { background: #e3dfe0 url('../graphics/icon_twitter.png') no-repeat 7px 0 !important }<?
	
	} else if ($_GET['ie'] == 7) { ?>
    
    	/* IE7 CSS Fixes - Light */
    
    	#navigation-top, #footer { background:#f0f0f0 !important }
        h2 { background:#f0f0f0 !important }
        ul.sidebar-subpages a, ul.idTabs li a { background:#f0f0f0 !important }
        ul.sidebar-subpages ul a { background:#FFF !important }
        .flickr h2 { background:#f0f0f0 url('../graphics/icon_flickr.png') no-repeat 7px 0 !important }
        .twitter h2 { background: #f0f0f0 url('../graphics/icon_twitter.png') no-repeat 7px 0 !important }
    	
   	<? }
	
} else {
	
	if ($_GET['color']) {
		$color = $_GET['color'];
	} else {
		$color = "A4D6EF";
	}
	
	if ($_GET['ie'] == 6) { ?>
    
        /* IE6 CSS Fixes - Dark */
    
        #navigation-top, #footer { background:#333 !important }
        h2 { background:#333 !important }
        ul.sidebar-subpages a, ul.idTabs li a { background:#333 !important }
        ul.sidebar-subpages ul a { background:#000 !important }
        .top-slide, .bottom-slide { background:#000 !important }
        .flickr h2 { background:#333 url('../graphics/icon_flickr.png') no-repeat 7px 0 !important }
        .twitter h2 { background: #333 url('../graphics/icon_twitter.png') no-repeat 7px 0 !important }<?
	
	} else if ($_GET['ie'] == 7) { ?>
    
    	/* IE7 CSS Fixes - Dark */
    
    	#navigation-top, #footer { background:#333 !important }
        h2 { background:#333 !important }
        ul.sidebar-subpages a, ul.idTabs li a { background:#333 !important }
        ul.sidebar-subpages ul a { background:#000 !important }
        .flickr h2 { background:#333 url('../graphics/icon_flickr.png') no-repeat 7px 0 !important }
        .twitter h2 { background: #333 url('../graphics/icon_twitter.png') no-repeat 7px 0 !important }
    	
   	<? }

} ?>

<? if ($_GET['ie'] == 6) { ?>

	h2 { display:block !important }
    a.sf-with-ul .sf-sub-indicator { right:25px !important }
    ul ul a.sf-with-ul .sf-sub-indicator { right:5px !important; top:11px }
    
    p.twitter-message {
        height:1%;
        position:relative }
        
    .twitter-arrow {
        bottom:-25px !important;
        position:absolute }
        
    .comment { height:1% !important }
    .comment div { height:1% !important; position:relative }
    .comment-meta { position:absolute !important }
    .reply { position:absolute !important; bottom:3px !important; right:0 !important }
    .comment-reply-link { position:relative !important; bottom:0 !important; right:0 !important }
    
    .windows,
    .navigation-top ul ul li,
    .navigation-top ul ul a,
    .navigation-top ul ul a:hover { height:1% !important }
    
    .post-block { margin:0 0 19px 0 !important; padding:0 0 1px 0 !important }
    
    #blog a.next { background-image:url('../graphics/arrow_down_ie.gif') }
    #blog a.previous { background-image:url('../graphics/arrow_up_ie.gif') }
    .comments { background:url('../graphics/icon_comments_ondark_ie.gif') 0 7px no-repeat }
   
<? } else if ($_GET['ie'] == 7) { ?>

	/* IE7 CSS Fixes */
    
    h2 { display:block !important }
    
    .post-block .post-entry p {
        font-size:12px;
        line-height:18px;
    }
    
    p.twitter-message {
        height:1%;
        position:relative }
        
    .windows { height:1% !important }	
    
    .comment { height:1% !important }
    .comment div { height:1% !important; position:relative }
    .comment-meta { position:absolute !important }
    .reply { position:absolute !important; bottom:3px !important; right:0 !important }
    .comment-reply-link { position:relative !important; bottom:0 !important; right:0 !important }

<? } ?>