<?php
session_start();
$alive      = true;
$private    = true;
$quickstat  = "viewinv";
$page_title = "Shop";

include "interface/header.php";
?>

<div class="brownTitle">Shop</div>

<div class="description">
You enter the village shop and the shopkeep greets you with a watchful eye.
<br /><br />
As you browse his wares he reminds you, "All prices are subject to change."
</div>

<!--Scroll shopping -->
<form id="shop_form" action="shop_mod.php" method="post" name="shop_form">
<table border="0">
<tr>
  <td>
  Item
  </td>

  <td>
  Description
  </td>

  <td>
  Cost
  </td>

  <td>
  Picture
  </td>
</tr>
<tr>
  <td>
  <input name="item" type="submit" value="Fire Scroll" class="shopButton" />
  </td>

  <td>
  Reduces HP
  </td>

  <td>
  $200
  </td>
  
  <td>
  <img src="images/scroll.png" />
</td>
</tr>
<tr>
  <td>
  <input name="item" type="submit" value="Ice Scroll" class="shopButton" />
  </td>

  <td>
  Reduces Turns
  </td>

  <td>
  $125
  </td>

  <td>
  <img src="images/scroll.png" />
  </td>
</tr>
<tr>
  <td>
  <input name="item" type="submit" value="Speed Scroll" class="shopButton" />
  </td>

  <td>
  Increases Turns
  </td>

  <td>
  $250
  </td>

  <td>
  <img src="images/scroll.png" />
  </td>
</tr>
<tr>
  <td>
  <input name="item" type="submit" value="Stealth Scroll" class="shopButton" />
  </td>

  <td>
  Stealths a Ninja(<a href="about.php#magic">*</a>)
  </td>

  <td>
  $300
  </td>

  <td>
  <img src="images/scroll.png" />
  </td>
</tr>
<tr>
  <td>
  <input name="item" type="submit" value="Shuriken" class="shopButton" />
  </td>

  <td>
  Reduces HP
  </td>

  <td>
  $75
  </td>

  <td>
  <img src="images/mini_star.png" />
  </td>
</tr>
<!--
<tr>
  <td>
  <input name="item" type="submit" value="Dim Mak" class="shopButton" />
  </td>

  <td>
  Kills Target
  </td>

  <td>
  $10,000
  </td>

  <td>
  <img src="images/scroll.png" />
  </td>
</tr>
-->
</table>
</form>

<?php
include "interface/footer.php";
?>
