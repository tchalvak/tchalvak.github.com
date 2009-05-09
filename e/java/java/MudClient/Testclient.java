import java.io.*;
import java.net.*;

public class Client 
    {
	private static int PORT = 5000;
	private static ClientThread clientThread;
	private static BufferedReader keyboardInputStream = new BufferedReader(new InputStreamReader(System.in));

	public ClientThread getClientThread()
	{
		return(clientThread);
	}

	public static void main(String[] args) throws IOException
	{
		try {clientThread = new ClientThread(new Socket("ragnar.slf.cx", PORT));}
		catch(UnknownHostException e) {System.err.println("Don't know about host");}
		catch(IOException e) {System.err.println("Couldn't get I/O for connection to host");}
 		
		clientThread.start();

		while(clientThread.stillConnected())
		{
			String fromUser = keyboardInputStream.readLine();
			if (fromUser != null)
			{
		    	    clientThread.sendText(fromUser);
			}
		}
	} 
}