
HoverMenu.DOM       = (document.getElementById && document.childNodes) ? true : false;
HoverMenu.Gecko     = (navigator.product == ("Gecko"));
HoverMenu.IE        = (document.all) ? true : false;
HoverMenu.Konqueror = (navigator.userAgent.indexOf("Konqueror")!=-1);
HoverMenu.Opera     = (navigator.userAgent.indexOf("Opera")!=-1);

HoverMenu.MaxCells = 20;	//max number of menu cells to look for; increase as necessary


if (HoverMenu.DOM) {
	// Find all the HoverMenu Items
	for(i=1; i<HoverMenu.MaxCells; i++) {
		if (document.getElementById("HoverMenu_Item" +i)) {
			setupHoverMenuCell(i);
		}
	}
}





// ############### FUNCTIONS ###################


function isArray() {
	// Return a boolean value telling whether 
	// the first argument is an Array object. 
	// from http://www.planetpdf.com/mainpage.asp?webpageid=1144
	if (typeof arguments[0] == 'object') {
		var criterion = arguments[0].constructor.toString().match(/array/i);
		return (criterion != null);
	}
	return false;
}


function setupHoverMenuCell(i) {
	thisMenuCell = document.getElementById("HoverMenu_Item" +i);
	thisMenuCell.setParameters = HoverMenu_SetParameters;
	thisMenuCell.setParameters(i);
}


function HoverMenu_SetParameters(i) {
	this.Number = i;
	
	this.SetBorder = HoverMenu_SetBorder;
	this.SetFontColor = HoverMenu_SetTextColor;
	
	// Link Stuff
	this.Link = "";
	this.LinkObj = "";
	this.LinkMouseOver = "";
	this.LinkMouseOut = "";

	if (this.hasChildNodes) {
		for (i=0; i<this.childNodes.length; i++) {
			thisChild = this.childNodes[i];
			if (thisChild.tagName == "A") {
				this.LinkObj = thisChild;
				this.Link = thisChild.getAttribute("HREF");
				this.LinkMouseOver = thisChild.getAttribute("ONMOUSEOVER");
				this.LinkMouseOut  = thisChild.getAttribute("ONMOUSEOUT");
				break;
			}
		}
	}
	
	// Text Color
	if (isArray(HoverMenu.TextColorOver)) {
		thisNum = this.Number
		while (thisNum > HoverMenu.TextColorOver.length) thisNum = thisNum - HoverMenu.TextColorOver.length;
		this.TextColorOver = HoverMenu.TextColorOver[thisNum-1];
	}
	else {
		this.TextColorOver = HoverMenu.TextColorOver;
	}
	
	// Background Color
	if (isArray(HoverMenu.BGColorOver)) {
		thisNum = this.Number
		while (thisNum > HoverMenu.BGColorOver.length) thisNum = thisNum - HoverMenu.BGColorOver.length;
		this.BGColorOver = HoverMenu.BGColorOver[thisNum-1];
	}
	else {
		this.BGColorOver = HoverMenu.BGColorOver;
	}
	
	this.style.cursor = HoverMenu.IE ? "hand" : "pointer";
	if (HoverMenu.BorderWidth) this.SetBorder(HoverMenu.BorderWidth, HoverMenu.BorderColor);
	
	this.onmouseover = HoverMenu_MouseOver;
	this.onmouseout  = HoverMenu_MouseOut;
	this.onmousedown = HoverMenu_Click;
}


function HoverMenu_SetBorder(borderWidth, borderColor) {
	this.style.borderStyle = "solid";
	this.style.borderColor = borderColor;
	this.style.borderWidth = borderWidth;
}


function HoverMenu_SetTextColor(fontColor) {
	this.style.color = fontColor;
	if (this.LinkObj) this.LinkObj.style.color = fontColor;
}


function HoverMenu_MouseOver() {
	this.SetFontColor(this.TextColorOver);
	this.style.backgroundColor = this.BGColorOver;
	if (HoverMenu.BorderWidth) this.SetBorder(HoverMenu.BorderWidth, HoverMenu.BorderColorOver);
	if (typeof(this.LinkMouseOver) == "function") this.LinkMouseOver();
	window.status = this.Link;
}


function HoverMenu_MouseOut() {
	this.SetFontColor(HoverMenu.TextColor);
	this.style.backgroundColor = HoverMenu.BGColor;
	if (HoverMenu.BorderWidth) this.SetBorder(HoverMenu.BorderWidth, HoverMenu.BorderColor);
	if (typeof(this.LinkMouseOut) == "function") this.LinkMouseOut();
	window.status = "";
}


function HoverMenu_Click() {
    if (this.Link.indexOf("javascript:")!=-1) {
		eval(this.link);
	} else {
        document.location.href = this.Link;
    }
}


