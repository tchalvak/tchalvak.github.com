<?php
session_start();
$private    = true;
$alive      = false;
$quickstat  = false;
$page_title = "Send A Message";

include "interface/header.php";
?>

<span class="brownHeading">Mail: Compose Message</span>

<p>
<?php
if ($_SESSION['clan'] != "")
{
  echo "<div style=\"border: thin solid white;padding-top: 3;padding-left: 5;padding-bottom: 3;width: 250px;\">\n";
  echo "Clan Mail\n";
  echo "<form action=\"mail_send.php\" method=\"get\">\n";
  echo "<textarea name=\"message\" cols=\"25\" rows=\"5\" style=\"font-family:Verdana,Arial;font-size:xx-small;\" /></textarea>\n";
  echo "<input type=\"hidden\" value=\"clansend\" name=\"to\" />\n";
  echo "<input type=\"hidden\" value=\"1\" name=\"messenger\" />\n";
  echo "<input type=\"submit\" value=\"Send\" class=\"formButton\" />\n";
  echo "</form>\n";
  echo "</div><br /><br />\n";
}
?>

Search for Ninja's to Message
<form action="list_all_players.php" method="get">
<input type="textbox" name="searched" style="font-family:Verdana, Arial;font-size:xx-small;" />
<input type="submit" value="Search for Ninja" class="formButton" />
</form>

</p>

<?php
include "interface/footer.php";
?>

