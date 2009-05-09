/*
	Ro Ronalds
	Lab 6, Exersize 2, CrayonBox
	CompSci 119		
*/

//import box;
//import crayons;
import java.awt.*;
import java.applet.Applet;

public class crayonbox extends Applet

{
final int boxdist = 400;
public box b1;
//public crayons c1;

public void init ()

{
b1 = new box (boxdist);
setBackground (Color.black);
setSize (boxdist, boxdist);
}

public void paint (Graphics page)

{
b1.box (page);
}
}

