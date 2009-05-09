/*
 CHROMELESS WINDOWS v.30.4
 Generate a chromeless window on IE4,IE5.x,IE6 on WIN32 and a regular one on the others browsers.

 (c) Gabriel Suchowolski power[z]one / www.microbians.com / powerz@microbians.com
 Distributed under the terms of the GNU Library General Public License (www.gnu.org)
*/

function openchromeless(theURL, wname, W, H, X, Y, NONEgrf, CLOSEdwn, CLOSEup, CLOSEovr, MINIdwn, MINIup, MINIovr, CLOCKgrf, titHTML, titWIN, winBORDERCOLOR, winBORDERCOLORsel, winBGCOLOR, winBGCOLORsel) {

	var isie = false
	var isv55= false
	var iswin= false

	if ( navigator.appName == "Microsoft Internet Explorer" && parseInt(navigator.appVersion)>=4 ) {
		isie=true
		if ( navigator.appVersion.substring(navigator.appVersion.indexOf("MSIE ")+5,navigator.appVersion.indexOf("MSIE ")+8) >= 5.5 ) isv55=true;
	}

	if ( navigator.userAgent.toLowerCase().indexOf("win")!=-1 ) iswin=true

	if (X==null) var X = Math.ceil( (window.screen.width  - W) / 2 );
	if (Y==null) var Y = Math.ceil( (window.screen.height - H) / 2 );

	if (isie) { H=H+20+3; W=W+2; }
	var s = ",width="+ W +",height="+ H ;

	if (isie && iswin) {

var chromeTIThtml = '\n' +
'<html> 																				'+ '\n'+
'<head> 																				'+ '\n'+
'<style type="text/css"> 																		'+ '\n'+
'#crtMOVE   { position: absolute; left:   0px; top: 0px; z-index: 2;			      			          } 						'+ '\n'+
'#txtTITLE  { position: absolute; left:   0px; top: 0px; width:  100%;  height: 20px; z-index: 1; clip:rect(0,100%,20,0); } 						'+ '\n'+
'#btnCLOSE  { position: absolute; left: -20px; top: 2px; width:   40px; height: 15px; z-index: 3; clip:rect(0,40,15,0);   } 						'+ '\n'+
'#btnMINI   { position: absolute; left: -20px; top: 4px; width:   11px; height: 11px; z-index: 3; clip:rect(0,11,11,0);   } 						'+ '\n'+
'#grfCLOCK  { position: absolute; left: -20px; top: 4px; width:   11px; height: 11px; z-index: 3; clip:rect(0,11,11,0);   } 						'+ '\n'+
'</style> 																				'+ '\n'+
'<script language="javascript"> 																	'+ '\n'+
'var imgCLOSEdwn = new Image(); imgCLOSEdwn.src = "'+ CLOSEdwn +'";  													'+ '\n'+
'var imgCLOSEup  = new Image(); imgCLOSEup.src  = "'+ CLOSEup  +'"; 													'+ '\n'+
'var imgCLOSEovr = new Image(); imgCLOSEovr.src = "'+ CLOSEovr +'"; 													'+ '\n'+
'var imgMINIdwn  = new Image(); imgMINIdwn.src  = "'+ MINIdwn +'"; 													'+ '\n'+
'var imgMINIup   = new Image(); imgMINIup.src   = "'+ MINIup  +'"; 													'+ '\n'+
'var imgMINIovr  = new Image(); imgMINIovr.src  = "'+ MINIovr +'"; 													'+ '\n'+
'var CLOCKgrfImg = new Image(); CLOCKgrfImg.src = "'+ CLOCKgrf +'"; 												'+ '\n'+
'document.onselectstart = new Function("return false;") 														'+ '\n'+
'document.ondragstart   = new Function("moveWIN();return false;") 														'+ '\n'+
'document.oncontextmenu = new Function("return false;") 														'+ '\n'+
'document.onmousemove   = moveWIN 																	'+ '\n'+
'winSTATUS = "up"; 																			'+ '\n'+
'function setLAYOUT() { 																		'+ '\n'+
'	document.all["btnCLOSE"].style.pixelLeft=document.body.clientWidth-45 												'+ '\n'+
'	if ( top.mainloaded ) 	{ 																	'+ '\n'+
'		document.all["grfCLOCK"].style.visibility = "hidden"; 													'+ '\n'
chromeTIThtml += '\n' +
'	} 																				'+ '\n'+
'	else { 																				'+ '\n'+
'		document.all["grfCLOCK"].style.pixelLeft=document.body.clientWidth-60; 											'+ '\n'+
'		setTimeout("setLAYOUT()",500); 																'+ '\n'+
'	} 																				'+ '\n'+
'} 																					'+ '\n'+
'function minimizeWIN() {  																		'+ '\n'+
'	top.window.moveTo(0,-4000); 																	'+ '\n'+
'	if ( (top.opener) && (!top.opener.closed) ) { top.opener.window.focus(); } 											'+ '\n'+
'	top.window.blur() 																		'+ '\n'+
'} 																					'+ '\n'+
'function moveWIN() { 																			'+ '\n'+
'	if ( winSTATUS == "down") { 																	'+ '\n'+
'		document.body.bgColor = "'+winBGCOLORsel+'"                                                                                     			'+ '\n'+
'		parent.bordeM.document.body.bgColor = "'+winBORDERCOLORsel+'"                                                                                     	'+ '\n'+
'		parent.bordeT.document.body.bgColor = "'+winBORDERCOLORsel+'"                                                                                     	'+ '\n'+
'		parent.bordeB.document.body.bgColor = "'+winBORDERCOLORsel+'"                                                                                     	'+ '\n'+
'		parent.bordeL.document.body.bgColor = "'+winBORDERCOLORsel+'"                                                                                     	'+ '\n'+
'		parent.bordeR.document.body.bgColor = "'+winBORDERCOLORsel+'"                                                                                     	'+ '\n'+
'		ofx =  event.x 																		'+ '\n'+
'		ofy =  event.y 																		'+ '\n'+
'		winSTATUS = "drag" 																	'+ '\n'+
'	} 																				'+ '\n'+
'	else if ( winSTATUS == "drag") { 																'+ '\n'+
'		px = event.screenX - ofx - 1; 																'+ '\n'+
'		py = event.screenY - ofy - 1; 																'+ '\n'+
'		top.window.x=px; 																	'+ '\n'+
'		top.window.y=py; 																	'+ '\n'+
'		top.window.moveTo(px , py); 																'+ '\n'+
'	} else { 																			'+ '\n'+
'		document.body.bgColor = "'+winBGCOLOR+'"                                                                                     				'+ '\n'+
'		parent.bordeM.document.body.bgColor = "'+winBORDERCOLOR+'"                                                                                     		'+ '\n'+
'		parent.bordeT.document.body.bgColor = "'+winBORDERCOLOR+'"                                                                                     		'+ '\n'+
'		parent.bordeB.document.body.bgColor = "'+winBORDERCOLOR+'"                                                                                     		'+ '\n'+
'		parent.bordeL.document.body.bgColor = "'+winBORDERCOLOR+'"                                                                                     		'+ '\n'+
'		parent.bordeR.document.body.bgColor = "'+winBORDERCOLOR+'"                                                                                     		'+ '\n'+
'		winStatus = "up" 																	'+ '\n'+
'	} 																				'+ '\n'+
'} 																					'+ '\n'+
'</script> 																				'+ '\n'+
'</head> 																				'+ '\n'+
'<body onresize="setLAYOUT()" bgcolor='+winBGCOLOR+'> 															'+ '\n'+
'<div id=crtMOVE><img onmousedown="winSTATUS=\'down\';moveWIN()" onmouseup="winSTATUS=\'up\';moveWIN()" border=0 src="'+NONEgrf+'" width=110% height=500></div> 	'+ '\n'+
'<div id=txtTITLE>'+ '<table width=100% height=20 border=0 cellpadding=0 cellspacing=0><tr><td valign=middle align=left>'+titHTML+'</td></tr></table>' +'</div> 	'+ '\n'+
'<div id=btnCLOSE><img name=imgCLOSE src="'+ CLOSEup  +'" border=0 width=40 height=15 onmouseover="this.src=imgCLOSEovr.src" onmouseout="btnSTATUS=false; this.src=imgCLOSEup.src" onmouseup="this.src=imgCLOSEup.src" onmousedown="this.src=imgCLOSEdwn.src" onclick="top.window.close()"></div> 	'+ '\n'+
'<div id=grfCLOCK><img name=imgCLOCK src="'+ CLOCKgrf +'" border=0 width=11 height=11></div> 										'+ '\n'+
'<script>setLAYOUT()</script> 																		'+ '\n'+
'</body> 																				'+ '\n'+
'</html> 																				'+ '\n'

var chromeFRMhtml = '' +
'<HTML>																							'+ '\n'+
'<HEAD>                                                                         													'+ '\n'+
'<TITLE>'+ titWIN +'</TITLE>                                          															'+ '\n'+
'</HEAD>                                                                        													'+ '\n'+
'<script> 																						'+ '\n'+
'top.mainloaded = false																					'+ '\n'+
'function generatetitle() { 																				'+ '\n'+
'	if( window.frames["frmTIT"] && window.frames["bordeL"] && window.frames["bordeB"] && window.frames["bordeR"] && window.frames["bordeM"] ) {					'+ '\n'+
'		frmTIT.document.bgColor="'+ winBGCOLOR +'"																'+ '\n'+
'		frmTIT.document.open();																			'+ '\n'+
'		frmTIT.document.write( "'+ quitasaltolinea(chromeTIThtml) +'" );													'+ '\n'+
'		frmTIT.document.close();																		'+ '\n'+
'		bordeM.document.bgColor="'+ winBORDERCOLOR +'"																'+ '\n'+
'		bordeL.document.bgColor="'+ winBORDERCOLOR +'"																'+ '\n'+
'		bordeR.document.bgColor="'+ winBORDERCOLOR +'"																'+ '\n'+
'		bordeB.document.bgColor="'+ winBORDERCOLOR +'"																'+ '\n'+
'		bordeT.document.bgColor="'+ winBORDERCOLOR +'"																'+ '\n'+
'	} else {																					'+ '\n'+
'		setTimeout("generatetitle()",20)																	'+ '\n'+
'	}																						'+ '\n'+
'}																							'+ '\n'+
'top.window.h='+H+'																					'+ '\n'+
'top.window.w='+W+'																					'+ '\n'+
'top.window.x='+X+'																				'+ '\n'+
'top.window.y='+Y+'																				'+ '\n'+
'generatetitle()																					'+ '\n'+
'</script>																						'+ '\n'+
'<frameset onload="top.mainloaded=true" onfocus="top.window.moveTo(top.window.x,top.window.y)" border=0 framespacing=0 frameborder=0 cols="1,100%,1"> 					'+ '\n'+
'	<frame name=bordeL src="about:blank" scrolling=no noresize> 															'+ '\n'+
'	<frameset border=0 framespacing=0 frameborder=0 rows="1,20,1,100%,1">        													'+ '\n'+
'		<frame name=bordeT src="about:blank" scrolling=no noresize> 														'+ '\n'+
'		<frame name=frmTIT src="about:blank" scrolling=no noresize>  														'+ '\n'+
'		<frame name=bordeM src="about:blank" scrolling=no noresize>         													'+ '\n'+
'		<frame name=main   src="'+theURL+'">                   															'+ '\n'+
'		<frame name=bordeB src="about:blank" scrolling=no noresize> 														'+ '\n'+
'	</frameset>                                                             													'+ '\n'+
'	<frame name=bordeR src="about:blank" scrolling=no noresize> 															'+ '\n'+
'</frameset> 																						'+ '\n'+
'</HTML>                                                                        													'

		var CWIN = window.open( "" , wname, "fullscreen=1"+s);
		CWIN.resizeTo( Math.ceil( W ) , Math.ceil( H ) );
		CWIN.moveTo  ( Math.ceil( X ) , Math.ceil( Y ) );
		CWIN.document.open();
		CWIN.document.write( chromeFRMhtml );
		CWIN.document.close();

	}
	else    {
		var CWIN = window.open(theURL, wname, "toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=0,resizable=1"+s, true);
	}

	CWIN.focus();

	return CWIN
}                                                                               
                                                                                
function quitasaltolinea(txt) {
  var salida = txt.toString()
  var re     = /\\/g; var salida = salida.replace(re, "\\\\");
  var re     = /\//g; var salida = salida.replace(re, "\\\/");
  var re     = /\"/g; var salida = salida.replace(re, "\\\"");
  var re     = /\'/g; var salida = salida.replace(re, "\\\'");
  var re     = /\n/g; var salida = salida.replace(re, "\\n");
  var re     = /  /g; var salida = salida.replace(re, "");
  var re     = /\t/g; var salida = salida.replace(re, "");
  var re     = /\r/g; var salida = salida.replace(re, "");
  return salida
}
