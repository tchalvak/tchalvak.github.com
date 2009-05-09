// #### CONFIG #############################
HoverMenu = new Object();	//Object w/ config option, browser info, etc

// TextColorOver can be either a string or an array
HoverMenu.TextColor = "#000000";
HoverMenu.TextColorOver = "#5a7bad";
//HoverMenu.TextColorOver = Array("#000099","#000099","#FFFFFF","#FFFFFF");

// BGColorOver can be either a string or an array
HoverMenu.BGColor = "#F1F1F1";
HoverMenu.BGColorOver = "#DDDDDD";
//HoverMenu.BGColorOver = Array("#99CCFF","#FFEE66","#6FC262","#CC0000");

HoverMenu.BorderWidth = 1;	//set to null for no border
HoverMenu.BorderColor = "#F1F1F1";
HoverMenu.BorderColorOver = "#666666";
// #########################################



if (document.getElementById && document.childNodes) {
	// if the browser supports the "standard" DOM, then load the main script.
	document.write("<scr" + "ipt language='javascript1.2' src='hovermenu.js' type='text/javascript'><\/scr" + "ipt>");
}
