<?php
session_start();
$private    = false;
$alive      = false;
$quickstat  = false;
$page_title = "News";

include "interface/header.php";
?>


<span class="brownHeading">New changes to NW</span>

<div style="margin-top: 25;">
<span style="font-weight: bold;text-decoration: underline;">Updates For November 9th, 2003</span>
<ul>
  <li>Headlines:
    <ul>
      <li>A new developer has joined the team. Say hello to Tchalvak.</li>
      <li>Doshin have set up an office in the village as a base for their operations against thieves in the countryside. The Doshin also take care of some law and order in the village now. They will list the most wanted criminals and offer bounties for them.</li>
      <li>A ranking system has been put into place. Rank will be determined by your progress in the game and is updated every hour.</li>
    </ul></li>
  <li>Bandwidth Issues:
    <ul>
      <li>We've been using a serious amount of bandwidth recently, so we've started to kill some of the old, inactive accounts.</li>
      <li>We've also deleted a serious amount of in-game emails. If you're missing important emails, we apologize, but we're trying to keep the game alive and free.</li>
    </ul></li>
  <li>Clan Features:
    <ul>
      <li>Clan disbanding works properly, and notifies all clan members.</li>
      <li>Clan kick implemented.</li>
      <li>When the clan leader deletes his/her account, the clan is disbanded.</li>
      <li>You can no longer attack ninja in the same clan as you.</li>
      <li>All members of the clan may now use clan message.</li>
      <li>Clans will now be displayed next to player name on the player list.</li>
    </ul></li>
  <li>Skill Changes:
    <ul>
      <li>All skills now require their turn cost correctly. No more using 5-turn skills with under 5 turns.</li>
      <li>The skills page now shows turn cost for skills and the target list now shows levels.</li>
      <li>Cold Steal will be reinstated in a more balanced way, with a chance to have a critical failure and freeze you until the next hour.</li>
      <li>Fire Bolt has had its damage increased slightly to make it more useful.</li>
    </ul></li>
  <li>Low level protection will turned back on in a new way.
    <ul>
      <li>For every 5 levels above your victim, you will have a bounty of 50 gold placed on your head.</li>
      <li>The NPCs in the game will now have levels associated with them.</li>
    </ul></li>
  <li>Interface Changes:
    <ul>
      <li>The player list has become the focus of player actions. It is searchable and provides a player detail screen from which you can take action against your target.</li>
      <li>Your status will now be slightly more informative.</li>
      <li>Some more pages have been restricted to guests, most notably the player list.</li>
      <li>The inventory page now shows your gold and the target list now shows levels.</li>
      <li>Quickstat inventory view will now show gold.</li>
      <li>They're called Shuriken, not Throwing Stars.</li>
      <li>The menus have been changed a bit, the frames are sized better, and some coloring and stylistic things have been changed slightly.</li>
    </ul></li>
  <li>You cannot go anywhere in the village if your dead or frozen except for the shrine.</li>
  <li>You can no longer work while dead.</li>
  <li>You can now have multiple states at once (Stealthed, Poisoned, etc.)</li>
  <li>Deleting your account now requires password confirmation.</li>
</ul>
<hr />
</div>

<?php
include "interface/footer.php";
?>