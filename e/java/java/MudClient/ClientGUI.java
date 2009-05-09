import java.util.*; 
import java.awt.*; 
import javax.swing.*; 

public class ClientGUI extends JFrame 
{ 

    private JTextArea      vMap, score; //vMap will be a textArea until we implement it for simplicity's     sake 
    private JList          mainText;
    private JScrollPane    mainTextPane; 
    private JTextField     commandLine; 
    private JLabel	   vMapLabel, scoreLabel;

    public ClientGUI (String name)
    { 

	super(name); 

	//Set up frame
	GridBagLayout layout = new GridBagLayout(); 
	GridBagConstraints layoutConstraints = new GridBagConstraints(); 
	getContentPane().setLayout(layout); 

	vMapLabel = new JLabel("vMap"); 
        layoutConstraints.gridx = 0; 
	layoutConstraints.gridy = 0; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 1; 
	//layoutConstraints.fill = GridBagConstraints.BOTH; 
	//layoutConstraints.anchor = GridBagConstraints.CENTER; 
	layoutConstraints.weightx = 0.0; 
	layoutConstraints.weighty = 0.0; 
	layout.setConstraints(vMapLabel, layoutConstraints); 
	getContentPane().add(vMapLabel); 

	vMap = new JTextArea(); 
        vMap.setEditable(false);
	vMap.setPreferredSize(new Dimension(120,120));
	layoutConstraints.gridx = 0; 
	layoutConstraints.gridy = 1; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 1; 
	//layoutConstraints.fill = GridBagConstraints.BOTH; 
	layoutConstraints.anchor = GridBagConstraints.CENTER; 
	layoutConstraints.weightx = 0.0; 
	layoutConstraints.weighty = 0.0; 
	layout.setConstraints(vMap, layoutConstraints); 
	getContentPane().add(vMap); 
	

	scoreLabel = new JLabel("Score"); 
        layoutConstraints.gridx = 0; 
	layoutConstraints.gridy = 2; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 1; 
	//layoutConstraints.fill = GridBagConstraints.BOTH; 
	//layoutConstraints.anchor = GridBagConstraints.CENTER; 
	layoutConstraints.weightx = 0.0; 
	layoutConstraints.weighty = 0.0; 
	layout.setConstraints(scoreLabel, layoutConstraints); 
	getContentPane().add(scoreLabel);  
	
	score = new JTextArea(); 
        score.setEditable(false);
        score.setPreferredSize(new Dimension(120,0));
	layoutConstraints.gridx = 0; 
	layoutConstraints.gridy = 3; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 2; 
	layoutConstraints.fill = GridBagConstraints.VERTICAL; 
	layoutConstraints.anchor = GridBagConstraints.CENTER; 
        layoutConstraints.insets  = new Insets(0, 0, 10, 0);
	layoutConstraints.weightx = 0.0; 
	layoutConstraints.weighty = 0.0; 
	layout.setConstraints(score, layoutConstraints); 
	getContentPane().add(score);  
	
	mainText = new JList();
        //mainText.setEditable(false); 

	JScrollPane mainTextPane = new JScrollPane(mainText, 
	ScrollPaneConstants.VERTICAL_SCROLLBAR_ALWAYS, 
	ScrollPaneConstants.HORIZONTAL_SCROLLBAR_AS_NEEDED); 
	layoutConstraints.gridx = 1; 
	layoutConstraints.gridy = 0; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 4; 
	layoutConstraints.fill = GridBagConstraints.BOTH; 
	//layoutConstraints.anchor = GridBagConstraints.CENTER; 
	layoutConstraints.insets  = new Insets(10, 10, 10, 10);
	layoutConstraints.weightx = 100; 
	layoutConstraints.weighty = 100; 
	layout.setConstraints(mainTextPane, layoutConstraints); 
	getContentPane().add(mainTextPane);

	commandLine = new JTextField(); 
	layoutConstraints.gridx = 1; 
	layoutConstraints.gridy = 4; 
	layoutConstraints.gridwidth = 1; 
	layoutConstraints.gridheight = 1; 
	layoutConstraints.fill = GridBagConstraints.HORIZONTAL; 
	//layoutConstraints.anchor = GridBagConstraints.CENTER; 
	layoutConstraints.weightx = 0.0; 
	layoutConstraints.weighty = 0.0; 
	layout.setConstraints(commandLine, layoutConstraints); 
	getContentPane().add(commandLine);  

    } 

    public static void main(String[] args) 
    { 
	JFrame frame = new ClientGUI("Client Version Sub.Beta"); 
	frame.setDefaultCloseOperation(EXIT_ON_CLOSE); 
	frame.setSize(640,480); 
	frame.setVisible(true);
    }
} 