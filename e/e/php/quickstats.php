<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Quickstats";

include "interface/header.php";

$command  = $_GET['command'];
$health   = $_SESSION['health'];
$strength = $_SESSION['strength'];
$gold     = $_SESSION['gold'];
$kills    = $_SESSION['kills'];
$turns    = $_SESSION['turns'];
$level    = $_SESSION['level'];
$class    = $_SESSION['class'];
$status   = getStatus($_SESSION['username']);

$msg      = $sql->QueryItem("SELECT messages FROM players WHERE uname = '".$_SESSION['username']."'");

$member   = $sql->QueryItem("SELECT member FROM players WHERE uname = '".$_SESSION['username']."'");

$bounty = getBounty($_SESSION['username']);
//$clan   = $_SESSION['clan'];

if ($command != "viewinv")
{
  echo "<table style=\"border: 0;\">\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Health: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $health."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Status: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  
  $status_output;
  if ($status['Stealth']) {$status_output[count($status_output)]="Stealthed";}
  if ($status['Poison'])  {$status_output[count($status_output)]="Poisoned";}
  if ($status['Frozen'])  {$status_output[count($status_output)]="Frozen";}
  if (!$status_output[0])
    {
      if ($health == 0) {echo "Dead\n";}
      else if ($health < 75) {echo "Injured\n";}
      else {echo "Healthy\n";}
    }
  else
    {
      $i=0;
      for ($i=0;$i<count($status_output)-1;$i++)
	{
	  echo $status_output[$i].", ";
	}
      echo  $status_output[$i]."\n";;
    }

  
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Str: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $strength."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Level: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $level."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Class: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $class."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Turns: \n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $turns."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Gold: \n";
  echo "  </td>\n";

  echo "  <td>\n";
  echo    $gold."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Bounty: \n";
  echo "  </td>\n";

  echo "  <td>\n";
  echo    $bounty."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "</table>\n";
}
else if ($command == "viewinv")
{
  echo "<table style=\"border: 0;\">\n";
  $count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='Shuriken'");
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Shuriken: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $count."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  $count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='Stealth Scroll'");
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Stealth Scroll: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $count."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  $count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='Fire Scroll'");
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Fire Scroll: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $count."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  $count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='Ice Scroll'");
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Ice Scroll: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $count."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  $count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='Speed Scroll'");
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Speed Scroll: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $count."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";

  echo "<tr>\n";
  echo "  <td>\n";
  echo "Gold: \n";
  echo "  </td>\n";
  echo "  <td>\n";
  echo    $_SESSION['gold']."<br />\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "</table>\n";
}

echo "<hr />\n";

$limit_time = time() - 300; // 5 Minute time out. 60 * 5 = 300

$sql1 = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='n' GROUP BY ip_address") or die (mysql_error());

$sql_member = mysql_query("SELECT * FROM ppl_online WHERE UNIX_TIMESTAMP(activity) >= $limit_time AND member='y' GROUP BY ip_address") or die (mysql_error());

$visits = mysql_num_rows($sql1);

$members = mysql_num_rows($sql_member);

echo "Guests Online: $visits<br />\n";
echo "Members Online: $members<br /><hr />\n";

include "interface/footer.php";
?>