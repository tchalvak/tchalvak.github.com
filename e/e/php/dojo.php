<?php
session_start();
$quickstat  = "player";
$private    = true;
$alive      = true;
$page_title = "Dojo";

include "interface/header.php";
?>
  
<div class="brownTitle">Dojo</div>

<div class="description">
You walk up the steps to the grandest building in the village. The dojo is home to many respected ninja.
<br /><br />
As you approach, you can hear the sounds of fighting coming from the wooden doors in front of you.
</div>

<?php
echo "<a href=\"chart.php\">Upgrade Chart</a><hr />\n";

$MAX_LEVEL = 32;


$nextlevel = $_SESSION['level'] + 1;

if ($upgrade == 1)  // *** If they requested an upgrade ***
{
  if ($nextlevel>$MAX_LEVEL)
    {
      $msg =  "There are no trainers that can teach you beyond your current skill. You are revered among the ninja.<br />\n";
    }
  else if ($_SESSION['kills']>=$_SESSION['level']*5)
    {
      subtractKills($_SESSION['username'],($_SESSION['level']*5));
      addLevel($_SESSION['username'],1);
      addStrength($_SESSION['username'],5);
    }
  else
    {
      echo "You do not have enough kills to proceed at this time.<br />\n";
    }
}
else if ($nextlevel>$MAX_LEVEL)  // *** If they just entered the dojo ***
{
  $msg = "You enter the dojo as one of the elite ninja. No trainer has anything left to teach you.<br />\n";
}
else if ($_SESSION['kills']<$_SESSION['level']*5)
{
  $msg = "Your trainer finds you lacking. You are instructed to prove your might against more ninja before you return.<br />\n";
}
else
{
  echo "<form action=\"dojo.php\" method=\"post\">\n";
  echo "<br />Do you wish to upgrade to level " . $nextlevel."?<br />\n";
  echo "<input type=\"hidden\" value=\"1\" name=\"upgrade\" class=\"formButton\" />\n";
  echo "<input type=\"submit\" value=\"Upgrade\" class=\"formButton\" /><br />\n";
  echo "</form>\n";
}

echo "Your current level is ".$_SESSION['level'].".<br /><br/>\n";
echo "Your current kills are ".$_SESSION['kills'].".<br /><br />\n";
echo "Level ".($_SESSION['level']+1)." requires ".($_SESSION['level']*5)." kills.<br /><br />\n";
echo $msg;

include "interface/footer.php";
?>

