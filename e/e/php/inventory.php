<?php
session_start();
$private    = true;
$alive      = false;
$quickstat  = "viewinv";
$page_title = "Your Inventory";

include "interface/header.php";
?>

<span class="brownHeading">Your Inventory</span>

<p>

<?php
$sql->QueryRow("SELECT * FROM inventory WHERE owner = '".$_SESSION['username']."'");
$row = $sql->data;
if ($sql->rows == 0)
{
  echo "You have no items, to buy some, visit the <a href=\"shop.php\">shop</a>\n";
}
else
{

  $items['Shuriken']       = 0;
  $items['Stealth Scroll'] = 0;
  $items['Fire Scroll']    = 0;
  $items['Ice Scroll']     = 0;
  $items['Speed Scroll']   = 0;

  for($i=0;$i<$sql->rows;$i++)
    {
      $sql->Fetch($i);
      $items[$item = $sql->data[1]]++;
    }

  echo "Click an item to use it on yourself.<br /><br />\n";

  echo "<table style=\"width: 100;\">\n";
  if ($items['Speed Scroll'] > 0)
    {
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  <a href=\"inventory_mod.php?item=Speed%20Scroll\">Speed Scrolls</a>: \n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo    $items['Speed Scroll']."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  if ($items['Stealth Scroll'] > 0)
    {
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  <a href=\"inventory_mod.php?item=Stealth%20Scroll\">Stealth Scrolls</a>: \n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo    $items['Stealth Scroll']."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  if ($items['Shuriken'] > 0)
    {
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  Shuriken: \n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo    $items['Shuriken']."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  if ($items['Fire Scroll'] > 0)
    {
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  Fire Scrolls: \n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo    $items['Fire Scroll']."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  if ($items['Ice Scroll'] > 0)
    {
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  Ice Scrolls: \n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo    $items['Ice Scroll']."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  echo "</table>\n";
}
?>
<br /><br />
<a href="list_all_players.php?hide=dead">Use an Item on a ninja?</a>
<form action="list_all_players.php" method="get">
<input type="text" name="searched" style="font-family:Verdana, Arial;font-size:xx-small;" />
<input type="hidden" name="hide" value="dead" />
<input type="submit" value="Search for Ninja" class="formButton" />
</form>

<br />
Current gold: <?echo $_SESSION['gold'];?>
<hr />

</p>

<?php
include "interface/footer.php";
?>