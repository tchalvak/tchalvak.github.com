<?php
session_start();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Lost Confirmation";

include "interface/header.php";
?>
  
<span class="brownHeading">Lost Confirm</span>

<p>

<form action="lostconfirm_mod.php" method="post">
Please submit your email address and we will resend a confirmation
<input type="text" name="email" style="font-family:Verdana, Arial;font-size:xx-small;" />
<br />
<input type="submit" name="" value="Resend Confirm Code" class="formButton" />
</form>

<hr />

<?php
include "interface/footer.php";
?>

