<?php
session_start();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Game Confirmation";

include "interface/header.php";
?>
  
<span class="brownHeading">Game Confirmation</span>

<hr />

<?php
$confirm   = $_GET['confirm'];
$check     = $sql->QueryRow("SELECT * FROM players WHERE uname = '".$_GET['username']."'");
$row       = $sql->data;
$sql->Fetch(0);
$check     = $sql->data[8];
$confirmed = $sql->data[9];

echo "<div style=\"border: 1 solid #000000;font-weight: bold;\">\n";

if ($confirm == $check  && $check != "" && $confirm != "")
{
  echo "Confirmation Confirmed\n";
  $sql->Update("UPDATE players SET confirmed = 1,confirm = 0  WHERE uname = '".$_GET['username']."'");
  $affected_rows = $sql->a_rows;
  echo "<br /><br /><a href=\"http://www.ninjawars.net/webgame/\">You may now login.</a>\n";

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
