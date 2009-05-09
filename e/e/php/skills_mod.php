<?php
session_start();
$private    = true;
$alive      = true;
$quickstat  = "player";
$page_title = "Using Skills";

include "interface/header.php";
?>

<span class="brownHeading">Skills You Posses</span>

<p>

<?php
$target    = $_POST['target'];

if ($target != "")
{
  $link_back = "<a href=\"player.php?player=$target\">Player Detail</a>";
}
else
{
  $target    = $_SESSION['username'];
  $link_back = "<a href=\"skills.php\">Skills</a>";
}

$user_ip   = $_SESSION['ip'];

$class     = $_SESSION['class'];

$command   = $_POST['command'];

$target_hp = getHealth($target);

$target_ip = $sql->QueryItem("SELECT ip FROM players WHERE uname = '$target'");

$level_check  = $_SESSION['level'] - getLevel($target);

$covert       = false;
$victim_alive = true;
$attacker_id  = $_SESSION['username'];
if (getStatus($_SESSION['username']) && $status_array['Stealth'])
{
  $attacker_id = "A Stealthed Ninja";
}
if ($target_ip != $user_ip || ($target == $_SESSION['username']))
{
  if ($class != "" && $target != "" && $command != "")
    {
      if ($target_hp > 0)
	{
	  echo "Preparing to use skill...<br />\n";
	  
	  $result = "";
	  
	  if ($class == "White")
	    {
	      if ($command == "Sight")
		{
		  $covert    = true;
		  $turn_cost = 1;
		  
		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      $msg = "You have had sight cast on you by $attacker_id at $today";
		      sendMessage($attacker_id,$target,$msg);
		      
		      $sql->QueryRow("SELECT uname,class,health,strength,gold,kills,turns,level FROM players WHERE uname='$target'");
		      
		      $sql->Fetch(0);
	      
		      echo "<table>\n";
		      echo "<tr>\n";
		      echo "  <th>Name</th>\n";
		      echo "  <th>Class</th>\n";
		      echo "  <th>Health</th>\n";
		      echo "  <th>Str</th>\n";
		      echo "  <th>Gold</th>\n";
		      echo "  <th>Kills</th>\n";
		      echo "  <th>Turns</th>\n";
		      echo "  <th>Level</th>\n";
		      echo "</tr>\n";
		      echo "<tr>\n";
		      
		      for ($i = 0; $i <= 12; $i++)
			{
			  echo "<td>".$sql->data[$i]."</td>\n";
			}
		      
		      echo "</tr>";
		      echo "</table>";
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		}
	    }
	  else if ($class == "Black")
	    {
	      if ($command == "Stealth")
		{
		  $covert     = true;
		  $stealth    = $_POST['mode'];
		  $turn_cost  = ($stealth ? 5 : 0);
		  $mode       = ($stealth ? STEALTH : (-1)*STEALTH);
		  $state      = ($stealth ? "stealthed" : "unstealthed");

		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      if (getStatus($target) && $stealth!=$status_array['Stealth'])
			{
			  addStatus($target,$mode);
			  echo "You are now $state.<br />\n";
			}
		      else
			{
			  $turn_cost = 0;
			  echo "$target is already $state.\n";
			}
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }

		}
	      else if ($command == "Poison Touch")
		{
		  $covert = true;
		  $turn_cost = 5;
		  
		  if($_SESSION['turns'] >= $turn_cost)
		    {
		      addStatus($target,POISON);
		      
		      $target_damage = rand(1,3);
		      
		      $victim_alive = subtractHealth($target,$target_damage);
		      
		      echo "$target's HP reduced by $target_damage!<br />\n";
		      
		      $msg = "You have been poisoned by $attacker_id at $today";
		      sendMessage($attacker_id,$target,$msg);
		    }
		  else 
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		} 
	    }
	  else if ($class == "Red")
	    {
	      if ($command == "Fire Bolt")
		{
		  $turn_cost = 5;
		  
		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      $target_damage = (5*(ceil($_SESSION['level']/3))+rand(1,$_SESSION['strength']));
		      
		      echo "$target's HP reduced by $target_damage!<br />\n";
		      
		      if($victim_alive = subtractHealth($target,$target_damage))
			{
			  $attacker_id  = $_SESSION['id'];
			}
		      
		      $msg = "You have had fire bolt cast on you by $attacker_id at $today";
		      sendMessage($attacker_id,$target,$msg);
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		}
	    }
	  else if ($class == "Blue")
	    {
	      if ($command == "Ice Bolt")
		{
		  $turn_cost = 5;
		  
		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      $turns_decrease = rand(1,5);
		      subtractTurns($target,$turns_decrease);
		      
		      $msg = "Ice bolt cast on you by $attacker_id at $today, your turns have been reduced by $turns_decrease.";
		      sendMessage($attacker_id,$target,$msg);
		      
		      $result = "$target's turns reduced by $turns_decrease!<br />\n";
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		}
	      else if ($command == "Cold Steal")
		{
		  $turn_cost = 3;
	      
		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      $target_turns = $sql->QueryItem("SELECT turns FROM players WHERE uname = '$target'");
		      $critical_failure = rand(1,100);

		      if ($critical_failure > 12)
			{
			  if($target_turns >= 5)
			    {
			      $turns_decrease = rand(2,6);
			      
			      subtractTurns($target,$turns_decrease);
			      addTurns($_SESSION['username'],$turns_decrease);
			      
			      $msg = "You have had Cold Steal cast on you for $turns_decrease by $attacker_id at $today";
			      sendMessage($attacker_id,$target,$msg);
			      
			      $result = "You cast Cold Steal on $target and take $turns_decrease of his turns.<br />\n";
			    }
			  else
			    {
			      $turn_cost = 0;
			      $result = "The victim did not have enough turns to give you.<br />\n";
			    }
			}
		      else
			{
			  addStatus($_SESSION['username'],FROZEN);

			  $unfreeze_time = date("F j, Y, g:i a",mktime(date("G")+1,0,0,date("m"),date("d"),date("Y")));
			  
			  $failure_msg = "You have experienced a critical failure while using Cold Steal on $today. You will be unfrozen on $unfreeze_time";
			  sendMessage("SysMsg",$_SESSION['username'],$failure_msg);
			  $result = "Cold Steal has backfired! You have lost 3 turns and are now frozen until $unfreeze_time!<br />\n";
			}
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		}
	    }
	  else if ($class == "Thief")
	    {
	      if  ($command == "Pick Pocket")
		{
		  $covert = true;
		  $turn_cost = 2;
		  
		  if ($_SESSION['turns'] >= $turn_cost)
		    {
		      $gold_decrease = rand(1,10);
		      
		      changeGold($_SESSION['username'],$gold_decrease);
		      subtractGold($target,$gold_decrease);
		      
		      $msg = "You have had pick pocket cast on you for $gold_decrease by $attacker_id at $today";
		      sendMessage($attacker_id,$target,$msg);
		      
		      $result = "$target has lost $gold_decrease, ".$_SESSION['username']." has gained $gold_decrease!<br />\n";
		    }
		  else
		    {
		      $turn_cost = 0;
		      echo "You do not have enough turns to cast $command.\n";
		    }
		}
	    }
	  
	  echo $result;

	  if (!$victim_alive)
	    {
	      if ($target != $_SESSION['username'])
		{
		  $gold_mod = 0.15;
		  $loot     = round($gold_mod*getGold($target));
	  
		  subtractGold($target,$loot);
		  addGold($_SESSION['username'],$loot);
		  
		  addKills($_SESSION['username'],1);
		  
		  echo "You have killed $target with $command!<br />\n";
		  echo "You receive $loot gold from $target.<br />\n";

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
		  
		  $target_message = "$attacker_id has killed you with $command on $today and taken $loot gold.";
		  sendMessage($attacker_id,$target,$target_message);

		  $attacker_message = "You have killed $target with $command on $today and taken $loot gold.";
		  sendMessage($target,$_SESSION['username'],$target_message);
		}
	      else
		{
		  $loot = 0;
		  echo "You have comitted suicide!<br />\n";
		}
	    }

	  subtractTurns($_SESSION['username'],$turn_cost);

	  if (!$covert && getStatus($_SESSION['username']) && $status_array['Stealth'])
	    {
	      subtractStatus($_SESSION['username'],STEALTH);
	      echo "Your actions have revealed you. You are no longer stealthed.<br />\n";
	    }
	}
      else
	{
	  echo "You can not use skills on a dead ninja.\n";
	}
    }
  else
    {
      echo "You did not choose a victim or a skill, or you do not have a class.\n";
    }
}
else
{
  echo "You cannot use skills on ninja from the same domain.";
}
?>

<br /><br />

Return to <?echo $link_back;?>

</p>

<?php
include "interface/footer.php";
?>