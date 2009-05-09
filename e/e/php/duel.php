<?php
session_start();
$private    = false;
$alive      = false;
$quickstat  = false;
$page_title = "Duel Log";

include "interface/header.php";
?>

<span class="brownHeading">Past Duels: Reset Nightly</span>

<br /><br />

<?php

$sql->QueryRow("SELECT * FROM mail WHERE send_to = 'SysMsg' ORDER BY id DESC");
$row = $sql->data;

if ($sql->rows == 0)
{
  echo "Duel log has reset\n";
}

echo "<table style=\"border:1 solid #000000;\">\n";
echo "<tr>\n";
echo "  <th>\n";
echo "  Duel Log\n";
echo "  </th>\n";
echo "</tr>\n";

for ($i = 0; $i < $sql->rows; $i++)
{
  $sql->Fetch($i);
  $id = $sql->data[0];
  $from = $sql->data[1];
  $to = $sql->data[2];
  $message = $sql->data[3];

  echo "<tr>\n";
  echo "  <td valign=\"top\">\n";
  echo    $message."\n";
  echo "  </td>\n";
  echo "</tr>\n";
}
echo "</table>\n";
echo "</form>\n";


include "interface/footer.php";
?>
