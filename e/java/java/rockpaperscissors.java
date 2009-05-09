/*
    Ro Ronalds    CSci 119
    Rock Paper Scissors Project	
	rockpaperscissors.java
	Project 1
*/

import cs1.Keyboard;
public class rockpaperscissors
{
public static void main(String args[]) 
{
int userwins, mywins, ties, rps, myrps, contchoice, winner;
mywins = 0; userwins = 0; ties = 0;
winner = 3;
contchoice = 1;
System.out.println("\nThe Rules are thus: \n Rock breaks Scissors.\n Scissors cuts Paper.\n Paper covers Rock.\n");
while (contchoice != 0)//Beginning of while loop, loop set on.
	{
	System.out.println("(Choose: [1]Rock [2]Paper [3]Scissors.)");
	/* Beginning of the Contest, 1 is rock, 2 is paper, and 3 is scissors.*/
	rps = Keyboard.readInt();
	myrps = (int)(Math.random()*3)+1;
	if (rps == myrps)
		{
		System.out.println(" [Tie.]");
		winner = 3;
		ties += 1;
		}
	else
		{
		switch (rps)
			{
			case 1://User chooses rock.
				{
				switch (myrps)
					{
					case 2://p
					winner = 0;
					break;
					case 3://s
					winner = 1;
					break;
					}
				}
			break;
			case 2://User chooses paper.
				{
				switch (myrps)
					{
					case 1://r
					winner = 1;
					break;
					case 3://s
					winner = 0;
					break;
					}
				}
			break;
			case 3://User chooses scissors.
				{
				switch (myrps)
					{
					case 1://r
					winner = 0;
					break;
					case 2://p
					winner = 1;
					break;
					}
				}
			break;
			default://Invalid Choice
				{
				System.out.println("(Invalid Choice.)");
				break;
				}
			}
		}
	if (winner == 0)//Computer won and the count of it's wins is increased by one.
		{
		System.out.println("[I win.]");
		mywins += 1;
		}
	if (winner == 1)//User won and the count of their wins is increased by one.
		{
		System.out.println("[You win... that round.]");
		userwins += 1;
		}
	System.out.println("(To Quit: [0] Any other input continues.)");
	contchoice = Keyboard.readInt();
	}
//Final Tally of All games.
System.out.println("My wins: "+mywins);
System.out.println("Your wins: "+userwins);
System.out.println("Ties: "+ties);
}
}