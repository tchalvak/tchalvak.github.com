<?php
session_start();
$alive      = false;
$private    = false;
$quickstat  = false;
$page_title = "Tutorial";

include "interface/header.php";
?>

<span class="brownHeading">Tutorial</span> <br /><p>
Welcome to a world that is not all it seems, be on your guard<br /><br />

<span class="brownHeading">How can I communicate with other players</span><br />
All communication is done through the Mail interface on the left side of screen.  To check your messages click Inbox. To send a message click send.  You may also do this from a players profile in the Players List.<hr />

<span class="brownHeading">I need turns, where can I get them</span><br />
You will receive 1 Turn per hour automatically(Blue Ninjas receive 2), if you need more buy a speed scroll and use it from inventory.<hr />

<span class="brownHeading">I need gold, where can I get it</span><br />
You can get a percentage of gold from killing a Ninja(Players), NPC, Stealing(Thief Class), or Clicking on Work in the Village, which will let you exchange turns for gold. Also, the Doshin Office keeps a list of ninjas with bounties on their heads. Killing those ninja will get you the bounty as a reward.<hr />

<span class="brownHeading">Using a Skill.</span><br />
Different Ninjas have different skills based on type, red, white, blue, black.  Click on skills, then choose a Ninja to use the skill on.<hr />

<span class="brownHeading">How to attack another ninja.</span><br />
You can attack another ninja by selecting combat then choosing a ninja's name or you can view the player list and attack a ninja from their profile.<hr />

<span class="brownHeading">How do I attack an NPC.</span><br />
Choose the combat link from menu. Then select an NPC.  NPC's will not yield kills, but items and gold.<hr />

<span class="brownHeading">Can I give items to another user ?</span><br />
Yes you can.  Click on Inventory, then select the item and the target/victim.  Click the checkbox below to give this item to your victim.  If you do not check this box your item will get used on the player.<hr />

<span class="brownHeading">How do I level up ?</span><br />
By killing other Ninjas you may increase you level by visiting the Dojo in the village, this will make you stronger and give you more abilities.<hr />

<?php
include "interface/footer.php";
?>