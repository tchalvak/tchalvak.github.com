<?php
session_start();
$private    = false;
$alive      = false;
$page_title = "Staff";
$quickstat  = false;

include "interface/header.php";
?>

<span class="brownHeading">Staff</span>

<p>
Developers
<br />

<a href="mailto:Admin@ninjawars.net">NinjaLord / John Facey, II</a> - Creator of NW

<br />
<br />

<a href="mailto:Beagle@ninjawars.net">Beagle / Al Vazquez</a> - Coder/Designer

<br /><br />

<a href="mailto:Tchalvak@ninjawars.net">Tchalvak</a> - Coder/Quality Control

<hr />

Artists

<br />

<a href="javascript:alert('Coming Soon');">Evolym Fragile/Davinel</a> - Visual conception and creative help <a href="http://eve.faith.at">http://eve.faith.at</a>

<hr />

Want to join the team? <a href="mailto:Admin@ninjalord.net">Admin Ninja Lord</a>

</p>

<?php
include "interface/footer.php";
?>

