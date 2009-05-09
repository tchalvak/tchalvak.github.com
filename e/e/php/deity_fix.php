<?php
include "interface/header.php";
?>

<span style="font-weight: bold;color: red;">Deity Patch</span

<?php
$l_result= mysql_query("repair TABLE players");
$l_result= mysql_query("repair TABLE inventory");
$l_result= mysql_query("repair TABLE admins");
$l_result= mysql_query("repair TABLE mail");

include "interface/footer.php";
?>

