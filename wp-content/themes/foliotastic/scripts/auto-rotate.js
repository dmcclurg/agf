// START ROTATE CODE
var currentFeatureSlide = 1;
var timer;
var donext = function(x) {

    if (currentFeatureSlide != totalFeatureSlides) {
				
		if (currentFeatureSlide == 1) {
			newFeatureLocation = (currentFeatureLocation + 620);
			$("a.arrow-prev").fadeTo(300,0.95);
		} else {
			newFeatureLocation = (currentFeatureLocation + 620);
		}
		$(".featured-entry").animate({left:"-"+newFeatureLocation},{queue:false,duration:450,easing:'easeInOutExpo'});
		if (currentFeatureSlide + 1 == totalFeatureSlides) {
			$("a.arrow-next").fadeTo(300,0.2); }
		currentFeatureLocation = newFeatureLocation;
		currentFeatureSlide = currentFeatureSlide + 1;
			
	} else if (currentFeatureSlide == totalFeatureSlides) {
	  
	  	$("a.arrow-right").fadeTo(300,0.95);
	  	$("a.arrow-left").fadeTo(300,0.2);
	  	newFeatureLocation = 0;
		$(".featured-entry").animate({left:0},{queue:false,duration:450,easing:'easeInOutExpo'});
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
    }, 4500); // Change the time in between rotations here (in milliseconds)             
}

dotimer();