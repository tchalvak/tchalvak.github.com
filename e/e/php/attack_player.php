<?php
session_start();
$private    = true;
$alive      = false;
$page_title = "Attack";
$quickstat  = "player";

include "interface/header.php";
?>
  
<span class="brownHeading">Attack</span>

<br /><br />

<p>
To attack a ninja, use the <a href="list_all_players.php?hide=dead">player list</a> or search for a ninja below.</a>
</p>

<form action="list_all_players.php" method="get">
Search by Ninja Name or Rank
<input type="textbox" name="searched" style="font-family:Verdana, Arial;font-size:xx-small;" />
<input type="hidden" name="hide" value="dead" />
<input type="submit" value="Search for Ninja" class="formButton" />
</form>

<hr />

<br />

Attack Non-Player Character
<form action="attack_npc.php" method="post">
<select name="victim">
  <option select="selected" value="">Pick a Victim</option>
  <option value="villager">Villager</option>
  <option value="merchant">Merchant</option>
  <option value="guard">Emperor's Guard</option>
  <option value="thief">Thief</option>
  <option value="samurai">Samurai</option>
</select>
<input type="hidden" name="attacked" value="1" />
<input type="submit" value="Attack Victim" class="formButton" />
</form>

<?php
include "interface/footer.php";
?>