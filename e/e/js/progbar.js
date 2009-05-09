
<!-- begin hiding

/*
Preload Image With Update Bar Script (By Marcin Wojtowicz [one_spook@hotmail.com])
Submitted to and permission granted to Dynamicdrive.com to feature script in it's archive
For full source code to this script and 100's more, visit http://dynamicdrive.com
*/

// You may modify the following:
	var locationAfterPreload = "index2.php" // URL of the page after preload finishes
	var lengthOfPreloadBar = 346 // Length of preload bar (in pixels)
	var heightOfPreloadBar = 2 // Height of preload bar (in pixels)
	// Put the URLs of images that you want to preload below (as many as you want)
	var yourImages = new Array("images/splash.jpg" "images/nc6.jpg" "images/nc6_orange.jpg" "images/nc_blue.jpg" "images/x.jpg" "images/nc6-button.jpg" "images/nc6-button-orange.jpg" images/nc6-button-blue.jpg")
// Do not modify anything beyond this point!
if (document.images) {
	var dots = new Array() 
	dots[0] = new Image(1,1)
	dots[0].src = "images/black.gif" // default preloadbar color (note: You can substitute it with your image, but it has to be 1x1 size)
	dots[1] = new Image(1,1)
	dots[1].src = "images/bar.gif" // color of bar as preloading progresses (same note as above)
	var preImages = new Array(),coverage = Math.floor(lengthOfPreloadBar/yourImages.length),currCount = 0
	var loaded = new Array(),i,covered,timerID
	var leftOverWidth = lengthOfPreloadBar%coverage
}
function loadImages() { 
	for (i = 0; i < yourImages.length; i++) { 
		preImages[i] = new Image()
		preImages[i].src = yourImages[i]
	}
	for (i = 0; i < preImages.length; i++) { 
		loaded[i] = false
	}
	checkLoad()
}
function checkLoad() {
	if (currCount == preImages.length) { 
newwindow=window.open("index2.php","","width=1000,height=600")
newwindow.creator=self
		return
	}
	for (i = 0; i <= preImages.length; i++) {
		if (loaded[i] == false && preImages[i].complete) {
			loaded[i] = true
			eval("document.img" + currCount + ".src=dots[1].src")
			currCount++
		}
	}
	timerID = setTimeout("checkLoad()",10) 
}
// end hiding -->
