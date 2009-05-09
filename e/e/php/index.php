<?php
session_start();
?>
<html>
<head>
    <title>Ninja Wars: Live By the Sword.</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body class="mainBody">

<table style="border: 0;width: 820px;" cellpadding="0" cellspacing="0" align="center">
<tr>
  <td colspan="5" align="center">
  <object
   classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="656"
   height="115"
   codebase="http://active.macromedia.com/flash5/cabs/swflash.cab#version=5,0,0,0">
  <param name="MOVIE" value="ninjawars2.swf"> <param name="PLAY" value="true" />
  <param name="LOOP" value="true" />
  <param name="WMODE" value="opaque" />
  <param name="QUALITY" value="high" />
  <embed src="ninjawars2.swf" width="656" height="115" play="true" loop="true" wmode="opaque"
  quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash"></embed>
  </object>
  <!-- ***** END OF ANIMATION CODE ***** --> 
  </td>
</tr>

<tr>
  <td colspan="5">
  <img src="images/space.gif" style="height: 8px;" />
  </td>
</tr>

<tr>
  <td valign="top" colspan="5">

  <!--- menu starts here --->

  <table style="border: 0;background-color: #666666;width: 600px;" cellpadding="1" cellspacing="1" align="center">
  <tr>
    <td>
    <table style="border: 0;background-color: #333333;width: 600px;" cellpadding="1" cellspacing="0">
    <tr>
      <td><a href="main.php" target="main"><b>Home</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="about.php" target="main"><b>About</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="signup.php" target="main"><b>Sign Up</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="http://ninjawars.proboards19.com" target="_blank"><b>Message Board</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="members.php" target="main"><b>Members</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="donate.php" target="main"><b>Donate</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="staff.php" target="main"><b>Staff</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
      <td><a href="news.php" target="main"><b>News</a></td>
      <td><img src="images/space.gif" style="width: 8px;"></td>
    </tr>
    </table>
    </td>
  </tr>
  </table>

  <!--- menu ends here --->

  </td>
</tr>

<tr>
  <td colspan="5">
  <img src="images/space.gif" style="height: 8px;" />
  </td>
</tr>

<tr>
  <td style="padding-left: 6;padding-right: 15;padding-top: 6;background-color: #333333;width: 105px;" valign="top">
  <!--- left column --->

  <span class="brownHeading">Main Menu</span><br />
  <a href="login.php" target="main">Login</a><br />
  <a href="logout.php" target="main">Logout</a><br />
  <a href="about.php" target="main">About</a><br />
  <a href="tutorial.php" target="main">Tutorial</a><br />

  <hr />

  <span class="brownHeading">Command Menu</span><br />
  <a href="attack_player.php" target="main">Combat</a><br />
  <a href="clan.php" target="main">Clan</a><br />
  <a href="inventory.php" target="main">Inventory</a><br />
  <a href="skills.php" target="main">Skills</a><br />
  <a href="stats.php" target="main">Stats</a><br />
  <a href="mail_read.php" target="main">Mail</a><br />

  <hr />

  <span class="brownHeading">Village</span><br />
  <a href="doshin_office.php" target="main">Doshin Office</a><br />
  <a href="dojo.php" target="main">Dojo</a><br />
  <a href="shop.php" target="main">Shop</a><br />
  <a href="shrine.php" target="main">Shrine</a><br />
  <a href="work.php" target="main">Work</a><br />
  <a href="casino.php" target="main">Casino</a><br />

  <hr />
<?
include "db/util.php";
$sql = new MySQL_class;
$sql->Create("ninjawar_nwtest");
//$sql->Create("crux");
$player_count = $sql->QueryItem("Select count(*) FROM players WHERE confirmed = 1");
echo "<span class=\"brownHeading\">Players: $player_count</span>";
?>

  </td>
<!--- end left column --->

  <td align="center" valign="top" style="background-color: #333333;width: 575;">
  <!-- Important width setting for center table -->

  <!--- photo and caption --->

  <!-- Primary Content Block Start-->
    <iframe src="main.php" frameborder="0" height="410" width="100%" name="main"></iframe><br />
    <iframe src="google.php" frameborder="0" height="120" width="100%" name="village"></iframe>
    <!-- Primary Content Block End-->

  <!--- end photo and caption --->

  </td>

  <td style="padding-left: 6;padding-right: 8;padding-top: 6;background-color: #333333;width: 150px;" valign="top">
  <!--- right column --->
  <a href="list_all_players.php" target="main">Player List</a><br />
  <a href="village.php" target="main">Chat Room</a><br />
  <a href="http://ninjawars.proboards19.com" target="_blank">Message Board</a><br />
  <a href="duel.php" target="main">Duel Log</a><br />
  <a href="vote.php" target="main">Vote For NW </a><br />
  <a href="http://www.cafeshops.com/ninjawars" target="_blank">Online Shop</a><br />
  <a href="links.php" target="main">Links</a><br />

  <hr />
  <span class="brownHeading">Music</span> - <embed src="samsho.mid" autostart="false" width="70" height="24" loop="true"></embed>

  <hr />

  <div class="brownTitle">Quick Stats</div>
  <div style="text-align: center;">
  <a href="quickstats.php" target="quickstats">Player</a> | <a href="quickstats.php?command=viewinv" target="quickstats">Inventory</a>
  </div>

  <br />

  <iframe style="width: 100%;height: 300px;border: thin solid #ccb094;" src="quickstats.php" frameborder="0" name="quickstats"></iframe>

  <!--- end right column -->
  </td>
</tr>
<tr>
  <td colspan="5">
  <img src="images/space.gif" style="height: 8;" />
  </td>
</tr>
<tr>
  <td colspan="5" style="text-align: center;">
  Created By: <a href="http://css.active.ws/" target="_blank">Cosmic Soldier Software</a>
  </td>
</tr>
</table>

</body>
</html>
