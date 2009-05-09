<?php
setcookie ("user_cookie", $_POST['username'],time()+60*60*24*365); // *** 360 days ***
$private    = false;
$alive      = false;
$quickstat  = "player";
$page_title = "Logging You In";

include "interface/header.php";

$username = $_POST['username'];

$password1 = $_POST['password1'];

$l_result= mysql_query("SELECT pname FROM players WHERE uname='$username' AND pname='$password1'");
$login = mysql_num_rows($l_result);

// *** new code ***
$check = $sql->QueryRow("SELECT * FROM players WHERE uname = '$username'");
$row = $sql->data;
$sql->Fetch(0);
$confirmed = $sql->data[9];

// *** end check for confirmed ***

if ($login != "0" && $confirmed == "1")  // check login info is correct
{
  session_start();
  $player_stats_query = "SELECT gold,health,turns,status,strength,level,kills,clan,class,ip,bounty FROM players WHERE uname = '$username'";
  $player_stats = $sql->QueryRow($player_stats_query);

  $_SESSION['username'] = $username;
  $_SESSION['gold']     = $player_stats[0];
  $_SESSION['health']   = $player_stats[1];
  $_SESSION['turns']    = $player_stats[2];
  $_SESSION['status']   = $player_stats[3];
  $_SESSION['strength'] = $player_stats[4];
  $_SESSION['level']    = $player_stats[5];
  $_SESSION['kills']    = $player_stats[6];
  $_SESSION['clan']     = $player_stats[7];
  $_SESSION['class']    = $player_stats[8];
  $_SESSION['ip']       = $player_stats[9];
  $_SESSION['bounty']   = $player_stats[10];

  echo "Logging you in: " . $_SESSION['username'] . "<br /><br />\n";
  echo "You are now logged in.<br /><br />\n";

  $sql->Update("UPDATE players SET days = 0 WHERE uname='$username'");
  $user_ip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
  $sql->Update("UPDATE players SET ip = '$user_ip' WHERE uname='$username'");

  echo "You may now access any of the games features from the menus. If you require help or questions contact <a href=\"staff.php\">Staff</a><hr /><br />\n";

  $sql->QueryRow("SELECT * FROM mail WHERE send_to = '$username' ORDER BY id DESC");
  $row = $sql->data;

  if ($sql->rows > 0)
    {
      echo "You have messages in your <a href=\"mail_read.php\" style=\"font-weight: bold;\">Inbox</a>.<br />";
    }

  echo "<br />Options <a href=\"village.php\" style=\"font-weight: bold;\">Chat</a> | \n";
  echo "<a href=\"tutorial.php\" style=\"font-weight: bold;\">Tutorial</a> | \n";
  echo "<a href=\"staff.php\" style=\"font-weight: bold;\">Help</a> | \n";
  echo "<a href=\"about.php\" style=\"font-weight: bold;\">FAQ</a>\n";
}
else
{
  echo "Password incorrect or account has not been confirmed <br /><br /> Click <a href=\"login.php\">here</a> to login.\n";
}

include "interface/footer.php";
?>
