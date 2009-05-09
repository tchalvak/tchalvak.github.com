<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Accept a New Clan Member";

include "interface/header.php";
?>
  
<span class="brownHeading">Accept A New Clan Member</span>

<hr  />

<?php
$confirm     = $_GET['confirm'];
$clan_name   = $_GET['clan_name'];
$clan_joiner = $_GET['clan_joiner'];

echo "Clan Joiner: $clan_joiner<br />\n";
echo "Clan Name: $clan_name<br />\n";
echo "Clan Confirm: $confirm<hr />\n";

$check = $sql->QueryItem("SELECT confirm FROM players WHERE uname = '$clan_name'");

$current_clan = $sql->QueryItem("SELECT clan FROM players WHERE uname = '$clan_joiner'");

echo "<div style=\"border:1 solid #000000;font-weight: bold;\">\n";

if ($current_clan != "")
{
  echo "This member is already part of a clan and cannot join yours.\n";
  echo "<br /><br />\n";
  echo "<a href=\"/webgame/\">Return to Main</a>\n";
}
else if ($confirm == $check )
{
  echo "Request Accepted.<br />\n";
  $clan_l_name = getClanLongName($clan_name);
  if (!$clan_l_name)
    {
      $clan_l_name = $clan_name."'s Clan";
    }
  $sql->Update("UPDATE players SET clan = '$clan_name',clan_long_name = '$clan_l_name',confirm = 0 WHERE uname = '$clan_joiner'");

  echo "<br />$clan_joiner is now a member of your clan.<hr />\n";
  sendMessage($clan_name,$clan_joiner,"You have been accepted into $clan_l_name");

  echo "<br /><br />\n";
  echo "<a href=\"/webgame/\">Return to Main</a>\n";

}
else
{
  echo "This account can not be verified.\n";
}
?>
<br /><br />
<a href="http://www.ninjawars.net">Return to Main ?</a>

</div>

<?php
include "interface/footer.php";
?>