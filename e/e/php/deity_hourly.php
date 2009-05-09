<?php
include "interface/header.php";

$sql->Update("UPDATE players SET turns = 0 WHERE turns < 0");

$sql->Update("UPDATE players SET health = health - CASE WHEN health-10 < 0 THEN health*(-1) ELSE 10 END WHERE status&".POISON); // *** poisoned decrement life ***

$sql->Update("UPDATE players SET status = status-".STEALTH."  WHERE status&".STEALTH); //stealth lasts 1 hr

$sql->Update("UPDATE players SET health = 0 WHERE health < 0"); // fix for poison

echo "All players below 0 HP were brought up to 0 HP.\n";

$sql->Update("UPDATE players SET turns = turns+1");         // add 1 turn an hour

$affected_rows = $sql->a_rows;
echo "Rows: " . $affected_rows."\n";


$sql->Update("UPDATE players SET turns = turns+1 WHERE class ='Blue'");         // Blue turn code

$affected_rows = $sql->a_rows;

$sql->Update("UPDATE players SET turns = 50 WHERE turns > 50"); // max turn code

$affected_rows = $sql->a_rows;

$sql->Update("UPDATE players SET status = status-".FROZEN." WHERE status&".FROZEN); // Cold Steal Crit Fail Unfreeze
$affected_row = $sql->a_rows;

$sql->Update("UPDATE players SET bounty = 0 WHERE bounty < 0");

// Database connection information here

$maxtime = time() -600;

$mySql = mysql_query("DELETE FROM ppl_online WHERE UNIX_TIMESTAMP(activity) < '$maxtime'");

$rows = mysql_affected_rows();

echo "<hr >Total of $rows Deleted<hr />\n";



// *** RANKING SCRIPT ***

$sql->Delete("DELETE FROM rankings");

$sql->Query("ALTER TABLE rankings AUTO_INCREMENT=1");

$sql->Insert("INSERT INTO rankings (score,uname,class,level,alive,days,clan) SELECT $score AS 'score',uname,class,level,CASE WHEN health = 0 THEN 0 ELSE 1 END 'health',days,CASE WHEN clan = '' THEN '(none)' WHEN clan_long_name <> '' THEN clan_long_name ELSE clan END 'clan' FROM players WHERE confirmed = 1 ORDER BY score DESC");

// *********************


include "interface/footer.php";
?>



