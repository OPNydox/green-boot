"use strict";
// product-magnifier var
	var lukani_magnifier_vars;
	var yith_magnifier_options = {
		
		sliderOptions: {
			responsive: lukani_magnifier_vars.responsive,
			circular: lukani_magnifier_vars.circular,
			infinite: lukani_magnifier_vars.infinite,
			direction: 'left',
            debug: false,
            auto: false,
            align: 'left',
            height: 'auto',  
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(lukani_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		
		showTitle: false,
		zoomWidth: lukani_magnifier_vars.zoomWidth,
		zoomHeight: lukani_magnifier_vars.zoomHeight,
		position: lukani_magnifier_vars.position,
		lensOpacity: lukani_magnifier_vars.lensOpacity,
		softFocus: lukani_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: lukani_magnifier_vars.phoneBehavior,
		loadingLabel: lukani_magnifier_vars.loadingLabel,
	};