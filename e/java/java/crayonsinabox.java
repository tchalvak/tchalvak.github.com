/*
	Ro Ronalds
	Lab 6, Exersize 2, CrayonBox
	CompSci 119	 	
*/

import box;
import crayons;
import java.awt.*;
import java.applet.Applet;

public class crayonsinabox extends Applet
{
public final int bg = 500;
public int w, h;
public void Color c;
public void crayons c1, c2, c3;
public void box b1;
public void init ()
{
repaint ();
setBackground (Color.black);
setSize (bg, bg);
}
public static void repaint (Graphics pg)
{
box.draw (pg);
/*
crayons c1 = crayonmake (100, 20, Color.blue);
crayonmake.c1 ();*/
}
}
/*
public class crayons extends crayonbox
{
public void crayonmake (int h, int w, Color c)
{
Graphics.setColor (c);
Graphics.fillRect (w,400-h,10,h);
}
}
*/