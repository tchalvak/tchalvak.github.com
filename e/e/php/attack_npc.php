<?php
session_start();
$alive      = true;
$private    = true;
$quickstat  = "player";
$page_title = "NPC Battle Status";

include "interface/header.php";
?>
  
<span class="brownHeading">Battle Status</span>

<hr />

<?php

$attacked = $_POST['attacked'];
$turn_cost = 1;
if($_SESSION['turns'] > 0)
{
  if ($attacked == 1)
    {
      echo "Commencing Attack<br /><br />\n";
      
      if (getStatus($_SESSION['username']) && $status_array['Stealth'])
	{
	  subtractStatus($_SESSION['username'],STEALTH);
	}
      
      $attacker_str    = $_SESSION['strength'];
      $attacker_health = $_SESSION['health'];
      $attacker_gold   = $_SESSION['gold'];
      
      if ($victim == "")
	{
	  
	  echo "You attack the air.\n";
	}
      else if ($victim == "villager")
	{
	  echo "The villager sees you and prepares to defend!<br /><br />\n";
	  
	  $villager_attack = rand(0,10); // *** Villager Damage ***
	  
	  if (!subtractHealth($_SESSION['username'],$villager_attack))      
	    {
	      echo "The villager has slain you!<br />\n";
	      echo "Go to the <a href=\"shrine.php\">shrine</a> to resurrect.\n";
	    }
	  else
	    {
	      $villager_gold = rand(0,15);    // *** Vilager Gold    ***
	      addGold($_SESSION['username'],$villager_gold);

	      echo "The villager is no match for you!<br />\n";
	      echo "Villager does $villager_attack points of damage.<br />\n";
	      echo "You have gained $villager_gold gold.<br />\n";

	      if ($_SESSION['level'] > 5)
		{
		  $added_bounty = floor($_SESSION['level']/5);
		  echo "You have unjustly slain a commoner! A bounty of ".($added_bounty*50)." gold has been placed on your head!<br />\n";
		  addBounty($_SESSION['username'],($added_bounty*50));
		}
	    }
	}
      else if ($victim == "samurai")
	{
	  echo "Samurai is so powerful he will be worth 1 kill point!<br /><br />\n";
	  echo "<img src=\"images/samurai.png\" border=\"0\" />\n";
	  
	  echo "Samurai is not ready for battle yet.<br />\n";
	  $turn_cost = 0;
	}
      else if ($victim == "merchant")
	{
	  echo "Merchant sees you and prepares to defend!<br /><br />\n";
	  echo "<img src=\"images/merchant.png\" border=\"0\" />";
	  
	  $merchant_attack = rand(15,35);  // *** Merchant Damage ***
	  
	  if (!subtractHealth($_SESSION['username'],$merchant_attack))
	    {
	      echo "Merchant has slain you!<br />\n";
	      echo "Go to the <a href=\"shrine.php\">shrine</a> to resurrect.<br />\n";
	    }
	  else
	    {
	      $merchant_gold   = rand(20,35);  // *** Merchant Gold   ***
	      addGold($_SESSION['username'],$merchant_gold);
	      
	      echo "The merchant is defeated<br />\n";
	      echo "Merchant does $merchant_attack points of damage<br />\n";
	      echo "You have gained $merchant_gold gold<br />\n";
	      
	      if ($merchant_attack > 34)
		{
		  $sql->Insert("INSERT INTO inventory VALUES ('".$_SESSION['username']."','Fire Scroll')");
		  echo "Merchant has dropped an item. You have a new item in your inventory.\n"; 
		}

	      if ($_SESSION['level'] > 10)
		{
		  $added_bounty = floor($_SESSION['level']/5);
		  echo "You have unjustly slain a member of the village! A bounty of ".($added_bounty*50)." gold has been placed on your head!<br />\n";
		  addBounty($_SESSION['username'],($added_bounty*50));
		}
	    }
	}
      else if ($victim == "guard")
	{
	  echo "Guard sees you and prepares to defend!<br /><br />\n";
	  echo "<img src=\"images/fighter.png\" border=\"0\" />\n";
	  
	  $guard_attack = rand(0,$attacker_str+10);  // *** Guard Damage ***
	  
	  if (!subtractHealth($_SESSION['username'],$guard_attack))
	    {
	      echo "Guard has slain you!<br />\n";
	      echo "Go to the <a href=\"shrine.php\">shrine</a> to resurrect.<br />\n";
	    }
	  else
	    {
	      $guard_gold   = rand(0,35);           // *** Guard Gold   ***
	      addGold($_SESSION['username'],$guard_gold);
	      
	      echo "The guard is defeated!<br />\n";
	      echo "Guard does $guard_attack points of damage!<br />\n";
	      echo "You have gained $guard_gold gold.<br />\n";

	      if ($_SESSION['level'] > 15)
		{
		  $added_bounty = floor($_SESSION['level']/5);
		  echo "You have unjustly slain a member of the military! A bounty of ".($added_bounty*50)." gold has been placed on your head!<br />\n";
		  addBounty($_SESSION['username'],($added_bounty*50));
		}

	    }
	}
      else if ($victim == "thief")
	{
	  echo "Thief sees you and prepares to defend!<br /><br />\n";
	  echo "<img src=\"images/thief.png\" border=\"0\" />\n";
	  
	  $thief_attack = rand(0,35);  // *** Thief Damage  ***
	  
	  if (!subtractHealth($_SESSION['username'],$thief_attack))
	    {
	      echo "Thief has slain you!<br />\n";
	      echo "Go to the <a href=\"shrine.php\">shrine</a> to resurrect.<br />\n";
	    }
	  else
	    {
	      $thief_gold    = rand(0,35);  // *** Thief Gold ***
	      
	      if ($thief_attack > 30)
		{
		  echo "Thief escaped and stole $thief_gold amount of your gold!\n";
		  subtractGold($_SESSION['username'],$thief_gold);
		}
	      else if ($thief_attack < 30)
		{
		  echo "The Thief is injured!<br />\n";
		  echo "Thief does $thief_attack points of damage!<br />\n";
		  echo "You have gained $thief_gold gold.<br /> You have found items on the thief!\n";
		  addGold($_SESSION['username'],$thief_gold);
		  
		  $sql->Insert("INSERT INTO inventory VALUES ('".$_SESSION['username']."','Shuriken')");
		}
	      
	      echo "Beware the Ninja Thieves, they have entered this world to steal from all!<br />\n";
	    }
	  
	  if (!$_SESSION['health'])
	    {
	      sendMessage("SysMsg",$_SESSION['username'],"You have been killed by a non-player character at $today");
	    }
	  
	  subtractTurns($_SESSION['username'],$turn_cost);
	}
      
      echo "<hr />\n";
      echo "<a href=\"attack_player.php\">Return to Combat</a>\n";
    }
}
else
{
  echo "You have no turns left today. Buy a speed scroll or wait for your turns to replenish.\n";
}

include "interface/footer.php";
?>
