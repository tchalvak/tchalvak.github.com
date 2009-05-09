/*
	Ro Ronalds
	Lab 6, Exersize 2, Crayons class
	CompSci 119		
*/
import java.awt.*;
import java.awt.Graphics;
import java.applet.Applet;

public class crayons
{
public int w, h;
public Graphics newpage;
public Color z;

public crayons (Graphics page, int x, int y, Color z)
{
int w = x;
int h = y;
Color c = z;
Graphics newpage = page;
}
public static void paint (Graphics page) 
{
page.setColor (c);
page.drawRect(w, 400-h, w+10, 400);
}
}

/*
import java.awt.*;
import java.applet.Applet;

public class crayons
{
public static void draw (Graphics page)
{
paint (void);
}
public crayons (int x, int y, Color z)
{
this.w = x;
this.h = y;
this.c = z;
}
public static void paint (Graphics page, int w, int h, Color c) 
{
page.setColor (c);
page.drawRect(w,400-h, w+10, 400);
}
}
*/