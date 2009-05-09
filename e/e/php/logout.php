<?php
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Log out";

include "interface/header.php";

session_destroy();

echo "You have been logged out.\n";

include "interface/footer.php";
?>

