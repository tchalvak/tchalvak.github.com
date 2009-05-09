/*  Ro Ronalds, Lab 6, Exersize 1,
    CompSci 119, Qualitypoints Exersize.
*/

import cs1.Keyboard;
public class qualitypoints 
{
public static void main(String args[]) 
{
int average;
System.out.println("Input Average: ");
average = Keyboard.readInt();
int qpoint = quality (average);
System.out.println("Quality points: " + qpoint);
}
private static int quality (int average)
{
int qpoint;
qpoint = 0;
if (average <=100&&average>=0)
	{
	if (average <= 100 && average >= 90)
		{
		qpoint = 4;
		}
	if (average <90 && average>=80)
		{
		qpoint = 3;
		}
	if (average <80 && average>=70)
		{
		qpoint = 2;
		}
	if (average <0 && average>=70)
		{
		qpoint = 1;
		}
	if (average <60 && average>=0)
		{
		qpoint = 0;
		}
	}
else
	{
	System.out.println("Average must be from 0 to 100.");
	qpoint = -1;
	}
return qpoint;
}
}