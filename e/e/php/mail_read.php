<?php
session_start();
$private    = true;
$alive      = false;
$quickstat  = false;
$page_title = "Mail";

include "interface/header.php";
?>

<span class="brownHeading">Mail</span>

<br /><br />

<a href="mail.php">Send Mail</a>

<br /><br />

<?php
$sql->QueryRow("SELECT * FROM mail WHERE send_to = '".$_SESSION['username']."' ORDER BY id DESC");
$row = $sql->data;

echo "<span style=\"font-weight: bold\">Inbox</span>\n";
echo "<form action=\"mail_delete.php\" method=\"post\">\n";
echo "Total Messages: ".$sql->rows."<br />\n";
echo "<input type=\"submit\" value=\"DeleteAll\" name=\"DeleteAll\" class=\"formButton\" />\n";
echo "<hr />\n";
echo "</form>\n";

echo "<form action=\"mail_delete.php\" method=\"post\"\n>";

if ($sql->rows == 0)
{
  echo "You have no messages.\n";
}
else
{
  echo "(Click on a Ninja's name to Send a Reply Msg.)<br />\n";
  echo "<table style=\"border:1 solid #000000;\">\n";
  echo "<tr>\n";
  echo "  <th>\n";
  echo "  Delete\n";
  echo "  </th>\n";
  
  echo "  <th>\n";
  echo "  From\n";
  echo "  </th>\n";
  
  echo "  <th>\n";
  echo "  Message\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $id      = $sql->data[0];
      $from    = $sql->data[1];
      $to      = $sql->data[2];
      $message = $sql->data[3];
      
      echo "<tr>\n";
      echo "  <td valign=\"top\" style=\"text-align: center;\">\n";
      echo "  <a href=\"mail_delete.php?id=$id\">X</a>\n";
      echo "  </td>\n";
      
      echo "  <td valign=\"top\">\n";
      echo "  <a href=\"player.php?player=$from\">$from</a>\n";
      echo "  </td>\n";
	  
      echo "  <td>\n";
      echo    $message."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  
  echo "</table>\n";
  echo "</form>\n";
}

include "interface/footer.php";
?>

