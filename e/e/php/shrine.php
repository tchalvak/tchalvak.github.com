<?php
session_start();
$page_title = "Shrine";
$alive      = false;
$private    = true;
$quickstat  = "player";

include "interface/header.php";
?>

<div class="brownTitle">Shrine</div>

<div class="description">
The shrine to the gods is peacefully quiet as you enter. The sound of flowing water soothes your mind.
<br /><br />
A monk approaches you quietly and asks, "Are you in need of healing?"
</div>

<form action="shrine_mod.php" method="post">

<br />
Cost is measured in gold per point
<br />

Heal:
<select name="heal_points">
   <option value="1">1 HP</option>
   <option value="2">2 HP</option>
   <option value="3">3 HP</option>
   <option value="4">4 HP</option>
   <option selected="selected" value="5">5 HP</option>
   <option value="10">10 HP</option>
   <option value="20">20 HP</option>
   <option value="30">30 HP</option>
   <option value="40">40 HP</option>
   <option value="50">50 HP</option>
   <option value="60">60 HP</option>
   <option value="70">70 HP</option>
   <option value="80">80 HP</option>
   <option value="90">90 HP</option>
   <option value="100">100 HP</option>
   <option value="125">125 HP</option>
   <option value="150">150 HP</option>
</select>

<input type="hidden" name="healed" value="1" />
<input type="submit" value="Get Healed" class="formButton" />
</form>

<hr />

<form action="shrine_mod.php" method="post">

<span class="brownHeading">Resurrect</span>
<p>
Resurrect to return to life. You will lose a kill point for every resurrect.
<input type="hidden" name="restore" value="1" />
<input type="submit" value="Return to life" class="formButton" />
</p>
</form>

<hr />

<form action="shrine_mod.php" method="post">
<span class="brownHeading">Antidote(remove poison)</span>
<p>
Cure Poison effect, Cost: $50.
<input type="hidden" name="poisoned" value="1" />
<input type="submit" value="Antidote" class="formButton" />
</p>
</form>

<?php
include "interface/footer.php";
?>

