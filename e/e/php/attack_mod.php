<?php
session_start();
$private    = true;
$alive      = true;
$page_title = "Battle Status";
$quickstat  = "player";

include "interface/header.php";
?>

<span class="brownHeading">Battle Status</span>

<hr />

<?php
// *** ********* GET VARS FROM POST - OR GET ************* ***
$attacked = $_POST['attacked'];
$attackee = $_POST['attackee'];

if ($attacked == "") {$attacked = $_GET['attacked'];}
if ($attackee == "") {$attackee = $_GET['attackee'];}
// *** *************************************************** ***

$attackee_health    = getHealth($attackee);
$attackee_level     = getLevel($attackee);
$ee_confirmed_query = "SELECT confirmed FROM players WHERE uname = '$attackee'";
$ee_ip_query        = "SELECT ip        FROM players WHERE uname = '$attackee'";
$attackee_confirmed = $sql->QueryItem($ee_confirmed_query);
$attackee_ip        = $sql->QueryItem($ee_ip_query);
  
$attacker_health    = $_SESSION['health'];
$attacker_level     = $_SESSION['level'];
$user_turns         = $_SESSION['turns'];

// *** $attack_turns = $_GET['attack_turns']; ***
$attack_turns   = 1;
$required_turns = $attack_turns;

if (attackLegal())
{
  $attackee_str       = getStrength($attackee);

  
  $attacker_str       = $_SESSION['strength'];
  $attacker_status    = getStatus($_SESSION['username']);
  
  $level_check = 0;
  $level_check = $attacker_level - $attackee_level;

  if (!$attacker_status['Stealth'])
    {
      if ($_SESSION['class']=="Red")
	{
	  echo "(*Blazing will cause extra damage to victim)\n";
	}
      
      $what = "";
      
      // *** PRE-BATTLE STATS ***
      preBattleStats();
      
      // *** BEGIN MAIN BATTLE ALGORITHM ***
      
      $turns_counter         = $attack_turns;
      $total_attackee_damage = 0;
      $total_attacker_damage = 0;
      $attackee_damage       = 0;
      $attacker_damage       = 0;
      
      // *** Combat Calculations ***
      $round = 1;
      while ($turns_counter > 0 && $total_attackee_damage < $attacker_health && $total_attacker_damage < $attackee_health)
	{
	  $turns_counter -= ($duel != "on" ? 1 : 0);
	  
	  $attackee_damage = rand (1, $attackee_str);
	  $attacker_damage = rand (1, $attacker_str);
	  
	  if ($blaze=="on")
	    {
	      $attacker_damage += 10;
	      echo "Extra 10 damage done due to blazing!<br />\n";
	    }
	  else if ($deflect=="on")
	    {
	      $attackee_damage = round($attackee_damage/2);
	      echo "$attackee attack reduced by deflection!<br />\n";
	    }
	  
	  $total_attackee_damage += $attackee_damage;
	  $total_attacker_damage += $attacker_damage;
	  
	  echo "Round $round<br /><br />\n";
	  $round++;
	  
	  battleResults();
	}
      
      finalResults();
      
      // *** Do the work now ***
      
      $gold_mod = 0.20;
      
      subtractTurns($_SESSION['username'],$required_turns);
	  
      if ($duel=="on")
	{
	  echo "<br />Dueling has weakened you. You have lost 5 turns.<br />\n";
	  
	  $duel_log_msg     = $_SESSION['username']." has dueled $attackee at $today.";
	  sendMessage("SysMsg","SysMsg",$duel_log_msg);
	  
	  $gold_mod = 0.25;
	  $what     = "duel";
	}
      if ($blaze=="on")
	{
	  echo "Blazing has weakened you. You have lost 5 turns.<br />\n";
	}
      if ($deflect=="on")
	{
	  echo "Deflecting has weakened you. You have lost 5 turns.<br />\n";
	}
      
      //  *** Let the victim know who hit them ***
      
      $email_msg   = "You have been attacked by ".$_SESSION['username']." at $today!";
      sendMessage($_SESSION['username'],$attackee,$email_msg);
      
      if (!subtractHealth($attackee,$total_attacker_damage))
	{
	  addKills($_SESSION['username'],1);
	  subtractStatus($attackee,STEALTH+POISON+FROZEN+CLASS_STATE);
	  
	  $loot = round($gold_mod*getGold($attackee));
	  
	  addGold($_SESSION['username'],$loot);
	  subtractGold($attackee,$loot);
	  
	  $attackee_msg = "You have been killed by ".$_SESSION['username']." in combat and lost $loot gold on $today!";
	  sendMessage($_SESSION['username'],$attackee,$attackee_msg);
	  
	  $attacker_msg = "You have killed $attackee in combat and taken $loot gold on $today.";
	  sendMessage($attackee,$_SESSION['username'],$attacker_msg);
	  
	  echo $_SESSION['username']." has killed $attackee!<br />\n";
	  echo "$attackee is dead, you have proved your might!<br />\n";
	  echo "You have taken $loot gold from $attackee.<br />\n";
	  
	  $added_bounty = floor($level_check/5);
	  
	  if ($added_bounty>0)
	    {
	      addBounty($_SESSION['username'],($added_bounty*50));
	      echo "Your victim was much weaker than you. The townsfolk are angered. A bounty of ".($added_bounty*50)." gold has been placed on your head!<br />\n";
	    }
	  else
	    {
	      if($bounty = rewardBounty($_SESSION['username'],$attackee))
		{
		  echo "You have received the $bounty gold bounty on $attackee's head for your deeds!<br />\n";
		  
		  $bounty_msg = "You have valiantly slain the wanted criminal, $attackee! For your efforts, you have been awarded $bounty gold!";
		  sendMessage("Village Doshin",$_SESSION['username'],$bounty_msg);
		}
	    }
	  
	  echo "<hr />\n";
	}
      if (!subtractHealth($_SESSION['username'],$total_attackee_damage))
	{
	  addKills($attackee,1);
	  subtractStatus($_SESSION['username'],STEALTH+POISON+FROZEN+CLASS_STATE);
	  
	  $loot = round($gold_mod*getGold($_SESSION['username']));
	  
	  addGold($attackee,$loot);
	  subtractGold($_SESSION['username'],$loot);
	  
	  $attackee_msg = "You have killed ".$_SESSION['username']." in combat and taken $loot gold on $today.";
	  sendMessage($_SESSION['username'],$attackee,$attackee_msg);
	  
	  $attacker_msg = "You have been killed by $attackee in combat and lost $loot gold on $today!";
	  sendMessage($attackee,$_SESSION['username'],$attacker_msg);
 	      
	  echo "$attackee has killed ".$_SESSION['username']."!<br />\n";
	  echo "You have been slain!<br />Go to the <a href=\"shrine.php\">Shrine</a> to return to the living.\n";
	  echo "$attackee has taken $loot gold from you.<br />\n";
	  echo "<hr />\n";
	}
      echo "<a href=\"player.php?player=$attackee\">Return to Player Detail</a>\n";  
      
      // *** END MAIN BATTLE ALGORITHM ***
    }
  else if ($duel != "on")
    {
      echo "You are in Stealth mode, you quickly strike your victim!<br />\n";
      
      subtractStatus($_SESSION['username'],STEALTH);
      
      subtractTurns($_SESSION['username'],1);
      
      echo "Your attack has revealed you from the shadows! You are no longer stealthed.<br />\n";
      
      if (!subtractHealth($attackee,10))
	{
	  echo "You have slain $attackee with a dastardly attack!<br />\n";
	  echo "You do not receive recognition for this kill.<br />\n";
	  
	  $gold_mod = .1;
	  
	  subtractStatus($attackee,STEALTH+POISON+FROZEN+CLASS_STATE);
	  
	  $loot = round($gold_mod*getGold($attackee));
	  
	  addGold($_SESSION['username'],$loot);
	  subtractGold($attackee,$loot);
	  
	  $attackee_msg = "You have been killed by a stealthed ninja in combat and lost $loot gold on $today!";
	  sendMessage("A Stealthed Ninja",$attackee,$attackee_msg);
	  
	  $attacker_msg = "You have killed $attackee in combat and taken $loot gold on $today.";
	  sendMessage($attackee,$_SESSION['username'],$attacker_msg);

	  if ($added_bounty>0)
	    {
	      addBounty($_SESSION['username'],($added_bounty*50));
	      echo "Your victim was much weaker than you. The townsfolk are angered. A bounty of ".($added_bounty*50)." gold has been placed on your head!<br />\n";
	    }
	  else
	    {
	      if($bounty = rewardBounty($_SESSION['username'],$attackee))
		{
		  echo "You have received the $bounty gold bounty on $attackee's head for your deeds!<br />\n";
		  
		  $bounty_msg = "You have valiantly slain the wanted criminal, $attackee! For your efforts, you have been awarded $bounty gold!";
		  sendMessage("Village Doshin",$_SESSION['username'],$bounty_msg);
		}
	    }
	  
	  echo "<hr />\n";
	}
      else
	{
	  echo "$attackee has lost 10 HP.<br />\n";
	  
	  sendMessage($_SESSION['username'],$attackee,$_SESSION['username']." has attacked you from the shadows for 10 damage.");
	}
      
      echo "<a href=\"player.php?player=$attackee\">Return to Player Detail</a>\n";
    }
  else
    {
      echo "You may not duel when you are stealthed.<br />\n";
      echo "<a href=\"player.php?player=$attackee\">Return to Player Detail</a>\n"; 
    }
}

include "interface/footer.php";

function attackLegal()
{
  global $duel,$blaze,$deflect,$attacked,$attackee,$user_turns,$required_turns;
  global $attackee_ip,$attacker_ip,$attackee_confirmed,$attacker_health,$attackee_health;

  $attackee_status    = getStatus($attackee);

  $turns_modifier = 0;
  if ($duel     == "on") {$required_turns  = 5;$turns_modifier = 1;}
  if ($blaze    == "on") {$required_turns += (4+$turns_modifier);}
  if ($deflect  == "on") {$required_turns += (4+$turns_modifier);}

  if ($attacked == 1)
    {
      if ($attackee != "")
	{
	  if ($attackee != $_SESSION['username'])
	    {
	      if($user_turns >= $required_turns)
		{
		  if ($attackee_ip != $_SESSION['ip'])
		    {
		      if ($attackee_confirmed != 0)
			{
			  if ($attackee_health > 0)
			    {
			      if (!$attackee_status['Stealth'])
				{
				  if (getClan($attackee)!=getClan($_SESSION['username']) || getClan($_SESSION['username'] == ""))
				    {
				      return true;
				    }
				  else
				    {
				      echo "You cannot attack a ninja in the same clan as you.\n";
				      echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
				      return false;
				    }
				}
			      else
				{
				  echo "Your victim is stealthed. You cannot attack this ninja by normal means.\n";
				  echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
				  return false;
				}
			    }
			  else
			    {
			      echo "You can not attack a corpse.<br />\n";
			      echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
			      return false;
			    }
			}
		      else
			{
			  echo "You can not attack an inactive ninja.<br />\n";
			  echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
			  return false;
			}
		    }
		  else
		    {
		      echo "You can not attack a ninja from the same domain.<br />\n";
		      echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
		      return false;
		    }
		}
	      else
		{
		  echo "You do not have enough turns to execute the attack you chose.<br />\n";
		  echo "<a href=\"player.php?player=$attackee\">Return to Player Detail</a>\n";
		  return false;
		}
	    }
	  else
	    {
	      echo "Commiting suicide hasn't been implemented yet. Start your combat <a href=\"list_all_players.php\">here.</a>\n";
	      return false;
	    }
	}
      else
	{
	  echo "Your victim does not exist. Start your combat <a href=\"list_all_players.php\">here.</a>\n";
	  return false;
	}
    }
  else
    {
      echo "Start your combat <a href=\"list_all_players.php\">here.</a>\n";
      return false;
    }
}

function preBattleStats()
{
  global $attackee,$attackee_health,$attackee_str;

  echo "<table border=\"0\">\n";
  echo "<tr>\n";
  echo "  <th colspan=\"3\">\n";
  echo "  Pre-Battle Stats\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Name\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  STR\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  HP\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $_SESSION['username']."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $_SESSION['strength']."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $_SESSION['health']."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $attackee."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attackee_str."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attackee_health."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "</table>\n";
  
  echo "<hr />\n";
}

function battleResults()
{
  global $attacker_damage,$attacker_health,$attackee,$attackee_damage,$attackee_health;

  echo "<table style=\"border: 0;\">";
  echo "<tr>\n";
  echo "  <th colspan=\"3\">\n";
  echo "  Damage Dealt*\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Name\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  STR\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  HP\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $_SESSION['username']."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attacker_damage."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attacker_health."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $attackee."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attackee_damage."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attackee_health."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "</table>";
  
  echo "<hr />";
}

function finalResults()
{
  global $total_attacker_damage,$total_attackee_damage,$attackee,$attacker_health,$attackee_health;

  echo "<table style=\"border: 0;\">\n";
  echo "<tr>\n";
  echo "  <th colspan=\"3\">\n";
  echo "  Final Results\n";
  echo "  </th>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo "  Name\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  Total Dmg\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo "  HP\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $_SESSION['username']."\n";
  echo "  </td>\n";
  
  echo "  <td style=\"text-align: center;\">\n";
  echo    $total_attacker_damage."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attacker_health - $total_attackee_damage."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  echo "<tr>\n";
  echo "  <td>\n";
  echo    $attackee."\n";
  echo "  </td>\n";
  
  echo "  <td style=\"text-align: center;\">\n";
  echo    $total_attackee_damage."\n";
  echo "  </td>\n";
  
  echo "  <td>\n";
  echo    $attackee_health - $total_attacker_damage."\n";
  echo "  </td>\n";
  echo "</tr>\n";
  echo "</table>";
  
  echo "<hr />\n";
}
?>

