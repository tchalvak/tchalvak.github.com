<?php
session_start();
$private    = true;
$alive      = true;
$quickstat  = "player";
$page_title = "Working in the Village";

include "interface/header.php";
?>

<div class="brownTitle">Working in the Village</div>

<?php

$description2 = "<div class=\"description\">\n".
                "On your way back from the fields, you pass by a few young children ".
	          "chasing grasshoppers in the tall grass.\n".
                "<br /><br />\n".
                "The foreman hands you a small pouch of gold as he says ".
                "\"Care to put a little more work in? I'll keep paying you.\"\n".
                "</div>\n";

$description1 = "<div class=\"description\">\n".
                "On your way to the foreman's office, you pass by several workers ".
                "drenched in sweat from working in the heat all day.\n".
                "<br /><br />\n".
                "The foreman barely looks up at you as he busies himself with paper ".
                "work and a cigarette. \"So, how much work can we expect from you?\"\n".
                "</div>\n";

$description = $description1;

$worked = $_GET['worked'];
if ($worked > 0 && $worked != "")
{
  $turns = $_SESSION['turns'];
  $gold  = $_SESSION['gold'];
 
  if ($worked > $turns)
    {
      $description .= "You have chosen to do more work than turns you have.<br />\n";
    }
  else
    {
      $new_gold  = $worked * 10;   // *** calc amount worked ***

      $gold  = addGold($_SESSION['username'],$new_gold);
      $turns = subtractTurns($_SESSION['username'],$worked);

     
      $description = $description2.
	"Current: ".$turns."<br />\n".
	"Working For: ".$worked."<br />\n".
	"Current Gold: ".$gold."<br />\n".
	"You have worked for $worked turns.<br />\n".
	"You now have $new_gold.<hr />\n";
    }
}

echo $description;
echo "You can earn money by working in the Village<br /><br />\n";
echo "Village work will exchange turns for gold.<br /><br />\n";
echo "The current work exchange rate: 1 Turn = 10 Gold.<br />\n";
echo "Work in the Village?<br />\n";
echo "<a href=\"work.php?worked=1\">Work 1 Turn</a><br />\n";
echo "<a href=\"work.php?worked=5\">Work 5 Turns</a><br />\n";
echo "<a href=\"work.php?worked=10\">Work 10 Turns</a><br />\n";
echo "<a href=\"work.php?worked=20\">Work 20 Turns</a><br />\n";
echo "<a href=\"work.php?worked=50\">Work 50 Turns</a><br />\n";

include "interface/footer.php";
?>
