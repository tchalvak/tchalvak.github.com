/*  Ro Ronalds
	CompSci 119*/ 
	
import java.io.*;
import java.util.StringTokenizer;//for parsing string input;
import Mortgage;

public class MortgageMain
{

public static void main(String args[]) throws IOException
{
Mortgage myloan;
BufferedReader stdin = new BufferedReader
	(new InputStreamReader (System.in));
StringTokenizer reader; //to set up reader as a tokenizer.
	
/*input variables*/
double principal, interest;
int noyears, begmonth, begyear;

System.out.println("Input Set: [principal] [interest] [# of years] [begmonth] [begyear]");
reader = new StringTokenizer(stdin.readLine());//get first input record

while(reader.hasMoreTokens())
	{
	if (reader.countTokens()==5)//check for five items entered on input rec.
		{
		principal=Double.parseDouble(reader.nextToken());
		interest=Double.parseDouble(reader.nextToken());
		noyears=Integer.parseInt(reader.nextToken());
		begmonth=Integer.parseInt(reader.nextToken());
		begyear=Integer.parseInt(reader.nextToken());
			//instantiate loan.
		myloan= new Mortgage(principal, interest, noyears, begmonth, begyear);
		
		myloan.echoData(/*principal,interest,noyears*/);//print title and echo input values.

		if(myloan.dataValid(/*testprincipal, interest,noyears,begmonth, begyear*/))//if ok prints nothing, otherwise error message.
			{
			myloan.printSchedule(/*testprincipal, interest,noyears,begmonth, begyear*/);//print amortization schedule
			}//end checking if loan is valid.
		else
			{System.out.println("Input Error.");}
		}//end check for correct number of values on line.
		reader=new StringTokenizer(stdin.readLine());//get next loan record
	}//end while loop.
}//end main method
}//end class MortgageMain