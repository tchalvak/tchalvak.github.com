<?php
session_start();
$private    = true;
$alive      = true;
$quickstat  = "player";
$page_title = "Casino";

include "interface/header.php";
?>

<div class="brownTitle">Casino: v1.0b</div>

<div class="description">
You walk down the alley towards a shadowed door. As you enter the small casino, a guard eyes you with caution.
<br /><br />
You walk towards the only table with an attendant. He shows you a shiny coin with a dragon on one side and a house on the other.
<br /><br />
"Place your bet, call the coin in the air, and let's see who's lucky today!"
</div>

<hr />

<?php
$bet = $_POST['bet'];

if($_SESSION['turns'] > 0)
{
  if($_SESSION['gold'] >= 5)
    {
      // *** got in ***
      echo "Welcome ".$_SESSION['username']." to the Casino<br />\n";

      echo "<form action=\"casino.php\" method=\"post\">\n";

      if ($bet!="")
	{
	  echo "You have lost 1 turn for betting.\n";
	  
	  subtractTurns($_SESSION['username'],1);
	  $answer = rand (1, 2);
	  
	  if ($answer == 1)
	    {
	      echo $_SESSION['username']." wins!<br />\n";
	      addGold($_SESSION['username'],$bet);
	    }
	  else if ($answer == 2)
	    {
	      echo $_SESSION['username']." loses!<br />\n";
	      subtractGold($_SESSION['username'],$bet);
	    }  

	  echo "<br /><a href=\"casino.php\">Try Again?</a><br />\n";
	}
      else
	{
	  echo "Bet: <select name=\"bet\" size=\"1\">\n";
	  echo "<option selected=\"selected\">5</option>\n";
	  echo "<option>10</option>\n";
	  echo "<option>20</option>\n";
	  echo "<option>30</option>\n";
	  echo "<option>40</option>\n";
	  echo "<option>50</option>\n";
	  echo "</select>\n";
	  echo "&nbsp;&nbsp;<input type=\"submit\" value=\"Place bet\" class=\"formButton\" /><br />\n";
	}
      
      echo "Current Gold: ".$_SESSION['gold']."<br />\n";
      echo "Current Turns: ".$_SESSION['turns']."<br />\n";
    }
  else
    {
      echo "You do not have enough gold.\n";
    }
}
else
{
  echo "You have no turns left today.\n";
}

include "interface/footer.php";
?>
