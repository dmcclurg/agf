Cufon.replace('h2, .top-slide h3, .post-entry h3, div.entry h1, .thumb-comments .comments, .sidebar-subpages a, ul.idTabs li a');

slideDelay = slideDelay * 1000;

$(document).ready(function(){
						   
	$("#comment").elastic();
	$("#comment").blur(function(){
		if (this.value == '') {
			$(this).animate({"height": "23px"}, "fast");
		}
	});
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animationSpeed: 'normal', /* fast/slow/normal */
		padding: 40, /* padding for each side of the picture */
		opacity: 0.55, /* Value betwee 0 and 1 */
		showTitle: true, /* true/false */
		allowresize: false, /* true/false */
		counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
		theme: 'dark_rounded' /* light_rounded / dark_rounded / light_square / dark_square */
	});

	nanotabs({c:"idTabs", e:"click", s:"selected", d:0, f:false});
	
	$("ul.navigation-top-ul").superfish();
	$("ul.navigation-top-ul ul li:last-child a").addClass("no-border");
	$("ul.sidebar-subpages > ul > li:last-child a").addClass("no-border");
	
	// Portfolio Hover Sliders
	$("#featured").hover(function(){
		if (autoRotate == 1){ clearInterval(timer); }
		$(this).find(".top-slide").animate({top:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".bottom-slide").animate({bottom:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".arrow-prev").animate({left:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".arrow-next").animate({right:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
	}, function(){
		if (autoRotate == 1){ dotimer(); }
		$(this).find(".top-slide").animate({top:"-65px"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".bottom-slide").animate({bottom:"-61px"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".arrow-prev").animate({left:"-40px"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".arrow-next").animate({right:"-40px"},{queue:false,duration:350,easing:'easeOutExpo'});
	});
	
	// Portfolio Page Arrows
	var currentFeatureSlide = 1;
	var currentFeatureLocation = 0;
	$("a.arrow-prev").fadeTo(0,0.2);
	
	var totalFeatureSlides = Math.ceil( ($(".featured-entry > div").size()) );
	var animationOn = false;
	
	$("a.arrow-next").click(function(event){
									 
		if (currentFeatureSlide != totalFeatureSlides) {
				
			if (currentFeatureSlide == 1) {
				newFeatureLocation = (currentFeatureLocation + 620);
				$("a.arrow-prev").fadeTo(300,0.95);
			} else {
				newFeatureLocation = (currentFeatureLocation + 620);
			}
			$(".featured-entry").animate({left:"-"+newFeatureLocation},{queue:false,duration:slideSpeed,easing:'easeInOutQuint'});
			if (currentFeatureSlide + 1 == totalFeatureSlides) {
				$("a.arrow-next").fadeTo(300,0.2); }
			currentFeatureLocation = newFeatureLocation;
			currentFeatureSlide = currentFeatureSlide + 1;
				
		}
		
	});
	
	$("a.arrow-prev").click(function(event){
								   
		if (currentFeatureSlide != 1) {
			
			if (currentFeatureSlide == totalFeatureSlides) {
				$("a.arrow-next").fadeTo(300,0.95); }
				
			if (currentFeatureSlide == 2) {
				newFeatureLocation = (currentFeatureLocation - 620);
			} else {
				newFeatureLocation = (currentFeatureLocation - 620);
			}
			
			if (currentFeatureSlide > 2) {
				newFeatureLocationNum = "-"+newFeatureLocation; } else {
				newFeatureLocationNum = newFeatureLocation; }
			$(".featured-entry").animate({left:newFeatureLocationNum},{queue:false,duration:slideSpeed,easing:'easeInOutExpo'});
			if (currentFeatureSlide - 1 == 1) {
				$("a.arrow-prev").fadeTo(300,0.2); }
			currentFeatureLocation = newFeatureLocation;
			currentFeatureSlide = currentFeatureSlide - 1;
				
		}
		
	});
	
	if (autoRotate == 1){
		// START ROTATE CODE
		var timer;
		var donext = function(x) {
	    
		    if (currentFeatureSlide != totalFeatureSlides) {
						
				if (currentFeatureSlide == 1) {
					newFeatureLocation = (currentFeatureLocation + 620);
					$("a.arrow-prev").fadeTo(300,0.95);
				} else {
					newFeatureLocation = (currentFeatureLocation + 620);
				}
				$(".featured-entry").animate({left:"-"+newFeatureLocation},{queue:false,duration:slideSpeed,easing:'easeInOutExpo'});
				if (currentFeatureSlide + 1 == totalFeatureSlides) {
					$("a.arrow-next").fadeTo(300,0.2); }
				currentFeatureLocation = newFeatureLocation;
				currentFeatureSlide = currentFeatureSlide + 1;
					
			} else if (currentFeatureSlide == totalFeatureSlides) {
			  
			  	$("a.arrow-next").fadeTo(300,0.95);
			  	$("a.arrow-prev").fadeTo(300,0.2);
			  	newFeatureLocation = 0;
				$(".featured-entry").animate({left:0},{queue:false,duration:slideSpeed,easing:'easeInOutExpo'});
				currentFeatureSlide = 1;
				currentFeatureLocation = newFeatureLocation;
	
			}
		    
		} 
	  
	  	var dotimer = function (){
		    if(timer != null) {
		      	clearInterval(timer);
		    }
		
		    timer = setInterval(function() {
		      	donext();
		    }, slideDelay); // Change the time in between rotations here (in milliseconds)             
		}
	
		dotimer();
		// END ROTATE CODE
	}
	
	// Regular Portfolio Entries
	$(".portfolio-entry").hover(function(){
		$(this).find(".top-slide").animate({top:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".bottom-slide").animate({bottom:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
	}, function(){
		$(this).find(".top-slide").animate({top:"-55px"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find(".bottom-slide").animate({bottom:"-46px"},{queue:false,duration:350,easing:'easeOutExpo'});
	});
	
	// Blog Pagination
	$("#blog").hover(function(){
		$(this).find("a.next").animate({top:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find("a.previous").animate({top:"0"},{queue:false,duration:350,easing:'easeOutExpo'});
	}, function(){
		$(this).find("a.next").animate({top:"-25px"},{queue:false,duration:350,easing:'easeOutExpo'});
		$(this).find("a.previous").animate({top:"-25px"},{queue:false,duration:350,easing:'easeOutExpo'});
	});
	
	var currentBlogSlide = 1;
	var currentLocation = 20;
	
	var totalBlogSlides = Math.ceil( ($(".blog-holder > div").size()) / 2 );
	var animationOn = false;
	
	$("a.previous").fadeTo(0,0.25);
	if (totalBlogSlides > 1) {
		$("a.next").fadeTo(0,1);
	} else {
		$("a.next").fadeTo(0,0.25);
	}
	
	$("a.next").click(function(event){
									 
		if (currentBlogSlide != totalBlogSlides) {
				
			if (currentBlogSlide == 1) {
				newLocation = (currentLocation + 274) - 20;
				$("a.previous").fadeTo(300,1); } else {
				newLocation = (currentLocation + 314) - 20; }
			$(".blog-holder").animate({top:"-"+newLocation},{queue:false,duration:450,easing:'easeInOutExpo'});
			if (currentBlogSlide + 1 == totalBlogSlides) {
				$("a.next").fadeTo(300,0.25); }
			currentLocation = newLocation;
			currentBlogSlide = currentBlogSlide + 1;
				
		}
		
	});
	
	$("a.previous").click(function(event){
								   
		if (currentBlogSlide != 1) {
			
			if (currentBlogSlide == totalBlogSlides) {
				$("a.next").fadeTo(300,1.0); }
			if (currentBlogSlide == 2) {
				newLocation = (currentLocation - 274) + 20; } else {
				newLocation = (currentLocation - 314) + 20; }
			if (currentBlogSlide > 2) {
				newLocationNum = "-"+newLocation; } else {
				newLocationNum = newLocation; }
			$(".blog-holder").animate({top:newLocationNum},{queue:false,duration:450,easing:'easeInOutExpo'});
			if (currentBlogSlide - 1 == 1) {
				$("a.previous").fadeTo(300,0.25); }
			currentLocation = newLocation;
			currentBlogSlide = currentBlogSlide - 1;
				
		}
		
	});

});