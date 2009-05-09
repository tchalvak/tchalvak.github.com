<?php
session_start();
$page_title = "Your Stats";
$private    = true;
$alive      = false;
$quickstat  = "viewinv";

include "interface/header.php";

echo "<span class=\"brownHeading\">Your Stats</span>\n";

echo "<p>\n";

if  ($_POST['changepass'] == 1)
{
  $newpass = $_POST['newpass'];
  if ($newpass != "")
  {
    $sql->Update("UPDATE players SET pname = '$newpass' WHERE uname = '".$_SESSION['username']."'");
    echo "Password has been changed.\n";
  }
  else
  {
    echo "Can not enter a blank password.\n";
  }
}
else if  ($_POST['deleteaccount'] == 1)
{
  $verify = $sql->QueryItem("SELECT pname FROM players WHERE uname = '".$_SESSION['username']."'");
  if ($verify == $passw)
    {
      if ($_SESSION['clan'] == $_SESSION['username'])
	{
	  disbandClan($_SESSION['clan']);
	}
      $sql->Delete("DELETE FROM players WHERE uname = '".$_SESSION['username']."'");
      $sql->Delete("DELETE FROM inventory WHERE owner = '".$_SESSION['username']."'");
      $sql->Delete("DELETE FROM mail WHERE to = '".$_SESSION['username']."'");
      $_SESSION['username'] = "";
      session_destroy();
      
      echo "Your account has been removed from Ninja Wars. If you wish to sign back up you may do so. <br />If not, we hope you will send us an email telling us why you choose to leave the game,<br />Thank you.<br /><br />Admin@NinjaWars.net\n";
    }
  else
    {
      echo "Please provide your password to confirm.<br />\n";
      echo "<form method=\"POST\" action=\"stats.php\">\n";
      echo "<input type=\"password\" name=\"passw\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" />\n";
      echo "<input type=\"hidden\" name=\"deleteaccount\" value=\"1\" />\n";
      echo "<input type=\"submit\" value=\"Confirm Delete\" class=\"formButton\" />\n";
      echo "</form>\n";
    }
}
else if ($_POST['changeprofile'] == 1)
{
  $newprofile = $_POST['newprofile'];
  if ($newprofile != "")
    {
      $sql->Update("UPDATE players SET messages = '$newprofile' WHERE uname = '".$_SESSION['username']."'");
      $affected_rows = $sql->a_rows;
      
      echo "Profile has been changed.\n";
    }
  else
    {
      echo "Can not enter a blank profile.\n";
    }
}

$msg      = $sql->QueryItem("SELECT messages FROM players WHERE uname = '".$_SESSION['username']."'");
$email    = $sql->QueryItem("SELECT email FROM players WHERE uname = '".$_SESSION['username']."'");
$member   = $sql->QueryItem("SELECT member FROM players WHERE uname = '".$_SESSION['username']."'");

echo "<form action=\"stats.php\" method=\"post\">\n";
echo "<input type=\"hidden\" name=\"changepass\" value=\"1\" /><br />\n";
echo "Account Info: ".$_SESSION['username']."<br />\n";
echo "Password: <input type=\"text\" name=\"newpass\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" /><input type=\"submit\" value=\"<== Change Password\" class=\"formButton\" />\n";
echo "</form><br />\n";

echo "<form action=\"stats.php\" method=\"post\">\n";
echo "<input type=\"hidden\" name=\"changeprofile\" value=\"1\" />\n";

echo "Health: ".$_SESSION['health']."<br />\n";
echo "Strength: ".$_SESSION['strength']."<br />\n";
echo "Gold: ".$_SESSION['gold']."<br />\n";
echo "Kills: ".$_SESSION['kills']."<br />\n";
echo "Turns: ".$_SESSION['turns']."<br />\n";
echo "Email: $email<br />\n";
echo "Class: ".$_SESSION['class']."<br />\n";
echo "Level: ".$_SESSION['level']."<br />\n";
echo "Bounty: ".getBounty($_SESSION['username'])." gold<br />\n";
echo "Clan: ".$_SESSION['clan']."<br />\n";

$status   = getStatus($_SESSION['username']);
echo "Status: ";
  
$status_output;
if ($status['Stealth']) {$status_output[count($status_output)]="Stealthed";}
if ($status['Poison'])  {$status_output[count($status_output)]="Poisoned";}
if ($status['Frozen'])  {$status_output[count($status_output)]="Frozen";}
if (!$status_output[0])
{
  if ($_SESSION['health'] == 0) {echo "Dead<br />\n";}
  else if ($_SESSION['health'] < 75) {echo "Injured<br />\n";}
  else {echo "Healthy<br />\n";}
}
else
{
  $i=0;
  for ($i=0;$i<count($status_output)-1;$i++)
    {
      echo $status_output[$i].", ";
    }
  echo  $status_output[$i]."<br />\n";
}

echo "Membership: ";
if ($member == 0) {echo "Free Member<br />\n";}
else if ($member == 1) {echo "Paid Member<br />\n";}

echo "Profile: <br /><textarea name=\"newprofile\" cols=\"45\" rows=\"10\" style=\"font-family:Verdana, Arial;font-size:xx-small;\">$msg</textarea><br />\n";
echo "<input type=\"submit\" value=\"Change Profile\" class=\"formButton\" />\n";
echo "</form>\n";

echo "<hr />If you require account help email: <a href=\"mailto:Admin@ninjawars.net\">Admin NinjaLord</a><hr />\n";
echo "WARNING: Clicking on the button below will terminate your account.<br />\n";
echo "<form action=\"stats.php\" method=\"POST\">\n";
echo "<input type=\"hidden\" name=\"deleteaccount\" value=\"1\" />\n";
echo "<input type=\"submit\" value=\"Permanetly Remove Your Account\" class=\"formButton\" />\n";
echo "</form>\n";

echo "</p>";

include "interface/footer.php";
?>
