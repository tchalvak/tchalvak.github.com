<?php
include "db/util.php";
$GLOBALS['GameName'] = "Ninja Wars";
$GLOBALS['PlayerType'] = "Ninja";


function ShowGameName()
{
  echo $GLOBALS['GameName'];
}

function ShowPlayerType()
{
  echo $GLOBALS['PlayerType'];
}
?>

