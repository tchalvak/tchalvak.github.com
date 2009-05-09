<?php
session_start();
$private    = true;
$alive      = true;
$quickstat  = "viewinv";
$page_title = "Bank";

include "interface/header.php";
?>

<div class="brownTitle">Bank: v0.1</div>

<div class="description">
<br />
You stand at the steps to the village bank. The doors are barred shut.
<br /><br />
</div>

<hr/>
<?php
die("");
?>
<?php
if($_SESSION['turns'] > 0)
{
  if ($_SESSION['gold'] >= 5)
    {
      echo "Welcome ".$_SESSION['username']." to the Bank.<br />\n";
    }
  else
    {
      echo "You do not have enough gold.\n";
    }
}
else
{
  echo "You have no turns left today.\n";
}
?>

Bank is currently under construction.

<br /><br />

Inquries about deposits, withdrawls and other gold related transfers can be sent to
<a href="staff.php" style="font-weight: bold;">Staff</a>

<br /><br />

Would you like to make a deposit ?

<input type="hidden" name="command" value="deposit" />
<input type="textbox" name="amount" style="font-family:Verdana, Arial;font-size:xx-small;"/><input type="submit" name="" value="Deposit" class="formButton" />

<hr />

Would you like to make a withdrawl ?
<input type="hidden" name="command" value="withdrawl" />
<input type="textbox" name="amount" style="font-family:Verdana, Arial;font-size:xx-small;" /><input type="submit" name="" value="Withdrawl" class="formButton" />

<?
include "interface/footer.php";
?>



