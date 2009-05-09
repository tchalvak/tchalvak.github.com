<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = "player";
$page_title = "Player Detail";

include "interface/header.php";

if ($player = $_GET['player'])
{
  $player_info = $sql->QueryRow("SELECT $score AS 'score',messages,class,level,health,days,clan,clan_long_name FROM players WHERE uname = '$player'");

  $clan = $player_info['clan_long_name'];
  if (!$clan)
    {
      if (!$player_info['clan'])
	{
	  $clan = "(none)";
	}
      else
	{
	  $clan = $player_info['clan']."'s Clan";
	}
    }

  if (!$player_info['days'])
    {
      $days = "Today";
    }
  else
    {
      $days = $player_info['days']." days ago";
    }

  if (!$player_info['health'])
    {
      $status = "Dead";
    }
  else
    {
      $status  = "Alive";
    }

  echo "<table align=\"center\" style=\"width: 400px;\">\n";
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  <table align=\"right\" style=\"border: thin solid white;height: 175px;width: 175px;\">\n";
  echo "  <tr>\n";
  echo "    <th>Player Info</th>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Ninja: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      $player."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Class: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      $player_info['class']."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Level: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      $player_info['level']."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Bounty: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      getBounty($player)."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Clan: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      $clan."<br />\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Last Login: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo      $days."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td>\n";
  echo "    Status: \n";
  echo "    </td>\n";
  echo "    <td>\n";
  echo     $status."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  </table>\n";
  echo "  </td>\n";

  echo "  <td>\n";
  echo "  <table style=\"border: thin solid white;height: 175px;width: 175px;padding-left: 5;padding-top: 5;\">\n";
  echo "  <tr>\n";
  echo "    <td style=\"height: 15px;font-weight: bold;\">\n";
  echo "    Profile\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  <tr>\n";
  echo "    <td valign=\"top\">\n";
  echo      $player_info['messages']."\n";
  echo "    </td>\n";
  echo "  </tr>\n";
  echo "  </table>\n";
  echo "  </td>\n";
  echo "</tr>\n";

  if ($player != $_SESSION['username'])
    {
      echo "<tr>\n";
      echo "  <td colspan=\"2\">\n";
      echo "  <table align=\"center\" style=\"width: 275px;\">\n";
      echo "  <tr>\n";
      echo "    <td style=\"border: thin solid white;padding-left: 5;padding-right: 5;padding-top: 5;padding-bottom: 5;text-align: center;\">\n";
      echo "    <form id=\"inventory_form\" action=\"inventory_mod.php\" method=\"post\" name=\"inventory_form\">\n";
      echo "    <input type=\"hidden\" name=\"target\" value=\"$player\" />";
      echo "    <input type=\"submit\" value=\"Use\" class=\"formButton\" />\n";
      echo "  <select id=\"item\" name=\"item\">\n";
      echo "  <option selected=\"selected\" value=\"\">Your Inventory</option>\n";
      
      $sql->QueryRow("SELECT * FROM inventory WHERE owner = '".$_SESSION['username']."'");
      $row = $sql->data;
      
      for ($i = 0; $i < $sql->rows; $i++)
	{
	  $sql->Fetch($i);
	  $username = $sql->data[0]; //owner
	  $item = $sql->data[1];     //item name
	  echo "<option value=\"$item\">$item</option>\n";
	}
      
      echo "    </select>\n";
      echo "    <input type=\"submit\" value=\"Give\" name=\"give\" class=\"formButton\" />\n";
      echo "    </form>\n";
      echo "    </td>\n";
      echo "  </tr>\n";
      echo "  <tr>\n";
      echo "    <td style=\"border: thin solid white;padding-left: 5;padding-right: 5;padding-top: 5;padding-bottom: 5;text-align: center;\">\n";
      echo "<form action=\"attack_mod.php\" method=\"post\">\n";
      echo "<span style=\"border: thin solid white;padding-top: 1;padding-bottom: 1;padding-left: 1;padding-right: 1;\"><a href=\"about.php#duels\" style=\"font-weight: bold;\">Duel</a><input type=\"checkbox\" name=\"duel\" /></span>\n";
      
      if ($_SESSION['class'] == "Red")
	{
	  echo "<span style=\"border: thin solid white;padding-top: 1;padding-bottom: 1;padding-left: 1;padding-right: 1;\"><a href=\"#\">Blaze</a><input type=\"checkbox\" name=\"blaze\" /></span>\n";
	}
      else if ($_SESSION['class'] == "White")
	{
	  echo "<span style=\"border: thin solid white;padding-top: 1;padding-bottom: 1;padding-left: 1;padding-right: 1;\"><a href=\"#\">Deflect</a><input type=\"checkbox\" name=\"deflect\" /></span>\n";
	}
      echo "    <input type=\"hidden\" name=\"attackee\" value=\"$player\" />\n";
      echo "    <input type=\"hidden\" name=\"attacked\" value=\"1\" />\n";
      echo "    <br /><input type=\"submit\" value=\"Attack\" class=\"formButton\" />\n";
      echo "    </form>\n";
      echo "    </td>\n";
      echo "  </tr>\n";
      echo "  <tr>\n";
      echo "    <td style=\"border: thin solid white;padding-left: 5;padding-right: 5;padding-top: 5;padding-bottom: 5;text-align: center;\">\n";
      if ($_SESSION['class'] == "Red")
	{
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Fire Bolt\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" ><br />\n";
	  echo "(5 Turns)\n";
	  echo "</form>\n";
	}
      else if ($_SESSION['class'] == "Black")
	{
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Poison Touch\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" /><br />\n";
	  echo "(5 Turns)\n";
	  echo "</form>\n";
	}
      else if ($_SESSION['class'] == "Blue")
	{
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Ice Bolt\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" /><br />\n";
	  echo "(5 Turns)\n";
	  echo "</form>\n";
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Cold Steal\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" /><br />\n";
	  echo "(3 Turns)<br />\n";
	  echo "</form>";
	  echo "Cold Steal will take away 2 to 6 turns from your target and give them to you. Careful not to freeze yourself!\n";
	}
      else if ($_SESSION['class'] == "White")
	{
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Sight\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" /><br />\n";
	  echo "(1 Turn)\n";
	  echo "</form>\n";
	}
      else if ($_SESSION['class'] == "Thief")
	{
	  echo "<form action=\"skills_mod.php\" method=\"post\">\n";
	  echo "<input type=\"submit\" name=\"command\" value=\"Pick Pocket\" class=\"formButton\" />\n";
	  echo "<input type=\"hidden\" name=\"target\" value=\"$player\" />\n";
	  echo "</form>\n";
	}
      echo "    </td>\n";
      echo "  </tr>\n";
      echo "  <tr>\n";
      echo "    <td style=\"border: thin solid white;padding-left: 5;padding-right: 5;padding-top: 5;padding-bottom: 5;text-align: center;\">\n";
      echo "    <form action=\"mail_send.php\" method=\"get\">\n";
      echo "    <input type=\"hidden\" name=\"to\" value=\"$player\" />\n";
      echo "    <input type=\"submit\" value=\"Send Mail\" class=\"formButton\" />\n";
      echo "    <input type=\"hidden\" name=\"messenger\" value=\"1\" /><br >\n";
      echo "    <textarea name=\"message\" cols=\"25\" rows=\"2\"></textarea>\n";
      echo "    </form>\n";
      echo "    </td>\n";
      echo "  </tr>\n";
      echo "  </table>\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
      echo "</table>\n";
}

include "interface/footer.php";
?>

