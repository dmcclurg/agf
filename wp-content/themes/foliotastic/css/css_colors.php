<? header("Content-type: text/css");

// NOTE: All of the colors here can be set via the admin panel, leaving you no reason to edit this file
// unless you absolutely know what you're doing. Just a fair warning!
	
$background_color = $_GET['background_color'];
$highlight_color = $_GET['highlight_color'];
$midrange_color = $_GET['midrange_color'];
$text_color = $_GET['text_color'];
$searchbox_color = $_GET['searchbox_color'];

if ($background_color == "FFFFFF" && $text_color == "5F5F5F" && $midrange_color == "F0F0F0" && $highlight_color == "147CB2" && $searchbox_color == "DFDFDF"){ ?>
/* ---------------------------------------------------- */
/* CSS3 Styling - New since v2.0                        */

h2, .sidebar-subpages a, p.twitter-message, .page-button a, .reply a, #search .textbox, #search .button-go { text-shadow:1px 1px 0 #fff; }
p.twitter-message, .page-button a, #search .button-go { text-shadow:none; }
.reply a { text-shadow:1px 1px 0 #000; }
#search .textbox { text-shadow:1px 1px 0 #eeeeee; }
#search .textbox {
	background-image: -moz-linear-gradient(100% 100% 90deg, #dfdfdf, #cccccc);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#dfdfdf), to(#cccccc));
}
#footer {
	text-shadow:1px 1px 0 #ffffff;
	background-image: -moz-linear-gradient(100% 100% 90deg, #fafafa, #f0f0f0);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#fafafa), to(#f0f0f0));
}
<? } ?>

/* ---------------------------------------------------- */
/* LIGHT COLORS                                         */

body, p.twitter-message { background:#<? echo $background_color ?> !important }
.post-block .thumb-comments .comments { background:url('../graphics/icon_comments_onlight.png') 0 7px no-repeat; }
.introduction p { text-shadow:1px 1px 0 #<? echo $background_color ?>; }

/* COLORS - Custom Color Elements */
ul.idTabs li a.selected, ul.idTabs li a.selected:hover,a#contact-block,
a.next,a.previous,.page-button a,.navigation-top li ul,
.navigation-top li ul ul, .flickr-link { background-color:#<? echo $highlight_color ?> !important }
div.entry h1, div.entry h3, div.entry h6, .custom-color, a, a.twitter-postlink,
blockquote, .page-button a, .twitter-message a, a.twitter-user { color:#<? echo $highlight_color ?> !important }
.windows { border-top:5px solid #<? echo $highlight_color ?> }
.navigation-top a:hover, .navigation-top li.current_page a { border-bottom:5px solid #<? echo $highlight_color ?> }
.twitter-arrow { border-top:10px solid #<? echo $background_color ?> }
ul ul a.sf-with-ul .sf-sub-indicator { border-color:#<? echo $highlight_color ?> #<? echo $highlight_color ?> #<? echo $highlight_color ?> #<? echo $background_color ?> }

/* COLORS - Dark Grey Elements */
div.entry h2, div.entry h4, div.entry h5, body, input, .navigation-top li.current_page a,h5.logo a, a:hover, a:hover.twitter-postlink,
.post-block .thumb-comments .comments, p.twitter-message { color:#<? echo $text_color; ?> !important }

/* COLORS - White Elements */
ul.idTabs li a, .page-button a, #contact-block a:hover,
.comments, .navigation-top ul ul a,
#contact-block,#blog a.next, #blog a.previous { color:#<? echo $background_color ?> !important }

p.twitter-message a, p.twitter-message a:hover { color:#<? echo $text_color ?> }
#search .button-go { background-color:#<? echo $background_color ?> !important }
.twitter-arrow { border-left:10px solid #<? echo $midrange_color ?>; border-right:10px solid #<? echo $midrange_color ?> }
.navigation-top li ul { border:2px solid #<? echo $background_color ?> }

/* COLORS - Other Grey Colors */
.post-block { border-bottom:1px solid #<? echo $searchbox_color ?> }
.wp-caption { border: 1px solid #<? echo $searchbox_color ?>; background-color: #<? echo $midrange_color ?>; }
h2, #navigation-top, #footer, ul.sidebar-subpages > a { background-color:#<? echo $midrange_color ?> !important }
#search .textbox { background-color:#<? echo $searchbox_color ?> !important }
.single-title-image h2, a.twitter-postlink:hover, .single-title-image a:hover { color:#<? echo $text_color ?> !important }
.twitter-timestamp { color:#<? echo $text_color ?> }
ul.idTabs li a { background:#<? echo $text_color ?> }
.postmetadata { color:#<? echo $text_color ?> }
.navigation-top ul ul a { border-bottom:1px dotted #<? echo $midrange_color ?> }
.navigation-top ul ul a:hover { border-bottom:1px dashed #<? echo $midrange_color ?>; color:#<? echo $text_color; ?> !important; background:#<? echo $midrange_color ?> }
a.sf-with-ul .sf-sub-indicator,ul ul a.sf-with-ul:hover .sf-sub-indicator { border-color:#<? echo $midrange_color ?> #<? echo $midrange_color ?> #<? echo $midrange_color ?> #<? echo $text_color ?> }
blockquote { border-top:1px solid #<? echo $searchbox_color ?> !important; border-bottom:1px solid #<? echo $searchbox_color ?> !important }

/* COLORS - Comments */
#commentform input { border:1px solid #<? echo $text_color; ?> }
#comment { border:1px solid #<? echo $text_color; ?> }
#submit { background:#<? echo $highlight_color ?>; color:#<? echo $background_color ?> !important }
.comment { border-bottom:1px solid #<? echo $midrange_color; ?> }
.reply a { background:#aaa !important; color:#FFF !important }
.reply a:hover { background:#888 !important }
.children .comment { border-top:1px solid #eee; background:#<? echo $background_color ?> }
.children .children .comment { background:#<? echo $background_color ?> }

/* COLORS - Error Messages */
/* These only show up during Foliotastic Setup */
p.error { background:#FFFCDF; border:1px solid #DFC47D }

/* COLORS - Sidebar */

#sidebar { background:#<? echo $midrange_color ?> }
#sidebar h2 { background:#<? echo $highlight_color ?> !important; color:#<? echo $background_color ?> !important; }

.sidebar-subpages { background:#<? echo $background_color ?> }
.sidebar-subpages ul a { border-bottom:1px solid #<? echo $midrange_color ?> }

.sidebar-subpages ul li.current_page_item a,
.sidebar-subpages ul li.current_page_item a:hover,
.sidebar-subpages ul li.current-cat a,
.sidebar-subpages ul li.current-cat a:hover { background:#<? echo $highlight_color ?> !important; color:#<? echo $background_color ?> !important; border-bottom:1px solid #<? echo $highlight_color ?> !important }

.sidebar-subpages ul li.current_page_item ul li a,
.sidebar-subpages ul li.current-cat ul li a { background:#<? echo $background_color ?> !important; color:#<? echo $highlight_color ?> !important; border-bottom:1px solid #<? echo $background_color ?> !important }

.sidebar-subpages ul a:hover,
.sidebar-subpages ul li.current_page_item ul li a:hover,
.sidebar-subpages ul li.current-cat ul li a:hover { color:#<? echo $highlight_color ?> !important; border-color:#<? echo $background_color ?> !important; background:#<? echo $midrange_color ?> !important }
.sidebar-subpages h2 a { color:#<? echo $background_color ?> !important }