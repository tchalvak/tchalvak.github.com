<?php
include "interface/header.php";
?>
  
<span style="font-weight: bold;color: red;">Deity Nightly</span>

<?php
$sql->Update("UPDATE players SET health = 150 WHERE health < 150 AND class ='White'"); // White Heal code
$affected_rows = $sql->a_rows;

$sql->Update("UPDATE players SET days = days+1");
$affected_rows = $sql->a_rows;

$sql->Update("UPDATE players SET status = status-".POISON." WHERE status&".POISON);  // Black Poison Fix
$affected_rows = $sql->a_rows;

$sql->Update("DELETE FROM mail WHERE send_to='ChatMsg'");
$sql->Update("DELETE FROM mail WHERE send_to='SysMsg'");

$sql->Update("UPDATE players SET health = 150 WHERE health < 1");
$affected_rows = $sql->a_rows;

include "interface/footer.php";
?>

