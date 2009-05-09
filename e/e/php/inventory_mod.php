<?php

/***********************************************
 File: inventory_mod.php
 Author: John K. Facey (NinjaLord)
 Date: Unknown
 Description: Submission page from inventory.php
              to process results of item use
 ***********************************************
 Edited By: Al Vazquez (Beagle)
 Edited On: 10/26/2003
************************************************/

session_start();
$quickstat  = "viewinv";
$private    = true;
$alive      = true;
$page_title = "Use Item Module";

include "interface/header.php";
?>

<span class="brownHeading">Inventory Management</span>

<br /><br />

<?php
$turn_cost  = 1;
$target     = $_POST['target'];
$victim_alive = true;
$give  = $_POST['give'];

$link_back = "<a href=\"player.php?player=$target\">Player Detail</a>";

if (!$target)
{
  $item   = $_GET['item'];
  if ($item != "")
    {
      $target = $_SESSION['username'];
      $link_back = "<a href=\"inventory.php\">Inventory</a>";
    }
}
else
{
  $item  = $_POST['item'];
}

if($_SESSION['turns'] > 0)
{
  if ($item != "" || $target != "")
    {

      $level_check = $_SESSION['level'] - getLevel($target);

      $target_hp    = $sql->QueryItem("SELECT health FROM players WHERE uname = '$target'");
      
      if ($target_hp > 0)
	{
	  $item_count = $sql->QueryItem("SELECT count(*) FROM inventory WHERE owner = '".$_SESSION['username']."' AND item='$item'");
	  $row = $sql->data;
	  
	  if ($item_count != 0)
	    {
	      echo "Preparing to use item - <br />\n";
	      
	      if ($give == "on" || $give == "Give")
		{
		  $sql->Insert("INSERT INTO inventory VALUES ('$target','$item')");

		  $give_msg = "You have been given a $item by ".$_SESSION['username'].".";
		  sendMessage($_SESSION['username'],$target,$give_msg);
		  
		  echo "$target will receive your $item.<br />\n";	 
		}
	      else
		{
		  $article = "a";
		  
		  // *** HP Altering ***
		  
		  if ($item == "Fire Scroll")
		    {
		      $target_damage = rand(20,$_SESSION['strength']+20);
		      $result        = "lose ".$target_damage." HP";
		      $victim_alive  = subtractHealth($target,$target_damage);
		    }
		  else if ($item == "Shuriken")
		    {
		      $target_damage = rand(0,$_SESSION['strength']+10);
		      $result        = "lose ".$target_damage." HP";
		      $victim_alive  = subtractHealth($target,$target_damage);
		    } 			  //Turn Altering
		  else if ($item == "Ice Scroll")
		    {
		      $article = "an";
		      $turns_decrease = rand(1,15);
		      $result         = "lose ".$turns_decrease." turns";
		      subtractTurns($target,$turns_decrease);
		      $victim_alive = true;
		    }
		  else if ($item == "Speed Scroll")
		    {
		      $turns_increase = 6;
		      $result         = "gain $turns_increase turns";
		      changeTurns($target,$turns_increase);
		      $covert         = true;
		      $victim_alive = true;
		    }
		  else if ($item == "Stealth Scroll")
		    {
		      addStatus($target,STEALTH);
		      echo "<br />$target is now Stealthed.<br />\n";
		      $result = false;
		      $covert =  true;
		      $victim_alive = true;
		    }
		}
	      
	      if ($result)
		{
		  // *** Message to display based on item type ***
		  if ($target_damage)
		    {
		      echo "$target's HP reduced by $target_damage.<br /><br />\n";
		    }
		  else if ($turns_decrease)
		    {
		      echo "$target's turns reduced by $turns_decrease.<br />\n";
		    }
		  else if ($turns_increase)
		    {
		      echo "$target's turns increased by $turns_increase.<br />\n";
		    }
		  
		  if (!$victim_alive)
		    {
		      if (getStatus($_SESSION['username']) && $target != $_SESSION['username'])
			{
			  $attacker_id = ($status_array['Stealth'] ? "A Stealthed Ninja" : $_SESSION['username']);

			  $gold_mod = 0.15;
			  $loot     = round($gold_mod*getGold($target));

			  subtractGold($target,$loot);
			  addGold($_SESSION['username'],$loot);
			      
			  addKills($_SESSION['username'],1);

			  echo "You have killed $target with $article $item!<br />\n";
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
			}
		      else
			{
			  $loot = 0;
			  echo "You have comitted suicide!<br />\n";
			}
		      
		      $target_email_msg   = "You have been killed by $attacker_id with $article $item at $today and lost $loot gold.";
		      sendMessage($attacker_id,$target,$target_email_msg);
		      
		      $user_email_msg     = "You have killed $target with $article $item at $today and received $loot gold.";
		      sendMessage($target,$_SESSION['username'],$user_email_msg);
		    }
		  else
		    {
		      $attacker_id = $_SESSION['username'];
		    }
		  
		  $target_email_msg   = "$attacker_id has used $article $item on you at $today and caused you to $result.";
		  sendMessage($attacker_id,$target,$target_email_msg);
		}
	      
	      // *** turn decrement ***
	      
	      subtractTurns($_SESSION['username'],$turn_cost);
	      
	      // *** remove Item ***
	      
	      echo "<br />Removing $item from your inventory.<br />\n";
	      
	      $sql->Delete("DELETE FROM inventory WHERE owner = '".$_SESSION['username']."' AND item ='$item' LIMIT 1");
	      
	      // unstealth
	      if (!$covert && getStatus($_SESSION['username']) && $status_array['Stealth'])
		{
		  subtractStatus($_SESSION['username'],STEALTH);
		  echo "Your actions have revealed you. You are no longer stealthed.<br />\n";
		}

	    }
	  else
	    {
	      echo "You do not have $item.\n";
	    }
	}
      else
	{
	  echo "$target is among the deceased.\n";
	}
    }
  else
    {
	  echo "You didn't choose an item/victim.\n";
    }
}
else
{
  echo "You have no turns. You must wait for your turns to replenish.\n";
}
?>

<br /><br />

Return to <?echo $link_back;?>

<?php
include "interface/footer.php";
?>
