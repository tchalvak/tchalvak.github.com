<?php
session_start();
$page_title = "Lost Password";
$quickstat  = false;
$private    = false;
$alive      = false;

include "interface/header.php";
?>
 
<span class="brownHeading">Lost Password</span>

<p>

<form action="lostpass_mod.php" method="post">
Please submit your email and your password will be sent to you:<br />
<input type="text" name="email" style="font-family:Verdana, Arial;font-size:xx-small;" /><br />
<input type="submit" name="" value="Get Password" class="formButton" />
</form>

<hr />

</p>

<?php
include "interface/footer.php";
?>

