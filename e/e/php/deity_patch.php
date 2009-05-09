<?php
include "interface/header.php";
?>

<span style="font-weight: bold;color: red;">Deity Patch</span>

<?php
$sql->Update("UPDATE players SET turns = 50");
$affected_rows = $sql->a_rows;

include "interface/footer.php";
?>

