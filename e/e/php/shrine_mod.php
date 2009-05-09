<?php
session_start();
$page_title = "Shrine";
$alive      = false;
$private    = true;
$quickstat  = "player";

include "interface/header.php";
?>
  
<span class="brownHeading">Shrine Effects</span>

<hr />

<?php
$healed   = $_POST['healed'];
$poisoned = $_POST['poisoned'];
$restore  = $_POST['restore'];

echo "<br />\n";

if ($healed == 1)
{
  $max_health = (150+(($_SESSION['level']-1)*25));

  if ($_SESSION['health'] > 0)
    {
      if ($heal_points <= $_SESSION['gold']) 
	{
	  if (($_SESSION['health']+$heal_points) <= $max_health)
	    {
	      echo "A monk tends to your wounds.<br /><br />\n";

		subtractGold($_SESSION['username'],$heal_points);
	      addHealth($_SESSION['username'],$heal_points);
	    }
	  else
	    {
	      echo "You can not heal over $max_health HP at your current level.<br />\n";
	    }
	}
      else
	{
	  echo "You do not have enough gold for this amount of healing.<br />\n";
	}
    }
  else
    {
      echo "You must resurrect before you can heal.<br />\n";
    }
} // *** end healed ***
else if ($restore == 1)
{
  $health = $_SESSION['health'];
  $kills  = $_SESSION['kills'];

  if ($_SESSION['health'] < 1)
    {
      echo "What once was dead shall rise again.<br />\n";
      echo "Current Kills: ".$_SESSION['kills']."<br />\n";

      if ($_SESSION['kills'] > 0)
	{
	  subtractKills($_SESSION['username'],1);
	}

      echo "Adjusted Kills after death: ".$_SESSION['kills']."<br />\n";

      setHealth($_SESSION['username'],100);
      subtractStatus($_SESSION['username'],STEALH+POISON+FROZEN+CLASS_STATE);
    }
  else
    {
      echo "You are not dead.<br /><br />\n";
    }
} // *** end restore ***
else if ($poisoned == 1)
{
  $cost = 50;
  if ($_SESSION['gold'] >= $cost)
    {
      if (getStatus($_SESSION['username']) && $status_array['Poison'])
	{
	  subtractGold($_SESSION['username'],$cost);
	  subtractStatus($_SESSION['username'],POISON);
	  echo "You have been cured!<br />\n";
	}
      else
	{
	  echo "You are not ill.<br /><br />\n";
	}
    }
  else
    {
      echo "You need more gold to remove poison.<br />\n";
    }
}

?>

<a href="shrine.php">Heal Again ?</a>

<?php
include "interface/footer.php";
?>