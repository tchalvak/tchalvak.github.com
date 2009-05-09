<?php
session_start();
$page_title = "Confirmation Resend";
$alive      = false;
$private    = false;
$quickstat  = false;

include "interface/header.php";
?>

<span class="brownHeading">Retriving Confirm Code</span>

<p>
<?php
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* additional headers */
$headers .= "From: SysMsg <SysMsg@NinjaWars.net>\r\n";

$lost_email   = $_POST['email'];

$data = $sql->QueryRow("SELECT confirm,uname FROM players WHERE email = '$lost_email'");

$lost_email = $data[0];
$lost_uname = $data[1];

echo "Retriving Confirm Code: It will be sent to your email.<br />\n";

if ($lost_uname != "")
{
  echo "$lost_uname confirm code sending...\n";
  mail("$lost_email", "NinjaWars Confirm Code", "You have requested your confirm code for the account: $lost_uname.<br />\n<br />\nUse this link to activate your account<br />\n<br />\n<b>Account Info</b><br />\nUsername: $lost_uname<br />\n<br />\n<a href=\"http://www.ninjawars.net/webgame/confirm.php?username=$lost_uname&confirm=$lost_confirm\">Activate Account</a><br />\n<br />\nOr, paste this URL into your browser.<br />\n<br />\nhttp://www.ninjawars.net/webgame/confirm.php?username=$lost_uname&confirm=$lost_confirm<br />\n<br />\nIf you require any further help, email: Admin@NinjaWars.net","$headers");
}
else
{
  echo "There are no accounts with that email. Please <a href=\"signup.php\">sign up</a> for an account.<br />\n";
}
?>
<hr />
<a href="main.php">Return to Game</a>
</p>

<?php
include "interface/footer.php";
?>

