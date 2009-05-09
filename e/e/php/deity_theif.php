<?php
include "interface/header.php";
session_start();
?>
  

<span style="font-weight: bold;color: red;">Ninja Thieves Script</span>

<p>

<?php

// Living Players
// Not Thieves


$sql->QueryRow("SELECT * FROM players WHERE health > 0 AND class != 'Thief' AND gold > 25 ORDER BY uname");
$row = $sql->data;

echo "$l_result";

//$affected_rows = $sql->a_rows;

echo "<br />Potential targets: $sql->rows <br />\n";

$i = rand(1,$sql->rows);
echo "<br />Choosen target $i of $sql->rows";
{
  $sql->Fetch($i);
  $name = $sql->data[0]; //username
  $empty = $sql->data[1]; //password
  $health = $sql->data[2]; //
  $str = $sql->data[3]; // str
  $gold = $sql->data[4]; // str
  $kills = $sql->data[6]; // str
  $turns = $sql->data[7]; // str
  $empty = $sql->data[8]; // confirm
  
  $empty = $sql->data[9]; // confirmed
  $empty = $sql->data[10]; // email
  $cla = $sql->data[11]; // class
  $lev = $sql->data[12]; // class
}

echo "<br />Victim: $name  \n";


$gold_change = $gold * 0.10;
$gold_change = round($gold_change);
$new_gold = $gold - $gold_change;

echo "<br /> Thieves have stolen $gold_change of $name gold!\n";

// Subtract Gold
$sql->Update("UPDATE players SET gold = '$new_gold' WHERE uname = '$name'");
$affected_rows = $sql->a_rows;

//Inform User
$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

/* additional headers */
$headers .= "From: SysMsg <SysMsg@NinjaWars.net>\r\n";
$sql->Insert("INSERT INTO mail VALUES (0,'Thief Guild','$name','Thieves have stolen $gold_change of your gold, Follow the quest in the village if you dare')");
$affected_rows = $sql->a_rows;
mail("$email", "Ninja Thieves", "Thieves have stolen $gold_change of your gold! Follow the quest in the village if you dare!<hr />Staff: <a href=\"staff.php\">Ninja Wars Staff</a>","$headers");


//Update Thief Guild Gold
$sql->Update("UPDATE guild SET gold = gold + '$gold_change' WHERE guild_name = 'thief'");
$affected_rows = $sql->a_rows;


echo "<br />Thief Guild \n";


include('interface/footer.php');
?>

