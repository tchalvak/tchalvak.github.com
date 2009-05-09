<?php
session_start();
$alive      = true;
$private    = true;
$quickstat  = false;
$page_title = "Doshin Office";

include "interface/header.php";
?>
  
<div class="brownTitle">Doshin Office</div>

<div class="description">
You walk up to the Doshin Office to find the door locked. The Doshin are busy protecting the borders of the village from thieves.
<br /><br />
Nailed to the door is an official roster of wanted criminals and the bounties offered for their heads.
</div>


<p>
<?php

$row = $sql->Query("SELECT uname,bounty,class,level,clan,clan_long_name FROM players WHERE bounty > 0 AND confirmed = 1 ORDER BY bounty DESC");

$row = $sql->data;

if ($sql->rows)
{
  echo "Click on a Name to read a Ninja's profile.<br />\n";
  echo "You may attack/msg a Ninja from their profile.<br /><br />\n";
  
  echo "Total Wanted Ninja: ".$sql->rows."\n";
  
  echo "<hr />\n";
  
  echo "<table cellpadding=\"2\" cellspacing=\"1\" class=\"playerTable\">\n";
  echo "<tr>\n";
  echo "  <th class=\"playerTable\">\n";
  echo "  Name\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Bounty\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Level\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Class\n";
  echo "  </th>\n";
  
  echo "  <th class=\"playerTable\">\n";
  echo "  Clan\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $name = $sql->data[0]; //username
      $bounty = $sql->data[1]; // bounty
      $class = $sql->data[2]; // class
      $level = $sql->data[3]; // level
      $clan = $sql->data[4]; // clan
      $clan_l_name = $sql->data[5]; // clan long name
      
      $cla = ($cla == "" ? "(none)" : $cla);
      $clan_l_name  = ($clan_l_name == "" ? $cla : $clan_l_name);
      
      echo "<tr>\n";
      echo "  <td class=\"playerTable\">\n";
      echo "  <a href=\"player.php?player=$name\">$name</a>\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $bounty."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $level."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $class."\n";
      echo "  </td>\n";
      
      echo "  <td class=\"playerTable\">\n";
      echo    $clan_l_name."\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  
  echo "</table>\n";
}
else
{
  echo "The Doshin do not currently have any open bounties. Your village is safe.<br />\n";
}


include "interface/footer.php";
?>

