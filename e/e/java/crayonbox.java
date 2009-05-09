/*
	Ro Ronalds
	Lab 6, Exersize 2, CrayonBox
	CompSci 119	 	
*/

import box;
//import crayons;
import java.awt.*;
import java.applet.Applet;

public class crayonbox extends Applet
{
private final int bg = 500;
public box b1;
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

public class box
{
public static void draw (Graphics pg)
{
int x = 400;
pg.setColor (Color.yellow);
pg.fillRect (50,50,x,x);
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