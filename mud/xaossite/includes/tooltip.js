
if (!document.layers&&!document.all)
event="test"
function showtip(current,e,text){

if (document.all){
thetitle=text.split('<br>')
if (thetitle.length>1){
thetitles=''
for (i=0;i<thetitle.length;i++)
thetitles+=thetitle[i]
current.title=thetitles
}
else
current.title=text
}

else if (document.layers){
document.tooltip.document.write('<layer bgcolor=#000000 style="style="position:absolute;visibility:hidden; z-index:1; background-color: #CCCCCC; layer-background-color: #CCCCCC; border: 1px solid #333333; font-family:Verdana, Arial; font-size: 11px; font-weight:bold;"><font style="bgcolor:black;">'+text+'</layer>')
document.tooltip.document.close()
document.tooltip.left=e.pageX+5
document.tooltip.top=e.pageY+5
document.tooltip.visibility="show"
}
}
function hidetip(){
if (document.layers)
document.tooltip.visibility="hidden"
}
