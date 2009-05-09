<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Advancement Chart";

include "interface/header.php";
?>

<div class="brownTitle">Dojo Chart</div>
<div class="description">
<br />
Hanging on the wall of the dojo is a scroll outlining the training requirements for all ninjas.
<br /><br />
</div>

<?php
echo "<a href=\"dojo.php\">Return to Dojo</a><hr />\n";
?>
Shows how many kills you need to progress and how your stats will change:
<table style="border: 0;\">
<tr>
  <td>
  Level
  </td>

  <td>
  Kills
  </td>

  <td>
  Str
  </td>

  <td>
  Max HP
  </td>
</tr>

<?php
$level = 1;
$kills = 0;
$str   = 5;
$hp = 150;
$MAX_LEVEL = 32;
$MAX_HP = 1000;
for ($i=1 ; $i<=$MAX_LEVEL ; $i++)
  {
    echo "<tr>\n";
    echo "  <td>\n";
    echo    $level."\n";
    echo "  </td>\n";
    
    echo "  <td>\n";
    echo    $kills."\n";
    echo "  </td>\n";
    
    echo "  <td>\n";
    echo    $str."\n";
    echo "  </td>\n";
    
    echo "  <td>\n";
    echo    $hp."\n";
    echo "  </td>\n";
    echo "</tr>\n";
    
    $level = $level + 1;
    $kills = $kills + 5;
    $str = $str + 5;
    $hp += ($hp <= $MAX_HP ? 25 : 0);
  }

echo "</table>\n";

include "interface/footer.php";
?>