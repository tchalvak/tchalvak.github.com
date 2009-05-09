// ASM SCROLLER 2.0 - (c) 2000 Brent Gustafson, vitaflo.com and assembler.org
//
// Feel free to hack around with this code for personal use, it's open source
// so do what ya want w/ it.  Though a link would be nice. ;)  While this code
// doesn't have a ton of documentation, please remember that I am a busy man,
// so support of this code will be very minimal.  Use at your own risk.
//
// Follow me into a solo, get in the FLO
// And you can picture like a photo
// Music mixed mellow maintains to make 
// Melodies for MC's motivates the breaks 
// I'm everlasting, I can go on for days and days 
// With rhyme displays that engrave deep as X-rays
//
// -Brent (brent@assembler.org)
// assembler.org || vitaflo.com

var w3c = (document.getElementById) ? 1:0
var ns4 = (document.layers) ? 1:0
var ie4 = (document.all) ? 1:0

var range = "";
var cap = "";
var mutex = 0;
var yplace = 0;
var ymax = 0;
var ymin = 0;
var xplace = 0;
var newsHeight = 0;

/** The only code you should ever need to change here are the following 3 vars **/
var speed = 4;                         //speed at which the news scrolls
var newsId = "news";                   //name of the overall news div
var newsClipId = "newsClipping";       //name of the news clipping div

function redrawScreen() {
  location.reload();
  return false
}

function shiftTo(obj, x, y) {
  if (w3c) {
    obj.style.left = x + "px";
    obj.style.top = y + "px";
  }
  else if (ns4) {
	 obj.moveTo(x,y);
  } 
  else if (ie4) {
    obj.style.pixelLeft = x;
	obj.style.pixelTop = y;
  }
}

function getObject(obj) {
	var theObj = eval("document." + range + obj + cap);
	return theObj;
} 

function scrollUp() {
  if (mutex == 1){
    var theObj = getObject(newsId);
    if (yplace < ymax) {
      yplace = yplace + speed;
      if (yplace > ymax) yplace = ymax;
      shiftTo(theObj, xplace, yplace);
      setTimeout("scrollUp()",25);
    }
  }
}
  
function scrollDown() {
  if (mutex == 2){
    var theObj = getObject(newsId);
    if (yplace > ymin) {
      yplace = yplace - speed;
      if (yplace < ymin) yplace = ymin;
      shiftTo(theObj, xplace, yplace);
      setTimeout("scrollDown()",25);
    }
  }
}

function scrollIt(msg, dir) {
  window.status = msg; 
  mutex = dir;
  if (mutex == 1) scrollUp();
  else if (mutex == 2) scrollDown();
}

function init() {
  if (w3c) {
    range = "getElementById(\"";
    cap = "\")";
    theObj = getObject(newsClipId);
    newsHeight = parseInt(theObj.offsetHeight);
    theObj = getObject(newsId);
    ymin = (parseInt(theObj.offsetHeight) - newsHeight) * -1;
  }
  else if (ns4) {
    window.captureEvents(Event.RESIZE);
    window.onresize = redrawScreen;
    theObj = getObject(newsClipId);
    newsHeight = theObj.clip.height;
    newsId = newsClipId + ".document." + newsId;
    theObj = getObject(newsId);
    ymin = (theObj.clip.height - newsHeight) * -1;
  }
  else if (ie4) {
    range = "all.";
    theObj = getObject(newsClipId);
    newsHeight = theObj.offsetHeight;
    theObj = getObject(newsId);
    ymin = (theObj.offsetHeight - newsHeight) * -1;
  }
}

// END OF LINE