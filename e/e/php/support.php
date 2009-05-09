<?php
session_start();
$private    = false;
$alive      = false;
$quickstat  = false;
$page_title = "Support";

include "interface/header.php";
?>
  
<span class="brownHeading">Support</span>

<p>
Support Options: <br /><br />
<a href="mailto:admin@ninjawars.net">Email NinjaLord</a> - Admin@ninjawars.net<br />
<a href="mailto:Beagle@ninjawars.net"Email Beagle</a> - Beagle@ninjawars.net<br />
<a href="http://www.ninjawars.net/forum/" target="_blank">Forum</a>
</p>

<?php
include "interface/footer.php";
?>

