<?php
session_start();
$alive      = false;
$private    = true;
$quickstat  = false;
$page_title = "Clan Panel";

include "interface/header.php";
?>

<span class="brownHeading">Clan Panel</span>

<br /><br />

<?php
$command       = $_GET['command'];
$process       = $_GET['process'];
$clan_name     = $_GET['clan_name'];
$new_clan_name = $_GET['new_clan_name'];
$sure          = $_GET['sure'];
$kicked        = $_GET['kicked'];
$clan          = getClan($_SESSION['username']);

if ($clan  != "")
{
  if ($clan == $_SESSION['username'])
    {
      if      ($command == "rename" ) {renameClan($new_clan_name);}
      else if ($command == "kick")
	{
	  if ($kicked == "")
	    {
	      $sql->Query("SELECT uname FROM players WHERE clan = '$clan' && uname <> '".$_SESSION['username']."'");
	      $members =  $sql->data;

	      echo "<form name=\"kickForm\" action=\"clan.php\" method=\"GET\">\n";
	      echo "Kick: \n";
	      echo "<select name=\"kicked\">\n";
	      echo "<option value=\"\">--Pick a Member--</option>\n";

	      for ($i = 0; $i < $sql->rows; $i++)
		{
		  $sql->Fetch($i);
		  $name = $sql->data[0];
		  echo "<option value=\"$name\">$name</option>\n";
		}

	      echo "</select>\n";
	      echo "<input type=\"hidden\" name=\"command\" value=\"kick\" />\n";
	      echo "<input type=\"submit\" value=\"Kick\" class=\"formButton\" />\n";
	      echo "</form>\n";
	      echo "<br />\n";
	    }
	  else
	    {
	      kick($kicked);

	      echo "You have removed $kicked from your clan.<br />\n";
	    }
	}
      else if ($command == "disband")
	{
	  if (!$sure)
	    {
	      echo "Are you sure you want to continue? This will remove all members from your clan.<br />\n";
	      echo "<form name=\"disband\" method=\"GET\" action=\"clan.php\">\n";
	      echo "<input type=\"submit\" value=\"Disband\" class=\"formButton\" />\n";
	      echo "<input type=\"hidden\" name=\"command\" value=\"disband\" />\n";
	      echo "<input type=\"hidden\" name=\"sure\" value=\"yes\" />\n";
	      echo "</form>\n";
	    }
	  else if ($sure == "yes")
	    {
	      disbandClan($_SESSION['username']);
	      die("Your clan has been disbanded.<br />\n");
	    }
	}
      echo "<span style=\"font-weight: bold;\">Leader Panel</span><br />\n";
      echo "<div style=\"border: thin solid white;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;width: 190px;margin-left: 5px;\">\n";
      echo "You are leader of your clan.<br /><br />\n";
      echo "Inviting is not working yet.<br /><br />\n";
      echo "<!-- <a href=\"javascript:alert('Feature not Implemented')\">Recruit for your Clan</a><br  /> -->\n";
      echo "<a href=\"clan.php?command=rename\">Rename Clan</a><br />\n";
      echo "<a href=\"clan.php?command=disband\">Disband Your Clan</a><br />\n";
      echo "<a href=\"clan.php?command=kick\">Kick a Clan Member</a><br />\n";
      echo "</div>\n";
      echo "<br /><br />\n";
    }
  else
    {
      if ($command == "leave")
	{
	  setClan($_SESSION['username'],"");
	  setClanLongName($_SESSION['username'],"");
	  die("You have left your clan.<br />\n");
	}
      
      echo "You are currently a member of the $clan's clan.<br />\n";
      echo "<a href=\"clan.php?command=leave\">Leave Current Clan</a><br />";
    }
  
  if ($command == "msgclan")
    {
      echo "<form action=\"mail_send.php\" method=\"get\">\n";
      echo "Msg: <input type=\"text\" name=\"message\" size=\"50\" style=\"font-family:Verdana,Arial;font-size:xx-small;\" /><br />\n";
      echo "<input type=\"hidden\" value=\"clansend\" name=\"to\" />\n";
      echo "<input type=\"hidden\" value=\"1\" name=\"messenger\" />\n";
      echo "<input type=\"submit\" value=\"Send This Message\" class=\"formButton\" />\n";
      echo "</form>\n";
    }

  echo "<a href=\"clan.php?command=msgclan\">Msg Clan Members</a><br />";
  echo "<a href=\"clan.php?command=view&clan_name=$clan\">View Your Clan</a><br />";
}
else
{
  
  if ($command == "new")
    {
      setClan($_SESSION['username'],$_SESSION['username']);
      die("You are now part of ".$_SESSION['username']."'s clan.\n");
    }
  else if ($command == "join")
    {
      if ($process == 1)
	{
	  $headers  = "MIME-Version: 1.0\r\n";
	  $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	  
	  /* additional headers */
	  $headers .= "From: SysMsg <SysMsg@NinjaWars.net>\r\n";
	  
	  $clan_leader_email = $sql->QueryItem("SELECT email FROM players WHERE uname = '$clan_name'");
	  $confirm = $sql->QueryItem("SELECT confirm FROM players WHERE uname = '$clan_name'");

	  mail("$clan_leader_email", "NW: Clan Request", $_SESSION['username']." has sent you a clan request<br /><br/> If you wish to allow this member into your clan click the link below or paste into browser.<hr /><br /><br />http://www.ninjawars.net/webgame/clan_confirm.php?clan_joiner=".$_SESSION['username']."&confirm=$confirm&clan_name=$clan_name<br /><br /><hr />","$headers");
	  
	  echo "***Your request to join this clan has been sent (emailed) to $clan_name***<br />\n";
	}
      else
	{
	  $sql->QueryRow("SELECT * FROM players WHERE clan <> '' AND uname = clan");
	  echo "Clans Available to Join<br />\n";
	  echo "To send a clan request click on that clan leader's name.<br />\n";
	  echo "(actual clan names will be added later)<br /><br />\n";
	  for ($i = 0; $i < $sql->rows; $i++)
	    {
	      $sql->Fetch($i);
	      $name = $sql->data[0];
	      $level = $sql->data[12];
	      $clan = $sql->data[18];
	      echo "Join <a href=\"clan.php?command=join&clan_name=$clan&process=1\">$clan's</a> Clan<br />\n";
	    }
	}
    }
  
  echo "You are not a member of any clan.<br /><br />\n";
  echo "<a href=\"clan.php?command=new\">Start a New Clan</a><br />\n";
  echo "<a href=\"clan.php?command=join\">Join a Clan</a><br />\n";
}

echo "<a href=\"clan.php?command=list\">List Clans</a><br />\n";

if ($command == "list")
{
  $sql->QueryRow("SELECT * FROM players WHERE clan <> '' AND uname = clan");
  echo "<hr />Clans List: <br /><br />\n";
  echo "<table>\n";
  echo "<tr>\n";
  echo "  <td style=\"font-weight: bold;\">\n";
  echo "  Clan\n";
  echo "  </td>\n";
  
  echo "  <td style=\"font-weight: bold;\">\n";
  echo "  Leader\n";
  echo "  </td>\n";
  
  echo "  <td style=\"font-weight: bold;\">\n";
  echo "  View\n";
  echo "  </td>\n";
  echo "</tr>\n";
  
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $name = $sql->data[0];
      $level = $sql->data[12];
      $clan = $sql->data[18];
      $clan_l_name = $sql->data[19];
      echo "<tr>\n";
      echo "  <td>\n";
      echo "  $clan_l_name\n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo "  $clan\n";
      echo "  </td>\n";
      
      echo "  <td>\n";
      echo "  <a href=\"clan.php?command=view&clan_name=$clan\">View this Clan</a>\n";
      echo "  </td>\n";
      echo "</tr>\n";
    }
  echo "</table>\n";
}
else if ($command == "view")
{
  $sql->QueryRow("SELECT uname FROM players WHERE clan = '$clan_name'");
  $row = $sql->data;
  
  echo "Clans Members: $sql->rows <br /><br />\n";
  for ($i = 0; $i < $sql->rows; $i++)
    {
      $sql->Fetch($i);
      $name = $sql->data[0];
      echo "$name<br />\n";
    }
}


include "interface/footer.php";

// *** COMMAND FUNCTIONS ***

function renameClan($new_name)
{
  global $sql;
  
  if ($new_name != "")
    {
      $sql->Update("UPDATE players SET clan_long_name = '$new_name' WHERE clan = '".$_SESSION['username']."'");
      echo "Your clan's name has been changed to <span style=\"font-weight: bold;\">$new_name.</span><br />\n";
    }
  else
    {
      echo "Do not enter a blank clan name.<br />\n";
      echo "<form action=\"clan.php\">\n";
      echo "<input type=\"hidden\" name=\"command\" value=\"rename\" />\n";
      echo "<input type=\"textbox\" name=\"new_clan_name\" ".
	     "style=\"font-family:Verdana,Arial;font-size:xx-small;\" />".
	     "<input type=\"submit\" class=\"formButton\" value=\"Rename Clan\" />\n";
      echo "</form>\n";
      echo "<hr />\n";
    }
}
?> 

