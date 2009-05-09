<?php
session_start();
$page_title = "Purchasing";
$alive      = "true";
$private    = "true";
$quickstat  = "viewinv";

include "interface/header.php";
?>

<span class="brownHeading">Shop</span>

<p>
Shop: Prices subject to change.<br /><br />

<?php
$gold = $_SESSION['gold'];

if ($item == "Fire Scroll")    { $current_item_cost = 200;}
if ($item == "Ice Scroll")     { $current_item_cost = 125;}
if ($item == "Shuriken")       { $current_item_cost = 75;}
if ($item == "Speed Scroll")   { $current_item_cost = 250;}
if ($item == "Stealth Scroll") { $current_item_cost = 300;}
if ($item == "Dim Mak")        { $current_item_cost = 10000;}

if ($current_item_cost > $gold)
{
  echo "You can not afford this item.\n";
}
else
{                                      //    Owner/     Item Name
  $sql->Insert("INSERT INTO inventory VALUES ('".$_SESSION['username']."','$item')");
    
  echo "$item has been purchased.\n";

  subtractGold($_SESSION['username'],$current_item_cost);
}

include "interface/footer.php";
?>

