<?php
include "interface/header.php";

$sql->Delete("DELETE FROM rankings");

$sql->Query("ALTER TABLE rankings AUTO_INCREMENT=1");

$sql->Insert("INSERT INTO rankings (score,uname,class,level,alive,days,clan) SELECT $score AS 'score',uname,class,level,CASE WHEN health = 0 THEN 0 ELSE 1 END 'health',days,CASE WHEN clan = '' THEN '(none)' WHEN clan_long_name <> '' THEN clan_long_name ELSE clan END 'clan' FROM players WHERE confirmed = 1 ORDER BY score DESC");

include "interface/footer.php";
?>