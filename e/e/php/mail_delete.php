<?php
session_start();
$page_title = "Deleting Mail";
$quickstat  = false;
$private    = true;
$alive      = false;

include "interface/header.php";
?>
  
<span style="font-weight: bold;color: #ccb094;">Deleting Mail</span>

<br /><br />

<?php
if ($_GET['id']  != "")  {$id = $_GET['id'];}
if ($_POST['id'] != "")  {$id = $_POST['id'];}

if ($id != "")
{
  echo "Message Deleted\n";
  
  $sql->Delete("DELETE FROM mail WHERE id = '$id' AND send_to='".$_SESSION['username']."'");
  $affected_rows = $sql->a_rows;
  
  echo "<br />Returning to Inbox...\n";
  echo "<meta HTTP-EQUIV=Refresh CONTENT=\"2; URL=mail_read.php\">";
}

if ($DeleteAll == "DeleteAll")
{
  $sql->Delete("DELETE FROM mail WHERE send_to='".$_SESSION['username']."'");
  $affected_rows = $sql->a_rows;
  
  echo "All your messages have been deleted.\n";
  echo "<a href=\"mail_read.php\" style=\"font-weight: bold;\">Return to Mail</a>\n";
  echo "<br />Returning to Inbox...\n";
  echo "<meta HTTP-EQUIV=Refresh CONTENT=\"2; URL=mail_read.php\">";
}
?>

<?php
include "interface/footer.php";
?>

