import java.net.*;
import java.io.*;
import java.util.*;

public class ClientThread extends Thread
{
    private Socket socket = null;
    private PrintWriter toServerStream = null;
    private BufferedReader fromServerStream = null;
    private StringBuffer exitSequence = new StringBuffer("???????????????????????????????????????????????????????");
    private PrintStream displayStream = System.out;

 
    public ClientThread(Socket aSocket) throws IOException{
	System.out.println("New client thread started");
	socket = aSocket;
	toServerStream = new PrintWriter(socket.getOutputStream(),true);
	fromServerStream = new BufferedReader(new InputStreamReader(socket.getInputStream()));
    }


    public PrintStream setDisplayStream (PrintStream aPrintStream)
    {
	return(displayStream = aPrintStream);
    }


    public void sendText(String text)
    {
	//System.out.println(text);
	toServerStream.println(text);
    }

    public boolean stillConnected()
    {
	return (socket!=null);
    }
    
    public void parseInput()
    {
	try
	{
	    char   input = '\u0000';
	    while (input != 'm')
	    {
		input = (char)fromServerStream.read();
	    }
	}
	catch(Exception e)
	{
	    System.out.println(e);
	}
    }
     
   
    public void run()
    {
 	try
        {
            StringBuffer serverStringBuffer = new StringBuffer(); //for trigger implementation.
	    char        serverChar;
	    while(stillConnected())
 	    {
		serverChar = '\u0000';
                serverStringBuffer.setLength(0);
  	        while ((int)serverChar != 13)
  		{
			serverChar = (char)fromServerStream.read();

			// When an escape code is received: parse the input.  At the moment that parsing consits of deleting the colour codes
                        if ((int)serverChar == 27) 
		        {
                            parseInput();
		        } 
		        else
		        {
			    //MUST be changed to output to a place of choice, not necessarily console.
		            displayStream.print(serverChar);
		        }
			
  			serverStringBuffer.append(serverChar);

/*Socket closing.  Right now searches out question marks, but doesn't seem to work, for some ungodly reason.

  	  		if ((serverStringBuffer.length() >= exitSequence.length()) && (serverStringBuffer.substring(serverStringBuffer.length() - exitSequence.length())).equals(exitSequence.toString()))
	                {
			    toServerStream.close();
	  	   	    fromServerStream.close();
			    socket.close();
			    System.exit(-1);
		        }
*/  		}
	    }
	}
        catch(Exception e)
	{
	    System.out.println(e);
	}
    }
}