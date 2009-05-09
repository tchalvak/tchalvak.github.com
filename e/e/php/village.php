<?php
session_start();
$private    = true;
$alive      = false;
$page_title = "In-Game Chat";
$quickstat  = false;

include "interface/header.php";
?>

<hr />

<span class="brownHeading">Ninja Wars: Quick Chat</span> -

<?php
echo "<a href=\"village.php?go=post\">Post a Msg</a> | ";
echo "<a href=\"village.php\">Refresh</a>\n";
echo "<br />\n";

$go      = $_GET['go'];
$command = $_POST['command'];
$message = $_POST['message'];
?>

<script type="text/javascript">
function refreshpage()
{
  parent.main.location="village.php";
}
setInterval("refreshpage()",600*1000);
</script>

<?
$sql->QueryRow("SELECT * FROM mail WHERE send_to = 'ChatMsg' ORDER BY id DESC");
$row = $sql->data;

if ($sql->rows == 0) {echo "Chat will reset every night.\n";}

if ($go == "post")
{
  echo "<form action=\"village.php\" method=\"post\">\n";
  echo "Send Msg: <input type=\"text\" name=\"message\" size=\"50\" style=\"font-family:Verdana, Arial;font-size:xx-small;\" /><br />\n";
  echo "<input type=\"hidden\" value=\"postnow\" name=\"command\" />\n";
  echo "<input type=\"submit\" value=\"Send This Message\" class=\"formButton\" />\n";
  echo "</form>\n";
}

if ($command == "postnow")
{
  sendMessage($_SESSION['username'],ChatMsg,$message);

  echo "You post has been added.<br /> <a href=\"village.php\">Return to Quick Chat ?</a>";
}
else if ($command != "post")
{
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $from = $sql->data[1];
      $message = $sql->data[3];
      echo "[<a href=\"player.php?player=$from\" target=\"main\">$from</a>]: $message<br />\n";
    }
}

include "interface/footer.php";
?>
