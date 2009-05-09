<?php

$backup = system("mysqldump -h localhost -u ninjawar_root -p VRVRVR ninjawar_ninjawars > ninjawars.sql");
echo $backup . "Hi";
?>
