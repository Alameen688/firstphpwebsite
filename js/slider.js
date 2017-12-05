<script>
	jQuery(document).ready(function(){
		
		jQuery("#slider1").cycle({ 
			fx: "fade",
			timeoutFn: slideTimeoutslider1,
			speed: 1000,
			pause: 0,
			pauseOnPagerHover: 0,
			cleartype: true,
			cleartypeNoBg: true,	
			prev: "#slider1-wrapper .slide-prev", 
			next: "#slider1-wrapper .slide-next",
			pager: "#slider1-wrapper .slider-nav",
			pagerAnchorBuilder: function(idx, slide) {return "#slider1-wrapper .slider-nav span:eq(" + idx + ")";}  
		});						


		// Display Slider 
		
		jQuery('.slider-wrapper').show();


		// Show Play Button
		
		jQuery("#slider1-wrapper .slide-prev, #slider1-wrapper .slide-next, #slider1-wrapper .slider-button").click(function() {
			jQuery('#slider1 .play-video').show();
			jQuery('#slider1 .caption').show();
		});	
				
				
		// Pause Slider
		
		jQuery("#slider1-wrapper .slider-button, #slider1 .play-video").click(function() { 
			jQuery("#slider1").cycle("pause"); 
		});
		
									
		// Resume Slider
		
		jQuery("#slider1-wrapper .slide-prev, #slider1-wrapper .slide-next").click(function() {
			jQuery('#slider1').cycle('resume');
		});
								
	});
	
		
	// Timeouts per slide (in seconds) 
	
	var posttimeoutsslider1 = [6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,6,]; 
	function slideTimeoutslider1(currElement, nextElement, opts, isForward) { 
	var index = opts.currSlide; 
	return posttimeoutsslider1[index] * 1000; 
	} 
	
	</script>